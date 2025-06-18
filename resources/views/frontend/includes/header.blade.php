<div class="header-wrapper">
    <div id="masthead" class="header-main">
        <div class="header-inner flex-row container logo-left medium-logo-left" role="navigation">
            <div id="logo" class="flex-col logo hide-for-medium">
                <a href="{{ url('/') }}" title="{{ $setting->title }}" rel="home"><img data-lazyloaded="1"
                        src="{{ showImage($setting->logo) }}" width="87" height="87"
                        data-src="{{ showImage($setting->logo) }}" class="header_logo header-logo"
                        alt="In Hoa Long" /><img data-lazyloaded="1" src="{{ showImage($setting->logo) }}"
                        width="87" height="87" data-src="{{ showImage($setting->logo) }}"
                        class="header-logo-dark" alt="In Hoa Long" /></a>
            </div>
            <div class="flex-col show-for-medium flex-left">
                <ul class="mobile-nav nav nav-left">
                    <li class="nav-icon has-icon">
                        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" class="is-small"
                            aria-label="Menu" aria-controls="offcanvasMenu" aria-expanded="false">
                            <i class="icon-menu"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="logo" class="flex-col logo show-for-medium flex-left">
                <a href="{{ url('/') }}" title="{{ $setting->title }}" rel="home"><img data-lazyloaded="1"
                        src="{{ showImage($setting->logo) }}" width="87" height="87"
                        data-src="{{ showImage($setting->logo) }}" class="header_logo header-logo"
                        alt="In Hoa Long" /><img data-lazyloaded="1" src="{{ showImage($setting->logo) }}"
                        width="87" height="87" data-src="{{ showImage($setting->logo) }}"
                        class="header-logo-dark" alt="In Hoa Long" /></a>
            </div>
            <div class="flex-col show-for-medium flex-right" style="margin: 0 0 0 45px">
                <ul class="header-nav header-nav-main nav nav-right">
                    <li>
                        <div class="header-button" style="color: #dd3333!important">
                            <a href="tel:{{ preg_replace('/\D+/', '', strip_tags($setting->phone)) }}" class="button">
                                <span class="hotline-label">HOTLINE</span>
                                <span class="hotline-number">{{ str_replace(' ', '', $setting->phone) }}</span>
                            </a>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="flex-col hide-for-medium flex-left flex-grow">
                <ul class="nav header-nav header-bottom-nav nav-center nav-size-large nav-spacing-xlarge">
                    <li id="menu-item-7734"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7734 menu-item-design-default">
                        <a rel="nofollow" href="{{ route('introduce') }}" class="nav-top-link">Giới thiệu</a>
                    </li>
                    <li id="menu-item-7736"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7736 menu-item-design-container-width menu-item-has-block has-dropdown">
                        <a href="{{ route('products.list') }}" class="nav-top-link" aria-expanded="false"
                            aria-haspopup="menu">Sản phẩm nổi bật<i class="icon-angle-down"></i></a>
                        <div class="sub-menu nav-dropdown">
                            <section class="section" id="section_954440176">
                                <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
                                <div class="section-content relative">
                                    <div class="row row-inan" id="row-339153088">
                                        @foreach ($topProducts as $item)
                                            <div id="col-1990830711" class="col pb-half medium-3 small-6 large-3">
                                                <div class="col-inner" style="background-color: rgb(255, 255, 255)">
                                                    <a class="plain"
                                                        href="{{ route('products.detail', [$item->category->slug, $item->slug]) }}">
                                                        <div
                                                            class="icon-box featured-box align-middle icon-box-left text-left">
                                                            <div class="icon-box-img" style="width: 56px">
                                                                <div class="icon">
                                                                    <div class="icon-inner">
                                                                        <img data-lazyloaded="1"
                                                                            src="{{ showImage($item->image) }}"
                                                                            width="56" height="56"
                                                                            data-src="{{ showImage($item->image) }}"
                                                                            class="attachment-medium size-medium"
                                                                            alt="{{ $item->name }}"
                                                                            decoding="async" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-box-text last-reset">
                                                                <p>{{ $item->short_name }}</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <style>
                                                    #col-1990830711>.col-inner {
                                                        padding: 17px 17px 17px 17px;
                                                        border-radius: 10px;
                                                    }
                                                </style>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <style>
                                    #section_954440176 {
                                        padding-top: 30px;
                                        padding-bottom: 30px;
                                        background-color: rgb(238, 238, 238);
                                    }
                                </style>
                            </section>
                        </div>
                    </li>
                    <li id="menu-item-14388"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14388 menu-item-design-container-width menu-item-has-block">
                        <a href="{{ route('news') }}" class="nav-top-link" aria-expanded="false"
                            aria-haspopup="menu">Báo giá
                        </a>
                        {{-- <div class="sub-menu nav-dropdown">
                            <section class="section" id="section_535199547">
                                <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
                                <div class="section-content relative">
                                    <div class="row row-inan" id="row-1597314937">
                                        @foreach ($posts as $post)
                                            <div id="col-29306870" class="col pb-half medium-3 small-6 large-3">
                                                <div class="col-inner" style="background-color: rgb(255, 255, 255)">
                                                    <a class="plain" href="{{ route('news', $post->slug) }}">
                                                        <div
                                                            class="icon-box featured-box align-middle icon-box-left text-left">
                                                            <div class="icon-box-img" style="width: 56px">
                                                                <div class="icon">
                                                                    <div class="icon-inner">
                                                                        <img data-lazyloaded="1"
                                                                            src="{{ showImage($post->featured_image) }}"
                                                                            width="56" height="56"
                                                                            data-src="{{ showImage($post->featured_image) }}"
                                                                            class="attachment-medium size-medium"
                                                                            alt="{{ $post->short_name }}"
                                                                            decoding="async" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-box-text last-reset">
                                                                {{ $post->short_name }}
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <style>
                                                    #col-29306870>.col-inner {
                                                        padding: 17px 17px 17px 17px;
                                                        border-radius: 10px;
                                                    }
                                                </style>
                                            </div>
                                        @endforeach

                                        <div id="col-855229690" class="col pb-half medium-3 small-6 large-3">
                                            <div class="col-inner" style="background-color: rgb(255, 255, 255)">
                                                <a class="plain" href="{{ route('news') }}">
                                                    <div
                                                        class="icon-box featured-box align-middle icon-box-left text-left">
                                                        <div class="icon-box-img" style="width: 56px">
                                                            <div class="icon">
                                                                <div class="icon-inner">
                                                                    <img data-lazyloaded="1"
                                                                        src="{{ asset('frontend/assets/image/bg-12.png') }}"
                                                                        width="56" height="56"
                                                                        data-src="{{ asset('frontend/assets/image/bg-12.png') }}"
                                                                        class="attachment-medium size-medium"
                                                                        alt="Bg 12" decoding="async" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="icon-box-text last-reset">
                                                            Xem thêm
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <style>
                                                #col-855229690>.col-inner {
                                                    padding: 17px 17px 17px 17px;
                                                    border-radius: 10px;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                    #section_535199547 {
                                        padding-top: 30px;
                                        padding-bottom: 30px;
                                        background-color: rgb(238, 238, 238);
                                    }
                                </style>
                            </section>
                        </div> --}}
                    </li>
                    <li id="menu-item-7737"
                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7737 menu-item-design-default">
                        <a rel="nofollow" href="{{ route('news') }}" class="nav-top-link">Tin Tức</a>
                    </li>
                    <li id="menu-item-7738"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7738 menu-item-design-default">
                        <a rel="nofollow" href="{{ route('contact') }}" class="nav-top-link">Liên hệ</a>
                    </li>
                    <li id="menu-item-7738"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7738 menu-item-design-default">
                        <a rel="nofollow" href="{{ route('contact') }}" class="nav-top-link">In nhanh</a>
                    </li>
                </ul>
            </div>
            <div class="flex-col hide-for-medium flex-right">
                <ul class="header-nav header-nav-main nav nav-right">
                    <li class="html header-button-1">
                        <div class="header-button" style="color: #dd3333!important">
                            <a style="color: #dd3333!important"
                                href="tel:{{ preg_replace('/\D+/', '', strip_tags($setting->phone)) }}"
                                class="button" style="border-radius: 60px">
                                <span>HOTLINE {{ $setting->phone }}</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wide-nav" class="header-bottom wide-nav nav-dark flex-has-center">
        <div class="flex-row container">
            <div class=" hide-for-medium">
                <ul class="nav header-nav header-bottom-nav nav-size-large nav-spacing-xlarge"
                    style="display: inline-block">
                    <li class="header-vertical-menu" role="navigation">
                        <div class="header-vertical-menu__opener dark">
                            <span class="header-vertical-menu__icon"><i class="icon-menu"></i></span><span
                                class="header-vertical-menu__title">TOP SẢN PHẨM IN ẤN</span>
                            {{-- <i class="icon-angle-down"></i> --}}
                        </div>
                        <div class="header-vertical-menu__fly-out has-shadow">
                            <div class="menu-vertical-menu-container">
                                <ul id="menu-vertical-menu" class="ux-nav-vertical-menu nav-vertical-fly-out">

                                    @foreach ($categories as $category)
                                        <li id="menu-item-7762"
                                            class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-7762 menu-item-design-default">
                                            <a href="{{ route('category.product', $category->slug) }}"
                                                class="nav-top-link">{{ $category->name }}</a>
                                        </li>
                                    @endforeach

                                    <li id="menu-item-7766"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7766 menu-item-design-default">
                                        <a href="{{ route('products.list') }}" class="nav-top-link">Xem tất cả</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex-col hide-for-medium flex-right flex-grow">

                <ul
                    class="nav header-nav header-bottom-nav nav-right  nav-line-bottom nav-spacing-xlarge nav-uppercase">
                    <li class="header-search-form search-form html relative has-icon">
                        <form role="search" method="get" class="searchform" action="">
                            <div class="flex-row relative">
                                <div class="flex-col flex-grow">
                                    <label class="screen-reader-text" for="woocommerce-product-search-field-0">Tìm
                                        kiếm:</label>
                                    <input type="search" id="woocommerce-product-search-field-0"
                                        class="search-field mb-0" placeholder="Tìm kiếm..." value=""
                                        name="s" autocomplete="off">
                                </div>
                                <div class="flex-col">
                                    <button type="submit" value="Tìm kiếm"
                                        class="ux-search-submit submit-button secondary button icon mb-0"
                                        aria-label="Submit">
                                        <i class="icon-search"></i> </button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li class="header-divider"></li>
                    <li class="html header-button-2">
                        <div class="header-button">
                            <a href="#tu-van-247" class="button plain is-link" style="border-radius: 99px">
                                <span>YÊU CẦU ĐẶT HÀNG</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bg-container fill">
        <div class="header-bg-image fill"></div>
        <div class="header-bg-color fill"></div>
    </div>
</div>
