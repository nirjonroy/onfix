@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $firstService = null;
    if (isset($services)) {
        if ($services instanceof \Illuminate\Support\Collection && $services->count()) {
            $firstService = $services->first();
        } elseif (is_array($services) && count($services)) {
            $firstService = $services[0];
        }
    }
    $category = $firstService?->category;
    $subCategory = $firstService?->subCategory;
    $childCategory = $firstService?->childCategory;
    $contextCategory = $childCategory ?: ($subCategory ?: $category);
    $metaBaseTitle = $contextCategory?->name ?? 'Services';
    $metaTitle = $contextCategory?->meta_title ?: ($contextCategory?->seo_title ?: ($metaBaseTitle !== 'Services' ? $metaBaseTitle . ' Repair Services' : 'Device Repair Services'));
    $metaDescription = $contextCategory?->meta_description ?: ($contextCategory?->seo_description ?: strip_tags($contextCategory?->short_description ?? ''));
    $metaImage = $contextCategory?->meta_image ? asset($contextCategory->meta_image) : ($contextCategory?->image ? asset($contextCategory->image) : ($SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $contextCategory?->site_name ?: ($SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '');
    $metaKeywords = $contextCategory?->keywords ?: ($SeoSettings?->keywords ?? '');
    $metaAuthor = $contextCategory?->author ?: ($SeoSettings?->author ?? '');
    $metaPublisher = $contextCategory?->publisher ?: ($SeoSettings?->publisher ?? '');
    $metaCopyright = $contextCategory?->copyright ?: ($SeoSettings?->copyright ?? '');
    $headerTitleParts = [];
    if ($category) {
        $headerTitleParts[] = $category->name;
    }
    if ($subCategory) {
        $headerTitleParts[] = $subCategory->name;
    }
    if ($childCategory) {
        $headerTitleParts[] = $childCategory->name;
    }
    $headerTitle = $headerTitleParts ? implode(' / ', $headerTitleParts) : ($contextCategory?->name ?? 'Services');
    $headerDescription = $contextCategory?->short_description ?: ($contextCategory?->seo_description ?: '');
@endphp
@section('title', $metaTitle)
@section('seos')
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $metaTitle }}">
    <meta name="description" content="{{ $metaDescription }}">
    @if($metaKeywords)
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    @if($metaAuthor)
        <meta name="author" content="{{ $metaAuthor }}">
    @endif
    @if($metaPublisher)
        <meta name="publisher" content="{{ $metaPublisher }}">
        <meta property="article:publisher" content="{{ $metaPublisher }}">
    @endif
    @if($metaCopyright)
        <meta name="copyright" content="{{ $metaCopyright }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($siteName)
        <meta property="og:site_name" content="{{ $siteName }}">
    @endif
    @if($metaImage)
        <meta property="og:image" content="{{ $metaImage }}">
    @endif
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
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
@push('css')

@endpush
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
                                            <h2 class="title-heading big text-white">{{ $headerTitle }}</h2>
                                            <p class="name title-small mb-0">
                                                <a class="name title-small space" href="{{ route('front.home') }}">Home</a>
                                                Services
                                                @if($category) / {{ $category->name }} @endif
                                                @if($subCategory) / {{ $subCategory->name }} @endif
                                                @if($childCategory) / {{ $childCategory->name }} @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner-all">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $bannerImage }}" alt="{{ $headerTitle }}">
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
                                            <h5 class="title-heading small">Services</h5>
                                        </div>
                                        <div class="wrap-inner-big">
                                            <h2 class="title-heading big">{{ $headerTitle }}</h2>
                                        </div>
                                        @if($headerDescription)
                                            <div class="wrap-sub">
                                                <p class="title-small">{{ $headerDescription }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="16" data-mobile="35" data-smobile="35"></div>
                            <div class="row wrap-row-services">
                                @forelse ($services as $item)
                                    <div class="col-md-4">
                                        <div class="themesflat-image-box style-1 has-icon icon-right w65 clearfix wow fadeInUp" data-wow-delay="{{ $loop->index * 150 }}ms" data-wow-duration="1500ms">
                                            <div class="image-box-item clearfix">
                                                <div class="inner">
                                                    <div class="thumb data-effect-item">
                                                        <img src="{{ $item->thumb_image ? asset($item->thumb_image) : asset($fixmo . '/img/services/service-1.jpg') }}" alt="{{ $item->name }}">
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
                                                                    <h4 class="title-heading big"><a href="{{ route('front.single.service', $item->slug) }}">{{ $item->name }}</a></h4>
                                                                    <p class="title-small mb-0">{!! Str::limit(strip_tags($item->short_description), 90, '...') !!}</p>
                                                                </div>
                                                                <div class="frame-button">
                                                                    <a href="{{ route('front.single.service', $item->slug) }}" class="fixmo-button btn-font-1">
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
                                        <p class="title-small text-center">No services found.</p>
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
