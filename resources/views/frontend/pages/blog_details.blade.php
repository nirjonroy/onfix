@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 4)->first();
    $metaTitle = $blog->meta_title ?: ($blog->seo_title ? $blog->seo_title : $blog->title);
    $metaDescription = $blog->meta_description ?: ($blog->seo_description ? $blog->seo_description : Str::limit(strip_tags($blog->description), 160, ''));
    $metaImage = $blog->meta_image ? asset($blog->meta_image) : ($blog->image ? asset($blog->image) : ($SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $blog->site_name ?: ($SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '');
    $metaKeywords = $blog->keywords ?: ($SeoSettings && $SeoSettings->keywords ? $SeoSettings->keywords : '');
    $metaAuthor = $blog->author ?: ($SeoSettings && $SeoSettings->author ? $SeoSettings->author : '');
    $metaPublisher = $blog->publisher ?: ($SeoSettings && $SeoSettings->publisher ? $SeoSettings->publisher : '');
    $metaCopyright = $blog->copyright ?: ($SeoSettings && $SeoSettings->copyright ? $SeoSettings->copyright : '');
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
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
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
    $fallbackBlogImage = asset($fixmo . '/img/group/protfolio10-770x450.jpg');
    $postImage = $blog->image ? asset($blog->image) : $fallbackBlogImage;
    $selectedCategory = $blog->category;
    $topicCategories = $blogCategories->where('blogs_count', '>', 0)->take(8);
    $authorName = $blog->author ?: ($blog->admin?->name ?: 'Admin');
    $comments = $blog->activeComments ?? collect();
    $shareUrl = urlencode(url()->current());
    $shareTitle = urlencode($blog->title);
    $tagItems = collect(explode(',', $metaKeywords))
        ->map(function ($tag) { return trim($tag); })
        ->filter()
        ->unique()
        ->take(6);
    if ($tagItems->isEmpty() && $blog->category) {
        $tagItems = collect([$blog->category->name]);
    }
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
                                            <h2 class="title-heading big text-white">Blog Details</h2>
                                            <p class="name title-small mb-0">
                                                <a class="name title-small space" href="{{ route('front.home') }}">Home</a>
                                                <a class="name title-small space" href="{{ route('front.blog') }}">Blog</a>
                                                {{ Str::limit($blog->title, 36) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner-all">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $bannerImage }}" alt="{{ $blog->title }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="themesflat-spacer clearfix" data-desktop="70" data-mobile="100" data-smobile="60"></div>
                    </section>

                    <section class="row-blog-details">
                        <div class="container">
                            <div class="themesflat-spacer clearfix" data-desktop="50" data-mobile="0" data-smobile="0"></div>
                            <div class="row">
                                <div class="col-md-8">
                                    <article class="main-post-box marb-20 blog-detail-post">
                                        <div class="entry-img text-center">
                                            <img src="{{ $postImage }}" alt="{{ $blog->title }}">
                                        </div>
                                        <div class="post-content">
                                            <ul class="post-media d-flex">
                                                <li class="user bg-red">
                                                    <a class="title-small" href="{{ route('front.blog') }}">BY {{ Str::upper($authorName) }}</a>
                                                </li>
                                                <li class="date bg-red">
                                                    <a class="title-small" href="{{ route('front.blog_details', [$blog->slug]) }}">
                                                        {{ optional($blog->created_at)->format('d F, Y') }}
                                                    </a>
                                                </li>
                                                @if($blog->category)
                                                    <li>
                                                        <a class="title-small" href="{{ route('front.blog', ['category' => $blog->category->id]) }}">
                                                            {{ Str::upper($blog->category->name) }}
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                            <div class="post-title mart-17">
                                                <h1 class="title-heading big post-details">{{ $blog->title }}</h1>
                                                @if($metaDescription)
                                                    <p class="title-small mart-7 blog-detail-lead">{{ $metaDescription }}</p>
                                                @endif
                                                <div class="post-prestation">
                                                    <p class="title-small mb-0">
                                                        {{ $blog->category ? $blog->category->name . ' insights and repair guidance from ' . $authorName . '.' : 'Repair guidance and practical advice from ' . $authorName . '.' }}
                                                    </p>
                                                    <p class="author title-heading big mb-0">
                                                        <a href="{{ route('front.blog') }}">{{ $authorName }}</a>
                                                    </p>
                                                </div>
                                                <div class="title-small ml-1 blog-detail-body">
                                                    {!! $blog->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </article>

                                    @if($relatedPosts->isNotEmpty())
                                        <div class="blog-related-grid">
                                            <h2 class="title-heading big title-head mb-0">Related Posts</h2>
                                            <div class="themesflat-spacer clearfix" data-desktop="28" data-mobile="20" data-smobile="20"></div>
                                            <div class="row">
                                                @foreach($relatedPosts as $relatedPost)
                                                    <div class="col-md-4">
                                                        <article class="blog-related-card">
                                                            <a class="thumb" href="{{ route('front.blog_details', [$relatedPost->slug]) }}">
                                                                <img src="{{ $relatedPost->image ? asset($relatedPost->image) : $fallbackBlogImage }}" alt="{{ $relatedPost->title }}">
                                                            </a>
                                                            <div class="content">
                                                                <h3 class="title-heading big font-size-20 line-20">
                                                                    <a href="{{ route('front.blog_details', [$relatedPost->slug]) }}">{{ Str::limit($relatedPost->title, 52) }}</a>
                                                                </h3>
                                                                <p class="title-small mb-0">{{ optional($relatedPost->created_at)->format('d M Y') }}</p>
                                                            </div>
                                                        </article>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <hr class="m-0 hr-blog">

                                    <section class="row-comment">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-md-6 widget-tag">
                                                    <h2 class="title-heading big font-size-24 mb-0">Related Tags :</h2>
                                                    <p class="title-small">
                                                        {{ $tagItems->isNotEmpty() ? $tagItems->implode('. ') : 'Repair. Service. Support' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6 widget-share">
                                                    <h2 class="title-heading big font-size-24 mb-0">Share :</h2>
                                                    <ul class="list-social">
                                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook"></i></a></li>
                                                        <li><a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a></li>
                                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-linkedin"></i></a></li>
                                                        <li><a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-whatsapp"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="themesflat-spacer clearfix" data-desktop="72" data-mobile="38" data-smobile="38"></div>

                                            <div class="widget-comment">
                                                <h2 class="title-heading big title-head mb-0">Comments</h2>
                                                @forelse($comments as $comment)
                                                    <div class="comment">
                                                        <div class="avatar">
                                                            <img src="{{ asset($fixmo . '/img/group/staff-box1@2x.png') }}" alt="{{ $comment->name }}">
                                                        </div>
                                                        <div class="wrap-comment">
                                                            <div class="name-date">
                                                                <h2 class="title-heading big name mb-0"><a href="#">{{ $comment->name }}</a></h2>
                                                                <p class="title-small mb-0">{{ optional($comment->created_at)->format('M d, Y') }}</p>
                                                            </div>
                                                            <div class="sub">
                                                                <p class="cmt-subs title-small mb-4">{{ $comment->comment }}</p>
                                                            </div>
                                                        </div>
                                                        @unless($loop->last)
                                                            <hr class="m-0 hr-blog">
                                                        @endunless
                                                    </div>
                                                @empty
                                                    <div class="comment-empty">
                                                        <p class="title-small mb-0">No approved comments yet.</p>
                                                    </div>
                                                @endforelse
                                            </div>

                                            <div class="themesflat-spacer clearfix" data-desktop="68" data-mobile="38" data-smobile="38"></div>

                                            <div class="comment-write">
                                                <h2 class="title-heading big title-head mb-0">Leave a Reply</h2>
                                                <p class="title-small comment-note mb-0">
                                                    Comment submissions are currently disabled on this frontend. Use the contact page if you need to reach the team directly.
                                                </p>
                                                <div class="frame-button mart-26">
                                                    <a href="{{ route('front.contact') }}" class="fixmo-button d-inline-flex shadow bg-red bold">
                                                        Contact Us
                                                        <span class="icon icon-long-arrow-right"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-4 hide-smb">
                                    <div class="side-bar blog-standard-sidebar">
                                        <div class="widget-search-box">
                                            <form action="{{ route('front.blog') }}" method="get" role="search" class="form-search">
                                                <input type="search" class="search-field" placeholder="Search Keywords" name="query" title="Search">
                                                <button type="submit" class="fixmo-button bg-red search-submit text-white">
                                                    <span class="search-icon fa fa-search"></span>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="themesflat-spacer clearfix" data-desktop="35" data-mobile="35" data-smobile="35"></div>

                                        @if($recentPosts->isNotEmpty())
                                            <div class="widget-recent-new">
                                                <h2 class="title-heading big font-size-33 mb-bar">Recent News</h2>
                                                <div class="hr">
                                                    <hr class="hr-3">
                                                    <hr class="hr-4">
                                                </div>
                                                <div class="widget-new">
                                                    @foreach($recentPosts as $recentPost)
                                                        <div class="recent-new{{ $loop->index === 1 ? ' middle' : '' }}{{ $loop->last ? ' last' : '' }}">
                                                            <div class="img-new">
                                                                <img src="{{ $recentPost->image ? asset($recentPost->image) : $fallbackBlogImage }}" alt="{{ $recentPost->title }}">
                                                            </div>
                                                            <div class="title-new">
                                                                <a href="{{ route('front.blog_details', [$recentPost->slug]) }}" class="title-heading big font-size-20 line-20">
                                                                    {{ Str::limit($recentPost->title, 48, '...') }}
                                                                </a>
                                                                <p class="title-small font-size-14 mb-0">
                                                                    <a href="{{ route('front.blog_details', [$recentPost->slug]) }}">
                                                                        {{ optional($recentPost->created_at)->format('d M Y') }}
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="themesflat-spacer clearfix" data-desktop="38" data-mobile="38" data-smobile="38"></div>
                                        @endif

                                        @if($topicCategories->isNotEmpty())
                                            <div class="widget-recent-new tag">
                                                <h2 class="title-heading big font-size-33 mb-bar">Popular Topics</h2>
                                                <div class="hr">
                                                    <hr class="hr-3">
                                                    <hr class="hr-4">
                                                </div>
                                                <div class="widget-button">
                                                    @foreach($topicCategories as $category)
                                                        <a class="fixmo-button{{ $selectedCategory && $selectedCategory->id === $category->id ? ' active' : '' }}" href="{{ route('front.blog', ['category' => $category->id]) }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="191" data-mobile="100" data-smobile="100"></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
