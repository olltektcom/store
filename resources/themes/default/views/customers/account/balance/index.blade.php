@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.balance.index.page-title') }}
@endsection

@section('account-content')
    <div class="account-layout">
        <div class="account-head mb-10">
            <span class="back-icon">
                <a href="{{ route('customer.profile.index') }}">
                    <i class="icon icon-menu-back"></i>
                </a>
            </span>

            <span class="account-heading">
                {{ __('shop::app.customer.account.balance.index.title') }}
            </span>

            <div class="horizontal-rule"></div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                <div class="card-header">
                    Pending Balance
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $pendingBalance ?? 0 }} SAR</h5>
                    <p class="card-text">This balance is subject to change according to the refund policy.</p>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                <div class="card-header">
                    Outstanding Balance
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $outstandingBalance ?? 0 }} SAR</h5>
                    <p class="card-text">This balance is available to redeem.</p>
                </div>
                </div>
            </div>
        </div>


        {!! view_render_event('bagisto.shop.customers.account.balance.list.before') !!}

        <div class="account-items-list">
            <div class="account-table-content">

                <datagrid-plus src="{{ route('customer.balance.index') }}"></datagrid-plus>

            </div>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.balance.list.after') !!}
    </div>
@endsection