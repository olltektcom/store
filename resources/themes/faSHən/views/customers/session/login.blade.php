{!! view_render_event('bagisto.shop.layout.header.account-item.before') !!}
<div class="header-link dropdown-link header-account">
    <a href="#"><i class="icon icon-user"></i></a>
    @guest('customer')
        <div class="dropdown-container right">
            @php 
                    $validateEmail = 'v-validate="\'required|email\'"';
                    $validatePassword =  'v-validate="\'required|min:6\'"';
                    if((strpos(Request::url(),"customer/register") || strpos(Request::url(),"customer/login"))===false){
                        $validateEmail=$validatePassword="";

            @endphp
            <div class="title">Registered Customers</div>
            <div class="top-text">If you have an account with us, please log in.</div>
            
            {!! view_render_event('bagisto.shop.customers.login.before') !!}
                <!-- form -->
                <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">
                    {{ csrf_field() }}
                    {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}
                    <input type="text" class="form-control" name="email"  value="{{ old('email') }}" @php echo $validateEmail @endphp data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;">
                    <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                    <input type="password" @php echo $validatePassword; @endphp  class="form-control" id="password" name="password" value=""/>
                    <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                    {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}
                    <a class="reset-password" href="{{ route('customer.forgot-password.create') }}">{{ __('shop::app.customer.login-form.forgot_pass') }}</a>
                    @if (Cookie::has('enable-resend'))
                        @if (Cookie::get('enable-resend') == true)
                            <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                        @endif
                    @endif
                    <button type="submit" class="btn">{{ __('shop::app.customer.login-form.button_title') }}</button>
                </form>
                <!-- /form -->
            @php
            }else{
            @endphp
                <div class="bottom-text">If you have an account with us, please <a href="{{ route('customer.session.index') }}">log in</a>.</div>
            @php
            }
            @endphp
            {!! view_render_event('bagisto.shop.customers.login.after') !!}
            
            <div class="title">OR</div>
            <div class="bottom-text">Create a <a href="{{ route('customer.register.index') }}">New Account</a></div>
        </div>
    @endguest

    @auth('customer')
    <div class="dropdown-container right my-account-links">
                    <div class="username">
                        <label>
                            {{ auth()->guard('customer')->user()->first_name }}
                        </label>
                    </div>

                    <ul class="profile-links">
                        <li>
                            <a href="{{ route('customer.profile.index') }}">{{ __('shop::app.header.profile') }}</a>
                        </li>

                        <li>
                            <a href="{{ route('customer.wishlist.index') }}">{{ __('shop::app.header.wishlist') }}</a>
                        </li>

                        <li>
                            <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.header.cart') }}</a>
                        </li>

                        <li>
                            <a href="{{ route('customer.session.destroy') }}">{{ __('shop::app.header.logout') }}</a>
                        </li>
                    </ul>

        </div>
        
    @endauth

    
</div>
{!! view_render_event('bagisto.shop.layout.header.account-item.after') !!}