<!DOCTYPE html>
<html lang="vi" class="js" style="--flatsome--header--sticky-height: 120px">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('title', $setting->title)" />
    <meta property="og:description" content="@yield('og:description', $setting->seo_description)" />
    <meta name="description" content="@yield('description', $setting->seo_description)" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="fb:app_id" content="1234567890" />
    <meta property="og:type" content="article">
    <title>@yield('title')</title>
    <link rel="icon" href=" {{ showImage($setting->icon) }} " sizes="192x192">
    @include('frontend.includes.style')

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v22.0&appId=598605722761627"></script>

    {!! $setting->head_script !!}
</head>

<body
    class="home page-template page-template-page-blank page-template-page-blank-php page page-id-5185 theme-flatsome woocommerce-no-js lightbox nav-dropdown-has-arrow">
    {!! $setting->body_script !!}

    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
    <div id="wrapper">
        <header id="header" class="header has-sticky sticky-jump sticky-hide-on-scroll">
            @include('frontend.includes.header')
        </header>

        <main id="main" class="">
            @yield('content')
        </main>

        <footer id="footer" class="footer-wrapper">
            {!! $setting->footer_script !!}

            @include('frontend.includes.footer')
        </footer>
    </div>

    <div class="box-phone-fixed"><a href="tel:{{ preg_replace('/\D+/', '', strip_tags($setting->phone)) }}">
            <img data-lazyloaded="1" src="{{ asset('frontend/assets/image/fixed-1.png') }}" width="40"
                height="40" data-src="{{ asset('frontend/assets/image/fixed-1.png') }}" alt="Gọi đến Indongkinh"
                data-ll-status="loaded" class="entered litespeed-loaded">
        </a>
        <a target="_blank" href="https://zalo.me/{{ preg_replace('/\D+/', '', strip_tags($setting->hotline)) }}"
            rel="nofollow">
            <img data-lazyloaded="1" src="{{ asset('frontend/assets/image/zalo.png') }}" width="40" height="40"
                data-src="{{ asset('frontend/assets/image/zalo.png') }}" alt="Chat với Indongkinh"
                data-ll-status="loaded" class="entered litespeed-loaded">
        </a>
        <a href="#top" class="btn-go-top" id="top-link">
            <img data-lazyloaded="1" src="{{ asset('frontend/assets/image/go-top.png') }}" width="40" height="40"
                data-src="{{ asset('frontend/assets/image/go-top.png') }}" alt="Lên đầu trang web"
                data-ll-status="loaded" class="entered litespeed-loaded">
        </a>
    </div>

    @include('frontend.includes.support')

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        @include('frontend.includes.offcanvas')
    </div>

    @include('frontend.includes.script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submenuToggles = document.querySelectorAll(".submenu-toggle");

            submenuToggles.forEach(toggle => {
                toggle.addEventListener("click", function(e) {
                    e.preventDefault();
                    const parentLi = this.parentElement;

                    // Đóng tất cả submenu khác (nếu muốn chỉ mở 1 menu tại 1 thời điểm)
                    document.querySelectorAll(".has-submenu").forEach(item => {
                        if (item !== parentLi) {
                            item.classList.remove("active");
                        }
                    });

                    // Toggle menu hiện tại
                    parentLi.classList.toggle("active");
                });
            });
        });
    </script>
</body>

</html>
