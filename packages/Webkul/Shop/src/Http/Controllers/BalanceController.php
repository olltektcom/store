<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Webkul\Admin\DataGrids\BalanceDataGrid;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Customer\Repositories\WishlistRepository;
use Webkul\CartRule\Repositories\CartRuleCouponRepository;
use Webkul\Sales\Models\Order;

class BalanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Customer\Repositories\CartItemRepository  $wishlistRepository
     * @param  \Webkul\Product\Repositories\ProductRepository  $productRepository
     * @param  \Webkul\CartRule\Repositories\CartRuleCouponRepository  $cartRuleCouponRepository
     * @return void
     */
    public function __construct(
        protected WishlistRepository $wishlistRepository,
        protected ProductRepository $productRepository,
        protected CartRuleCouponRepository $cartRuleCouponRepository
    )
    {
        $this->middleware('throttle:5,1')->only('applyCoupon');

        $this->middleware('customer')->only('moveToWishlist');

        parent::__construct();
    }

    /**
     * Method to populate the cart page which will be populated before the checkout process.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(BalanceDataGrid::class)->toJson();
        }

        $outstandingBalance = DB::table('cart_items')
            ->join('cart', 'cart_items.cart_id', '=', 'cart.id')
            ->joinSub(
                DB::table('orders')->select('id', 'cart_id'),
                'order_carts',
                function ($join) {
                    $join->on('cart.id', '=', 'order_carts.cart_id');
                }
            )
            ->join('orders', 'order_carts.id', '=', 'orders.id')
            ->select(DB::raw('SUM(cart_items.profit) as outstanding_balance'))
            ->where('orders.status', '=', Order::STATUS_COMPLETED)
            ->where('orders.created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 14 DAY)'))
            ->where('orders.customer_id', '=', auth()->guard('customer')->user()->id)
            ->get()
            ->first()
            ->outstanding_balance ?? 0;

        $pendingBalance = DB::table('cart_items')
            ->join('cart', 'cart_items.cart_id', '=', 'cart.id')
            ->joinSub(
                DB::table('orders')->select('id', 'cart_id'),
                'order_carts',
                function ($join) {
                    $join->on('cart.id', '=', 'order_carts.cart_id');
                }
            )
            ->join('orders', 'order_carts.id', '=', 'orders.id')
            ->select(DB::raw('SUM(cart_items.profit) as pending_balance'))
            ->where('orders.status', '=', Order::STATUS_PENDING)
            ->orWhere('orders.created_at', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 14 DAY)'))
            ->where('orders.customer_id', '=', auth()->guard('customer')->user()->id)
            ->get()
            ->first()
            ->pending_balance ?? 0;

        return view($this->_config['view'], compact('outstandingBalance', 'pendingBalance'));
    }
}
