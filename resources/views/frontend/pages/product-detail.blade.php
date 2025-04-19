@extends('frontend.master')

@section('content')
    <div class="shop-container">
        <div class="container">
            <div class="woocommerce-notices-wrapper"></div>
        </div>
        <div id="product-{{ $product->id }}" class="product type-product">
            <div class="product-container">
                <div class="product-main">
                    <div class="row content-row mb-0">
                        <div class="product-gallery large-6 col">
                            <div class="product-images relative mb-half has-hover woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                data-columns="4" style="opacity: 1">
                                @if (isOnSale($product))
                                    <div class="badge-container absolute left top z-1">
                                        <div class="callout badge badge-circle">
                                            <div class="badge-inner secondary on-sale">
                                                <span
                                                    class="onsale">-{{ getDiscountPercentage($product->price, $product->sale_price) }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="swiper main-slider">
                                    <div class="swiper-wrapper">
                                        @foreach ($images as $image)
                                            <div class="swiper-slide">
                                                <img src="{{ showImage($image) }}" alt="{{ $image }}" width="600"
                                                    height="600" />
                                            </div>
                                        @endforeach

                                    </div>
                                </div>


                                <div class="image-tools absolute top show-on-hover right z-3">

                                </div>

                                <div class="image-tools absolute bottom left z-3">
                                    <a href="#product-zoom"
                                        class="zoom-button button is-outline circle icon tooltip hide-for-small"
                                        title="Zoom">
                                        <i class="icon-expand"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="swiper thumb-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($images as $image)
                                        <div class="swiper-slide transition-all duration-300">
                                            <img src="{{ showImage($image) }}" alt="{{ $image }}" width="100"
                                                height="100" />
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="sub_description mt">

                                @foreach ($setting->commits as $commit)
                                    <div class="commit-item">
                                        <img data-lazyloaded="1" src="{{ showImage($commit['image']) }}" decoding="async"
                                            class="size-full wp-image-18110 alignright entered litespeed-loaded"
                                            data-src="{{ showImage($commit['image']) }}" alt="" width="40"
                                            height="40" data-ll-status="loaded" />

                                        <span style="font-size: 100%">&nbsp;{{ $commit['text'] }}</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="product-info summary col-fit col entry-summary product-summary">

                            <h1 class="product-title product_title entry-title">
                                {{ $product->name }}
                            </h1>

                            <div class="price-wrapper">

                                @if (isOnSale($product))
                                    <p class="price product-page-price price-on-sale">

                                        <del aria-hidden="true">
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>{{ formatPrice($product->price) }}&nbsp;
                                                    <span class="woocommerce-Price-currencySymbol">₫
                                                    </span>
                                                </bdi>
                                            </span>
                                        </del>

                                        <ins aria-hidden="true">
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>{{ formatPrice($product->sale_price) }}&nbsp;
                                                    <span class="woocommerce-Price-currencySymbol">₫</span>
                                                </bdi>
                                            </span>
                                        </ins>
                                    @else
                                        <ins aria-hidden="true">
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>{{ formatPrice($product->price) }}&nbsp;
                                                    <span class="woocommerce-Price-currencySymbol">₫</span>
                                                </bdi>
                                            </span>
                                        </ins>
                                @endif
                                </p>
                            </div>
                            <div class="product-short-description">
                                <p>
                                    {{ $product->short_description }}
                                </p>
                            </div>

                            <div class="form-product-type-wrap mt">
                                <a class="button primary uppercase flex align-middle justify-center mb-half mr-0 requestPrice"
                                    href="#requestPrice">
                                    <i class="icon-envelop"></i>
                                    <span>Yêu cầu báo giá</span>
                                </a>
                            </div>

                            <style>
                                .mfp-container.mfp-s-ready.mfp-inline-holder {
                                    padding: 0;
                                }

                                .mfp-wrap.mfp-close-btn-in.mfp-auto-cursor.mfp-ready {
                                    z-index: 2000000003;
                                }

                                form.cart .quantity.buttons_added input.qty {
                                    min-width: 6em;
                                }

                                form.cart {
                                    align-items: center;
                                    display: flex;
                                    flex-flow: row nowrap;
                                    justify-content: space-between;
                                    width: 100%;
                                    margin-bottom: 24px;
                                }

                                form.cart .button {
                                    width: 100%;
                                    margin: 0 12px;
                                }

                                form.cart a {
                                    width: 100%;
                                }

                                .product-summary form.cart .quantity {
                                    margin-bottom: 0;
                                }
                            </style>

                            <div class="product_meta">
                                <span class="sku_wrapper">Mã: <span class="sku">{{ $product->sku }}</span></span><span
                                    class="posted_in">Danh mục:
                                    <a href="https://inhoalong.vn/danh-muc/hop-cung/"
                                        rel="tag">{{ $product->category->name }}</a></span>
                                <span class="tagged_as">Thẻ:
                                    @foreach ($tags as $tag)
                                        <a href="#"
                                            rel="tag">{{ $tag }}</a>{{ !$loop->last ? ',' : '' }}
                                    @endforeach

                                </span>

                                <div class="socials-share">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-footer">
                    <div class="container">
                        <div class="row content-row mb-0">
                            <div class="large-3 col post-sidebar pt-0" id="product-sidebar">
                                <div class="is-sticky-column" data-sticky-mode="javascript"
                                    style="transform: translateY(0px)">
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

                            <div class="large-9 col">
                                <div class="woocommerce-tabs wc-tabs-wrapper container tabbed-content">
                                    <ul class="tabs wc-tabs product-tabs small-nav-collapse nav nav-uppercase nav-line nav-left"
                                        role="tablist">
                                        <li class="description_tab active" id="tab-title-description" role="presentation"
                                            aria-selected="true">
                                            <a href="#tab-description" role="tab" aria-selected="true"
                                                aria-controls="tab-description">Mô tả</a>
                                        </li>
                                        <li class="reviews_tab" id="tab-title-reviews" role="presentation"
                                            aria-selected="false">
                                            <a href="#tab-reviews" role="tab" aria-selected="false"
                                                aria-controls="tab-reviews" tabindex="-1">Đánh giá (0)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-panels">
                                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content active"
                                            id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                                            {!! $product->description !!}
                                        </div>
                                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews panel entry-content"
                                            id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews">
                                            <div id="reviews" class="woocommerce-Reviews row">
                                                <div id="comments" class="col large-12">
                                                    <h3 class="woocommerce-Reviews-title normal">
                                                        Đánh giá
                                                    </h3>
                                                    <p class="woocommerce-noreviews">
                                                        Chưa có đánh giá nào.
                                                    </p>
                                                </div>
                                                <div id="review_form_wrapper" class="large-12 col">
                                                    <div id="review_form" class="col-inner">
                                                        <div class="review-form-inner has-border">
                                                            <div id="respond" class="comment-respond">
                                                                <h3 id="reply-title" class="comment-reply-title">
                                                                    Hãy là người đầu tiên nhận xét “Báo giá
                                                                    hộp giấy đựng quà Noel đẹp giá rẻ chất
                                                                    lượng tại Hà Nội”
                                                                    <small><a rel="nofollow"
                                                                            id="cancel-comment-reply-link"
                                                                            href="/hop-giay-dung-qua-noel-dep-gia-re-tai-ha-noi/#respond"
                                                                            style="display: none">Hủy</a></small>
                                                                </h3>
                                                                <form action="https://inhoalong.vn/wp-comments-post.php"
                                                                    method="post" id="commentform" class="comment-form"
                                                                    novalidate="">
                                                                    <div class="comment-form-rating">
                                                                        <label for="rating">Đánh giá của bạn&nbsp;<span
                                                                                class="required">*</span></label>
                                                                        <p class="stars">
                                                                            <span>
                                                                                <a class="star-1" href="#">1</a>
                                                                                <a class="star-2" href="#">2</a>
                                                                                <a class="star-3" href="#">3</a>
                                                                                <a class="star-4" href="#">4</a>
                                                                                <a class="star-5" href="#">5</a>
                                                                            </span>
                                                                        </p>
                                                                        <select name="rating" id="rating"
                                                                            required="" style="display: none">
                                                                            <option value="">Xếp hạng…</option>
                                                                            <option value="5">Rất tốt</option>
                                                                            <option value="4">Tốt</option>
                                                                            <option value="3">
                                                                                Trung bình
                                                                            </option>
                                                                            <option value="2">Không tệ</option>
                                                                            <option value="1">Rất tệ</option>
                                                                        </select>
                                                                    </div>
                                                                    <p class="comment-form-comment">
                                                                        <label for="comment">Nhận xét của bạn&nbsp;<span
                                                                                class="required">*</span></label>
                                                                        <textarea id="comment" name="comment" cols="45" rows="8" required=""></textarea>
                                                                    </p>
                                                                    <p class="comment-form-author">
                                                                        <label for="author">Tên&nbsp;<span
                                                                                class="required">*</span></label><input
                                                                            id="author" name="author" type="text"
                                                                            value="" size="30"
                                                                            required="" />
                                                                    </p>
                                                                    <p class="comment-form-email">
                                                                        <label for="email">Email&nbsp;<span
                                                                                class="required">*</span></label><input
                                                                            id="email" name="email" type="email"
                                                                            value="" size="30"
                                                                            required="" />
                                                                    </p>
                                                                    <p class="comment-form-cookies-consent">
                                                                        <input id="wp-comment-cookies-consent"
                                                                            name="wp-comment-cookies-consent"
                                                                            type="checkbox" value="yes" />
                                                                        <label for="wp-comment-cookies-consent">Lưu tên
                                                                            của tôi, email, và trang
                                                                            web trong trình duyệt này cho lần
                                                                            bình luận kế tiếp của tôi.</label>
                                                                    </p>
                                                                    <p class="form-submit">
                                                                        <input name="submit" type="submit"
                                                                            id="submit" class="submit"
                                                                            value="Gửi đi" />
                                                                        <input type="hidden" name="comment_post_ID"
                                                                            value="15904" id="comment_post_ID" /><input
                                                                            type="hidden" name="comment_parent"
                                                                            id="comment_parent" value="0" />
                                                                    </p>
                                                                    <p style="display: none">
                                                                        <input type="hidden" id="akismet_comment_nonce"
                                                                            name="akismet_comment_nonce"
                                                                            value="78d06f411f" />
                                                                    </p>
                                                                    <p style="display: none !important"
                                                                        class="akismet-fields-container"
                                                                        data-prefix="ak_">
                                                                        <label>Δ
                                                                            <textarea name="ak_hp_textarea" cols="45" rows="8" maxlength="100"></textarea>
                                                                        </label><input type="hidden" id="ak_js_2"
                                                                            name="ak_js" value="1744678244336" />
                                                                        <script
                                                                            src="data:text/javascript;base64,ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoImFrX2pzXzIiKS5zZXRBdHRyaWJ1dGUoInZhbHVlIiwobmV3IERhdGUoKSkuZ2V0VGltZSgpKQ=="
                                                                            defer=""></script>
                                                                    </p>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="large-12 col">
                                <div class="custom-related-products">
                                    <div class="related related-products-wrapper product-section">
                                        <h3
                                            class="product-section-title container-width product-section-title-related pt-half pb-half uppercase">
                                            Sản phẩm tương tự
                                        </h3>

                                        @foreach ($relatedProducts as $relatedProduct)
                                            <div
                                                class="row equalize-box large-columns-4 medium-columns-3 small-columns-2 row-small slider row-slider slider-nav-circle slider-nav-push">
                                                <div class="product-small col has-hover product">
                                                    <div class="col-inner">
                                                        @if (isOnSale($relatedProduct))
                                                            <div class="badge-container absolute left top z-1">
                                                                <div class="callout badge badge-circle">
                                                                    <div class="badge-inner secondary on-sale">
                                                                        <span
                                                                            class="onsale">-{{ getDiscountPercentage($relatedProduct->price, $relatedProduct->sale_price) }}%</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="product-small box">
                                                            <div class="box-image">
                                                                <div class="image-zoom">
                                                                    <a href="{{ route('products.detail', [$relatedProduct->category->slug, $relatedProduct->slug]) }}"
                                                                        aria-label="{{ $relatedProduct->name }}"><img
                                                                            data-lazyloaded="1"
                                                                            src="{{ showImage($relatedProduct->image) }}"
                                                                            width="300" height="300"
                                                                            data-src="{{ showImage($relatedProduct->image) }}"
                                                                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                                            alt="In hộp bánh trung thu" decoding="async"
                                                                            data-srcset="{{ showImage($relatedProduct->image) }} 300w, {{ showImage($relatedProduct->image) }} 100w"
                                                                            data-sizes="(max-width: 300px) 100vw, 300px" /><noscript><img
                                                                                width="300" height="300"
                                                                                src="{{ showImage($relatedProduct->image) }}"
                                                                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                                                alt="In hộp bánh trung thu"
                                                                                decoding="async"
                                                                                srcset="
                                                                             {{ showImage($relatedProduct->image) }} 300w,
                                                                             {{ showImage($relatedProduct->image) }} 150w,
                                                                             {{ showImage($relatedProduct->image) }} 100w
                                                                         "
                                                                                sizes="(max-width: 300px) 100vw, 300px" /></noscript></a>
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
                                                            <div class="box-text box-text-products text-center grid-style-2"
                                                                style="height: 94.7778px">
                                                                <div class="title-wrapper">
                                                                    <p class="name product-title woocommerce-loop-product__title"
                                                                        style="height: 42px">
                                                                        <a href="https://inhoalong.vn/in-hop-banh-trung-thu/"
                                                                            class="woocommerce-LoopProduct-link woocommerce-loop-product__link">{{ $relatedProduct->name }}</a>
                                                                    </p>
                                                                </div>
                                                                <div class="price-wrapper" style="height: 16px">
                                                                    <span class="price">
                                                                        @if (isOnSale($relatedProduct))
                                                                            <del aria-hidden="true">
                                                                                <span
                                                                                    class="woocommerce-Price-amount amount">
                                                                                    <bdi>{{ formatPrice($relatedProduct->price) }}&nbsp;
                                                                                        <span
                                                                                            class="woocommerce-Price-currencySymbol">₫
                                                                                        </span>
                                                                                    </bdi>
                                                                                </span>
                                                                            </del>

                                                                            <ins aria-hidden="true">
                                                                                <span
                                                                                    class="woocommerce-Price-amount amount">
                                                                                    <bdi>{{ formatPrice($relatedProduct->sale_price) }}&nbsp;
                                                                                        <span
                                                                                            class="woocommerce-Price-currencySymbol">₫</span>
                                                                                    </bdi>
                                                                                </span>
                                                                            </ins>
                                                                        @else
                                                                            <ins aria-hidden="true">
                                                                                <span
                                                                                    class="woocommerce-Price-amount amount">
                                                                                    <bdi>{{ formatPrice($relatedProduct->price) }}&nbsp;
                                                                                        <span
                                                                                            class="woocommerce-Price-currencySymbol">₫</span>
                                                                                    </bdi>
                                                                                </span>
                                                                            </ins>
                                                                        @endif
                                                                    </span>
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
            </div>
        </div>
    </div>

    <div class="wpcf7 js" id="wpcf7-f123-o2" lang="vi" dir="ltr" data-wpcf7-id="123">
        <div class="screen-reader-response">
            <p role="status" aria-live="polite" aria-atomic="true"></p>
            <ul></ul>
        </div>
        <form action="/hop-giay-dung-qua-noel-dep-gia-re-tai-ha-noi/#wpcf7-f123-o2" method="post"
            class="wpcf7-form init" aria-label="Form liên hệ" novalidate="novalidate" data-status="init">
            <div style="display: none">
                <input type="hidden" name="_wpcf7" value="123" /><input type="hidden" name="_wpcf7_version"
                    value="6.0" /><input type="hidden" name="_wpcf7_locale" value="vi" /><input type="hidden"
                    name="_wpcf7_unit_tag" value="wpcf7-f123-o2" /><input type="hidden" name="_wpcf7_container_post"
                    value="0" /><input type="hidden" name="_wpcf7_posted_data_hash" value="" />
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40"
                                maxlength="400"
                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"
                                aria-required="true" aria-invalid="false" placeholder="Họ và Tên*" value=""
                                type="text" name="your-name" /></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col large-6">
                    <div class="form-group">
                        <span class="wpcf7-form-control-wrap" data-name="your-phone"><input size="40"
                                maxlength="400"
                                class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel form-control"
                                aria-required="true" aria-invalid="false" placeholder="Số điện thoại*" value=""
                                type="tel" name="your-phone" /></span>
                    </div>
                </div>
                <div class="col large-6">
                    <div class="form-group">
                        <span class="wpcf7-form-control-wrap" data-name="your-email"><input size="40"
                                maxlength="400"
                                class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email form-control"
                                aria-required="true" aria-invalid="false" placeholder="Email*" value=""
                                type="email" name="your-email" /></span>
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
                        <input class="wpcf7-form-control wpcf7-submit has-spinner btn btn-primary" id="btn-submit"
                            type="submit" value="Đăng ký tư vấn" /><span class="wpcf7-spinner"></span>
                    </div>
                </div>
            </div>
            <p style="display: none !important" class="akismet-fields-container" data-prefix="_wpcf7_ak_">
                <label>Δ
                    <textarea name="_wpcf7_ak_hp_textarea" cols="45" rows="8" maxlength="100"></textarea>
                </label><input type="hidden" id="ak_js_3" name="_wpcf7_ak_js" value="1744678244336" />
                <script
                    src="data:text/javascript;base64,ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoImFrX2pzXzMiKS5zZXRBdHRyaWJ1dGUoInZhbHVlIiwobmV3IERhdGUoKSkuZ2V0VGltZSgpKQ=="
                    defer=""></script>
            </p>
            <div class="wpcf7-response-output" aria-hidden="true"></div>
        </form>
    </div>

    <section class="section" id="section_255208508">
        <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
        <div class="section-content relative">
            <div class="row list-link-product" id="row-2063934611">
                <div id="col-1040839963" class="col small-12 large-12">
                    <div class="col-inner">
                        <div id="text-4222440184" class="text">
                            <h3>Danh sách sản phẩm tốt nhất</h3>
                            <style>
                                #text-4222440184 {
                                    color: #1596e2;
                                }

                                #text-4222440184>* {
                                    color: #1596e2;
                                }
                            </style>
                        </div>
                    </div>
                </div>
                @foreach ($bestProducts as $bestProduct)
                    <div id="col-{{ $bestProduct->id }}" class="col medium-3 small-12 large-3">
                        <div class="col-inner">
                            <a href="{{ route('products.detail', [$bestProduct->category->slug, $bestProduct->slug]) }}"
                                target="_self" class="button primary expand" style="border-radius: 10px">
                                <span>{{ $bestProduct->short_name }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <style>
            #section_255208508 {
                padding-top: 30px;
                padding-bottom: 30px;
            }
        </style>
    </section>
@endsection


@push('scripts')
    <script>
        const thumbSlider = new Swiper('.thumb-slider', {
            spaceBetween: 10,
            slidesPerView: 5,
            freeMode: true,
            watchSlidesProgress: true,
        });

        const mainSlider = new Swiper('.main-slider', {
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: thumbSlider,
            },
        });
    </script>
@endpush


@push('styles')
    <style>
        .thumb-slider .swiper-slide {
            opacity: 0.5;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .thumb-slider .swiper-slide-thumb-active {
            opacity: 1;
        }
    </style>
@endpush
