@if(core()->getConfigData('recently_purchased.settings.settings.status')==1)
    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ bagisto_asset('css/recentlypurchased.css') }}">
    @endpush
    <!-- recently purchase product -->
    <div class="media recently-purchase" data-repeat-time="<?php echo core()->getConfigData('recently_purchased.settings.settings.timer') ?>">
        <speed-booster></speed-booster>
    </div>
    <!-- recently purchase product -->


    @push('scripts')
        <script type="text/javascript" src="{{ bagisto_asset('js/recentlypurchased.js') }}"></script>
    @endpush
@endif