@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 1)->first();
    $metaTitle = $SeoSettings->meta_title ?: $SeoSettings->seo_title;
    $metaDescription = $SeoSettings->meta_description ?: $SeoSettings->seo_description;
    $metaImage = $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings->site_name ?: $SeoSettings->seo_title;
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'DC-Phone-Repair-Home')
@push('css')

@endpush
@section('seos')
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $SeoSettings->seo_title }}">
    <meta name="description" content="{{ $SeoSettings->seo_description }}">
    @if($SeoSettings->keywords)
        <meta name="keywords" content="{{ $SeoSettings->keywords }}">
    @endif
    @if($SeoSettings->author)
        <meta name="author" content="{{ $SeoSettings->author }}">
    @endif
    @if($SeoSettings->publisher)
        <meta name="publisher" content="{{ $SeoSettings->publisher }}">
        <meta property="article:publisher" content="{{ $SeoSettings->publisher }}">
    @endif
    @if($SeoSettings->copyright)
        <meta name="copyright" content="{{ $SeoSettings->copyright }}">
    @endif

    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $siteName }}">

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    @if($metaImage)
        <meta property="og:image" content="{{ $metaImage }}">
    @endif
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="article:modified_time" content="2023-03-01T12:33:34+00:00">
    <meta name="twitter:card" content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:url" content="">
    @if($metaImage)
        <meta name="twitter:image" content="{{ $metaImage }}">
    @endif
@endsection
@section('content')
@php
    $fixmo = 'frontend/assets/fixmo';
    $hero = $sliders->first();
    $heroPhone = siteInfo()->topbar_phone;
    $heroTel = $heroPhone ? preg_replace('/[^0-9+]/', '', $heroPhone) : '';
    $serviceIcons = [
        'icon-phonendoscope',
        'icon-smartphone-broken',
        'icon-plaster',
        'icon-tablet-broken',
        'icon-sync-laptop',
        'icon-smartphone-repair',
    ];
    $featuredTop = $feateuredCategories->take(3);
    $serviceProducts = $products->take(6);
    $aboutTitle = optional($about)->title ?: 'We Fix All Devices, All Problems';
    $aboutExcerpt = optional($about)->description_three ?: 'Fast diagnostics, quality parts, and honest pricing for every repair.';
@endphp

