<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ showImage($setting->icon) }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/kaiadmin.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"
        media="print" onload="this.media='all'" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <title>@yield('title', $setting->seo_title ?? env('APP_NAME'))</title>

    @stack('styles')
    <style>
        .toggle {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 29px;
        }

        .toggle input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input.status-change:checked+.slider {
            background-color: #4CAF50;
        }

        input.status-change:checked+.slider:before {
            transform: translateX(24px);
        }

        .label {
            margin-left: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .status-input {
            margin-bottom: 20px;
        }

        .status-input label {
            font-weight: bold;
            margin-right: 10px;
        }

        .radio-group {
            display: flex;
            align-items: center;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
            accent-color: #007bff;
            /* Màu xanh cho Hoạt động */
        }

        .radio-group label {
            margin-right: 20px;
            font-size: 16px;
        }
    </style>

    @yield('filemanager')
</head>
<style>
    .nav-item {
        position: relative;
        display: inline-block;
    }

    .profile-pic {
        gap: 10px;
        cursor: pointer;
        text-decoration: none;
        color: #333;
        display: flex;
        align-items: center;
    }

    .dropdown-menu {
        display: none;
        /* Ẩn menu dropdown mặc định */
        position: absolute;
        top: 100%;
        /* Đặt menu ngay dưới nút */
        left: 0;
        background-color: white;
        min-width: 200px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 10px;
        border-radius: 4px;
        z-index: 1000;
    }

    .dropdown-menu li {
        list-style: none;
        padding: 5px 0;
    }

    .dropdown-menu li:hover {
        background-color: #f0f0f0;
    }

    .collapse {
        display: none;
    }

    .collapse.show {
        display: block;
    }

    .collapse {
        display: none;
    }

    .collapse.show {
        display: block;
    }
</style>

<body>
    <div id="wrapper">
        @include('backend.layout.sidebar')

        <div class="main-panel">

            @include('backend.layout.header');
            <div class="container px-5">
                @yield('content')
            </div>

            @include('backend.layout.footer')

        </div>

    </div>

    <script src="{{ asset('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/kaiadmin.js') }}"></script>
    <script src="{{ asset('backend/assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('backend/assets/js/setting-demo2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            // Toggle dropdown menu on click
            $("#dropdownToggle").click(function(e) {
                e.preventDefault(); // Ngăn chặn điều hướng mặc định
                $(this).closest(".nav-item").find(".dropdown-menu").toggle(); // Toggle menu
            });

            // Đóng dropdown khi click bên ngoài
            $(document).click(function(e) {
                if (!$(e.target).closest(".nav-item").length) {
                    $(".dropdown-menu").hide(); // Ẩn menu nếu click bên ngoài
                }
            });
        });

        const previewImage = function(event, imgId) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                const imgElement = document.getElementById(imgId);
                imgElement.src = reader.result;
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function convertSelfSlug(selector) {
            $(selector).on("input", function() {
                let value = $(this).val();

                const slug = value
                    .toLowerCase()
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "") // Bỏ dấu tiếng Việt
                    .replace(/đ/g, "d")
                    .replace(/Đ/g, "d")
                    .replace(/[^a-z0-9 -]/g, "") // Loại bỏ ký tự đặc biệt
                    .replace(/\s+/g, "-") // Thay khoảng trắng bằng "-"
                    .replace(/-+/g, "-") // Loại bỏ dấu "-" liên tiếp
                    .replace(/^-|-$/g, "") // Bỏ dấu "-" đầu/cuối
                    .trim();

                $(this).val(slug);
            });
        }

        function autoGenerateSlug(fromSelector, toSelector) {
            $(fromSelector).on("input", function() {
                const text = $(this).val();
                const slug = text
                    .toLowerCase()
                    .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                    .replace(/đ/g, "d").replace(/Đ/g, "d")
                    .replace(/[^a-z0-9 -]/g, "")
                    .replace(/\s+/g, "-")
                    .replace(/-+/g, "-")
                    .replace(/^-|-$/g, "")
                    .trim();

                $(toSelector).val(slug).trigger('input'); // ✅ cập nhật rồi trigger input để char count update
            });
        }


        function formatPrice(price) {
            if (price) {
                // Chuyển sang số nguyên trước khi format để loại bỏ phần thập phân
                price = parseInt(price);

                return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            return '0';
        }

        function updateCharCount(inputSelector, maxLength) {
            // Tìm label có 'for' tương ứng với inputSelector
            const labelSelector = $('label[for="' + inputSelector.substring(1) + '"]');

            // Tạo thẻ charCountSelector và thêm vào sau label
            const charCountSelector = $("<small></small>")
                .addClass("char-count")
                .css({
                    position: "absolute",
                    right: "1.2rem",
                    top: "0.5rem",
                })
                .insertAfter(labelSelector);

            // Đặt maxlength ban đầu cho phần tử input/textarea
            $(inputSelector).attr("maxlength", maxLength);

            // Hàm cập nhật số ký tự
            $(inputSelector).on("input", function() {
                var currentLength = $(this).val().length;
                charCountSelector.text(currentLength + "/" + maxLength);

                // Kiểm tra khi đã đạt maxLength, ngừng nhập
                if (currentLength >= maxLength) {
                    $(this).attr("maxlength", maxLength); // Ngừng cho phép nhập thêm ký tự
                }
            });

            // Cập nhật số ký tự ban đầu khi trang tải
            var initialLength = $(inputSelector).val().length;
            charCountSelector.text(initialLength + "/" + maxLength);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>

    @stack('scripts')
</body>

</html>
