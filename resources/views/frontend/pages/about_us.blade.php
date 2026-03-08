@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 2)->first();
    $metaTitle = $SeoSettings->meta_title ?: $SeoSettings->seo_title;
    $metaDescription = $SeoSettings->meta_description ?: $SeoSettings->seo_description;
    $metaImage = $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings->site_name ?: $SeoSettings->seo_title;
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'About Us- DC Phone Repair')
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
    <link rel="canonical" href="{{ url()->current() }}">
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
    <meta name="twitter:url" content="{{ url()->current() }}">
    @if($metaImage)
        <meta name="twitter:image" content="{{ $metaImage }}">
    @endif
@endsection
@section('content')
@php
    $fixmo = 'frontend/assets/fixmo';
    $aboutIntro = optional($about_us)->description_three ?: 'Fast, reliable repair for phones, tablets, and laptops.';
    $aboutBody = optional($about_us)->about_us ?: '';
    $aboutBody = preg_replace('/<img[^>]*>/i', '', $aboutBody);
    $aboutBody = preg_replace('/<p>\s*(?:&nbsp;|\s|<br\s*\/?>)*<\/p>/i', '', $aboutBody);
    $bannerImage = asset($fixmo . '/img/banner/banner-370.jpg');
    $aboutImageTop = asset($fixmo . '/img/group/protfolio2-470x430.jpg');
    $aboutImageBottom = asset($fixmo . '/img/group/protfolio5-500x345.jpg');
