@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $metaTitle = $SeoSettings->meta_title ?: $SeoSettings->seo_title;
    $metaDescription = $SeoSettings->meta_description ?: $SeoSettings->seo_description;
    $metaImage = $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings->site_name ?: $SeoSettings->seo_title;
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'Contact us | DC Phone Repair')

@section('seos')
    <meta charset="UTF-8">
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
    $contactPhone = $contacts->phone ?: (siteInfo()->topbar_phone ?? '');
    $contactEmail = $contacts->email ?: (siteInfo()->contact_email ?? '');
    $contactAddress = $contacts->address ?: trim((siteInfo()->address_1 ?? '') . ' ' . (siteInfo()->address_2 ?? ''));
    $contactTitle = $contacts->title ?: 'Contact Information';
    $contactDescription = $contacts->description ?: 'Get in touch with our repair team for diagnostics, pricing, and turnaround details.';
    $contactMap = $contacts->map ?: null;
    $phoneHref = $contactPhone ? 'tel:' . preg_replace('/[^0-9+]/', '', $contactPhone) : '#';
    $emailHref = $contactEmail ? 'mailto:' . $contactEmail : '#';
    $socialLinks = [
        ['icon' => 'fa fa-facebook', 'url' => '#'],
        ['icon' => 'fa fa-twitter', 'url' => '#'],
        ['icon' => 'fa fa-instagram', 'url' => '#'],
        ['icon' => 'fa fa-linkedin', 'url' => '#'],
    ];
@endphp

<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">
                    <section class="fixmo-banner">
                        <div class="container-fluid p-0">
                            <div class="row m-0 wrap-height">
                                <div class="col-md-5 col-left-banner-all">
                                    <div class="wrap-banner-left wrap-page">
                                        <div class="name-page">
                                            <h2 class="title-heading big text-white">Contact</h2>
                                            <p class="name title-small mb-0">
                                                <a class="name title-small space" href="{{ route('front.home') }}">Home</a>
                                                Contact
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner-all">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $bannerImage }}" alt="Contact">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="0" data-smobile="0"></div>
                    </section>

                    @if($contactMap)
                        <section class="row-map">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div class="map">
                                            <iframe src="{{ $contactMap }}" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row-owner">
                                <div class="container">
                                    <div class="row wrap-our-footer style-1">
                                        <div class="col-md-4">
                                            <div class="our-inner bg-style-2">
                                                <a class="icons color-w pt-style-1 background-color-042c71" href="{{ $phoneHref }}">
                                                    <span class="icon-mobile-keyboard text-white"></span>
                                                </a>
                                                <ul class="list-info">
                                                    <li class="title teko"><a class="text-white" href="{{ $phoneHref }}">Our Phone</a></li>
                                                    <li class="sub-title pad-1"><a class="text-white" href="{{ $phoneHref }}">{{ $contactPhone }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="our-inner pl-style-2 bg-style-1">
                                                <a class="icons pt-style-2 background-color-ff4e4e" href="{{ $emailHref }}">
                                                    <span class="font-size-33 text-white icon-mail-open"></span>
                                                </a>
                                                <ul class="list-info mar-info-1">
                                                    <li class="title teko mt-1"><a class="text-white" href="{{ $emailHref }}">Our Email</a></li>
                                                    <li class="sub-title pad-1"><a class="text-white" href="{{ $emailHref }}">{{ $contactEmail }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="our-inner pl-style-3 background-color-white box-shadow-style-2">
                                                <a class="icons pt-style-3 background-color-ff4e4e" href="#contact-information">
                                                    <span class="text-white icon-location-map"></span>
                                                </a>
                                                <ul class="list-info mar-info-3">
                                                    <li class="title teko"><a href="#contact-information">Our Address</a></li>
                                                    <li class="sub-title pad-1"><a href="#contact-information">{{ $contactAddress }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    <section class="row-contact">
                        <div class="container">
                            <div class="themesflat-spacer clearfix" data-desktop="100" data-mobile="60" data-smobile="60"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="themesflat-headings contact clearfix" id="contact-information">
                                        <div class="wrap-inner-small">
                                            <h5 class="title-heading small m-0">Get in touch</h5>
                                        </div>
                                        <div class="wrap-inner-big">
                                            <h2 class="title-heading big">{{ $contactTitle }}</h2>
                                            <div class="title-small">{!! $contactDescription !!}</div>
                                        </div>
                                        <div class="contact-social">
                                            <ul class="widget-social">
                                                @foreach($socialLinks as $link)
                                                    <li class="item-social">
                                                        <a href="{{ $link['url'] }}"><i class="{{ $link['icon'] }}"></i></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="contact-form style-1">
                                        <form action="{{ route('front.direct-message') }}" method="post" class="form-submit comment-form wpcf7-form">
                                            @csrf
                                            <span class="wpcf7-form-control-wrap your-name">
                                                <input type="text" tabindex="1" name="name" value="{{ old('name') }}" class="wpcf7-form-control" placeholder="Full Name" required>
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-phone">
                                                <input type="text" tabindex="2" name="phone" value="{{ old('phone') }}" class="wpcf7-form-control" placeholder="Phone Number">
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-email">
                                                <input type="email" tabindex="3" name="email" value="{{ old('email') }}" class="wpcf7-form-control" placeholder="Email Address">
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-subject">
                                                <input type="text" tabindex="4" name="subject" value="{{ old('subject') }}" class="wpcf7-form-control" placeholder="Subject">
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-address">
                                                <input type="text" tabindex="5" name="address" value="{{ old('address') }}" class="wpcf7-form-control" placeholder="Address">
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-message">
                                                <textarea name="message" tabindex="6" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Your Message">{{ old('message') }}</textarea>
                                            </span>
                                            <span class="wrap-submit">
                                                <button type="submit" class="submit wpcf7-form-control wpcf7-submit">Send Message</button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="118" data-mobile="60" data-smobile="60"></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
