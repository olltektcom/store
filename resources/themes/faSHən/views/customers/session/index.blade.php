@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')
<div class="block">
    <div class="container">
        <div class="form-card">
            <h3>{{ __('shop::app.customer.login-text.no_account') }} - <a href="{{ route('customer.register.index') }}">{{ __('shop::app.customer.login-text.title') }}</a></h3>
            

        {!! view_render_event('bagisto.shop.customers.login.before') !!}

        <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">
            {{ csrf_field() }}
            <div class="login-form">
                <div class="login-text">{{ __('shop::app.customer.login-form.title') }}</div>

                {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}
                <!-- Email -->
                <label for="email">{{ __('shop::app.customer.signup-form.email') }}<span class="required">*</span></label>
                <input type="text" class="form-control input-lg" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                <!-- /Email -->
                <!-- Password -->
                <label>{{ __('shop::app.customer.signup-form.password') }}<span class="required">*</span></label>
                <input type="password" class="form-control input-lg" name="password" v-validate="'required|min:6'" ref="password" value="{{ old('password') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;">
                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                <!-- /Password -->

                {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                <div class="forgot-password-link">
                    <a href="{{ route('customer.forgot-password.create') }}">{{ __('shop::app.customer.login-form.forgot_pass') }}</a>

                    <div class="mt-10">
                        @if (Cookie::has('enable-resend'))
                            @if (Cookie::get('enable-resend') == true)
                                <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                            @endif
                        @endif
                    </div>
                </div>

                <input class="btn btn-lg" type="submit" value="{{ __('shop::app.customer.login-form.button_title') }}">
            </div>
        </form>

        {!! view_render_event('bagisto.shop.customers.login.after') !!}
        </div>
    </div>
</div>
@stop

