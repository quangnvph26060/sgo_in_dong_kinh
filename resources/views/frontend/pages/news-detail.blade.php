@extends('frontend.master')

@section('title', $news->subject ?? $news->seo_title)
@section('og:description', $news->seo_description ?? $news->summary)
@section('description', $news->seo_description ?? $news->summary)
@section('image', showImage($news->featured_image))

@section('content')
    <div id="content" class="blog-wrapper blog-single page-wrapper">
        <div class="container" style="margin-bottom: 20px">
            <nav id="breadcrumbs" class="yoast-breadcrumb breadcrumbs uppercase">
                <span>
                    <span>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </span>
                    <span class="divider">/</span>
                    <span class="breadcrumb_last" aria-current="page">
                        <strong>{{ $news->subject }}</strong>
                    </span>
                </span>
            </nav>
        </div>
        <div class="row">
            <div class="post-sidebar large-3 col pb-1">
                <div class="is-sticky-column" data-sticky-mode="javascript">
                    <div class="is-sticky-column__inner">
                        <div id="secondary" class="widget-area" role="complementary">
                            <aside class="widget block_widget">
                                <div class="recent-posts-widget">
                                    <h3 class="widget-title">TOP 5 BÀI VIẾT GẦN ĐÂY</h3>
                                    <ul class="recent-posts-list">
                                        @foreach ($latestNews as $item)
                                            <li class="recent-post-item">
                                                <a href="{{ route('news', $item->slug) }}" class="recent-post-link">
                                                    <div class="recent-post-thumb">
                                                        <img src="{{ showImage($item->featured_image) }}"
                                                            alt="{{ $item->subject }}">
                                                    </div>
                                                    <div class="recent-post-content">
                                                        <div class="recent-post-title">
                                                            {{ \Str::words($item->subject, 8, '...') }}
                                                        </div>
                                                    </div>
                                                </a>
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
                <article id="post-13532"
                    class="post-13532 post type-post status-publish format-standard has-post-thumbnail hentry category-bao-gia-in-an-ha-noi tag-bao-gia-catalogue-a4 tag-bao-gia-in-an-catalogue tag-gia-in-catalogue tag-gia-lam-catalogue">
                    <div class="article-inner">
                        <header class="entry-header">
                            <div class="entry-header-text entry-header-text-top text-left">
                                <h1 class="entry-title">
                                    {{ $news->subject }}
                                </h1>
                                <div class="entry-meta">
                                    <span class="posted-on">Đăng vào
                                        <a href="" rel="bookmark">
                                            <time class="entry-date published"
                                                datetime="{{ $news->posted_at }}">{{ $news->posted_at->format('d/m/Y') }}</time>
                                            <time class="updated"
                                                datetime="{{ $news->updated_at }}">{{ $news->updated_at->format('d/m/Y') }}</time>
                                        </a>
                                    </span>

                                    <span class="entry-view">
                                        <span style="margin-right: 3px">
                                            <svg style="vertical-align: inherit" xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" viewBox="0 0 24 24">
                                                <path
                                                    d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z">
                                                </path>
                                            </svg>
                                        </span>{{ $news->view }} lượt xem</span>
                                </div>
                                <hr />
                            </div>
                        </header>
                        <div class="entry-content single-page">
                            <p>
                                {{ $news->summary }}
                            </p>
                            {!! $news->article !!}
                        </div>
                    </div>
                </article>
                <div class="html-before-comments mb">
                    <p><strong>Website</strong>: {{ $setting->website }}</p>

                    <p><strong>Hotline</strong>: {{ $setting->phone }} - <span style="color: #0000ff"><a
                                style="color: #0000ff"
                                href="https://zalo.me/{{ preg_replace('/\D+/', '', $setting->hotline) }}" target="_blank"
                                rel="nofollow">{{ $setting->hotline }}</a></span> (ĐT/ZALO)</p>

                    <p>
                        <span style="vertical-align: inherit"><strong>Gmail</strong>: {{ $setting->email }}</span>
                    </p>
                    <p>
                        <strong>Địa chỉ</strong>: {{ $setting->address }}
                    </p>
                    <p><strong>MST</strong>: {{ $setting->tax_code }}</p>
                </div>

                <p class="list-tag">
                    <i class="icon-tag"></i> Tags:
                    @foreach ($tags as $tag)
                        <a href="#" rel="tag">{{ $tag }}</a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
        <section class="section">
            <div class="container">
                <div class="tabbed-content tab-sinlge">
                    <ul class="nav nav-line-bottom nav-uppercase nav-size-normal nav-left" role="tablist">
                        <li id="tab-tin-liên-quan" class="tab active has-icon" role="presentation">
                            <a href="#tab_tin-liên-quan" role="tab" aria-selected="true"
                                aria-controls="tab_tin-liên-quan">
                                <h3>Tin liên quan</h3>
                            </a>
                        </li>
                        <li id="tab-tin-mới-nhất" class="tab has-icon" role="presentation">
                            <a href="#tab_tin-mới-nhất" tabindex="-1" role="tab" aria-selected="false"
                                aria-controls="tab_tin-mới-nhất">
                                <h3>Tin mới nhất</h3>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-panels">
                        <div id="tab_tin-liên-quan" class="panel active entry-content" role="tabpanel"
                            aria-labelledby="tab-tin-liên-quan">
                            <div class="wrap-related-post">
                                <div class="row large-columns-4 medium-columns-2 small-columns-1">
                                    @foreach ($relatedNews as $rn)
                                        <div class="col post-item pb-0">
                                            <div class="col-inner">
                                                <div class="box-normal box-text-bottom box-blog-post has-hover">
                                                    <a href="{{ route('news', $rn->slug) }}" class="plain">
                                                        <div class="box-image">
                                                            <div class="image-cover" style="padding-top: 66.66%">
                                                                <img data-lazyloaded="1"
                                                                    src="{{ showImage($rn->featured_image) }}"
                                                                    width="600" height="600"
                                                                    data-src="{{ showImage($rn->featured_image) }}"
                                                                    class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                                    alt="{{ $rn->short_name }}" decoding="async"
                                                                    data-srcset="{{ showImage($rn->featured_image) }} 600w, {{ showImage($rn->featured_image) }} 150w, {{ showImage($rn->featured_image) }} 300w, {{ showImage($rn->featured_image) }} 510w, {{ showImage($rn->featured_image) }} 100w"
                                                                    data-sizes="(max-width: 600px) 100vw, 600px" />
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="box-text text-left">
                                                        <div class="box-text-inner blog-post-inner">
                                                            <div class="c-line-top-meta">
                                                                <p class="c-meta-category">{{ $rn->category?->name }}</p>
                                                                <span
                                                                    class="c-meta-date">{{ $rn->posted_at->format('d/m/Y') }}</span>
                                                            </div>
                                                            <a href="{{ route('news', $rn->slug) }}" class="plain">
                                                                <h4 class="post-title is-large">
                                                                    {{ $rn->subject }}
                                                                </h4>
                                                                <p class="from_the_blog_excerpt">
                                                                    {{ \Str::words($rn->summary, 20, '...') }}
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="tab_tin-mới-nhất" class="panel entry-content" role="tabpanel"
                            aria-labelledby="tab-tin-mới-nhất">
                            <div class="row large-columns-4 medium-columns-1 small-columns-1">

                                @foreach ($latestNews->take(4) as $ln)
                                    <div class="col post-item">
                                        <div class="col-inner">
                                            <div class="box box-normal box-text-bottom box-blog-post has-hover">
                                                <div class="box-image">
                                                    <div class="image-cover" style="padding-top: 66.66%">
                                                        <a href="{{ route('news', $ln->slug) }}" class="plain"
                                                            aria-label="{{ $ln->subject }}"><img data-lazyloaded="1"
                                                                src="{{ showImage($ln->featured_image) }}" width="300"
                                                                height="200"
                                                                data-src="{{ showImage($ln->featured_image) }}"
                                                                class="attachment-medium size-medium wp-post-image"
                                                                alt="{{ $ln->subject }}" decoding="async"
                                                                data-srcset="{{ showImage($ln->featured_image) }} 300w, {{ showImage($ln->featured_image) }} 600w"
                                                                data-sizes="(max-width: 300px) 100vw, 300px" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="box-text text-left">
                                                    <div class="box-text-inner blog-post-inner">
                                                        <div class="c-line-top-meta">
                                                            <p class="c-meta-category">{{ $ln->category?->name }}</p>
                                                            <span
                                                                class="c-meta-date">{{ $ln->posted_at->format('d/m/Y') }}</span>
                                                        </div>
                                                        <h4 class="post-title is-large">
                                                            <a href="{{ route('news', $ln->slug) }}" class="plain"></a>
                                                        </h4>
                                                        <div class="is-divider">{{ $ln->subject }}</div>
                                                        <p class="from_the_blog_excerpt">
                                                            {{ \Str::words($ln->summary, 20, '...') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tabbed-content .nav li');
            const panels = document.querySelectorAll('.tabbed-content .tab-panels .panel');

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Xóa lớp active khỏi tất cả các tab và panel
                    tabs.forEach(t => t.classList.remove('active'));
                    panels.forEach(p => p.classList.remove('active'));

                    // Thêm lớp active cho tab được chọn
                    this.classList.add('active');

                    // Lấy id của panel cần hiển thị từ href
                    const targetId = this.querySelector('a').getAttribute('href');
                    const targetPanel = document.querySelector(targetId);
                    if (targetPanel) {
                        targetPanel.classList.add('active');
                    }
                });
            });
        });

        const images = document.querySelectorAll('.entry-content.single-page img');

        images.forEach(img => {
            // Lấy giá trị alt của từng ảnh
            const altText = img.alt;

            // Tạo thẻ div để hiển thị alt
            const altDiv = document.createElement('div');
            altDiv.classList.add('image-alt');
            altDiv.textContent = altText;

            // Thêm thẻ altDiv bên dưới ảnh
            img.parentElement.appendChild(altDiv);
        });
    </script>
