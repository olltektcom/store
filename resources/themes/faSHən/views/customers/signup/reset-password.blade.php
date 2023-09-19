@extends('shop::layouts.master')

@section('page_title')
 {{ __('shop::app.customer.reset-password.title') }}
@endsection

@section('content-wrapper')

<div class="block">
    <div class="container">
        <div class="form-card">
        <h3>{{ __('shop::app.customer.reset-password.title') }}</h3>
            {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}

            <form method="post" action="{{ route('customer.reset-password.store') }}" >

                {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ old('token') ?: $token }}">

                    {!! view_render_event('bagisto.shop.customers.reset_password_form_controls.before') !!}

                    <!-- Email -->
                    <label for="email">{{ __('shop::app.customer.signup-form.email') }}<span class="required">*</span></label>
                    <input type="text" class="form-control input-lg" name="email" v-validate="'required|email'" value="{{ old('email') }}">
                    <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                    <!-- /Email -->

                    <!-- Password -->
                    <label>{{ __('shop::app.customer.signup-form.password') }}<span class="required">*</span></label>
                    <input type="password" class="form-control input-lg" name="password" v-validate="'required|min:6'" ref="password" value="{{ old('password') }}">
                    <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                    <!-- /Password -->
                    <!-- Confirm Password -->
                    <label>{{ __('shop::app.customer.signup-form.confirm_pass') }}<span class="required">*</span></label>
                    <input type="password" class="form-control input-lg" name="password_confirmation"  v-validate="'required|min:6|confirmed:password'">
                    <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                    <!-- /Confirm Password -->

                    {!! view_render_event('bagisto.shop.customers.reset_password_form_controls.before') !!}

                    <div>
                        <button class="btn btn-lg">{{ __('shop::app.customer.reset-password.submit-btn-title') }}</button><span class="required-text">* Required Fields</span>
                    </div>

            </form>

    {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}
        </div>
    </div>
</div>
@endsection