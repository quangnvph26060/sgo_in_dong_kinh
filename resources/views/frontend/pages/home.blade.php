@extends('frontend.master')

@section('title', $setting->title ?? $setting->seo_title)
@section('description', $setting->seo_description)
@section('image', showImage($setting->logo))

@section('content')
    <div id="content" role="main" class="content-area">
        <section class="section" id="section_1158364768">
            <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
            <div class="section-content relative">
                <div class=" row-small row-banner" id="row-1765437824">
                    <div id="col-1563474248" class="col medium-12 small-12 large-12" style="padding: 0 0">
                        <div class="col-inner">
                            <div class="swiper mySwiper1">
                                <div class="swiper-wrapper">
                                    @foreach ($sliders as $slider)
                                        <!-- Slide {{ $loop->iteration }} -->
                                        <div class="swiper-slide slide-bg">
                                            <img src="{{ showImage($slider->image) }}" alt="{{ $slider->title }}" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container-custom">
                <div class="product-grid">
                    @foreach ($categoriesPageHome->take(11) as $item)
                        <a href="{{ route('category.product', $item->slug) }}">
                            <div class="category-item active">
                                <img src="{{ showImage($item->image) }}" alt="{{ $item->name }}">
                                <span>{{ $item->name }}</span>
                            </div>
                        </a>
                    @endforeach

                    <div class="category-item xem-tat-ca">
                        <div class="xem-tat-ca-content">
                            <span class="plus">+</span>
                            <span class="text">Xem tất cả</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="library-container">
                <div class="library-header">
                    <h1>SẢN PHẨM NỔI BẬT</h1>
                </div>
                <div class="product-list">
                    @foreach ($products as $product)
                        <!-- Một sản phẩm -->
                        <div class="product-card">
                            <a href="{{ route('products.detail', [$product->category->slug, $product->slug]) }}"
                                class="w-100">
                                <img src="{{ showImage($product->image) }}" alt="{{ $product->name }}">
                                <div class="product-info">
                                    <p class="op-7 no-text-overflow is-smaller uppercase">
                                        {{ $product->category->name }}
                                    </p>
                                    <h3>{{ $product->name }}</h3>
                                    <p class="code">{{ $product->sku }}</p>
                                    <button class="custom-button mt-2">Báo giá chi tiết</button>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="intro-section">
                <img src="{{ showImage($setting->banner) }}" alt="">
            </div>
        </section>

        @if ($postsNews->isNotEmpty())
            <section>
                <div class="library-container">
                    <div class="library-header">
                        <h1>TIN TỨC MỚI NHẤT</h1>
                    </div>

                    <div class="news-content">
                        <div class="news-list">
                            <!-- News Card 1 -->
                            @foreach ($postsNews->take(3) as $post)
                                <div class="news-card">
                                    <a href="{{ route('news', $post->slug) }}">
                                        <img src="{{ showImage($post->featured_image) }}" alt="{{ $post->subject }}">
                                        <div class="news-meta">
                                            <span class="news-date"><i class="fa-regular fa-clock"></i>
                                                {{ $post->posted_at->format('d/m/Y') }}</span>
                                            <span class="news-view"><i class="fa-regular fa-eye"></i>
                                                {{ $post->view_count }}</span>
                                        </div>
                                        <div class="news-info">
                                            <div class="news-headline">{{ $post->subject }}</div>
                                            <div class="news-desc">{{ Str::words($post->summary, 10, '...') }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="news-side">
                            @foreach ($postsNews->slice(3, 3) as $post)
                                <div class="news-side-item">
                                    <div class="side-title">{{ $post->subject }}</div>
                                    <div class="side-meta">
                                        <i class="fa-regular fa-clock"></i> {{ $post->posted_at->format('d/m/Y') }}
                                        <i class="fa-regular fa-eye"></i> {{ $post->view_count }}
                                    </div>
                                </div>
                            @endforeach
                            <a href="#" class="news-btn news-btn-yellow">XEM NHIỀU HƠN</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="section" id="section_580198375">
            <div class="bg section-bg fill bg-fill bg-loaded"></div>
            <div class="section-content relative">
                <div class="row row-small" id="row-595060047">
                    <div id="col-186028584" class="col box-form-home medium-6 small-12 large-6">
                        <div class="col-inner" style="background-color: rgb(255, 255, 255)">
                            <div id="text-1620241628" class="text">
                                <h4>
                                    <span class="ez-toc-section" id="DANG_KY_TU_VAN"></span><span
                                        style="font-size: 130%">ĐĂNG KÝ TƯ VẤN</span><span
                                        class="ez-toc-section-end"></span>
                                </h4>

                            </div>
                            <div id="text-1907170764" class="text">
                                <p>
                                    Quý khách hàng vui lòng để lại thông tin bên dưới, chúng
                                    tôi sẽ liên hệ với quý khách trong vòng ít phút<br />
                                </p>
                            </div>
                            <div class="wpcf7 no-js" id="wpcf7-f123-p5185-o1" lang="vi" dir="ltr"
                                data-wpcf7-id="123">
                                <div class="screen-reader-response">
                                    <p role="status" aria-live="polite" aria-atomic="true"></p>
                                    <ul></ul>
                                </div>
                                <form action="" method="post" class="wpcf7-form init" aria-label="Form liên hệ"
                                    novalidate="novalidate" data-status="init">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <span class="wpcf7-form-control-wrap" data-name="your-name"><input
                                                        size="40" maxlength="400"
                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Họ và Tên*" value="" type="text"
                                                        name="your-name" /></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col large-6">
                                            <div class="form-group">
                                                <span class="wpcf7-form-control-wrap" data-name="your-phone"><input
                                                        size="40" maxlength="400"
                                                        class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel form-control"
                                                        id="your-phone" aria-required="true" aria-invalid="false"
                                                        placeholder="Số điện thoại*" value="" type="tel"
                                                        name="your-phone" /></span>
                                            </div>
                                        </div>
                                        <div class="col large-6">
                                            <div class="form-group">
                                                <span class="wpcf7-form-control-wrap" data-name="your-email"><input
                                                        size="40" maxlength="400"
                                                        class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email form-control"
                                                        aria-required="true" aria-invalid="false" placeholder="Email*"
                                                        value="" type="email" name="your-email" /></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <span class="wpcf7-form-control-wrap" data-name="your-message">
                                                    <textarea cols="40" rows="10" maxlength="2000"
                                                        class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control" aria-required="true"
                                                        aria-invalid="false" placeholder="Nội dung liên hệ*" name="your-message"></textarea>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input class="wpcf7-form-control wpcf7-submit has-spinner btn btn-primary"
                                                    id="btn-submit" type="submit" value="Đăng ký tư vấn" /><span
                                                    class="wpcf7-spinner"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wpcf7-response-output" aria-hidden="true"></div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div id="col-1002633338" class="col hide-for-small medium-6 small-12 large-6">
                        <div class="col-inner" style="background-color: rgb(255, 255, 255)">
                            <div class="map-home">
                                <p>
                                    <iframe data-lazyloaded="1" src="about:blank" style="border: 0"
                                        title="Địa chỉ công ty" data-src="{{ extractIframeSrc($setting->map) }}"
                                        width="100%" height="482" allowfullscreen="allowfullscreen">
                                    </iframe><br />
                                </p>
                            </div>
                        </div>
                    </div>

                    @foreach ($supports as $support)
                        <div id="col-1628460180" class="col medium-4 small-12 large-4">
                            <div class="col-inner" style="background-color: rgb(255, 255, 255)">
                                <div class="box has-hover box-info-img has-hover box-vertical box-text-bottom">
                                    <div class="box-image" style="border-radius: 100%; width: 18%">
                                        <div class="">
                                            <img data-lazyloaded="1" src="{{ showImage($support->image) }}"
                                                decoding="async" width="68" height="68"
                                                data-src="{{ showImage($support['image']) }}"
                                                class="attachment-original size-original" alt="{{ $support->title }}" />
                                        </div>
                                    </div>
                                    <div class="box-text text-left" style="padding: 15px 0px 15px 10px">
                                        <div class="box-text-inner">
                                            <h4>
                                                <span class="ez-toc-section"
                                                    id="Kinh_doanh_Tu_van_247"></span>{{ $support->title }}<span
                                                    class="ez-toc-section-end"></span>
                                            </h4>
                                            <div class="icon-box featured-box icon-box-left text-left">
                                                <div class="icon-box-img" style="width: 20px">
                                                    <div class="icon">
                                                        <div class="icon-inner">
                                                            <img data-lazyloaded="1"
                                                                src="{{ asset('frontend/assets/image/Icon-sax.png') }}"
                                                                decoding="async" width="20" height="21"
                                                                data-src="{{ asset('frontend/assets/image/Icon-sax.png') }}"
                                                                class="attachment-medium size-medium" alt="Icon Sax" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="icon-box-text last-reset">
                                                    <p>
                                                        <a href="tel:{{ preg_replace('/\D+/', '', strip_tags($support['phone_number'])) }}"
                                                            rel="nofollow">{{ $support->phone_number }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div id="gap-2026242052" class="gap-element clearfix"
                                                style="display: block; height: auto">

                                            </div>
                                            <div class="icon-box featured-box icon-box-left text-left">
                                                <div class="icon-box-img" style="width: 20px">
                                                    <div class="icon">
                                                        <div class="icon-inner">
                                                            <img data-lazyloaded="1"
                                                                src="{{ asset('frontend/assets/image/icon-mail.png') }}"
                                                                decoding="async" width="20" height="21"
                                                                data-src="{{ asset('frontend/assets/image/icon-mail.png') }}"
                                                                class="attachment-medium size-medium" alt="Icon Mail" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="icon-box-text last-reset">
                                                    <p>{{ $support->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @if ($partners->isNotEmpty())
            <section class="partners-section py-5">
                <div class="container">
                    <div class="library-header text-center mb-4">
                        <h1>ĐỐI TÁC KHÁCH HÀNG</h1>
                    </div>
                    <div class="swiper partners-slider">
                        <div class="swiper-wrapper">
                            @foreach ($partners as $partner)
                                <div class="swiper-slide">
                                    <div class="partner-item">
                                        <img src="{{ showImage($partner->image) }}" alt="{{ $partner->name }}"
                                            class="img-fluid">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </div>
@endsection

@push('scripts')
    <script>
        const swiperPost = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: "slide", // bạn có thể dùng "fade"
        });

        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.partners-slider', {
                slidesPerView: 6,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    480: {
                        slidesPerView: 3,
                        spaceBetween: 15
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 15
                    },
                    992: {
                        slidesPerView: 5,
                        spaceBetween: 20
                    },
                    1200: {
                        slidesPerView: 6,
                        spaceBetween: 20
                    }
                }
            });
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .mySwiper1 .swiper-slide img {
            width: 100%;
            object-fit: cover;
            max-height: 560px;
        }

        .library-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 12px;
        }

        .library-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .library-header h1 {
            color: #1596e2;
            font-size: 1.5rem;
            text-align: center;
            position: relative;
            display: inline-block;
            margin-bottom: 0;
        }

        .library-header h1::after {
            content: "";
            display: block;
            width: 0;
            height: 4px;
            background: linear-gradient(90deg, #3ec6b6, #1596e2);
            border-radius: 2px;
            margin: 8px auto 0 auto;
            transition: width 0.4s cubic-bezier(.4, 0, .2, 1);
        }

        .library-header h1:hover::after {
            width: 20%;
        }

        .library-header nav {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .library-header nav a {
            color: #222;
            text-decoration: none;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .library-header nav a:hover {
            background: #e6f6f4;
            color: #3ec6b6;
        }

        @media (max-width: 1024px) {
            .product-list {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .product-list {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        .product-card {
            background: #fff;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: box-shadow 0.2s, border 0.2s;
            cursor: pointer;
            height: 100%;
            box-sizing: border-box;
            text-decoration: none;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 8px;
        }

        .product-info {
            width: 100%;
            display: flex;
            flex-direction: column;
            flex: 1 1 auto;
        }

        .product-info h3 {
            font-size: 1rem;
            margin: 0 0 4px 0;
            color: #222;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 2.5em;
            line-height: 1.25;
        }

        .product-info .code {
            color: #3ec6b6;
            font-size: 0.95rem;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            margin-top: auto;
            margin-bottom: 8px;
            min-height: 32px;
            border: 1px solid #3ec6b6;
            background: #e6f6f4;
            border-radius: 100px;
            padding: 3px 0;
            justify-content: center;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 35px;
            align-items: stretch;
        }

        @media (max-width: 1024px) {
            .product-list {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .product-list {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .product-price .sale-price {
                font-size: 1rem !important;
            }
        }

        @media (max-width: 480px) {
            .product-list {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .product-info h3 {
                font-size: 0.8rem;
                height: 3.2em;
            }

            .product-info .code {
                font-size: 0.85rem;
            }

            .product-price {
                min-height: 28px;
            }
        }

        @media (max-width: 420px) {
            .product-list {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 8px;
            }

            .product-card {
                width: 48%;
                background: #fff;
                border: 1px solid #eee;
                border-radius: 6px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                padding: 8px 6px;
                display: flex;
                flex-direction: column;
                align-items: center;
                flex-grow: 1;
            }

            .product-card img {
                width: 100%;
                height: auto;
                object-fit: cover;
                border-radius: 4px;
                margin-bottom: 4px;
            }

            .product-info {
                text-align: center;
                width: 100%;
                height: auto !important;
                overflow: visible !important;
                padding-bottom: 4px;
                /* ✅ tránh cắt chữ cuối nếu bị dính đáy */
            }

            .product-info p.op-7 {
                font-size: 11px;
                color: #888;
                margin: 2px 0;
                white-space: normal;
                overflow: visible;
                text-overflow: unset;
            }

            .product-info h3 {
                font-size: 11px;
                font-weight: bold;
                margin: 4px 0;
                line-height: 1.6;
                /* ✅ tăng nhẹ để không bị cắt */
                white-space: normal;
                word-break: break-word;
                padding-bottom: 2px;
            }

            .product-info p.code {
                font-size: 11px;
                color: #26a69a;
                margin-top: 6px;
                /* ✅ thêm khoảng cách rõ ràng */
                margin-bottom: 2px;
            }

            .custom-button {
                font-size: 12px;
                padding: 5px 8px;
                border: none;
                background-color: #007bff;
                color: #fff;
                border-radius: 4px;
                cursor: pointer;
                width: fit-content;
                margin: 0 auto;
                margin-top: 4px;
            }
        }



        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 0;
            display: flex;
            gap: 40px;
        }

        .product-grid {
            flex: 3 1 0;
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
        }

        .category-item {
            width: 181px;
            height: 181px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px #eee;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: box-shadow 0.2s, border 0.2s;
            cursor: pointer;
            border: 2px solid transparent;
            padding: 10px;
        }

        .category-item img {
            width: 100%;
            height: 132px;
            margin-bottom: 5px;
        }

        .category-item span {
            font-size: 12px;
            color: #222;
            text-align: center;
        }

        .category-item.active {
            border: 2px solid #e6f6f4;
            box-shadow: 0 4px 20px #e6f6f4;
            color: #3ec6b6;
        }

        .category-item.active span {
            color: #3ec6b6;
        }

        .category-item.xem-tat-ca {
            border: 2px solid #222;
            background: #fff;
            color: #222;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .xem-tat-ca-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 4px;
        }


        .xem-tat-ca .plus {
            font-size: 32px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }



        .xem-tat-ca .text {
            font-size: 14px;
            line-height: 1.2;
        }

        .product-item:hover {
            box-shadow: 0 4px 20px #e6f6f4;
            border: 2px solid #3ec6b6;
        }

        #post-mobile {
            display: none;
        }

        /* Chỉ hiển thị Swiper khi màn hình nhỏ hơn hoặc bằng 768px */
        @media (max-width: 768px) {
            #post-mobile {
                display: block;
            }
        }

        #section_580198375 {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        #section_580198375 .section-bg.bg-loaded {
            background-image: url({{ asset('frontend/assets/image/bg-hang-in-hoa-long.jpg') }});
        }

        @media (min-width: 550px) {
            #section_580198375 {
                padding-top: 52px;
                padding-bottom: 52px;
            }
        }

        #col-1314133381>.col-inner {
            padding: 0px 6px 0px 6px;
            border-radius: 12px;
        }

        #gap-197707568 {
            padding-top: 10px;
        }

        #col-1005452081>.col-inner {
            padding: 0px 6px 0px 6px;
            border-radius: 12px;
        }

        #gap-996847718 {
            padding-top: 10px;
        }

        #col-1628460180>.col-inner {
            padding: 0px 6px 0px 6px;
            border-radius: 12px;
        }

        #gap-2026242052 {
            padding-top: 10px;
        }

        #col-1002633338>.col-inner {
            padding: 29px 29px 8px 29px;
            border-radius: 16px;
        }

        #col-186028584>.col-inner {
            padding: 19px 19px 19px 19px;
            border-radius: 16px;
        }

        #text-1907170764 {
            color: rgb(0, 0, 0);
        }

        #text-1907170764>* {
            color: rgb(0, 0, 0);
        }

        #text-1620241628 {
            color: #1596e2;
        }

        #text-1620241628>* {
            color: #1596e2;
        }

        #section_1431349545 {
            padding-top: 50px;
            padding-bottom: 50px;
            background-color: #E5EFF9;
        }

        #image_1704918750 {
            width: 100%;
        }

        #stack-57586344>* {
            --stack-gap: 2.5rem;
        }

        #gap-2051293448 {
            padding-top: 0px;
        }

        #gap-187693907 {
            padding-top: 0px;
        }

        #image_70683243 {
            width: 100%;
        }

        #stack-2692657315>* {
            --stack-gap: 2.5rem;
        }

        #image_1684144030 {
            width: 100%;
        }

        #stack-2972240358>* {
            --stack-gap: 2.5rem;
        }

        #section_1703875609 {
            padding-top: 30px;
            padding-bottom: 30px;
            background-color: rgb(232, 232, 232);
        }

        #text-2393042501 {
            color: #1596e2;
        }

        #text-2393042501>* {
            color: #1596e2;
        }

        #section_1158364768 {
            padding-top: 0px;
            padding-bottom: 0px;
            /* background-color: #E5EFF9; */
        }

        #image_1468669802 {
            width: 100%;
            margin-top: 43px;
        }

        #image_1343568344 {
            width: 100%;
            margin-top: 43px;
        }

        #image_689441222 {
            width: 100%;
        }

        #col-1563474248>.col-inner {
            border-radius: 16px;
        }

        #text-2106889081 {
            color: #1596e2;
        }

        #text-2106889081>* {
            color: #1596e2;
        }

        #section_1013333252 {
            padding-top: 50px;
            padding-bottom: 50px;
            background-color: rgb(245, 245, 245);
        }

        @media (min-width: 550px) {
            #section_1013333252 {
                padding-top: 50px;
                padding-bottom: 50px;
            }
        }

        @media (max-width: 900px) {
            .container-custom {
                flex-direction: column;
                gap: 20px;
                padding: 20px 10px;
            }

            .product-grid {
                justify-content: center;
            }
        }

        @media (max-width: 600px) {
            .product-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                /* 2 cột bằng nhau */
                gap: 10px;
                /* khoảng cách đều giữa các sản phẩm */
                padding: 0 10px;
                /* khoảng cách với lề trái/phải */
                box-sizing: border-box;
            }

            .product-item {
                width: 100%;
                /* để item tự co theo cột */
                margin: 0;
                /* loại bỏ margin không cần thiết */
                background: #fff;
                text-align: center;
            }

            .product-item img {
                width: 40px;
                height: 40px;
                margin-bottom: 6px;
            }

            .product-item span {
                font-size: 14px;
                display: block;
            }
        }



        .product-card:hover .product-info>button {
            background: #3ec6b6;
            color: #fff;
        }

        .product-price {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            margin-top: auto;
            margin-bottom: 8px;
            min-height: 32px;
            border: 1px solid #3ec6b6;
            background: #e6f6f4;
            border-radius: 100px;
            padding: 3px 0;
            justify-content: center;
            /* Đảm bảo chiều cao đều khi không có giá gốc */
        }

        .product-card:hover .product-price {
            background: #3ec6b6;
            color: #fff;
        }

        .product-card:hover .product-price .sale-price,
        .product-card:hover .product-price .old-price {
            color: #fff;
        }

        .product-price .old-price {
            font-size: 0.95rem;
            color: #aaa;
            text-decoration: line-through;
            font-weight: 400;
        }

        .product-price .sale-price {
            font-size: 1.1rem;
            color: #e53935;
            font-weight: 700;
        }

        .news-section {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 16px;
        }

        .news-title {
            text-align: center;
            margin-bottom: 32px;
        }

        .news-subtitle {
            color: #222;
            font-size: 1rem;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .news-title h2 {
            font-size: 2.2rem;
            font-weight: bold;
            color: #222;
            margin: 0;
            letter-spacing: 1px;
        }

        .news-title-underline {
            width: 180px;
            height: 3px;
            background: #222;
            margin: 16px auto 0 auto;
            border-radius: 2px;
        }

        .news-content {
            display: flex;
            gap: 32px;
            align-items: flex-start;
        }

        .news-list {
            display: flex;
            gap: 24px;
            flex: 3;
        }

        .news-card {
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 12px #eee;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 340px;
            min-width: 260px;
            overflow: hidden;
            position: relative;
        }

        .news-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .news-meta {
            display: flex;
            gap: 16px;
            align-items: center;
            padding: 12px 16px 0 16px;
            font-size: 0.98rem;
            color: #1596e2;
            justify-content: space-between;
        }

        .news-meta i {
            margin-right: 4px;
        }

        .news-info {
            padding: 8px 16px 0 16px;
            flex: 1;
        }

        .news-headline {
            font-weight: bold;
            font-size: 1.08rem;
            color: #222;
            margin-bottom: 6px;
        }

        .news-desc {
            color: #555;
            font-size: 0.98rem;
            margin-bottom: 16px;
        }

        .news-btn {
            display: block;
            width: 80%;
            margin: 0 auto 18px auto;
            padding: 10px 0;
            border-radius: 4px;
            font-weight: bold;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.2s;
        }

        .news-btn-green {
            background: #18c2a5;
        }

        .news-btn-green:hover {
            background: #1596e2;
        }

        .news-btn-pink {
            background: #f7377b;
        }

        .news-btn-pink:hover {
            background: #1596e2;
        }

        .news-btn-blue {
            background: #1596e2;
        }

        .news-btn-blue:hover {
            background: #18c2a5;
        }

        .news-btn-yellow {
            background: #ffe600;
            color: #222;
        }

        .news-btn-yellow:hover {
            background: #ffd600;
            color: #222;
        }

        .news-side {
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 12px #eee;
            flex: 1;
            padding: 24px 18px 18px 18px;
            min-width: 260px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .news-side-item {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }

        .news-side-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .side-title {
            font-size: 1rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .side-meta {
            font-size: 0.95rem;
            color: #888;
        }

        .side-meta i {
            margin-right: 3px;
            margin-left: 8px;
        }

        .news-side .news-btn-yellow {
            width: 100%;
            margin: 12px 0 0 0;
            padding: 12px 0;
            font-size: 1.05rem;
            font-weight: bold;
            border-radius: 4px;
        }

        .intro-section {
            width: 100%;
            height: auto;
            max-height: 635px;
            /* hoặc chiều cao tối đa bạn mong muốn */
            overflow: hidden;
            position: relative;
        }

        .intro-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* quan trọng: đảm bảo ảnh phủ đều không méo */
            display: block;
        }

        /* @media (min-width: 1025px) {
                        .intro-section img {
                            height: 700px;
                        }
                    } */

        @media (min-width: 768px) and (max-width: 1024px) {
            .intro-section img {
                height: 500px;
            }
        }

        @media (max-width: 767px) {
            .intro-section img {
                height: 300px;
            }
        }

        /* Mobile nhỏ 320-480px */
        @media (max-width: 480px) {
            .intro-section img {
                height: 140px;
            }
        }

        .intro-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            width: 100%;
            padding: 0 20px;
        }

        .intro-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 480px;
            position: relative;
        }

        .pii-mascot {
            width: 340px;
            max-width: 100%;
            margin-bottom: 24px;
        }

        .intro-btn {
            background: #f7377b;
            color: #fff;
            border: none;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s;
            position: absolute;
            bottom: -350px;
            left: 50px;
        }

        .intro-btn:hover {
            background: #1596e2;
        }

        .intro-right {
            flex: 2;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }

        .intro-title {
            margin-bottom: 24px;
        }

        .intro-sub {
            font-size: 1rem;
            color: #222;
            font-weight: 500;
            text-align: left;
            margin-bottom: 4px;
        }

        .intro-title h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #222;
            margin: 0;
            letter-spacing: 1px;
        }

        .intro-title h2 span {
            color: #18c2a5;
        }

        .intro-underline {
            width: 180px;
            height: 2px;
            background: #222;
            margin: 12px 0 0 0;
            border-radius: 2px;
        }

        .intro-steps {
            margin-top: 18px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .intro-step {
            display: flex;
            align-items: flex-start;
            gap: 18px;
        }

        .intro-step-icon {
            color: #18c2a5;
            min-width: 85px;
            width: 85px;
            height: 85px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .intro-step-icon img {
            width: 85px;
            height: 85px;
            object-fit: contain;
        }

        .intro-step>div:last-child {
            flex: 1;
        }

        .intro-step-title {
            font-weight: bold;
            color: #3897C8;
            font-size: 1.1rem;
            margin-bottom: 8px;
            min-height: 1.5em;
            display: flex;
            align-items: center;
        }

        .intro-step-title.yellow,
        .intro-step-icon.yellow {
            color: #F2B029;
        }

        .intro-step-title.green,
        .intro-step-icon.green {
            color: #18c2a5;
        }

        .intro-step-desc {
            color: #222;
            font-size: 1rem;
            line-height: 1.5;
        }

        @media (max-width: 1200px) {
            .intro-section {
                height: auto;
                padding: 40px 0;
            }

            .intro-container {
                flex-direction: column;
                gap: 30px;
            }

            .intro-left {
                min-width: auto;
                width: 100%;
            }

            .intro-right {
                width: 100%;
                align-items: center;
            }

            .intro-title {
                text-align: center;
            }

            .intro-underline {
                margin: 12px auto 0 auto;
            }

            .intro-steps {
                width: 100%;
                max-width: 600px;
            }

            .intro-step {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 15px;
            }

            .intro-step-icon {
                margin-bottom: 10px;
            }

            .intro-btn {
                position: relative;
                bottom: auto;
                left: auto;
                margin-top: 20px;
            }
        }

        @media (max-width: 768px) {
            .intro-section {
                padding: 30px 0;
            }

            .intro-title h2 {
                font-size: 1.5rem;
            }

            .intro-step-icon {
                min-width: 60px;
                width: 60px;
                height: 60px;
            }

            .intro-step-icon img {
                width: 60px;
                height: 60px;
            }

            .intro-step-title {
                font-size: 1rem;
                min-height: 1.4em;
            }
        }

        @media (max-width: 480px) {
            .intro-section {
                padding: 20px 0;
            }

            .intro-title h2 {
                font-size: 1.2rem;
            }

            .intro-step-icon {
                min-width: 50px;
                width: 50px;
                height: 50px;
            }

            .intro-step-icon img {
                width: 50px;
                height: 50px;
            }

            .intro-step-title {
                font-size: 0.9rem;
                min-height: 1.3em;
            }

            .intro-btn {
                font-size: 0.9rem;
                padding: 8px 20px;
            }
        }

        .news-content {
            display: flex;
            gap: 32px;
            align-items: flex-start;
        }

        .news-list {
            display: flex;
            gap: 24px;
            flex: 3;
        }

        .news-card {
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 12px #eee;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 340px;
            min-width: 260px;
            overflow: hidden;
            position: relative;
        }

        .news-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .news-meta {
            display: flex;
            gap: 16px;
            align-items: center;
            padding: 12px 16px 0 16px;
            font-size: 0.98rem;
            color: #1596e2;
            justify-content: space-between;
        }

        .news-info {
            padding: 8px 16px 0 16px;
            flex: 1;
        }

        .news-headline {
            font-weight: bold;
            font-size: 1.08rem;
            color: #222;
            margin-bottom: 6px;
        }

        .news-desc {
            color: #555;
            font-size: 0.98rem;
            margin-bottom: 16px;
        }

        .news-side {
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 12px #eee;
            flex: 1;
            padding: 24px 18px 18px 18px;
            min-width: 260px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        @media (max-width: 1200px) {
            .news-content {
                flex-direction: column;
                gap: 24px;
            }

            .news-list {
                flex-direction: row;
                justify-content: center;
                flex-wrap: wrap;
            }

            .news-card {
                max-width: calc(50% - 12px);
                min-width: 280px;
            }

            .news-side {
                max-width: 100%;
                margin: 0 auto;
            }
        }

        @media (max-width: 768px) {
            .mySwiper1 .swiper-slide img {
                height: 130px;
            }

            .news-list {
                flex-direction: column;
                align-items: center;
                display: none;
            }

            .news-card {
                max-width: 100%;
                min-width: 100%;
            }

            .news-card img {
                height: 200px;
            }

            .news-meta {
                font-size: 0.9rem;
            }

            .news-headline {
                font-size: 1rem;
            }

            .news-desc {
                font-size: 0.9rem;
            }

            .news-side {
                padding: 20px 15px;
            }

            .side-title {
                font-size: 0.95rem;
            }

            .side-meta {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .news-content {
                gap: 16px;
            }

            .news-card img {
                height: 250px;
            }

            .news-meta {
                padding: 8px 12px 0 12px;
                font-size: 0.85rem;
            }

            .news-info {
                padding: 6px 12px 0 12px;
            }

            .news-headline {
                font-size: 0.95rem;
                margin-bottom: 4px;
            }

            .news-desc {
                font-size: 0.85rem;
                margin-bottom: 12px;
            }

            .news-side {
                padding: 15px 12px;
            }

            .side-title {
                font-size: 0.9rem;
            }

            .side-meta {
                font-size: 0.8rem;
            }

            .news-btn {
                font-size: 0.9rem;
                padding: 8px 0;
            }
        }

        .partners-section {
            background: #f8f9fa;
        }

        .partner-item {
            width: 100%;
            padding-top: 100%;
            /* tạo khung vuông dựa trên width */
            position: relative;
            background: #f9f9f9;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            overflow: hidden;
            display: block;
        }

        .partner-item img {
            position: absolute;
            top: 50%;
            left: 50%;
            max-width: 90%;
            max-height: 90%;
            transform: translate(-50%, -50%);
            object-fit: contain;
        }

        .partner-item img:hover {
            transform: scale(1.05);
        }

        .partners-slider {
            padding: 0 0 20px 0;
        }

        @media (max-width: 420px) {
            .category-item {
                width: 145px;
                height: 150px;
                text-align: center;
                padding: 10px;
                border: 1px solid #eee;
                border-radius: 8px;
                background: #fff;
            }

            .category-item img {
                width: 110px;
                height: 110px;
                object-fit: contain;
                /* ảnh hiển thị đều hơn */
                display: block;
                margin: 0 auto 6px auto;
            }

            .category-item span {
                font-size: 11px;
                line-height: 1.3;
                display: block;
                min-height: 2.6em;
                /* để các tên dài/ngắn có cùng độ cao 2 dòng */
                overflow: hidden;
            }
        }
    </style>
@endpush
