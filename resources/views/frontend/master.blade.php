<!DOCTYPE html>
<html lang="vi" class="js" style="--flatsome--header--sticky-height: 120px">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    @include('frontend.includes.style')

</head>

<body
    class="home page-template page-template-page-blank page-template-page-blank-php page page-id-5185 theme-flatsome woocommerce-no-js lightbox nav-dropdown-has-arrow">
    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
    <div id="wrapper">
        <header id="header" class="header has-sticky sticky-jump sticky-hide-on-scroll">
            @include('frontend.includes.header')
        </header>

        <main id="main" class="">
            @yield('content')
        </main>

        <footer id="footer" class="footer-wrapper">
            @include('frontend.includes.footer')
        </footer>
    </div>

    <div class="box-phone-fixed"><a href="tel:0903400469" target="_blank"><img data-lazyloaded="1"
                src="https://inhoalong.vn/wp-content/uploads/2024/05/fixed-1.png" width="40" height="40"
                data-src="https://inhoalong.vn/wp-content/uploads/2024/05/fixed-1.png" alt="Gọi đến Inhoalong"
                data-ll-status="loaded" class="entered litespeed-loaded"><noscript><img width="40" height="40"
                    src="https://inhoalong.vn/wp-content/uploads/2024/05/fixed-1.png"
                    alt="Gọi đến Inhoalong"></noscript></a><a target="_blank" href="https://zalo.me/0903400469"
            rel="nofollow"><img data-lazyloaded="1" src="https://inhoalong.vn/wp-content/uploads/2024/05/zalo.png"
                width="40" height="40" data-src="https://inhoalong.vn/wp-content/uploads/2024/05/zalo.png"
                alt="Chat với Inhoalong" data-ll-status="loaded" class="entered litespeed-loaded"><noscript><img
                    width="40" height="40" src="https://inhoalong.vn/wp-content/uploads/2024/05/zalo.png"
                    alt="Chat với Inhoalong"></noscript></a><a href="#top" class="btn-go-top" id="top-link"><img
                data-lazyloaded="1" src="https://inhoalong.vn/wp-content/uploads/2024/05/go-top.png" width="40"
                height="40" data-src="https://inhoalong.vn/wp-content/uploads/2024/05/go-top.png"
                alt="Lên đầu trang web" data-ll-status="loaded" class="entered litespeed-loaded"><noscript><img
                    width="40" height="40" src="https://inhoalong.vn/wp-content/uploads/2024/05/go-top.png"
                    alt="Lên đầu trang web"></noscript></a></div>

    <div class="box-fixed-sm">
        <div></div>
        <div class="zalo"><a href="https://zalo.me/0903400469" target="_blank" rel="nofollow"><img data-lazyloaded="1"
                    src="https://inhoalong.vn/wp-content/uploads/2024/05/zalo.svg"
                    data-src="https://inhoalong.vn/wp-content/uploads/2024/05/zalo.svg" alt="Chat với Inhoalong"
                    data-ll-status="loaded" class="entered litespeed-loaded"><noscript><img
                        src="https://inhoalong.vn/wp-content/uploads/2024/05/zalo.svg"
                        alt="Chat với Inhoalong"></noscript><span>Đặt in</span></a></div>
        <div class="tel-fixed"><a href="tel:0903400469" target="_blank" rel="nofollow"><img data-lazyloaded="1"
                    src="https://inhoalong.vn/wp-content/uploads/2024/05/call-calling.svg"
                    data-src="https://inhoalong.vn/wp-content/uploads/2024/05/call-calling.svg" alt="Gọi đến Inhoalong"
                    data-ll-status="loaded" class="entered litespeed-loaded"><noscript><img
                        src="https://inhoalong.vn/wp-content/uploads/2024/05/call-calling.svg"
                        alt="Gọi đến Inhoalong"></noscript><span>Hotline</span></a></div>
    </div>
    @include('frontend.includes.support')

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        @include('frontend.includes.offcanvas')
    </div>

    @include('frontend.includes.script')
</body>

</html>