@endpush


@push('styles')
    <style>
        .image-alt {
            display: flex;
            justify-content: center;
            /* căn ngang */
            align-items: center;
            /* căn dọc */
            height: 30px;
            /* nếu muốn cố định chiều cao */
            font-style: italic;
            color: #555;
            background-color: #f9f9f9;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 0.9rem;
            margin-top: 10px;
        }



        /* Màu chữ khi hover vào tab */
        .tab a:hover h3 {
            color: #007bff;
            /* Màu xanh */
        }

        /* Màu chữ khi tab đang active */
        .tab.active a h3 {
            color: #007bff;
            /* Màu xanh */
        }

        /* Màu chữ mặc định của tab */
        .tab a h3 {
            color: #333;
            /* Màu chữ mặc định */
        }

        .recent-posts-widget {
            background: #fff;
            border-radius: 10px;
        }

        .widget-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            color: #111;
        }

        .recent-posts-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .recent-post-item {
            margin-bottom: 1.2rem;
        }

        .recent-post-link {
            text-decoration: none;
            color: inherit;
            gap: 10px;
        }

        .recent-post-thumb {
            flex-shrink: 0;
            width: 100%;
            height: 150px;
            overflow: hidden;
            border-radius: 6px;
        }

        .recent-post-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recent-post-content {
            /* flex: 1; */
            margin-top: 5px;
        }

        .recent-post-title {
            font-size: .9rem;
            font-weight: 500;
            line-height: 1.4;
            color: #222;
        }

        .recent-post-link:hover .recent-post-title {
            color: #007bff;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .recent-post-content {
                margin-top: 0px;
            }

            .recent-post-link {
                display: flex;
            }

            .widget-title {
                font-size: 1.25rem;
            }

            .recent-post-thumb {
                width: 140px;
                height: 80px;
            }

            .recent-post-title {
                font-size: 0.8rem;
            }
        }
    </style>
@endpush
