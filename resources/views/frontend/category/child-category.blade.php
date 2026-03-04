@extends('frontend.app')
@php
    $currentSubCategory = $categories[0]->subCategory ?? null;
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $metaTitle = $currentSubCategory?->meta_title ?: ($currentSubCategory?->seo_title ?: ($currentSubCategory?->name ?? 'Services'));
    $metaDescription = $currentSubCategory?->meta_description ?: ($currentSubCategory?->seo_description ?: strip_tags($currentSubCategory?->short_description ?? ''));
    $metaImage = $currentSubCategory?->meta_image ? asset($currentSubCategory->meta_image) : ($currentSubCategory?->image ? asset($currentSubCategory->image) : ($SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $currentSubCategory?->site_name ?: ($SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '');
@endphp
@section('title', $metaTitle)

@section('seos')
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $metaTitle }}">
    <meta name="description" content="{{ $metaDescription }}">
    @if($currentSubCategory?->keywords)
        <meta name="keywords" content="{{ $currentSubCategory->keywords }}">
    @endif
    @if($currentSubCategory?->author)
        <meta name="author" content="{{ $currentSubCategory->author }}">
    @endif
    @if($currentSubCategory?->publisher)
        <meta name="publisher" content="{{ $currentSubCategory->publisher }}">
        <meta property="article:publisher" content="{{ $currentSubCategory->publisher }}">
    @endif
    @if($currentSubCategory?->copyright)
        <meta name="copyright" content="{{ $currentSubCategory->copyright }}">
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
    $pageTitle = $currentSubCategory?->name ?? 'Services';
    $pageDescription = $currentSubCategory?->short_description ?: '';
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
                                            <h2 class="title-heading big text-white">{{ $pageTitle }}</h2>
                                            <p class="name title-small mb-0"><a class="name title-small space" href="{{ route('front.home') }}">Home</a> Services / {{ $pageTitle }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner-all">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $bannerImage }}" alt="{{ $pageTitle }}">
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
                                            <h2 class="title-heading big">Browse {{ $pageTitle }}</h2>
                                        </div>
                                        @if($pageDescription)
                                            <div class="wrap-sub">
                                                <p class="title-small">{{ $pageDescription }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="16" data-mobile="35" data-smobile="35"></div>
                            <div class="row wrap-row-services">
                                @forelse($categories as $child)
                                    <div class="col-md-4">
                                        <div class="themesflat-image-box style-1 has-icon icon-right w65 clearfix wow fadeInUp" data-wow-delay="{{ $loop->index * 150 }}ms" data-wow-duration="1500ms">
                                            <div class="image-box-item clearfix">
                                                <div class="inner">
                                                    <div class="thumb data-effect-item">
                                                        <img src="{{ $child->image ? asset($child->image) : asset($fixmo . '/img/services/service-1.jpg') }}" alt="{{ $child->name }}">
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
                                                                        <a href="{{ route('front.services.childcategory', ['category' => $child->category->slug, 'subcategory' => $child->subCategory->slug, 'child' => $child->slug]) }}">{{ $child->name }}</a>
                                                                    </h4>
                                                                </div>
                                                                <div class="frame-button">
                                                                    <a href="{{ route('front.services.childcategory', ['category' => $child->category->slug, 'subcategory' => $child->subCategory->slug, 'child' => $child->slug]) }}" class="fixmo-button btn-font-1">
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
                                        <p class="title-small text-center">No models available.</p>
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

@push('js')
    <!--<script src="{{ asset('frontend/silck/slick.min.js') }}"></script>-->
@endpush
