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
                    <div id="col-1563474248" class="col medium-12 small-12 large-12">
                        <div class="col-inner">
                            <div class="swiper mySwiper1">
                                <div class="swiper-wrapper">

                                    @foreach ($sliders as $slider)
                                        <!-- Slide {{ $loop->iteration }} -->
                                        <div class="swiper-slide slide-bg">
                                            <div class="row-container">
                                                <div class="content">
                                                    <h2>
                                                        <strong>{{ $slider->title }}</strong>
                                                    </h2>
                                                    @php
                                                        $lis = explode('<br>', $slider->content ?? []);
                                                    @endphp
                                                    <ul>
                                                        @foreach ($lis as $li)
                                                            <li>{{ trim($li) }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <a href="{{ $slider->url }}"
                                                        class="btn">{{ $slider->button_text }}</a>
                                                </div>
                                                <div class="image">
                                                    <img src="{{ showImage($slider->image) }}" alt="{{ $slider->title }}" />
                                                </div>
                                            </div>
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
                    @foreach ($categoriesPageHome->take(9) as $item)
                        <div class="category-item active">
                            <img src="{{ showImage($item->image) }}" alt="{{ $item->name }}">
                            <span>{{ $item->name }}</span>
                        </div>
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
                {{-- @dd($products) --}}
                <div class="product-list">
                    @foreach ($products as $product)
                        <!-- Một sản phẩm -->
                        <div class="product-card">
                            <a href="{{ route('products.detail', [$product->category->slug, $product->slug]) }}">
                                <img src="{{ showImage($product->image) }}" alt="{{ $product->name }}">
                                <div class="product-info">
                                    <h3>{{ $product->name }}</h3>
                                    <p class="code">{{ $product->sku }}</p>
                                    {{-- <button>Số lượng tối thiểu (300)</button> --}}
                                    <div class="product-price">
                                        @if (!$product->price)
                                            <span class="sale-price">Liên hệ</span>
                                        @elseif (isOnSale($product))
                                            <span
                                                class="sale-price">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                                            <del>{{ number_format($product->price, 0, ',', '.') }}₫</del>
                                        @else
                                            <span
                                                class="sale-price">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="intro-section">
                <div class="container">
                    <div class="intro-container">
                        <div class="intro-left">
                            <button class="intro-btn">VIDEO HƯỚNG DẪN</button>
                        </div>
                        <div class="intro-right">
                            <div class="intro-title">
                                <h2>IN ẤN DỄ DÀNG HƠN CÙNG <span>PRINTGO</span></h2>
                                <div class="intro-underline"></div>
                            </div>
                            <div class="intro-steps">
                                <div class="intro-step">
                                    <div class="intro-step-icon">
                                        <img width="85" height="85"
                                            src="{{ asset('frontend/assets/svg/Icon1.svg') }}" alt="">
                                    </div>
                                    <div>
                                        <div class="intro-step-title">ĐIỀN THÔNG TIN ĐẶT HÀNG</div>
                                        <div class="intro-step-desc">
                                            Khách hàng điền đầy đủ thông tin cần thiết để in ấn theo các bước hướng dẫn của
                                            Printgo,
                                            chọn gói in mong muốn, số lượng để bắt đầu tiến hành in ấn.<br>
                                            Sau khi có đầy đủ thông tin, hệ thống sẽ cập nhật giá sản phẩm để khách hàng có
                                            thể tiến
                                            hành các bước tiếp theo.
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-step">
                                    <div class="intro-step-icon yellow">
                                        <img width="85" height="85"
                                            src="{{ asset('frontend/assets/svg/Icon3.svg') }}" alt="">
                                    </div>
                                    <div>
                                        <div class="intro-step-title yellow">KIỂM TRA THÔNG TIN ĐƠN HÀNG</div>
                                        <div class="intro-step-desc">
                                            Khách hàng kiểm tra lại toàn bộ các thông tin chi tiết về đơn hàng, giá, khuyến
                                            mãi
                                            trước khi chuyển in.<br>
                                            Trong trường hợp có sự lựa chọn in thêm, có thể bấm quay lại để chỉnh sửa phù
                                            hợp.
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-step">
                                    <div class="intro-step-icon green">
                                        <img width="85" height="85"
                                            src="{{ asset('frontend/assets/svg/Icon4.svg') }}" alt="">
                                    </div>
                                    <div>
                                        <div class="intro-step-title green">ĐIỀN THÔNG TIN THANH TOÁN, NHẬN HÀNG</div>
                                        <div class="intro-step-desc">
                                            Quý khách lựa chọn hình thức thanh toán mong muốn, điền địa chỉ nhận hàng.<br>
                                            Sau khi đơn hàng hoàn thành sẽ được chuyển đến địa chỉ đã đăng ký của khách
                                            hàng.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

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
                                    <img src="{{ showImage($post->image) }}" alt="{{ $post->subject }}">
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
                                                                src="https://inhoalong.vn/wp-content/uploads/2024/05/Icon-sax.png"
                                                                decoding="async" width="20" height="21"
                                                                data-src="https://inhoalong.vn/wp-content/uploads/2024/05/Icon-sax.png"
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
                                                                src="https://inhoalong.vn/wp-content/uploads/2024/05/icon-mail.png"
                                                                decoding="async" width="20" height="21"
                                                                data-src="https://inhoalong.vn/wp-content/uploads/2024/05/icon-mail.png"
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
    </div>
@endsection

@push('scripts')
    <script src=""></script>
    <script>
        const swiperPost = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            effect: "slide", // bạn có thể dùng "fade"
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
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
            font-size: 2rem;
            margin: 0 16px 0 0;
            text-align: center;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
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

        .product-list {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 24px;
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
        }

        /* @media (max-width: 480px) {
                                                                .product-list {
                                                                    grid-template-columns: 1fr;
                                                                    gap: 12px;
                                                                }
                                                            } */

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
        }

        .product-card img {
            width: 100%;
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
        }

        .product-info .code {
            color: #3ec6b6;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .product-meta {
            display: flex;
            justify-content: center;
            gap: 16px;
            font-size: 0.95rem;
            color: #888;
            margin-bottom: 8px;
        }

        .product-info button {
            margin-top: auto;
            width: 100%;
            background: #e6f6f4;
            color: #3ec6b6;
            border: none;
            border-radius: 100px;
            padding: 3px 12px;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s;
            margin-right: 0;
            margin-bottom: 0;
        }

        .product-info:hover>button {
            background: #3ec6b6;
            color: #fff;
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
            gap: 30px;
        }

        .category-item {
            width: 180px;
            height: 180px;
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
        }

        .category-item img {
            width: 70px;
            height: 70px;
            margin-bottom: 18px;
        }

        .category-item span {
            font-size: 18px;
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
        }

        .xem-tat-ca .plus {
            font-size: 48px;
            line-height: 1;
            margin-bottom: 6px;
        }

        .xem-tat-ca .text {
            font-size: 16px;
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
            background-image: url(https://inhoalong.vn/wp-content/uploads/2024/10/bg-hang-in-hoa-long.jpg);
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
            padding-bottom: 12px;
            background-color: #E5EFF9;
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
                gap: 10px;
                display: grid;
                grid-template-columns: 1fr 1fr;
                justify-items: center;
            }

            .product-item {
                width: 95%;
                max-width: 180px;
                height: 110px;
                margin: 0;
            }

            .product-item img {
                width: 36px;
                height: 36px;
                margin-bottom: 8px;
            }

            .product-item span {
                font-size: 14px;
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
            font-size: 1.2rem;
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
            background: #eaf7fd url('/frontend/assets/image/Banner-web.jpg') repeat;
            background-position: 50%;
            background-repeat: no-repeat;
            background-size: cover;
            height: 708px;
            margin-top: 5%;
            display: flex;
            align-items: center;
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
            min-width: 500px;
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
            min-width: 48px;
            text-align: center;
        }

        .intro-step-title {
            font-weight: bold;
            color: #3897C8;
            font-size: 1.1rem;
            margin-bottom: 2px;
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

            .intro-step-icon img {
                width: 60px;
                height: 60px;
            }

            .intro-step-title {
                font-size: 1rem;
            }

            .intro-step-desc {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .intro-section {
                padding: 20px 0;
            }

            .intro-title h2 {
                font-size: 1.2rem;
            }

            .intro-step-icon img {
                width: 50px;
                height: 50px;
            }

            .intro-step-title {
                font-size: 0.9rem;
            }

            .intro-step-desc {
                font-size: 0.85rem;
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
            .news-list {
                flex-direction: column;
                align-items: center;
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
    </style>
@endpush
