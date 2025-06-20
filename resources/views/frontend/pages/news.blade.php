@extends('frontend.master')

@section('content')
    <div id="content" class="blog-wrapper blog-archive page-wrapper">
        <div class="container">
            <nav id="breadcrumbs" class="yoast-breadcrumb breadcrumbs uppercase">
                <span>
                    <span>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </span>
                    <span class="divider">/</span>
                    <span class="breadcrumb_last" aria-current="page">
                        <strong>Bài viết</strong>
                    </span>
                </span>
            </nav>
        </div>
        <div class="row">
            <div class="large-3 col post-sidebar pt-0 d-none d-lg-block mt-3" id="product-sidebar">
                <div class="is-sticky-column" data-sticky-mode="javascript" style="transform: translateY(0px)">
                    <div class="is-sticky-column__inner">
                        <div class="sidebar-inner">
                            <aside id="nav_menu-2" class="widget widget_nav_menu">
                                <span class="widget-title shop-sidebar">Top sản phẩm in ấn</span>
                                <div class="is-divider small"></div>
                                <div class="menu-menu-chi-tiet-san-pham-container">
                                    <ul id="menu-menu-chi-tiet-san-pham" class="menu">

                                        @foreach ($topProducts as $item)
                                            <li id="menu-item-18076"
                                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18076">
                                                <a
                                                    href="{{ route('products.detail', [$item->category->slug, $item->slug]) }}">{{ $item->short_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div class="large-9 col medium-col-first">
                <h1 class="page-title">Tin Tức</h1>
                <div class="row large-columns-1 medium-columns- small-columns-1">

                    @foreach ($news as $new)
                        <div class="col post-item">
                            <div class="col-inner">
                                <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                                    <div class="box-image" style="width: 40%">
                                        <div class="image-cover" style="padding-top: 56%">
                                            <a href="{{ route('news', $new->slug) }}" class="plain"
                                                aria-label="{{ $new->subject }}"><img data-lazyloaded="1"
                                                    src="{{ showImage($new->featured_image) }}" width="300"
                                                    height="200" data-src="{{ showImage($new->featured_image) }}"
                                                    class="attachment-medium size-medium wp-post-image entered litespeed-loaded"
                                                    alt="{{ $new->subject }}" decoding="async"
                                                    data-srcset="{{ showImage($new->featured_image) }} 300w, {{ showImage($new->featured_image) }} 600w"
                                                    data-sizes="(max-width: 300px) 100vw, 300px" data-ll-status="loaded"
                                                    sizes="(max-width: 300px) 100vw, 300px"
                                                    srcset="
                                        {{ showImage($new->featured_image) }} 300w,
                                        {{ showImage($new->featured_image) }}         600w
                                        " />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="box-text text-left">
                                        <div class="box-text-inner blog-post-inner">
                                            <div class="c-line-top-meta">
                                                <a href="{{ route('news', $new->slug) }}"
                                                    class="c-meta-category">{{ $new->category?->name }}</a><span
                                                    class="c-meta-date">{{ $new->posted_at->format('d/m/Y') }}</span>
                                            </div>
                                            <h4 class="post-title is-large">
                                                <a href="{{ route('news', $new->slug) }}"
                                                    class="plain">{{ $new->subject }}</a>
                                            </h4>
                                            <div class="is-divider"></div>
                                            <p class="from_the_blog_excerpt">
                                                {{ \Str::words($new->summary, 30, '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $news->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