@endphp            <div id="main-content" class="site-main clearfix">
                <div id="content-wrap">
                    <div id="site-content" class="site-content clearfix">
                        <div id="inner-content" class="inner-content-wrap">
                            <div class="page-content">
                                <!-- Banner -->
                                <section class="fixmo-banner">
                                    <div class="container-fluid p-0">
                                        <div class="row m-0 wrap-height">
                                            <div class="col-md-5 col-left-banner-all">
                                                <div class="wrap-banner-left wrap-page">
                                                    <div class="name-page">
                                                        <h2 class="title-heading big text-white">About Us</h2>
                                                        <p class="name title-small mb-0"><a class="name title-small space" href="{{ route('front.home') }}">Home</a> About Us</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-right-banner-all">
                                                <div class="wrap-banner-right">
                                                    <img class="img-banner" src="{{ $bannerImage }}" alt="About banner">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
                                </section>
                                <!-- End Banner -->
                                <!-- PAGE About US -->
                                <section class="row-page-aboutus">
                                    <div class="container pad-col">
                                        <div class="row par-ser">
                                            <div class="col-md-6 pad-col mb-show">
                                                <div class="themesflat-headings style-1 clearfix">
                                                    <div class="wrap-inner-small">
                                                        <h5 class="title-heading small">Why Choose Us</h5>
                                                    </div>
                                                    <div class="wrap-inner-big">
                                                        <h2 class="title-heading big">Get your repair started</h2>
                                                    </div>
                                                    <div class="wrap-sub">
                                                        <p class="title-small">{{ $aboutIntro }}</p>
                                                    </div>
                                                    <div class="box-about">
                                                        <div class="themesflat-spacer clearfix" data-desktop="30" data-mobile="30" data-smobile="30"></div>
                                                        <div class="wrap-box clearfix wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                                            <div class="number-wrap">
                                                                <span class="text-white">01</span>
                                                            </div>
                                                            <div class="text-wrap">
                                                                <h5 class="title">Book a repair</h5>
                                                                <p class="sub-title">Schedule online or walk in for a free diagnostic on your device.</p>
                                                            </div>
                                                        </div>
                                                        <div class="themesflat-spacer clearfix" data-desktop="18" data-mobile="30" data-smobile="30"></div>
                                                        <div class="wrap-box clearfix wow fadeInLeft " data-wow-delay="200ms" data-wow-duration="1500ms">
                                                            <div class="number-wrap top-4">
                                                                <span class="text-white">02</span>
                                                            </div>
                                                            <div class="text-wrap">
                                                                <h5 class="title">Approve the estimate</h5>
                                                                <p class="sub-title">We explain the issue clearly and provide a transparent quote.</p>
                                                            </div>
                                                        </div>
                                                        <div class="themesflat-spacer clearfix" data-desktop="18" data-mobile="30" data-smobile="30"></div>
                                                        <div class="wrap-box clearfix wow fadeInLeft " data-wow-delay="400ms" data-wow-duration="1500ms">
                                                            <div class="number-wrap top-4">
                                                                <span class="text-white">03</span>
                                                            </div>
                                                            <div class="text-wrap">
                                                                <h5 class="title">Pick up your device</h5>
                                                                <p class="sub-title">We test every repair and back it with a service warranty.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($aboutBody)
                                                        <div class="themesflat-spacer clearfix" data-desktop="28" data-mobile="20" data-smobile="20"></div>
                                                        <div class="wrap-sub">
                                                            <div class="title-small">{!! $aboutBody !!}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 pad-col mb-hide">
                                                <div class="wrap-border-img">
                                                    <div class="wrap-img-top wow fadeInRight " data-wow-delay="0ms" data-wow-duration="1500ms">
                                                        <img src="{{ $aboutImageTop }}" alt="Our team">
                                                    </div>
                                                    <div class="wrap-square"></div>
                                                    <div class="wrap-img-bot wow fadeInUp " data-wow-delay="0ms" data-wow-duration="1500ms">
                                                        <img src="{{ $aboutImageBottom }}" alt="Repair process">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <div class="themesflat-spacer clearfix" data-desktop="9" data-mobile="0" data-smobile="0"></div>

                                    </div>
                                </section>
                                <!-- END PAGE About US -->
                                <!-- GROUP-1 -->
                                <section class="row-group-1">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="wrap-blog-img">
                                                    <img src="{{ asset('frontend/assets/fixmo/img/group/blog-1.jpg') }}" alt="images">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="themesflat-spacer clearfix" data-desktop="25" data-mobile="60" data-smobile="60"></div>
                                                <div class="wrap-group-title">
                                                    <div class="title-group wow fadeInDown " data-wow-delay="0ms" data-wow-duration="1500ms">
                                                        <h2 class="title-heading big text-white">Amazing facts about {{ $siteName }}</h2>
                                                    </div>
                                                    <div class="themesflat-spacer clearfix" data-desktop="33" data-mobile="20" data-smobile="20"></div>
                                                    <div class="container-fluid">
                                                        <div class="wrap-group-item wow fadeInUp " data-wow-delay="0ms" data-wow-duration="1500ms">
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
                                                                                            <span class="number" data-speed="2000" data-to="2000" data-inviewport="yes">2000</span><span class="suffix">+</span>
                                                                                        </div>
                                                                                        <h6 class="text-white">Happy Customers</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.themesflat-counter -->
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
                                                                                            <span class="number" data-speed="2000" data-to="5000" data-inviewport="yes">5000</span><span class="suffix">+</span>
                                                                                        </div>
                                                                                        <h6 class="text-white">Devices Repaired</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.themesflat-counter -->
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
                                                                                            <span class="number" data-speed="2000" data-to="20" data-inviewport="yes">20</span><span class="suffix">+</span>
                                                                                        </div>
                                                                                        <h6 class="text-white">Years Experience</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.themesflat-counter -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="45" data-smobile="45"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="box-group-1 flex-group wow fadeInDown " data-wow-delay="0ms" data-wow-duration="1500ms">
                                            <div class="group-left">
                                                <h2 class="title-heading big text-white">Enter Your Mail For subscribe</h2>
                                            </div>
                                            <div class="group-right">
                                                <form action="#" method="post" class="form-submit contact-form wpcf7-form">
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="email" placeholder="Email Address">
                                                        <a href="#" class="fixmo-button shadow bg-red">Subscribe</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- END GROUP-1 -->
                                <!-- GROUP 2 -->
                                <section class="row-group-2">
                                    <div class="wrap-testimonial bg-style-color-1">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="themesflat-spacer clearfix" data-desktop="116" data-mobile="60" data-smobile="60"></div>
                                                    <div class="themesflat-headings style-1 text-center clearfix wow fadeInDown " data-wow-delay="0ms" data-wow-duration="1500ms">
                                                        <div class="wrap-inner-small">
                                                            <h5 class="title-heading small text-color-FF4E4E">Client Testimonials</h5>
                                                        </div>
                                                        <div class="wrap-inner-big">
                                                            <h2 class="title-heading big">What our clients say </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="themesflat-spacer clearfix" data-desktop="41" data-mobile="41" data-smobile="41"></div>
                                                    <div class="container">
                                                        <div class="themesflat-carousel-box-style-3 clearfix" data-gap="30" data-column="2" data-column2="2" data-column3="1" data-auto="false">
                                                            <div class="owl-carousel owl-theme ew-resize wow fadeInUp " data-wow-delay="0ms" data-wow-duration="1500ms">
                                                                <div class="themesflat-testimonials style-2 align-center clearfix">
                                                                    <div class="wrap-testimonials staff-1 background-color-white">
                                                                        <div class="testimonials-item ">
                                                                            <div class="testimonials-img">
                                                                                <img src="{{ asset('frontend/assets/fixmo/img/group/staff-box1@2x.png') }}" alt="Image" class="img">
                                                                            </div>
                                                                            <div class="testimonials-heading">
                                                                                <p class="heading-name">Eugene Freeman</p>
                                                                                <p class="heading-woker">Tincidunt</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="testimonials-sub-title">
                                                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /themesflat-testimonials -->
                                                                <div class="themesflat-testimonials style-2 align-center clearfix">
                                                                    <div class="wrap-testimonials background-color-white">
                                                                        <div class="testimonials-item">
                                                                            <div class="testimonials-img">
                                                                                <img src="{{ asset('frontend/assets/fixmo/img/group/staff-box2@2x.png') }}" alt="Image" class="img">
                                                                            </div>
                                                                            <div class="testimonials-heading padl-30">
                                                                                <p class="heading-name">Kelly Coleman</p>
                                                                                <p class="heading-woker">Nulla nec</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="testimonials-sub-title">
                                                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /themesflat-testimonials -->
                                                                <div class="themesflat-testimonials style-2 align-center clearfix">
                                                                    <div class="wrap-testimonials staff-1 background-color-white">
                                                                        <div class="testimonials-item ">
                                                                            <div class="testimonials-img">
                                                                                <img src="{{ asset('frontend/assets/fixmo/img/group/staff-box1@2x.png') }}" alt="Image" class="img">
                                                                            </div>
                                                                            <div class="testimonials-heading">
                                                                                <p class="heading-name">Eugene Freeman</p>
                                                                                <p class="heading-woker">Tincidunt</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="testimonials-sub-title">
                                                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /themesflat-testimonials -->
                                                                <div class="themesflat-testimonials style-2 align-center clearfix">
                                                                    <div class="wrap-testimonials background-color-white">
                                                                        <div class="testimonials-item">
                                                                            <div class="testimonials-img">
                                                                                <img src="{{ asset('frontend/assets/fixmo/img/group/staff-box2@2x.png') }}" alt="Image" class="img">
                                                                            </div>
                                                                            <div class="testimonials-heading padl-30">
                                                                                <p class="heading-name">Kelly Coleman</p>
                                                                                <p class="heading-woker">Nulla nec</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="testimonials-sub-title">
                                                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /themesflat-testimonials -->
                                                            </div>
                                                        </div>
                                                        <!-- /.themesflat-carousel-box -->
                                                        <div class="themesflat-spacer clearfix" data-desktop="185" data-mobile="100" data-smobile="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- END GROUP 2 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

