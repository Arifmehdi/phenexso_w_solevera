<footer class="footer">
    <div class="container">
        {{--<div class="footer-top">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <a href="{{ route('home') }}" class="logo-footer">
                        // <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->footer_logo()]) }}" alt="logo-footer" width="154" height="43" />
                    </a>
                    <!-- End FooterLogo -->
                </div>
                <div class="col-lg-9">
                    <div class="widget widget-newsletter form-wrapper form-wrapper-inline">
                        <div class="newsletter-info mx-auto mr-lg-2 ml-lg-4">
                            <h4 class="widget-title">Subscribe to our Newsletter</h4>
                            <p>Get all the latest information, Sales and Offers.</p>
                        </div>
                        <form action="#" class="input-wrapper input-wrapper-inline">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Email address here..." required />
                            <button class="btn btn-primary btn-rounded btn-md ml-2" type="submit">subscribe<i
                                    class="d-icon-arrow-right"></i></button>
                        </form>
                    </div>
                    <!-- End Newsletter -->
                </div>
            </div>
        </div>--}}
        <!-- End FooterTop -->
        <div class="footer-middle">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget widget-info">
                        <h4 class="widget-title">Contact Info</h4>
                        <ul class="widget-body">
                            <li>
                                <label>Phone:</label>
                                <a href="tel:{{ $ws->contact_mobile }}">{{ $ws->contact_mobile }}</a>
                            </li>
                            <li>
                                <label>Email:</label>
                                <a href="mailto:{{ $ws->contact_email }}">{{ $ws->contact_email }}</a>
                            </li>
                            <li>
                                <label>Address:</label>
                                <a href="#">{{ $ws->contact_address }}</a>
                            </li>
                            <li>
                                <label>WORKING DAYS / HOURS:</label>
                            </li>
                            <li>
                                <a href="#">{{ $ws->working_day ?? 'Mon - Sun / 9:00 AM - 8:00 PM' }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Widget -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget ml-lg-4">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="widget-body">
                            <li>
                                <a href="{{ route('about-us') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('user.orders', 'all') }}">Order History</a>
                            </li>
                            <li>
                                <a href="{{ route('return-policy') }}">Returns</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">Custom Service</a>
                            </li>
                            <li>
                                <a href="{{ route('terms') }}">Terms &amp; Condition</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Widget -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget ml-lg-4">
                        <h4 class="widget-title">Quick Links</h4>
                        <ul class="widget-body">
                            @foreach($footerMenus as $menu)
                            <li>
                                <a href="{{ $menu->link }}">{{ $menu->name_en }}</a>
                            </li>
                            @endforeach
                            <li>
                                <a href="{{ route('cart') }}">View Cart</a>
                            </li>
                            <li>
                                <a href="{{ route('wishlist.index') }}">My Wishlist</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Widget -->
                </div>

                {{--<div class="col-lg-3 col-md-6">
                    <div class="widget widget-instagram">
                        <h4 class="widget-title">Instagram</h4>
                        <figure class="widget-body row">
                            <div class="col-3">
                                <img src="{{ asset('sungoods/images/instagram/01.jpg') }}" alt="instagram 1" width="64" height="64" />
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('sungoods/images/instagram/02.jpg') }}" alt="instagram 2" width="64" height="64" />
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('sungoods/images/instagram/03.jpg') }}" alt="instagram 3" width="64" height="64" />
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('sungoods/images/instagram/04.jpg') }}" alt="instagram 4" width="64" height="64" />
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('sungoods/images/instagram/05.jpg') }}" alt="instagram 5" width="64" height="64" />
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('sungoods/images/instagram/06.jpg') }}" alt="instagram 6" width="64" height="64" />
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('sungoods/images/instagram/07.jpg') }}" alt="instagram 7" width="64" height="64" />
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('sungoods/images/instagram/08.jpg') }}" alt="instagram 8" width="64" height="64" />
                            </div>
                        </figure>
                    </div>
                    <!-- End Instagram -->
                </div>--}}

                <div class="col-lg-3 col-md-6">
    <div class="widget ml-lg-4">
        <h4 class="widget-title">Download Our App</h4>

        <p class="mb-3">Get our app for the best shopping experience.</p>

        <div class="app-links">
            {{-- Google Play --}}
            <a href="{{ $ws->playstore_url ?? '#' }}" target="_blank" class="d-block mb-2">
                <img src="{{ asset('sungoods/images/app/play_store.png') }}" 
                     alt="Google Play" 
                     style="max-width: 150px;">
            </a>

            {{-- App Store (optional) --}}
            <a href="{{ $ws->appstore_url ?? '#' }}" target="_blank" class="d-block">
                <img src="{{ asset('sungoods/images/app/app_store.png') }}" 
                     alt="App Store" 
                     style="max-width: 150px;">
            </a>
        </div>
    </div>
</div>
            </div>
        </div>
        <!-- End FooterMiddle -->
        <div class="footer-bottom">
            <div class="footer-left">
                <figure class="payment">
                    <img src="{{ asset('sungoods/images/payment.png') }}" alt="payment" width="159" height="29" />
                </figure>
            </div>
            <div class="footer-center">
                <p class="copyright">
                    <a href="https://phenexsoft.com/" target="_blank">Phenexsoft IT</a> © 2026. All Rights Reserved
                </p>
            </div>
            <div class="footer-right">
                <div class="social-links">
                    <a href="{{ $ws->fb_url ?? '#' }}" title="social-link" class="social-link social-facebook fab fa-facebook-f" target="_blank"></a>
                    <a href="{{ $ws->twitter_url ?? '#' }}" title="social-link" class="social-link social-twitter fab fa-twitter" target="_blank"></a>
                    <a href="{{ $ws->youtube_url ?? '#' }}" title="social-link" class="social-link social-youtube fab fa-youtube" target="_blank"></a>
                </div>
            </div>
        </div>
        <!-- End FooterBottom -->
    </div>
</footer>
