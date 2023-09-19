@if ($bookingProduct->default_slot->duration)
    <div class="booking-info-row">
        <span class="icon bp-slot-icon"></span>
        <span class="title">
            {{ __('fashion::app.shop.products.slot-duration') }} :

            {{ __('fashion::app.shop.products.slot-duration-in-minutes', ['minutes' => $bookingProduct->default_slot->duration]) }}
        </span>
    </div>
@endif

@include ('fashion::shop.products.view.booking.slots', ['bookingProduct' => $bookingProduct])