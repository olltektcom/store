
@push('scripts')
    <link rel="stylesheet" href="{{ bagisto_asset('css/recentlypurchased.css') }}">
@endpush
<!-- recently purchase product -->
<div class="media recently-purchase">
    <img src="{{ bagisto_asset('images/sm.jpg') }}" alt="Floral Dress ">
    <div class="media-body">
        <div>
            <div class="title">
                Some recently purchase this item
            </div>
            <a href="#">
                <span class="product-name">
                    Floral Dress
                </span>
            </a>
            <small class="timeAgo">50 minutes ago</small>
        </div>
    </div>
    <a href="javascript:void(0)" class="close-popup fa fa-times"></a>
</div>
<!-- recently purchase product -->


@push('scripts')
    <script type="text/javascript" src="{{ bagisto_asset('js/recentlypurchased.js') }}"></script>
@endpush