<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">
                    <!-- Banner -->
                    <section class="fixmo-banner">
                        <div class="container-fluid p-0">
                            <div class="row m-0 wrap-height">
                                <div class="col-md-5 col-left-banner">
                                    <div class="wrap-banner-left">
                                        <img class="img-banner" src="{{ asset($fixmo . '/img/banner/banner-left.jpg') }}" alt="Banner">
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $hero && $hero->image ? asset($hero->image) : asset($fixmo . '/img/banner/banner-right-1.jpg') }}" alt="Banner">
                                    </div>
                                </div>
                                <div class="wrap-banner-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                                    <div class="frame-title">
                                        <h5 class="title-heading small">{{ $siteName }}</h5>
                                        <h1 class="title-heading big">{{ optional($hero)->title_one ?? 'Your device deserves expert care' }}</h1>
                                        <h6 class="title-small">{{ optional($hero)->title_two ?? 'Smartphone, tablet, and laptop repair with fast turnaround and transparent pricing.' }}</h6>
                                    </div>
                                    <div class="frame-button">
                                        <a href="{{ route('front.contact') }}" class="fixmo-button d-inline-flex shadow bg-red big">
                                            Book a service
                                            <span class="icon icon-long-arrow-right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="200" data-smobile="60"></div>
                    </section>
                    <!-- End Banner -->

                    <!-- SERVICES -->
                    <section class="row-services">
                        <div class="container par-ser">
                            <div class="row mr-0 wow rollIn">
                                <div class="col-md-12 pr-0 wow fadeInDown center">
                                    <div class="themesflat-headings style-1 text-center clearfix">
                                        <div class="wrap-inner-small">
                                            <h5 class="title-heading small">Why Choose Us</h5>
                                        </div>
                                        <div class="wrap-inner-big">
                                            <h2 class="title-heading big">Experts Trusted Us</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="16" data-mobile="0" data-smobile="0"></div>
                            <div class="row wrap-row-services">
                                @forelse($featuredTop as $item)
                                    @php
                                        $icon = $serviceIcons[$loop->index] ?? 'icon-smartphone-repair';
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="themesflat-image-box style-1 has-icon icon-right w65 clearfix wow fadeInUp" data-wow-delay="{{ $loop->index * 200 }}ms" data-wow-duration="1500ms">
                                            <div class="image-box-item clearfix">
                                                <div class="inner">
                                                    <div class="thumb data-effect-item">
                                                        <img src="{{ asset($item->category->image) }}" alt="{{ $item->category->name }}">
                                                        <div class="overlay-effect bg-color-accent"></div>
                                                    </div>
                                                    <div class="text-wrap">
                                                        <div class="row m-0">
                                                            <div class="col-md-3">
                                                                <div class="icon">
                                                                    <span class="{{ $icon }}"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="title">
                                                                    <h4 class="title-heading big">
                                                                        <a href="{{ route('front.services.category', ['category' => $item->category->slug]) }}">{{ $item->category->name }}</a>
                                                                    </h4>
                                                                    <p class="title-small mb-0">{!! Str::limit($item->category->short_description, 90, '...') !!}</p>
                                                                </div>
                                                                <div class="frame-button">
                                                                    <a href="{{ route('front.services.category', ['category' => $item->category->slug]) }}" class="fixmo-button btn-font-1">
                                                                        Read More
                                                                        <span class="icon"><i class="fa fa-arrow-right"></i></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12">
                                        <p class="title-small text-center">No featured services available right now.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                    <!-- END SERVICES -->

                    <!-- ABOUT US -->
                    <section class="row-aboutus">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-8 left-about parallax parallax-1"></div>
                                <div class="col-md-4 right-about">
                                    <img src="{{ asset($fixmo . '/img/about-us/about-mask.png') }}" alt="About">
                                </div>
                                <div class="wrap-about-title wow fadeInRight">
                                    <div class="frame-title">
                                        <h2 class="title-heading big text-white">{{ $aboutTitle }}</h2>
                                        <h6 class="title-small text-white">{{ $aboutExcerpt }}</h6>
                                    </div>
                                    <div class="frame-title-row">
                                        <div class="container-fluid p-0">
                                            <div class="device-frame">
                                                <div class="row-title">
                                                    <a href="{{ route('front.repair.all') }}">
                                                        <h3 class="title-heading big text-white">Quality Control System</h3>
                                                    </a>
                                                    <p class="title-small text-white">Every device passes a full diagnostic and quality checklist before pickup.</p>
                                                </div>
                                                <div class="row-title">
                                                    <a href="{{ route('front.repair.all') }}">
                                                        <h3 class="title-heading big text-white">Highly Professional Staff</h3>
                                                    </a>
                                                    <p class="title-small text-white">Certified technicians with years of hands-on repair experience.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frame-button">
                                        <a href="{{ route('front.contact') }}" class="fixmo-button d-inline-flex shadow bg-red big-2">
                                            Get A Quote
                                            <span class="icon icon-long-arrow-right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- END ABOUT US -->

                    <!-- SERVICES GRID -->
                    <section class="row-services background-color-f0f4f9">
                        <div class="container">
                            <div class="themesflat-headings style-1 text-center clearfix">
                                <div class="wrap-inner-small">
                                    <h5 class="title-heading small">Our Services</h5>
                                </div>
                                <div class="wrap-inner-big">
                                    <h2 class="title-heading big">Popular Repair Solutions</h2>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="16" data-mobile="0" data-smobile="0"></div>
                            <div class="row wrap-row-services">
                                @foreach($serviceProducts as $product)
                                    <div class="col-md-4">
                                        <div class="themesflat-image-box style-1 has-icon icon-right w65 clearfix wow fadeInUp" data-wow-delay="{{ $loop->index * 150 }}ms" data-wow-duration="1500ms">
                                            <div class="image-box-item clearfix">
                                                <div class="inner">
                                                    <div class="thumb data-effect-item">
                                                        <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                                                        <div class="overlay-effect bg-color-accent"></div>
                                                    </div>
                                                    <div class="text-wrap">
                                                        <div class="row m-0">
                                                            <div class="col-md-3">
                                                                <div class="icon">
                                                                    <span class="{{ $serviceIcons[$loop->index % count($serviceIcons)] }}"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="title">
                                                                    <h4 class="title-heading big">
                                                                        <a href="{{ route('front.repair', $product->slug) }}">{{ $product->name }}</a>
                                                                    </h4>
                                                                    <p class="title-small mb-0">{{ $product->short_name ?? 'Fast diagnostics and same-day service available.' }}</p>
                                                                </div>
                                                                <div class="frame-button">
                                                                    <a href="{{ route('front.repair', $product->slug) }}" class="fixmo-button btn-font-1">
                                                                        Repair Now
                                                                        <span class="icon"><i class="fa fa-arrow-right"></i></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="55" data-mobile="30" data-smobile="30"></div>
                        </div>
                    </section>
                    <!-- END SERVICES GRID -->

                    <!-- GROUP-1 -->
                    <section class="row-group-1">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="wrap-blog-img wow fadeInLeft">
                                        <img src="{{ asset($fixmo . '/img/group/blog-1.jpg') }}" alt="Highlights">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="themesflat-spacer clearfix" data-desktop="25" data-mobile="60" data-smobile="60"></div>
                                    <div class="wrap-group-title">
                                        <div class="title-group wow fadeInRight">
                                            <h2 class="title-heading big text-white">Amazing facts about {{ $siteName }}</h2>
                                        </div>
                                        <div class="themesflat-spacer clearfix" data-desktop="33" data-mobile="30" data-smobile="30"></div>
                                        <div class="container-fluid">
                                            <div class="wrap-group-item wow fadeInUp">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="themesflat-content-box clearfix" data-margin="0 0 0 0" data-mobilemargin="15px 0 15px 0">
                                                            <div class="fixmo-group style-1 align-center clearfix">
                                                                <div class="group-item">
                                                                    <div class="inner">
                                                                        <div class="text-wrap">
                                                                            <div class="icon-wrap">
                                                                                <span class="icon-Forma-1"></span>
                                                                            </div>
                                                                            <div class="number-wrap">
                                                                                <span class="number" data-speed="2000" data-to="20" data-inviewport="yes">20</span><span class="suffix">+</span>
                                                                            </div>
                                                                            <h6 class="text-white">Years of Experience</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="themesflat-content-box clearfix" data-margin="0 0 0 0" data-mobilemargin="15px 0 15px 0">
                                                            <div class="fixmo-group style-1 align-center clearfix">
                                                                <div class="group-item">
                                                                    <div class="inner">
                                                                        <div class="text-wrap">
                                                                            <div class="icon-wrap">
                                                                                <span class="icon-Forma-2"></span>
                                                                            </div>
                                                                            <div class="number-wrap">
                                                                                <span class="number" data-speed="2000" data-to="2000" data-inviewport="yes">2000</span><span class="suffix">+</span>
                                                                            </div>
                                                                            <h6 class="text-white">Happy Customers</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="themesflat-content-box clearfix" data-margin="0 0 0 0" data-mobilemargin="15px 0 15px 0">
                                                            <div class="fixmo-group style-1 align-center clearfix">
                                                                <div class="group-item">
                                                                    <div class="inner">
                                                                        <div class="text-wrap">
                                                                            <div class="icon-wrap">
                                                                                <span class="icon-Forma-3"></span>
                                                                            </div>
                                                                            <div class="number-wrap">
                                                                                <span class="number" data-speed="2000" data-to="5000" data-inviewport="yes">5000</span><span class="suffix">+</span>
                                                                            </div>
                                                                            <h6 class="text-white">Devices Repaired</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="60" data-smobile="60"></div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="box-group-1 flex-group wow fadeInUp">
                                <div class="group-left">
                                    <h2 class="title-heading big text-white">Need help now?</h2>
                                </div>
                                <div class="group-right">
                                    <a href="{{ $heroTel ? 'tel:' . $heroTel : '#' }}" class="fixmo-button shadow bg-red">Call {{ $heroPhone }}</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- END GROUP-1 -->

                    <!-- TESTIMONIALS -->
                    <section class="row-testimonials">
                        <div class="wrap-testimonial background-color-052336">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="themesflat-spacer clearfix" data-desktop="100" data-mobile="60" data-smobile="60"></div>
                                        <div class="themesflat-headings style-1 text-center clearfix wow fadeInDown">
                                            <div class="wrap-inner-small">
                                                <h5 class="title-heading small text-white">Client Testimonials</h5>
                                            </div>
                                            <div class="wrap-inner-big">
                                                <h2 class="title-heading big text-white">What our clients say</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="themesflat-spacer clearfix" data-desktop="40" data-mobile="40" data-smobile="40"></div>
                                        <div class="container">
                                            <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
                                            <div class="elfsight-app-a61bd2a5-3ade-497e-aeb9-7c300a7aa16f" data-elfsight-app-lazy></div>
                                        </div>
                                        <div class="themesflat-spacer clearfix" data-desktop="80" data-mobile="40" data-smobile="40"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- END TESTIMONIALS -->

                    <!-- FAQ -->
                    <section class="row-faq">
                        <div class="container">
                            <div class="wrap-list-faq">
                                <ul class="list-faq">
                                    @forelse($faqs as $faq)
                                        <li class="item-faq {{ $loop->first ? 'active' : '' }}">
                                            <div class="wrap-question">
                                                <h2 class="title-heading big font-size-36 mb-2">{{ sprintf('%02d.', $loop->iteration) }}&nbsp;{{ $faq->question }}</h2>
                                            </div>
                                            <div class="wrap-answer background-color-white">
                                                <p class="title-small mb-0">{!! $faq->answer !!}</p>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="item-faq active">
                                            <div class="wrap-question">
                                                <h2 class="title-heading big font-size-36 mb-2">01.&nbsp;How fast can you repair my device?</h2>
                                            </div>
                                            <div class="wrap-answer background-color-white">
                                                <p class="title-small mb-0">Most screen and battery repairs are completed the same day. We will confirm turnaround time during diagnostics.</p>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </section>
                    <!-- END FAQ -->

                    <!-- MAP -->
                    <section class="row-map">
                        <div class="container-fluid p-0">
                            <div class="themesflat-spacer clearfix" data-desktop="55" data-mobile="20" data-smobile="20"></div>
                            <div class="map wow fadeInDown">
                                <iframe class="mb-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d86077.66255184308!2d-122.40402224079803!3d47.60810999586645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54906ab3f905c4b1%3A0x96bf575ff75ab1aa!2s411%20University%20St%2C%20Seattle%2C%20WA%2098101%2C%20Hoa%20Ky!5e0!3m2!1sen!2sus!4v1584084043716!5m2!1sen!2sus" height="400" allowfullscreen="" aria-hidden="false" loading="lazy"></iframe>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="1" data-mobile="0" data-smobile="0"></div>
                        </div>
                    </section>
                    <!-- END MAP -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
