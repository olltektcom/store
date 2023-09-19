<div class="footer-top bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- newsletter -->
                <div class="newsletter variant3">
                    <div class="footer-logo">
                        <a href="{{ route('shop.home.index') }}">
                                @if ($logo = core()->getCurrentChannel()->logo_url)
                                    <img class="logo" src="{{ $logo }}" />
                                @else
                                    <img class="logo" src="{{ bagisto_asset('images/logo.png') }}" />
                                @endif
                        </a>
                    </div>
                    <div class="newsletter-box">
                        <!-- input-group -->
                        @if(core()->getConfigData('customer.settings.newsletter.subscription'))
                                <form action="{{ route('shop.subscribe') }}">
                                    <div class="input-group" :class="[errors.has('subscriber_email') ? 'has-error' : '']">
                                        <input type="email" class="form-control" name="subscriber_email" placeholder="Email Address" required>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="icon icon-close-envelope"></i></button>
                                        </span>
                                    </div>
                                </form>
                        @endif

                        <?php
                            $term = request()->input('term');

                            if (! is_null($term)) {
                                $serachQuery = 'term='.request()->input('term');
                            }
                        ?>

                        <!-- /input-group -->
                    </div>
                </div>
                <!-- /newsletter -->
            </div>
            <div class="col-md-3">
            @if ($velocityMetaData)
                {!! $velocityMetaData->subscription_bar_content !!}
            @else
                <h3><span class="custom-color">HOT</span> Company news </h3>
                <div class="news-item">
                    <div class="news-date">21.10.06</div>
                    <h4 class="news-title">Neque porro quisquam est</h4>
                    <div class="news-text">
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut git, sed quia consequuntur magni dolore</p>
                        <p><a href="#" class="readmore">Read more</a></p>
                    </div>
                </div>
            @endif
            </div>
            <div class="col-md-3">
                <h3>Twitter</h3>
                <div class="social-feed">
                    <a class="twitter-timeline" href="https://twitter.com/rastventure" data-chrome="transparent nofooter noborders noheader noscrollbar" data-tweet-limit="1" data-widget-id="677235277925113856">Tweets by @rastventure</a>
                    <script>
                        ! function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0],
                                p = /^http:/.test(d.location) ? 'http' : 'https';
                            if (!d.getElementById(id)) {
                                js = d.createElement(s);
                                js.id = id;
                                js.src = p + "://platform.twitter.com/widgets.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }
                        }(document, "script", "twitter-wjs");
                    </script>
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="footer-middle">
    <div class="container">
        @if ($velocityMetaData)
                {!! $velocityMetaData->footer_left_content !!}
        @else
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>INFORMATION</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul class="marker-list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Site Map</a></li>
                                <li><a href="#">Search Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>MY ACCOUNT</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul class="marker-list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Site Map</a></li>
                                <li><a href="#">Search Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>CUSTOMER CARE</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul class="marker-list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Site Map</a></li>
                                <li><a href="#">Search Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>CONTACT US</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul class="simple-list">
                                <li><i class="icon icon-phone"></i>+01 234 567 89</li>
                                <li><i class="icon icon-close-envelope"></i><a href="mailto:support@rastventure.com">support@rastventure.com</a></li>
                                <li><i class="icon icon-clock"></i>8:00 - 19:00, Monday - Saturday</li>
                            </ul>
                            <div class="footer-social">
                                <a href="#"><i class="icon icon-facebook-logo icon-circled"></i></a> <a href="#"><i class="icon icon-twitter-logo icon-circled"></i></a> <a href="#"><i class="icon icon-skype-logo icon-circled"></i></a> <a href="#"><i class="icon icon-vimeo icon-circled"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="footer-bot">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-8">
                <div class="image-banner text-center">
                    <a href="#"> <img src="{{ bagisto_asset('images/banners/footer-banner.jpg') }}" alt="Footer Banner" class="img-responsive"> </a>
                </div>
            </div>
            <div class=" col-md-6 col-lg-4">
                <div class="footer-copyright text-center"> ©@php echo date("Y") @endphp Demo Store. All Rights Reserved. </div>
                <div class="footer-payment-link text-center">
                    <a href="#"><img src="{{ bagisto_asset('images/payment-logo/icon-pay-1.png') }}" alt=""></a>
                    <a href="#"><img src="{{ bagisto_asset('images/payment-logo/icon-pay-2.png') }}" alt=""></a>
                    <a href="#"><img src="{{ bagisto_asset('images/payment-logo/icon-pay-3.png') }}" alt=""></a>
                    <a href="#"><img src="{{ bagisto_asset('images/payment-logo/icon-pay-4.png') }}" alt=""></a>

                </div>
            </div>
        </div>
    </div>
</div>