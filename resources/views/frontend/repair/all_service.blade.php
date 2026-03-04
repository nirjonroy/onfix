@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 10)->first();
    $metaTitle = $SeoSettings ? ($SeoSettings->meta_title ?: $SeoSettings->seo_title) : 'All Services';
    $metaDescription = $SeoSettings ? ($SeoSettings->meta_description ?: $SeoSettings->seo_description) : '';
    $metaImage = $SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '';
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'All Services')
@push('css')
@endpush

@section('seos')
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $SeoSettings ? $SeoSettings->seo_title : 'All Services' }}">
    <meta name="description" content="{{ $SeoSettings ? $SeoSettings->seo_description : '' }}">
    @if($SeoSettings && $SeoSettings->keywords)
        <meta name="keywords" content="{{ $SeoSettings->keywords }}">
    @endif
    @if($SeoSettings && $SeoSettings->author)
        <meta name="author" content="{{ $SeoSettings->author }}">
    @endif
    @if($SeoSettings && $SeoSettings->publisher)
        <meta name="publisher" content="{{ $SeoSettings->publisher }}">
        <meta property="article:publisher" content="{{ $SeoSettings->publisher }}">
    @endif
    @if($SeoSettings && $SeoSettings->copyright)
        <meta name="copyright" content="{{ $SeoSettings->copyright }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($siteName)
        <meta property="og:site_name" content="{{ $siteName }}">
    @endif
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    @if($metaImage)
        <meta property="og:image" content="{{ $metaImage }}">
    @endif
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta name="twitter:card" content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:url" content="{{ url()->current() }}">
    @if($metaImage)
        <meta name="twitter:image" content="{{ $metaImage }}">
    @endif
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
@endsection

@section('content')
@php
    $fixmo = 'frontend/assets/fixmo';
    $bannerImage = asset($fixmo . '/img/banner/banner-370.jpg');
    $serviceIcons = [
        'icon-phonendoscope',
        'icon-smartphone-broken',
        'icon-plaster',
        'icon-tablet-broken',
        'icon-sync-laptop',
        'icon-smartphone-repair',
    ];
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
                                <div class="col-md-5 col-left-banner-all">
                                    <div class="wrap-banner-left wrap-page">
                                        <div class="name-page">
                                            <h2 class="title-heading big text-white">All Services</h2>
                                            <p class="name title-small mb-0"><a class="name title-small space" href="{{ route('front.home') }}">Home</a> Services</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner-all">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $bannerImage }}" alt="Services banner">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
                    </section>
                    <!-- End Banner -->

                    <!-- SERVICES -->
                    <section class="row-services">
                        <div class="container par-ser">
                            <div class="row mr-0">
                                <div class="col-md-12 pr-0">
                                    <div class="themesflat-headings style-1 text-center clearfix">
                                        <div class="wrap-inner-small">
                                            <h5 class="title-heading small">Our Services</h5>
                                        </div>
                                        <div class="wrap-inner-big">
                                            <h2 class="title-heading big">Choose a device to repair</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="16" data-mobile="35" data-smobile="35"></div>
                            <div class="row wrap-row-services">
                                @forelse ($all_service as $item)
                                    <div class="col-md-4">
                                        <div class="themesflat-image-box style-1 has-icon icon-right w65 clearfix wow fadeInUp" data-wow-delay="{{ $loop->index * 150 }}ms" data-wow-duration="1500ms">
                                            <div class="image-box-item clearfix">
                                                <div class="inner">
                                                    <div class="thumb data-effect-item">
                                                        <img src="{{ $item->image ? asset($item->image) : asset($fixmo . '/img/services/service-1.jpg') }}" alt="{{ $item->name }}">
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
                                                                    <h4 class="title-heading big"><a href="{{ route('front.services.category', ['category' => $item->slug]) }}">{{ $item->name }}</a></h4>
                                                                    <p class="title-small mb-0">{!! Str::limit($item->short_description, 90, '...') !!}</p>
                                                                </div>
                                                                <div class="frame-button">
                                                                    <a href="{{ route('front.services.category', ['category' => $item->slug]) }}" class="fixmo-button btn-font-1">
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
                                        <p class="title-small text-center">No services available right now.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                    <!-- END SERVICES -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
