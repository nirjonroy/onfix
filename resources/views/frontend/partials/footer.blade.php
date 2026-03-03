@php
    $footerPhone = siteInfo()->topbar_phone;
    $footerTel = $footerPhone ? preg_replace('/[^0-9+]/', '', $footerPhone) : '';
    $footerEmail = siteInfo()->contact_email ?? 'info@example.com';
    $footerAddress = trim((siteInfo()->address_1 ?? '') . ' ' . (siteInfo()->address_2 ?? ''));
    $siteName = siteInfo()->site_name ?? config('app.name', 'OnFix');
@endphp

<footer class="row-footer">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="container">
                <div class="row wrap-our-footer style-1">
                    <div class="col-md-4">
                        <div class="our-inner pl-style-1 bg-style-1">
                            <a class="icons pt-style-1" href="{{ $footerTel ? 'tel:' . $footerTel : '#' }}"><span class="icon-mobile-keyboard"></span></a>
                            <ul class="list-info marl-23">
                                <li class="title"><a href="{{ $footerTel ? 'tel:' . $footerTel : '#' }}">Our Phone</a></li>
                                <li class="sub-title"><a href="{{ $footerTel ? 'tel:' . $footerTel : '#' }}">{{ $footerPhone }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="our-inner pl-style-2 bg-style-2">
                            <a class="icons pt-style-2" href="mailto:{{ $footerEmail }}"><span class="font-size-33 icon-mail-open"></span></a>
                            <ul class="list-info">
                                <li class="title"><a href="mailto:{{ $footerEmail }}">Our Email</a></li>
                                <li class="sub-title"><a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="our-inner pl-style-3 bg-style-1">
                            <a class="icons pt-style-3" href="{{ route('front.contact') }}"><span class="icon-location-map"></span></a>
                            <ul class="list-info">
                                <li class="title"><a href="{{ route('front.contact') }}">Our Address</a></li>
                                <li class="sub-title"><a href="{{ route('front.contact') }}">{{ $footerAddress ?: 'Visit our service center for in-person support.' }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="themesflat-spacer clearfix" data-desktop="37" data-mobile="20" data-smobile="20"></div>
                <div class="row wrap-our-footer style-2">
                    <div class="col-md-3">
                        <div class="wrap-about">
                            <div class="logo-footer">
                                <a class="title-logo" href="{{ route('front.home') }}">
                                    <img src="{{ asset(siteInfo()->logo) }}" class="padr-10" alt="{{ $siteName }}">{{ $siteName }}
                                </a>
                                <p class="title-small sub-logo">Fast, reliable repair for phones, tablets, and laptops. We back every fix with quality parts and expert service.</p>
                            </div>
                            <div class="social-footer">
                                <ul class="list-social">
                                    <li class="item-social active"><a href="#"><span class="icon-facebook"></span></a></li>
                                    <li class="item-social"><a href="#"><span class="icon-twitter"></span></a></li>
                                    <li class="item-social"><a href="#"><span class="icon-google"></span></a></li>
                                    <li class="item-social"><a href="#"><span class="icon-linkedin-square"></span></a></li>
                                    <li class="item-social"><a href="#"><span class="icon-pinterest"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="wrap-heading-footer">
                            <h2 class="title-heading big font-size-30 text-white">Services</h2>
                        </div>
                        <div class="wrap-sub-footer">
                            <ul class="list-sub">
                                @foreach(categories()->take(5) as $item)
                                    <li class="title-sub"><a class="title-small" href="{{ route('front.services.category', ['category' => $item->slug]) }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="wrap-heading-footer style-1">
                            <h2 class="title-heading big font-size-30 text-white">Useful Links</h2>
                        </div>
                        <div class="wrap-sub-footer style-1">
                            <ul class="list-sub">
                                <li class="title-sub"><a class="title-small" href="{{ route('front.home') }}">Home</a></li>
                                <li class="title-sub"><a class="title-small" href="{{ route('front.about-us') }}">About Us</a></li>
                                <li class="title-sub"><a class="title-small" href="{{ route('front.repair.all') }}">Services</a></li>
                                <li class="title-sub"><a class="title-small" href="{{ route('front.blog') }}">Blog</a></li>
                                <li class="title-sub"><a class="title-small" href="{{ route('front.contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="wrap-heading-footer style-1">
                            <h2 class="title-heading big font-size-30 text-white">Subscribe</h2>
                            <p class="title-small">Get the latest updates via email. You may unsubscribe any time.</p>
                            <form action="#" method="post" class="form-mailchimp">
                                <div class="inner-input">
                                    <input type="email" class="mailchimp" placeholder="Email">
                                </div>
                                <div class="inner-button">
                                    <button type="submit" class="fixmo-button bg-red btn-mailchimp">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="themesflat-spacer clearfix" data-desktop="40" data-mobile="20" data-smobile="20"></div>
            </div>
            <div class="container">
                <div class="wrap-end-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="left-footer-end">
                                <p class="title-small"><a href="{{ route('front.home') }}">&copy; {{ date('Y') }} {{ $siteName }}</a> | All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right-footer-end">
                                <a class="title-small line" href="{{ route('front.about-us') }}">About</a>
                                <a class="title-small line" href="{{ route('front.repair.all') }}">Services</a>
                                <a class="title-small line" href="{{ route('front.blog') }}">Blog</a>
                                <a class="title-small" href="{{ route('front.contact') }}">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<a id="scroll-top"></a>

<script src="{{ asset('frontend/assets/fixmo/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/tether.min.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/countto.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/owl.carousel2.thumbs.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/shortcodes.js') }}"></script>
<script src="{{ asset('frontend/assets/fixmo/js/main.js') }}"></script>

@stack('js')
