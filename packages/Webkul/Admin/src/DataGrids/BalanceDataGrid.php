<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;
use Webkul\Customer\Models\Customer;

class BalanceDataGrid extends DataGrid
{
    protected $index = 'id';

    // protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = Customer::select('customers.id', 'customers.first_name', 'customers.email', 'customers.phone', DB::raw('SUM(cart_items.profit) as total_profit'))
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->join('cart', 'orders.cart_id', '=', 'cart.id')
            ->join('cart_items', 'cart.id', '=', 'cart_items.cart_id')
            ->groupBy('customers.id');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'first_name',
            'label'      => trans('admin::app.profit.first_name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index'      => 'email',
            'label'      => trans('admin::app.profit.email'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'email',
            'label'      => trans('admin::app.profit.phone'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'total_profit',
            'label'      => trans('admin::app.profit.total_profit'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);
    }

    public function prepareActions()
    {
        // $this->addAction([
        //     'title'  => trans('admin::app.datagrid.edit'),
        //     'method' => 'GET',
        //     'route'  => 'admin.catalog.families.edit',
        //     'icon'   => 'icon pencil-lg-icon',
        // ]);

        // $this->addAction([
        //     'title'  => trans('admin::app.datagrid.delete'),
        //     'method' => 'POST',
        //     'route'  => 'admin.catalog.families.delete',
        //     'icon'   => 'icon trash-icon',
        // ]);
    }
}