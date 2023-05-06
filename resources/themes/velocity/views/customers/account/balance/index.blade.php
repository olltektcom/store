@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.balance.index.page-title') }}
@endsection

@section('page-detail-wrapper')
    <div class="account-layout">
        <!-- <div class="account-head mb-10">
            <span class="back-icon">
                <a href="{{ route('customer.profile.index') }}">
                    <i class="icon icon-menu-back"></i>
                </a>
            </span>

            <span class="account-heading">
                {{ __('shop::app.customer.account.balance.index.title') }}
            </span>

            <div class="horizontal-rule"></div>
        </div> -->

        <balance-page
            :outstandingbalance="{{ $outstandingBalance ?? 0}}"
            :pendingbalance="{{$pendingBalance ?? 0}}"
            :route="`{{ route('customer.balance.index') }}`"
        >
        </balance-page>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Redeem Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="text" class="form-control" id="amount">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" @click.prevent="redeemBalance">Redeem Now</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>


        {!! view_render_event('bagisto.shop.customers.account.balance.list.before') !!}



        {!! view_render_event('bagisto.shop.customers.account.balance.list.after') !!}
    </div>
@endsection


@push('scripts')


@endpush