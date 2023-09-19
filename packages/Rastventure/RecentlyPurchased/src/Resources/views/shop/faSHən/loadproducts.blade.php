@if(core()->getConfigData('recently_purchased.settings.settings.status')==1)
@php
$products_list=array();
$product_options = array();
$locations = ( core()->getConfigData('recently_purchased.settings.settings.locations') )!="" ?
core()->getConfigData('recently_purchased.settings.settings.locations') : '[Washington D.C., USA]; [Mumbai, India IN]';

$locations = explode( ';', $locations );
if ( count( $locations ) ) {
$locations_parsed = array();
foreach ( $locations as $location ) {
$location = str_replace( array( '[', ']', '; ' ), array( '' ), $location );
$location = explode( ',', $location );
$locations_parsed[] = $location;
}
}
@endphp
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
@foreach (app('Rastventure\RecentlyPurchased\Repositories\RecentlyPurchasedRepository')->getRecentlyPurchasedProdct() as $product)
<?php
$productBaseImage = productimage()->getProductBaseImage($product);
$product_options['title'] = $product->name;
$product_options['image'] = $productBaseImage['small_image_url'];
$product_options['url'] = route('shop.productOrCategory.index', $product->url_key);
$product_options['price'] = $product->price;
$product_options['time_ago'] = rand(2, 59);
$product_options['location'] = implode(', ', $locations_parsed[rand(0, count($locations_parsed) - 1)]);
$products_list[] = $product_options;
$productBaseImage = "";
?>
@endforeach

@push('scripts')
<script type="text/javascript" id="sales-booster-popup-products">
    @php echo json_encode($products_list);
    @endphp
</script>
@endpush
@endif