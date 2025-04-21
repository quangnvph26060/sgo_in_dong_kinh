@extends('frontend.master')

@section('title', $setting->title ?? $setting->seo_title)
@section('description', $setting->seo_description)
@section('image', showImage($setting->logo))

@section('content')
    <div id="content" role="main" class="content-area">
        <section class="section" id="section_1158364768">
            <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
            <div class="section-content relative">
                <div class="row row-small row-banner" id="row-1765437824">
                    <div id="col-1563474248" class="col medium-8 small-12 large-8">
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

                    <div id="col-1646303098" class="col pb-0 hide-for-small medium-4 small-12 large-4">
                        <div class="col-inner">
                            @foreach ($advertisementProducts as $product)
                                <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_{{ $product->id }}">
                                    <a class=""
                                        href="https://inhoalong.vn/in-tem-chong-hang-gia-chuyen-nghiep-tai-ha-noi/">
                                        <div class="img-inner dark">
                                            <img data-lazyloaded="1" src="{{ showImage($product->advertisement_image) }}"
                                                decoding="async" width="345" height="160"
                                                data-src="{{ showImage($product->advertisement_image) }}"
                                                class="attachment-original size-original" alt="{{ $product->short_name }}"
                                                data-srcset="{{ showImage($product->advertisement_image) }} 345w, {{ showImage($product->advertisement_image) }} 300w"
                                                data-sizes="(max-width: 345px) 100vw, 345px" />
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="col-1877603751" class="col show-for-small medium-4 small-12 large-4">
                        <div class="col-inner">
                            <div class="swiper-container slider-wrapper relative slide-banner-right" id="slider-534937241">
                                <!-- Các slide -->
                                <div class="swiper-wrapper">
                                    @foreach ($advertisementProducts as $productSlider)
                                        <div class="swiper-slide">
                                            <a href="#">
                                                <div class="img-inner dark">
                                                    <img src="{{ showImage($productSlider->advertisement_image) }}"
                                                        alt="{{ $product->short_name }}" />
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="section pb-half pb-sm-0" id="section_1703875609">
            <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
            <div class="section-content relative">
                <div class="row" id="row-1235775671">
                    <div id="col-177595988" class="col pb-0 medium-8 small-12 large-8">
                        <div class="col-inner">
                            <div id="text-2393042501" class="text">
                                <h3>
                                    <span class="ez-toc-section" id="SAN_PHAM_IN_AN_XEM_NHIEU"
                                        ez-toc-data-id="#SAN_PHAM_IN_AN_XEM_NHIEU"></span>[SẢN PHẨM IN ẤN XEM
                                    NHIỀU]<span class="ez-toc-section-end"></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div id="col-2123939782" class="col pb-0 hide-for-small medium-4 small-12 large-4">
                        <div class="col-inner text-right">
                            <a href="{{ route('products.list') }}" target="_self"
                                class="button alert is-link lowercase btn-more">
                                <span>Xem tất cả</span>
                                <i class="icon-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div id="col-1044705815" class="col pb-0 small-12 large-12">
                        <div class="col-inner">
                            <div class="swiper mySwiper2">
                                <div class="swiper-wrapper">
                                    @foreach ($topViewedProducts as $productView)
                                        <!-- Slide {{ $loop->iteration }} -->
                                        <div class="swiper-slide">
                                            <a
                                                href="{{ route('products.detail', [$productView->category->slug, $productView->slug]) }}">
                                                <img src="{{ showImage($productView->image) }}"
                                                    alt="Slide {{ $loop->iteration }}" />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="section_1431349545">
            <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
            <div class="section-content relative">

                @foreach ($labels as $label)
                    <div class="row" id="row-608375597">
                        <div id="col-2146691129" class="col pb-0 small-12 large-12">
                            <div class="col-inner">
                                <div class="container section-title-container">
                                    <h3 class="section-title section-title-normal">
                                        <span class="section-title-main"
                                            style="color: rgb(21, 150, 226)">{{ $label->title }}</span>
                                        <span class="ez-toc-section-end"></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-small tab-home" id="row-1036855917" style="margin-bottom: 40px">
                        <div id="col-1502426126" class="col pb-0 hide-for-small medium-4 small-12 large-4">
                            <div class="col-inner">
                                <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_1684144030">
                                    <a class="" href="#">
                                        <div class="img-inner dark">
                                            <img data-lazyloaded="1" src="{{ showImage($label->image) }}"
                                                decoding="async" width="378" height="624"
                                                data-src="{{ showImage($label->image) }}"
                                                class="attachment-original size-original" alt="{{ $label->title }}"
                                                data-srcset="{{ showImage($label->image) }} 378w, {{ showImage($label->image) }} 182w"
                                                data-sizes="(max-width: 378px) 100vw, 378px" />
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div id="col-1160486448" class="col product-home-cs pb-0 medium-8 small-12 large-8">
                            <div class="col-inner">
                                <div class="row equalize-box large-columns-3 medium-columns- small-columns-2 row-small">
                                    @foreach ($label->products as $labelProduct)
                                        <div
                                            class="product-small col has-hover product type-product post-23513 status-publish first instock product_cat-tem-nhan product_tag-in-tem-ruou-com product_tag-mau-tem-nhan-ruou-com product_tag-tem-nhan-ruou-com has-post-thumbnail sale taxable shipping-taxable purchasable product-type-simple">
                                            <div class="col-inner">
                                                <div class="product-small box">
                                                    <div class="box-image">
                                                        <div class="image-zoom">
                                                            <a href="{{ route('products.detail', [$labelProduct->category->slug, $labelProduct->slug]) }}"
                                                                aria-label="{{ $labelProduct->name }}">
                                                                <img data-lazyloaded="1"
                                                                    src="{{ showImage($labelProduct->image) }}"
                                                                    decoding="async" width="300" height="300"
                                                                    data-src="{{ showImage($labelProduct->image) }}"
                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                                    alt="{{ $labelProduct->name }}"
                                                                    data-srcset="{{ showImage($labelProduct->image) }} 300w, {{ showImage($labelProduct->image) }} 150w, {{ showImage($labelProduct->image) }} 100w, {{ showImage($labelProduct->image) }} 600w"
                                                                    data-sizes="(max-width: 300px) 100vw, 300px" />
                                                            </a>
                                                        </div>

                                                        <div class="image-tools is-small top right show-on-hover">
                                                        </div>

                                                        <div
                                                            class="image-tools is-small hide-for-small bottom left show-on-hover">
                                                        </div>

                                                        <div
                                                            class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                                        </div>
                                                    </div>

                                                    <div class="box-text box-text-products text-center grid-style-2">
                                                        <div class="title-wrapper">
                                                            <p class="name product-title woocommerce-loop-product__title">
                                                                <a href="{{ route('products.detail', [$labelProduct->category->slug, $labelProduct->slug]) }}"
                                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link">{{ $labelProduct->name }}</a>
                                                            </p>
                                                        </div>
                                                        <div class="price-wrapper"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row" id="row-177807343">
                    <div id="col-820780180" class="col pb-0 small-12 large-12">
                        <div class="col-inner">
                            <div class="container section-title-container">
                                <h3 class="section-title section-title-normal">
                                    <span class="ez-toc-section" id="Tin_Tuc_moi_nhatXem_tat_ca"></span><b></b><span
                                        class="section-title-main" style="color: rgb(21, 150, 226)">Tin Tức
                                        mới nhất</span><b></b><a href="{{ route('news') }}" target="">Xem
                                        tất cả<i class="icon-angle-right"></i></a><span class="ez-toc-section-end"></span>
                                </h3>
                            </div>
                            <div class="row home-news hide-for-small large-columns-3 medium-columns-1 small-columns-1">
                                @foreach ($postsNews->take(3) as $postDestop)
                                    <div class="col post-item">
                                        <div class="col-inner">
                                            <div class="box box-normal box-text-bottom box-blog-post has-hover">
                                                <div class="box-image">
                                                    <div class="image-cover" style="padding-top: 66%">
                                                        <a href="{{ route('news', $postDestop->slug) }}" class="plain"
                                                            aria-label="{{ $postDestop->subject }}"><img
                                                                data-lazyloaded="1"
                                                                src="{{ showImage($postDestop->featured_image) }}"
                                                                decoding="async" width="600" height="400"
                                                                data-src="{{ showImage($postDestop->featured_image) }}"
                                                                class="attachment-original size-original wp-post-image"
                                                                alt="{{ $postDestop->subject }}"
                                                                data-srcset="{{ showImage($postDestop->featured_image) }} 600w, {{ showImage($postDestop->featured_image) }} 300w"
                                                                data-sizes="(max-width: 600px) 100vw, 600px" /></a>
                                                    </div>
                                                </div>
                                                <div class="box-text text-left"
                                                    style="
                                                    background-color: rgb(255, 255, 255);
                                                    padding: 13px 13px 13px 13px;
                                                ">
                                                    <div class="box-text-inner blog-post-inner">
                                                        <div class="c-line-top-meta">
                                                            <p class="c-meta-category">{{ $postDestop->category->name }}
                                                            </p>
                                                            <div class="c-line-top-meta">
                                                                <span class="c-meta-date">
                                                                    {{ $postDestop->posted_at->format('d/m/Y') }}</span>
                                                            </div>
                                                        </div>
                                                        <h4 class="post-title is-large">
                                                            <span class="ez-toc-section"
                                                                id="Mau_hop_carton_dep_chuyen_nghiep_cho_doanh_nghiep"></span><a
                                                                href="{{ route('news', $postDestop->slug) }}"
                                                                class="plain"></a><span
                                                                class="ez-toc-section-end"></span>
                                                        </h4>
                                                        <div class="is-divider">{{ $postDestop->subject }}</div>
                                                        <p class="from_the_blog_excerpt">
                                                            {{ \Str::words($postDestop->summary, 15, '...') }}
                                                        </p>
                                                        <a href="{{ route('news', $postDestop->slug) }}"
                                                            class="button primary is-link is-small mb-0">Xem
                                                            chi
                                                            tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Swiper Container -->
                            <div class="swiper mySwiper" id="post-mobile">
                                <div class="swiper-wrapper">

                                    @foreach ($postsNews as $post)
                                        <!-- Slide {{ $loop->iteration }} -->
                                        <div class="swiper-slide">
                                            <div class="col post-item">
                                                <div class="col-inner">
                                                    <div class="box box-normal box-text-bottom box-blog-post has-hover">
                                                        <div class="box-image">
                                                            <div class="image-cover" style="padding-top: 56.25%">
                                                                <a href="{{ route('news', $post->slug) }}" class="plain"
                                                                    aria-label="{{ $post->subject }}">
                                                                    <img src="{{ showImage($post->featured_image) }}"
                                                                        width="300" height="200"
                                                                        alt="{{ $post->subject }}"
                                                                        class="attachment-medium size-medium wp-post-image" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="box-text text-left"
                                                            style="background-color: #fff; padding: 10px;">
                                                            <div class="box-text-inner blog-post-inner">
                                                                <div class="c-line-top-meta">
                                                                    <span class="c-meta-date">
                                                                        {{ $post->posted_at->format('d/m/Y') }}</span>
                                                                </div>
                                                                <h4 class="post-title is-large">
                                                                    <a href="{{ route('news', $post->slug) }}"
                                                                        class="plain">{{ $post->subject }}</a>
                                                                </h4>
                                                                <div class="is-divider"></div>
                                                                <p class="from_the_blog_excerpt">
                                                                    {{ \Str::words($post->summary, 15, '...') }}
                                                                </p>
                                                                <a href="{{ route('news', $post->slug) }}"
                                                                    class="button primary is-link is-small mb-0">Xem chi
                                                                    tiết</a>
                                                            </div>
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
                                <form action="/#wpcf7-f123-p5185-o1" method="post" class="wpcf7-form init"
                                    aria-label="Form liên hệ" novalidate="novalidate" data-status="init">

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
                                                    id="btn-submit" type="submit" value="Đăng ký tư vấn" />
                                            </div>
                                        </div>
                                    </div>
                                    <p style="display: none !important" class="akismet-fields-container"
                                        data-prefix="_wpcf7_ak_">
                                        <label>&#916;
                                            <textarea name="_wpcf7_ak_hp_textarea" cols="45" rows="8" maxlength="100"></textarea>
                                        </label><input type="hidden" id="ak_js_1" name="_wpcf7_ak_js"
                                            value="62" />
                                        <script
                                            src="data:text/javascript;base64,ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoImFrX2pzXzEiKS5zZXRBdHRyaWJ1dGUoInZhbHVlIiwobmV3IERhdGUoKSkuZ2V0VGltZSgpKQ=="
                                            defer></script>
                                    </p>
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

        @if ($setting->description)
            <section class="section" id="section_1013333252">
                <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
                <div class="section-content relative">
                    <div class="row" id="row-2037579384">
                        <div id="col-1253344782" class="col pb-0 small-12 large-12">
                            <div class="col-inner">
                                <div id="text-2462859472" class="text text-hidden">
                                    {!! $setting->description !!}
                                </div>
                                <a class="button primary lowercase btn-view" style="border-radius: 10px">
                                    <span>Xem thêm</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
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
    <style>
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
            background-color: rgb(232, 232, 232);
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
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: rgb(232, 232, 232);
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
    </style>
@endpush
