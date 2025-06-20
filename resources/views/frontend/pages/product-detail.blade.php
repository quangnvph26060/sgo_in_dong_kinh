@extends('frontend.master')

@section('title', $product->name ?? $product->title_seo)
@section('description', $product->description_seo ?? $product->short_description)
@section('image', showImage($product->image))

@section('content')
    <div class="shop-container blog-wrapper blog-archive page-wrapper">
        <div class="container">
            <nav id="breadcrumbs" class="yoast-breadcrumb breadcrumbs uppercase">
                <span>
                    <span>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </span>
                    <span class="divider">/</span>
                    <span class="breadcrumb_last" aria-current="page">
                        <a href="{{ route('category.product', $product->category->slug) }}">
                            {{ $product->category->name }}</a>
                    </span>
                    <span class="divider">/</span>
                    <span class="breadcrumb_last" aria-current="page">
                        <strong>{{ $product->name }}</strong>
                    </span>
                </span>
            </nav>
        </div>
        <div id="product-{{ $product->id }}" class="product type-product">
            <div class="product-container">
                <div class="product-main">
                    <div class="row content-row mb-0">
                        <div class="product-gallery large-6 col">
                            <div class="product-images relative mb-half has-hover woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                data-columns="4" style="opacity: 1">
                                @if (isOnSale($product))
                                    <div class="badge-container absolute left top z-5">
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

                        </div>
                        <div class="product-info summary col-fit col entry-summary product-summary">

                            <h1 class="product-title product_title entry-title">
                                {{ $product->name }}
                            </h1>

                            <div class="price-wrapper">

                                @if (isOnSale($product))
                                    <p class="price product-page-price price-on-sale">

                                        <del aria-hidden="true">
                                            <small class="woocommerce-Price-amount amount">
                                                <del>{{ formatPrice($product->price) }}
                                                    <span class="woocommerce-Price-currencySymbol">₫
                                                    </span>
                                                </del>
                                            </small>
                                        </del>

                                        <ins aria-hidden="true">
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>{{ formatPrice($product->sale_price) }}
                                                    <span class="woocommerce-Price-currencySymbol">₫</span>
                                                </bdi>
                                            </span>
                                        </ins>
                                    @else
                                        <ins aria-hidden="true">
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>{{ formatPrice($product->price) }}
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
                                    href="javascript:void(0)">
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
                                    <a href="{{ route('category.product', $product->category->slug) }}"
                                        rel="tag">{{ $product->category->name }}</a></span>
                                <span class="tagged_as">Thẻ:
                                    @foreach ($tags as $slug => $tag)
                                        <a href="{{ route('tag.product', $slug) }}"
                                            rel="tag">{{ $tag }}</a>{{ !$loop->last ? ',' : '' }}
                                    @endforeach

                                </span>

                                <div class="socials-share">
                                    <div class="fb-share-button" data-href="{{ request()->fullUrl() }}"
                                        data-layout="button_count" data-size=""><a target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}&amp;src=sdkpreparse"
                                            class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                                </div>

                                <div class="sub_description mt">
                                    @foreach ($setting->commits as $commit)
                                        <div class="commit-item">
                                            <img data-lazyloaded="1" src="{{ showImage($commit['image']) }}"
                                                decoding="async"
                                                class="size-full wp-image-18110 alignright entered litespeed-loaded"
                                                data-src="{{ showImage($commit['image']) }}" alt="" width="40"
                                                height="40" data-ll-status="loaded" />

                                            <span style="font-size: 100%">{{ $commit['text'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-footer mt-4">
                    <div class="container">
                        <div class="row content-row mb-0">
                            <div class="large-3 col post-sidebar pt-0 d-none d-lg-block" id="product-sidebar">
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
                                    </ul>
                                    <div class="tab-panels">
                                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content active"
                                            id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="custom-related-products mb-3">
                            <h3
                                class="product-section-title container-width product-section-title-related pt-half pb-half uppercase">
                                Sản phẩm tương tự
                            </h3>

                            <!-- Swiper -->
                            <div class="swiper related-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($relatedProducts as $relatedProduct)
                                        <div class="swiper-slide">
                                            <div class="product-small col has-hover product">
                                                <div class="col-inner">
                                                    {{-- Sale Badge --}}
                                                    @if (isOnSale($relatedProduct))
                                                        <div class="badge-container absolute left top z-5">
                                                            <div class="callout badge badge-circle">
                                                                <div class="badge-inner secondary on-sale">
                                                                    <span class="onsale">
                                                                        -{{ getDiscountPercentage($relatedProduct->price, $relatedProduct->sale_price) }}%
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- Product Image --}}
                                                    <div class="product-small box">
                                                        <div class="box-image">
                                                            <div class="image-zoom">
                                                                <a
                                                                    href="{{ route('products.detail', [$relatedProduct->category->slug, $relatedProduct->slug]) }}">
                                                                    <img src="{{ showImage($relatedProduct->image) }}"
                                                                        width="300" height="300"
                                                                        alt="{{ $relatedProduct->name }}" />
                                                                </a>
                                                            </div>
                                                        </div>

                                                        {{-- Product Info --}}
                                                        <div class="box-text box-text-products grid-style-2">
                                                            <div class="title-wrapper">
                                                                <p class="op-7 no-text-overflow is-smaller uppercase">
                                                                    {{ $relatedProduct->category->name }}
                                                                </p>
                                                                <p
                                                                    class="name product-title woocommerce-loop-product__title">
                                                                    <a
                                                                        href="{{ route('products.detail', [$relatedProduct->category->slug, $relatedProduct->slug]) }}">
                                                                        {{ $relatedProduct->name }}
                                                                    </a>
                                                                </p>
                                                            </div>
                                                            <div class="price-wrapper">
                                                                <a class="w-100" href="{{ route('products.detail', [$relatedProduct->category->slug, $relatedProduct->slug]) }}">
                                                                    <button class="custom-button mt-3">
                                                                        Báo
                                                                        giá chi
                                                                        tiết
                                                                    </button>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- If you want navigation -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>

                                <!-- If you want pagination (dots) -->
                                <div class="swiper-pagination"></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-overlay" id="popup-overlay">
        <div class="popup-form">
            <span class="close-popup" id="close-popup">&times;</span>
            <h3>Yêu cầu báo giá in: <small>{{ $product->name }}</small></h3>
            <form id="quote-request-form" data-product-id="{{ $product->id }}">
                @csrf
                <input type="text" name="name" placeholder="Họ và Tên*" required />
                <div class="flex-row">
                    <input type="text" name="phone" placeholder="Số điện thoại*" required />
                    <input type="email" name="email" placeholder="Email*" required />
                </div>
                <textarea name="notes" placeholder="Nội dung liên hệ*" required></textarea>

                <p class="note">(Giá tham khảo, chi tiết theo từng mức số lượng, quy cách sản xuất và thời gian vật liệu)
                </p>

                <button type="submit" class="submit-btn">GỬI YÊU CẦU</button>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>
    <script>
        var notyf = new Notyf({
            duration: 5000
        });
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

        document.querySelector('.requestPrice').addEventListener('click', function() {
            document.getElementById('popup-overlay').style.display = 'flex';
        });

        document.getElementById('close-popup').addEventListener('click', function() {
            document.getElementById('popup-overlay').style.display = 'none';
        });

        // Đóng popup khi bấm ra ngoài form
        document.getElementById('popup-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });

        $('#quote-request-form').on('submit', function(e) {
            e.preventDefault(); // Ngăn reload trang

            let $form = $(this);

            let productId = $form.data('product-id');

            let formData = $form.serializeArray();

            formData.push({
                name: 'productId',
                value: productId
            });

            $.ajax({
                url: '{{ route('quote.request') }}',
                type: 'POST',
                data: formData,
                success: function(res) {
                    notyf.success('Yêu cầu báo giá đã được gửi thành công!');

                    $form[0].reset();
                    $('#popup-overlay').fadeOut(300);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let key in errors) {
                            notyf.error(errors[key][0]);
                        }
                    } else if (xhr.status === 429) {
                        notyf.error(xhr.responseJSON.message);
                    } else {
                        notyf.error('Đã xảy ra lỗi. Vui lòng thử lại sau!');
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper(".related-swiper", {
                loop: true,
                spaceBetween: 20,
                slidesPerView: 1,
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        });
    </script>
@endpush


@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css">
    <style>
        .thumb-slider .swiper-slide {
            opacity: 0.5;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .thumb-slider .swiper-slide-thumb-active {
            opacity: 1;
        }

        /* Overlay + Form popup */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-form {
            background: white;
            padding: 25px 30px;
            border-radius: 6px;
            width: 500px;
            max-width: 95%;
            position: relative;
        }

        .close-popup {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        .popup-form h3 {
            margin-bottom: 15px;
            font-size: 1rem;
            font-weight: 500;
        }

        .popup-form h4 {
            margin-top: 20px;
            color: #0072CE;
            font-size: 15px;
        }

        .popup-form form input,
        .popup-form form textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .flex-row {
            display: flex;
            gap: 10px;
        }

        .popup-form .note {
            font-size: 12px;
            color: gray;
            margin-top: 10px;
        }

        .submit-btn {
            background-color: #0072CE;
            color: white;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
        }
    </style>
@endpush
