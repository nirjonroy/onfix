@php
    $headerPhone = siteInfo()->topbar_phone;
    $headerTel = $headerPhone ? preg_replace('/[^0-9+]/', '', $headerPhone) : '';
    $siteName = siteInfo()->site_name ?? config('app.name', 'OnFix');
    $isServicesPage = request()->is('services*', 'service/*', 'appoinment/*', 'all-service');
    $serviceCategories = categories();
    $currentServiceCategory = request()->route('category');
@endphp

<div id="site-header-wrap">
    <header id="site-header">
        <div id="site-header-inner" class="container-fluid p-0">
            <div class="wrap-inner clearfix row">
                <div class="col-md-3 max-logo">
                    <div id="site-logo" class="clearfix">
                        <div class="bg-color-logo wrap-logo m-0">
                            <div id="site-log-inner" class="wrap-inner-logo">
                                <a class="title-logo" href="{{ route('front.home') }}" aria-label="{{ $siteName }}">
                                    <img src="{{ asset(siteInfo()->logo) }}" class="padr-10" alt="{{ $siteName }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-button">
                    <span></span>
                </div>
                <div id="load-reject" class="col-md-6">
                    <nav id="main-nav" class="main-nav">
                        <ul id="menu-primary-menu" class="menu">
                            <li class="menu-item {{ request()->routeIs('front.home') ? 'current-menu-item' : '' }}">
                                <a href="{{ route('front.home') }}">Home</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('front.about-us') ? 'current-menu-item' : '' }}">
                                <a href="{{ route('front.about-us') }}">About Us</a>
                            </li>
                            <li class="menu-item menu-item-has-children {{ $isServicesPage ? 'current-menu-item' : '' }}">
                                <a href="{{ route('front.repair.all') }}" class="after-sub">Services</a>
                                <ul class="sub-menu services-dropdown-menu">
                                    <li class="{{ request()->routeIs('front.repair.all') ? 'current-item' : '' }}">
                                        <a href="{{ route('front.repair.all') }}">All Services</a>
                                    </li>
                                    @foreach($serviceCategories as $category)
                                        <li class="{{ $currentServiceCategory === $category->slug ? 'current-item' : '' }}">
                                            <a href="{{ route('front.services.category', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item {{ request()->routeIs('front.blog', 'front.blog_details') ? 'current-menu-item' : '' }}">
                                <a href="{{ route('front.blog') }}">Blog</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('front.contact', 'front.contact_us') ? 'current-menu-item' : '' }}">
                                <a href="{{ route('front.contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>

                    <div id="header-search">
                        <a href="#" class="header-search-icon">
                            <span class="search-icon icon-search"></span>
                        </a>

                        <form role="search" method="get" class="header-search-form" action="{{ route('front.product.search') }}">
                            <label class="screen-reader-text">Search for:</label>
                            <input type="text" value="" name="query" class="header-search-field" placeholder="Search...">
                            <button type="submit" class="header-search-submit" title="Search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <div id="header-button">
                        <a href="{{ route('front.contact') }}" class="fixmo-button d-inline-flex shadow bg-white big">
                            Book a service
                            <span class="icon icon-long-arrow-right"></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 des-mar">
                    <div class="wrap-right-bar">
                        <div class="right-bar bg-color-bar">
                            <a class="icons" href="{{ $headerTel ? 'tel:' . $headerTel : '#' }}"><i class="fa fa-phone fa-lg"></i></a>
                            <ul class="p-0">
                                <li class="call-us"><a href="{{ $headerTel ? 'tel:' . $headerTel : '#' }}">Call Us</a></li>
                                <li class="number"><a href="{{ $headerTel ? 'tel:' . $headerTel : '#' }}">{{ $headerPhone }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
