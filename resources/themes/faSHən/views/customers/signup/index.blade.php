@extends('shop::layouts.master')
@section('page_title')
    {{ __('shop::app.customer.signup-form.page-title') }}
@endsection
@section('content-wrapper')


<div class="block">
    <div class="container">
        <div class="form-card">
            <h3>{{ __('shop::app.customer.signup-text.account_exists') }} - <a href="{{ route('customer.session.index') }}">{{ __('shop::app.customer.signup-text.title') }}</a></h3>
            {!! view_render_event('bagisto.shop.customers.signup.before') !!}
            <form  method="post" action="{{ route('customer.register.create') }}" @submit.prevent="onSubmit" class="account-create">
                {{ csrf_field() }}
                {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}
                <!-- First Name -->
                <label for="first_name">{{ __('shop::app.customer.signup-form.firstname') }}<span class="required">*</span></label>
                <input type="text" class="form-control input-lg" name="first_name" v-validate="'required'" value="{{ old('first_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;">
                <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                {!! view_render_event('bagisto.shop.customers.signup_form_controls.firstname.after') !!}
                <!-- /First Name -->
                <!-- Last Name -->
                <label for="last_name">{{ __('shop::app.customer.signup-form.lastname') }}<span class="required">*</span></label>
                <input type="text" class="form-control input-lg" name="last_name" v-validate="'required'" value="{{ old('last_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;">
                <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                {!! view_render_event('bagisto.shop.customers.signup_form_controls.lastname.after') !!}
                <!-- /Last Name -->
                <!-- Email -->
                <label for="email">{{ __('shop::app.customer.signup-form.email') }}<span class="required">*</span></label>
                <input type="text" class="form-control input-lg" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                {!! view_render_event('bagisto.shop.customers.signup_form_controls.email.after') !!}
                <!-- /Email -->
                <!-- Password -->
                <label>{{ __('shop::app.customer.signup-form.password') }}<span class="required">*</span></label>
                <input type="password" class="form-control input-lg" name="password" v-validate="'required|min:6'" ref="password" value="{{ old('password') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;">
                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                {!! view_render_event('bagisto.shop.customers.signup_form_controls.password.after') !!}
                <!-- /Password -->
                <!-- Confirm Password -->
                <label>{{ __('shop::app.customer.signup-form.confirm_pass') }}<span class="required">*</span></label>
                <input type="password" class="form-control input-lg" name="password_confirmation"  v-validate="'required|min:6|confirmed:password'" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.confirm_pass') }}&quot;">
                <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                <!-- /Confirm Password -->
                {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}
                <!-- button -->
                <div>
                    <button class="btn btn-lg">{{ __('shop::app.customer.signup-form.button_title') }}</button><span class="required-text">* Required Fields</span>
                </div>
                <!-- /button -->
            </form>
            {!! view_render_event('bagisto.shop.customers.signup.after') !!}
        </div>
    </div>
</div>
@endsection
