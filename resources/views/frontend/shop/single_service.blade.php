@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $metaTitle = $service->meta_title ?: ($service->seo_title ? $service->seo_title : $service->name);
    $metaDescription = $service->meta_description ?: ($service->seo_description ? $service->seo_description : strip_tags($service->short_description));
    $metaImage = $service->meta_image ? asset($service->meta_image) : ($service->thumb_image ? asset($service->thumb_image) : ($SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $service->site_name ?: ($SeoSettings->site_name ?: $SeoSettings->seo_title);
    $metaKeywords = $service->keywords ?: ($SeoSettings->keywords ?: '');
    $metaAuthor = $service->author ?: ($SeoSettings->author ?: '');
    $metaPublisher = $service->publisher ?: ($SeoSettings->publisher ?: '');
    $metaCopyright = $service->copyright ?: ($SeoSettings->copyright ?: '');
    $metaModifiedTime = $service->updated_at ? $service->updated_at->toAtomString() : null;
    $category = $service->category;
    $subCategory = $service->subCategory;
    $childCategory = $service->childCategory;
    $heroDescription = $service->short_description
        ? Str::limit(strip_tags($service->short_description), 140)
        : ($service->seo_description ?: ($category?->short_description ?: ($SeoSettings->seo_description ?? '')));
@endphp
@section('title', $metaTitle . ' - DC-Phone-Repair')
@push('css')

@endpush
@section('seos')


    <meta charset="UTF-8">

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <meta name="title" content="{{$metaTitle}}">

    <meta name="description" content="{{$metaDescription}}">
    @if($metaKeywords)
        <meta name="keywords" content="{{$metaKeywords}}">
    @endif
    @if($metaAuthor)
        <meta name="author" content="{{$metaAuthor}}">
    @endif
    @if($metaPublisher)
        <meta name="publisher" content="{{$metaPublisher}}">
        <meta property="article:publisher" content="{{$metaPublisher}}">
    @endif
    @if($metaCopyright)
        <meta name="copyright" content="{{$metaCopyright}}">
    @endif
    <link rel="canonical" href="{{url()->current()}}">
    <meta property="og:title" content="{{$metaTitle}}">
    <meta property="og:description" content="{{$metaDescription}}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:site_name" content="{{$siteName}}">

    @if($metaImage)
        <meta property="og:image" content="{{$metaImage}}">
    @endif
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    
    
    @if($metaModifiedTime)
        <meta property="article:modified_time" content="{{ $metaModifiedTime }}">
    @endif
    <meta name="twitter:card" content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{$metaTitle}}">
    <meta name="twitter:description" content="{{$metaDescription}}">
    <meta name="twitter:url" content="{{url()->current()}}">
    @if($metaImage)
        <meta name="twitter:image" content="{{$metaImage}}">
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
                                            <h2 class="title-heading big text-white">{{ $service->name }}</h2>
                                            <p class="name title-small mb-0">
                                                <a class="name title-small space" href="{{ route('front.home') }}">Home</a>
                                                Services
                                                @if($category) / {{ $category->name }} @endif
                                                @if($subCategory) / {{ $subCategory->name }} @endif
                                                @if($childCategory) / {{ $childCategory->name }} @endif
                                                / {{ $service->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner-all">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $bannerImage }}" alt="{{ $service->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
                    </section>
                    <!-- End Banner -->

                    <!-- SERVICE DETAILS -->
                    <section class="row-page-aboutus">
                        <div class="container pad-col">
                            <div class="row par-ser">
                                <div class="col-md-6 pad-col mb-show">
                                    <div class="themesflat-headings style-1 clearfix">
                                        <div class="wrap-inner-small">
                                            <h5 class="title-heading small">Service Details</h5>
                                        </div>
                                        <div class="wrap-inner-big">
                                            <h2 class="title-heading big">{{ $service->name }}</h2>
                                        </div>
                                        <div class="wrap-sub">
                                            <div class="title-small">{!! $service->short_description !!}</div>
                                        </div>
                                        <div class="themesflat-spacer clearfix" data-desktop="18" data-mobile="18" data-smobile="18"></div>
                                        <div class="frame-button">
                                            <a href="{{ route('front.repair', $service->slug) }}" class="fixmo-button d-inline-flex shadow bg-red big-2">
                                                Book an Appointment
                                                <span class="icon icon-long-arrow-right"></span>
                                            </a>
                                        </div>
                                        @if($service->long_description)
                                            <div class="themesflat-spacer clearfix" data-desktop="28" data-mobile="20" data-smobile="20"></div>
                                            <div class="wrap-sub">
                                                <div class="title-small">{!! $service->long_description !!}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 pad-col mb-hide">
                                    <div class="wrap-border-img">
                                        <div class="wrap-img-top wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                                            <img src="{{ asset($service->thumb_image) }}" alt="{{ $service->name }}">
                                        </div>
                                        <div class="wrap-square"></div>
                                        <div class="wrap-img-bot wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                            <img src="{{ asset($fixmo . '/img/group/protfolio5-500x345.jpg') }}" alt="Repair detail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="9" data-mobile="0" data-smobile="0"></div>
                        </div>
                    </section>
                    <!-- END SERVICE DETAILS -->

                    <!-- RELATED SERVICES -->
                    <section class="row-services">
                        <div class="container par-ser">
                            <div class="row mr-0">
                                <div class="col-md-12 pr-0">
                                    <div class="themesflat-headings style-1 text-center clearfix">
                                        <div class="wrap-inner-small">
                                            <h5 class="title-heading small">Related</h5>
                                        </div>
                                        <div class="wrap-inner-big">
                                            <h2 class="title-heading big">Related Services</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="16" data-mobile="35" data-smobile="35"></div>
                            <div class="row wrap-row-services">
                                @forelse($related_product as $product)
                                    <div class="col-md-4">
                                        <div class="themesflat-image-box style-1 has-icon icon-right w65 clearfix wow fadeInUp" data-wow-delay="{{ $loop->index * 150 }}ms" data-wow-duration="1500ms">
                                            <div class="image-box-item clearfix">
                                                <div class="inner">
                                                    <div class="thumb data-effect-item">
                                                        <img src="{{ $product->thumb_image ? asset($product->thumb_image) : asset($fixmo . '/img/services/service-1.jpg') }}" alt="{{ $product->name }}">
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
                                                                    <h4 class="title-heading big"><a href="{{ route('front.single.service', $product->slug) }}">{{ $product->name }}</a></h4>
                                                                    <p class="title-small mb-0">{!! Str::limit(strip_tags($product->short_description), 90, '...') !!}</p>
                                                                </div>
                                                                <div class="frame-button">
                                                                    <a href="{{ route('front.single.service', $product->slug) }}" class="fixmo-button btn-font-1">
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
                                        <p class="title-small text-center">No related services available.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                    <!-- END RELATED SERVICES -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
