@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 4)->first();
    $metaTitle = $SeoSettings ? ($SeoSettings->meta_title ?: $SeoSettings->seo_title) : 'Blog';
    $metaDescription = $SeoSettings ? ($SeoSettings->meta_description ?: $SeoSettings->seo_description) : '';
    $metaImage = $SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '';
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'Blog- DC Phone Repair')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
@endpush
@section('seos')
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $SeoSettings ? $SeoSettings->seo_title : 'Blog' }}">
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
    $fallbackBlogImage = asset($fixmo . '/img/group/protfolio7-770x450.jpg');
    $searchQuery = request('query');
    $topicCategories = $blogCategories->where('blogs_count', '>', 0)->take(8);
    $pageStart = max(1, $blog->currentPage() - 1);
    $pageEnd = min($blog->lastPage(), $pageStart + 2);
    if (($pageEnd - $pageStart) < 2) {
        $pageStart = max(1, $pageEnd - 2);
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
                                            <h2 class="title-heading big text-white">Blog</h2>
                                            <p class="name title-small mb-0">
                                                <a class="name title-small space" href="{{ route('front.home') }}">Home</a>
                                                Blog
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner-all">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $bannerImage }}" alt="Blog">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="themesflat-spacer clearfix" data-desktop="70" data-mobile="60" data-smobile="60"></div>
                    </section>

                    <section class="row-blog-standard">
                        <div class="container">
                            <div class="themesflat-spacer clearfix" data-desktop="50" data-mobile="0" data-smobile="0"></div>
                            <div class="row">
                                <div class="col-md-8">
                                    @if($searchQuery || $selectedCategory)
                                        <div class="post-prestation">
                                            <p class="title-small mb-0">
                                                Showing blog results
                                                @if($searchQuery)
                                                    for "{{ $searchQuery }}"
                                                @endif
                                                @if($selectedCategory)
                                                    in {{ $selectedCategory->name }}
                                                @endif
                                            </p>
                                        </div>
                                    @endif

                                    @forelse($blog as $b)
                                        @php
                                            $authorName = $b->admin?->name ? Str::upper($b->admin->name) : 'ADMIN';
                                            $postImage = $b->image ? asset($b->image) : $fallbackBlogImage;
                                        @endphp
                                        <article class="main-post-box marb-30 blog-standard-post">
                                            <div class="entry-img text-center">
                                                <a href="{{ route('front.blog_details', [$b->slug]) }}">
                                                    <img src="{{ $postImage }}" alt="{{ $b->title }}">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <ul class="post-media d-flex">
                                                    <li class="user bg-red">
                                                        <a class="title-small" href="{{ route('front.blog') }}">BY {{ $authorName }}</a>
                                                    </li>
                                                    <li class="date bg-red">
                                                        <a class="title-small" href="{{ route('front.blog_details', [$b->slug]) }}">
                                                            {{ $b->created_at ? $b->created_at->format('d F, Y') : '' }}
                                                        </a>
                                                    </li>
                                                    @if($b->category)
                                                        <li>
                                                            <a class="title-small" href="{{ route('front.blog', ['category' => $b->category->id]) }}">
                                                                {{ Str::upper($b->category->name) }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <div class="post-title">
                                                    <h3 class="title-heading big post">
                                                        <a href="{{ route('front.blog_details', [$b->slug]) }}">{{ $b->title }}</a>
                                                    </h3>
                                                    <p class="title-small mt-1">
                                                        {{ Str::limit(strip_tags($b->description), 220, '...') }}
                                                    </p>
                                                </div>
                                                <div class="frame-button">
                                                    <a href="{{ route('front.blog_details', [$b->slug]) }}" class="fixmo-button d-inline-flex shadow bg-red bold">
                                                        Read More
                                                        <span class="icon icon-long-arrow-right"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </article>
                                    @empty
                                        <article class="main-post-box marb-30">
                                            <div class="post-content">
                                                <div class="post-title">
                                                    <h3 class="title-heading big post">No blog posts found</h3>
                                                    <p class="title-small mt-1">Try a different keyword or clear the category filter.</p>
                                                </div>
                                                <div class="frame-button">
                                                    <a href="{{ route('front.blog') }}" class="fixmo-button d-inline-flex shadow bg-red bold">
                                                        View All Posts
                                                        <span class="icon icon-long-arrow-right"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </article>
                                    @endforelse

                                    @if($blog->hasPages())
                                        <div class="widget-page">
                                            @if($blog->onFirstPage())
                                                <span class="fixmo-button page previous disabled"></span>
                                            @else
                                                <a class="fixmo-button page previous" href="{{ $blog->previousPageUrl() }}"></a>
                                            @endif

                                            @if($pageStart > 1)
                                                <a class="fixmo-button page" href="{{ $blog->url(1) }}">1</a>
                                                @if($pageStart > 2)
                                                    <span class="fixmo-button page dots">...</span>
                                                @endif
                                            @endif

                                            @for($page = $pageStart; $page <= $pageEnd; $page++)
                                                @if($page == $blog->currentPage())
                                                    <span class="fixmo-button page current">{{ $page }}</span>
                                                @else
                                                    <a class="fixmo-button page" href="{{ $blog->url($page) }}">{{ $page }}</a>
                                                @endif
                                            @endfor

                                            @if($pageEnd < $blog->lastPage())
                                                @if($pageEnd < ($blog->lastPage() - 1))
                                                    <span class="fixmo-button page dots">...</span>
                                                @endif
                                                <a class="fixmo-button page" href="{{ $blog->url($blog->lastPage()) }}">{{ $blog->lastPage() }}</a>
                                            @endif

                                            @if($blog->hasMorePages())
                                                <a class="fixmo-button page next" href="{{ $blog->nextPageUrl() }}"></a>
                                            @else
                                                <span class="fixmo-button page next disabled"></span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4 hide-smb">
                                    <div class="side-bar blog-standard-sidebar">
                                        <div class="widget-search-box">
                                            <form action="{{ route('front.blog') }}" method="get" role="search" class="form-search">
                                                @if(request()->filled('category'))
                                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                                @endif
                                                <input type="search" class="search-field" placeholder="Search Keywords" name="query" value="{{ $searchQuery }}" title="Search">
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
                                                                        {{ $recentPost->created_at ? $recentPost->created_at->format('d M Y') : '' }}
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="themesflat-spacer clearfix" data-desktop="35" data-mobile="35" data-smobile="35"></div>
                                        @endif

                                        @if($blogCategories->isNotEmpty())
                                            <div class="widget-recent-new category">
                                                <h2 class="title-heading big font-size-33 mb-bar">Category</h2>
                                                <div class="hr">
                                                    <hr class="hr-3">
                                                    <hr class="hr-4">
                                                </div>
                                                <ul class="wrap-category ml-0">
                                                    @foreach($blogCategories as $category)
                                                        <li class="item-category">
                                                            <a class="title-small{{ $selectedCategory && $selectedCategory->id === $category->id ? ' active' : '' }}" href="{{ route('front.blog', array_filter(['category' => $category->id, 'query' => $searchQuery])) }}">
                                                                {{ $category->name }}
                                                            </a>
                                                            <a class="title-small float-right" href="{{ route('front.blog', array_filter(['category' => $category->id, 'query' => $searchQuery])) }}">
                                                                ({{ $category->blogs_count }})
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="themesflat-spacer clearfix" data-desktop="35" data-mobile="35" data-smobile="35"></div>
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
                                                        <a class="fixmo-button{{ $selectedCategory && $selectedCategory->id === $category->id ? ' active' : '' }}" href="{{ route('front.blog', array_filter(['category' => $category->id, 'query' => $searchQuery])) }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="themesflat-spacer clearfix" data-desktop="186" data-mobile="100" data-smobile="100"></div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
