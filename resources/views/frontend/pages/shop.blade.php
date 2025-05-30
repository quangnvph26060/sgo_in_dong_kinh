@extends('frontend.master')

@section('content')
    <div class="shop-page-title category-page-title page-title ">
        <div class="page-title-inner flex-row medium-flex-wrap container">
            <div class="flex-col flex-grow medium-text-center">
                <div class="is-medium">
                    <nav id="breadcrumbs" class="yoast-breadcrumb breadcrumbs uppercase">
                        <span>
                            <span>
                                <a href="{{ url('/') }}">Trang chủ</a>
                            </span>
                            <span class="divider">/</span>
                            <span class="breadcrumb_last" aria-current="page">
                                <strong>{{ $pageName }}</strong>
                            </span>
                        </span>
                    </nav>
                </div>
            </div>
            <div class="flex-col medium-text-center">
                <p class="woocommerce-result-count hide-for-medium">Hiển thị {{ $products->total() }} kết quả</p>
                <form class="woocommerce-ordering" method="get">
                    <select name="orderby" class="orderby" aria-label="Đơn hàng của cửa hàng">
                        <option value="menu_order" {{ request('orderby') == 'menu_order' ? 'selected' : '' }}>Thứ tự mặc
                            định</option>
                        <option value="rating" {{ request('orderby') == 'rating' ? 'selected' : '' }}>Thứ tự theo điểm đánh
                            giá</option>
                        <option value="date" {{ request('orderby') == 'date' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="price" {{ request('orderby') == 'price' ? 'selected' : '' }}>Giá: thấp đến cao
                        </option>
                        <option value="price-desc" {{ request('orderby') == 'price-desc' ? 'selected' : '' }}>Giá: cao xuống
                            thấp</option>
                    </select>

                    <input type="hidden" name="page" value="{{ request('page') }}">
                    <input type="hidden" name="s" value="{{ request('s') }}">
                </form>
            </div>
        </div>
    </div>

    <div class="row category-page-row">

        @if (isset($category) && $category->banner)
            <img class="img-fluid mb-5" src="{{ showImage($category->banner) }}" alt="{{ $category->name }}">
        @endif

        <div class="col large-12">
            <div class="shop-container">
                {{-- <div class="page-description">
                    <p>
                        Đặt in ngay qua hotline:
                        <a href="tel:{{ preg_replace('/\D+/', '', $setting->phone) }}"
                            rel="nofollow">{{ $setting->phone }}</a>
                    </p>
                </div> --}}
                <div class="woocommerce-notices-wrapper"></div>
                <div class="products row row-small large-columns-4 medium-columns-3 small-columns-2 equalize-box">
                    @foreach ($products as $productItem)
                        <div
                            class="product-small col has-hover product type-product post-15904 status-publish first instock product_cat-hop-cung product_cat-hop-giay product_tag-hop-dung-qua-noel product_tag-hop-giay-noel product_tag-hop-qua-noel product_tag-hop-qua-noel-dep product_tag-in-hop-giay-dung-qua-noel product_tag-in-hop-qua-giang-sinh has-post-thumbnail sale taxable shipping-taxable purchasable product-type-simple">
                            <div class="col-inner">
                                @if (isOnSale($productItem))
                                    <div class="badge-container absolute left top z-5">
                                        <div class="callout badge badge-circle">
                                            <div class="badge-inner secondary on-sale">
                                                <span
                                                    class="onsale">-{{ getDiscountPercentage($productItem->price, $productItem->sale_price) }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="product-small box">
                                    <div class="box-image">
                                        <div class="image-zoom">
                                            <a href="{{ route('products.detail', [$productItem->category->slug, $productItem->slug]) }}"
                                                aria-label="{{ $productItem->name }}"><img data-lazyloaded="1"
                                                    src="{{ showImage($productItem->image) }}" width="300"
                                                    height="300" data-src="{{ showImage($productItem->image) }}"
                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail entered litespeed-loaded"
                                                    alt="{{ $productItem->name }}" decoding="async" fetchpriority="high"
                                                    data-srcset="{{ showImage($productItem->image) }} 300w, {{ showImage($productItem->image) }} 150w, {{ showImage($productItem->image) }} 100w, {{ showImage($productItem->image) }} 600w"
                                                    data-sizes="(max-width: 300px) 100vw, 300px" data-ll-status="loaded"
                                                    sizes="(max-width: 300px) 100vw, 300px"
                                                    srcset="
                                                        {{ showImage($productItem->image) }} 300w,
                                                        {{ showImage($productItem->image) }} 150w,
                                                        {{ showImage($productItem->image) }} 100w,
                                                        {{ showImage($productItem->image) }} 600w
                                                    " />
                                            </a>
                                        </div>
                                        <div class="image-tools is-small top right show-on-hover"></div>
                                        <div class="image-tools is-small hide-for-small bottom left show-on-hover"></div>
                                        <div
                                            class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                        </div>
                                    </div>
                                    <div class="box-text box-text-products text-center grid-style-2"
                                        style="height: 94.7778px">
                                        <div class="title-wrapper">
                                            <p class="name product-title woocommerce-loop-product__title"
                                                style="height: 42px">
                                                <a href="{{ route('products.detail', [$productItem->category->slug, $productItem->slug]) }}"
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link">{{ $productItem->name }}</a>
                                            </p>
                                        </div>
                                        <div class="price-wrapper" style="height: 16px">
                                            <span class="price">

                                                @if (isOnSale($productItem))
                                                    <del aria-hidden="true">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi>{{ formatPrice($productItem->price) }}&nbsp;
                                                                <span class="woocommerce-Price-currencySymbol">₫
                                                                </span>
                                                            </bdi>
                                                        </span>
                                                    </del>

                                                    <ins aria-hidden="true">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi>{{ formatPrice($productItem->sale_price) }}&nbsp;
                                                                <span class="woocommerce-Price-currencySymbol">₫</span>
                                                            </bdi>
                                                        </span>
                                                    </ins>
                                                @else
                                                    <ins aria-hidden="true">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi>{{ formatPrice($productItem->price) }}&nbsp;
                                                                <span class="woocommerce-Price-currencySymbol">₫</span>
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
                    @endforeach

                </div>
                <div class="container">
                    <nav class="woocommerce-pagination">
                        {{ $products->links('vendor.pagination.custom') }}
                    </nav>
                </div>
            </div>

            @isset($category)
                <div class="term-description mb-3">
                    {!! $category->description !!}
                </div>
            @endisset

            <div class="wpcf7 js" id="wpcf7-f123-o1" lang="vi" dir="ltr" data-wpcf7-id="123">
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
                                <span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40"
                                        maxlength="400"
                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"
                                        aria-required="true" aria-invalid="false" placeholder="Họ và Tên*"
                                        value="" type="text" name="your-name" /></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col large-6">
                            <div class="form-group">
                                <span class="wpcf7-form-control-wrap" data-name="your-phone"><input size="40"
                                        maxlength="400"
                                        class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel form-control"
                                        id="your-phone" aria-required="true" aria-invalid="false"
                                        placeholder="Số điện thoại*" value="" type="tel"
                                        name="your-phone" /></span>
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
                    <div class="wpcf7-response-output" aria-hidden="true"></div>
                </form>
            </div>
            <section class="section" id="section_249455491">
                <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
                <div class="section-content relative">
                    <div class="row list-link-product" id="row-1668116505">
                        <div id="col-517534901" class="col small-12 large-12">
                            <div class="col-inner">
                                <div id="text-1379789332" class="text">
                                    <h3>Top sản phẩm nổi bật</h3>
                                    <style>
                                        #text-1379789332 {
                                            color: #1596e2;
                                        }

                                        #text-1379789332>* {
                                            color: #1596e2;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                        @foreach ($topProducts as $topProductPageShop)
                            <div id="col-561602211" class="col medium-3 small-12 large-3">
                                <div class="col-inner">
                                    <a href="{{ route('products.detail', [$topProductPageShop->category->slug, $topProductPageShop->slug]) }}"
                                        target="_self" class="button primary expand" style="border-radius: 10px">
                                        <span>{{ $topProductPageShop->short_name }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <style>
                    #section_249455491 {
                        padding: 30px 0;
                    }
                </style>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const orderSelect = document.querySelector(".woocommerce-ordering .orderby");
            if (orderSelect) {
                orderSelect.addEventListener("change", function() {
                    this.form.submit();
                });
            }
        });
    </script>
@endpush
