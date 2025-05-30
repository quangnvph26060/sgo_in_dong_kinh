@extends('backend.layout.index')

@section('title', 'Thêm mới sản phẩm')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Sản phẩm</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới sản phẩm</li>
        </ol>
    </nav>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                            <!-- Tên sản phẩm -->
                            <div class="mb-3 col-lg-12 position-relative">
                                <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                                <input value="{{ old('name') }}" type="text" class="form-control" name="name"
                                    id="name" placeholder="Nhập tên sản phẩm">
                            </div>

                            <div class="mb-3 col-lg-6 position-relative">
                                <label for="slug" class="form-label fw-bold">Slug</label>
                                <input value="{{ old('slug') }}" type="text" class="form-control" name="slug"
                                    id="slug" placeholder="Nhập slug">
                            </div>

                            <div class="mb-3 col-lg-6 position-relative">
                                <label for="short_name" class="form-label fw-bold">Tên ngắn</label>
                                <input value="{{ old('short_name') }}" type="text" class="form-control" name="short_name"
                                    id="short_name" placeholder="Nhập tên ngắn">
                            </div>

                            <!-- Giá -->
                            <div class="mb-3 col-lg-6">
                                <label for="price" class="form-label fw-bold">Giá</label>
                                <input value="{{ old('price') }}" type="text" class="form-control money-input"
                                    name="price" id="price" placeholder="Nhập giá sản phẩm">
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="sale_price" class="form-label fw-bold">Giá khuyến mãi</label>
                                <input value="{{ old('sale_price') }}" type="text" class="form-control money-input"
                                    name="sale_price" id="sale_price" placeholder="Nhập giá khuyến mãi sản phẩm">
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="start_date" class="form-label fw-bold">Ngày bắt đầu</label>
                                <input value="{{ old('start_date') }}" type="text" class="form-control" name="start_date"
                                    id="start_date" placeholder="Nhập ngày bắt đầu">
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="end_date" class="form-label fw-bold">Ngày kết thúc</label>
                                <input value="{{ old('end_date') }}" type="text" class="form-control" name="end_date"
                                    id="end_date" placeholder="Nhập ngày kết thúc">
                            </div>

                            <div class="mb-3 col-lg-6 position-relative">
                                <label for="sku" class="form-label fw-bold">SKU</label>
                                <input value="{{ old('sku') }}" type="text" class="form-control" name="sku"
                                    id="sku" placeholder="Nhập SKU sản phẩm">
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="view_count" class="form-label fw-bold">Số lượt xem</label>
                                <input value="{{ old('view_count') }}" type="number" class="form-control"
                                    name="view_count" id="view_count">
                            </div>

                            <div class="col-lg-12 mb-3 position-relative">
                                <label for="short_description" class="form-label fw-bold">Mô tả ngắn</label>
                                <textarea id="short_description" class="form-control" name="short_description" rows="4">{{ old('short_description') }}</textarea>
                            </div>

                            <div class="col-lg-12">
                                <label for="description" class="form-label fw-bold">Mô tả chi tiết</label>
                                <textarea id="description" class="form-control ckeditor" name="description" rows="10">{!! old('description') !!}</textarea>
                            </div>

                            <div class="form-group mb-3 col-lg-12">
                                <label for="album" class="form-label fw-bold">Album</label>
                                <div class="album pb-3"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="fs-6 card-title">Tối ưu hóa công cụ tìm kiếm</h3>
                        <a href="#" class="text-primary text-decoration-none btn-trigger-show-seo-detail">Edit SEO
                            meta</a>
                    </div>
                    <div class="card-body">
                        <div class="seo-box">
                            <div class="seo-preview mb-3">
                                <a href="#" class="title d-block">{{ old('title_seo') ?? old('name') }}</a>
                                <div class="url">
                                    {{ config('app.url') }}/{{ old('category_slug') }}/{{ old('slug') }}</div>
                                <div class="date mt-1">
                                    {{ now()->locale('vi')->translatedFormat('L, j \T\h\á\n\g n, Y') }} -
                                    <span class="desc">{{ Str::words(old('description_seo'), 30, '...') }}</span>
                                </div>
                            </div>

                            <hr>

                            <div class="seo-edit-section" style="display: none">
                                <div class="mb-3 position-relative">
                                    <label for="title_seo" class="form-label">SEO Title</label>
                                    <input type="text" class="form-control" name="title_seo" id="title_seo"
                                        placeholder="SEO Title" value="{{ old('title_seo') }}">
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="description_seo" class="form-label">SEO description</label>
                                    <textarea class="form-control" name="description_seo" id="description_seo" rows="3"
                                        placeholder="SEO description">{{ old('description_seo') }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Xuất bản</h3>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary fs-6 me-2"><i class="fas fa-save me-2"></i>
                            Lưu</button>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-outline-secondary fs-6"><i
                                class="fas fa-arrow-left ms-2"></i> Quay lại</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Trạng thái</h3>
                    </div>

                    <div class="form-group">
                        <select class="form-select" name="status" id="status">
                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Công khai</option>
                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Tạm dừng</option>
                        </select>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Là sản phẩm nổi bật?</h3>
                    </div>

                    <div class="form-group">
                        <div class="radio-container">
                            <label class="toggle">
                                <input type="checkbox" class="status-change update-status" name="is_top"
                                    @checked(old('is_top') == 1) value="1">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Danh mục</h3>
                    </div>

                    <div class="form-group">
                        <select class="form-select" name="category_id" id="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Là sản phẩm quảng cáo?</h3>
                    </div>

                    <div class="form-group">
                        <div class="radio-container">
                            <label class="toggle">
                                <input type="checkbox" class="status-change update-status" name="is_advertisement"
                                    @checked(old('is_advertisement') == 1) value="1">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Ảnh quảng cáo</h3>
                    </div>

                    <div class="form-group">
                        <img class="img-fluid img-thumbnail w-100" id="show_advertisement_image" style="cursor: pointer"
                            src="{{ showImage('') }}" alt=""
                            onclick="document.getElementById('advertisement_image').click();">

                        <input type="file" class="form-control d-none" id="advertisement_image"
                            name="advertisement_image" accept="image/*"
                            onchange="previewImage(event, 'show_advertisement_image')">
                    </div>
                </div> --}}

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Ảnh đại diện</h3>
                    </div>

                    <div class="form-group">
                        <img class="img-fluid img-thumbnail w-100" id="show_image" style="cursor: pointer"
                            src="{{ showImage('') }}" alt=""
                            onclick="document.getElementById('image').click();">

                        <input type="file" class="form-control d-none" id="image" name="image"
                            accept="image/*" onchange="previewImage(event, 'show_image')">
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Là ấn phẩm tết?</h3>
                    </div>

                    <div class="form-group">
                        <div class="radio-container">
                            <label class="toggle">
                                <input type="checkbox" class="status-change update-status" name="is_tet_edition"
                                    @checked(old('is_tet_edition') == 1) value="1">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script src="{{ asset('backend/library/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="{{ asset('backend/assets/js/image-uploader.min.js') }}"></script>

    <script>
        function convertToAsciiUpper(inputId) {
            $(inputId).on("input", function() {
                let value = $(this).val();

                // Chuyển thành chữ IN HOA, loại bỏ dấu tiếng Việt và khoảng trắng
                value = value
                    .toUpperCase()
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "") // Bỏ dấu tiếng Việt
                    .replace(/\s+/g, ""); // Bỏ tất cả khoảng trắng

                $(this).val(value);
            });
        }
        $(function() {

            autoGenerateSlug('#name', '#slug');

            updateCharCount('#name', 255)
            updateCharCount('#short_name', 255)
            updateCharCount('#slug', 255)
            updateCharCount('#short_description', 500)
            updateCharCount('#sku', 255)
            updateCharCount('#title_seo', 255)
            updateCharCount('#description_seo', 500)
            convertToAsciiUpper("#sku");

            $('.btn-trigger-show-seo-detail').on('click', function(e) {
                e.preventDefault();
                $('.seo-edit-section').toggle();
            });

            $('.select-tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "Nhập hoặc chọn tag",
            });


            $(".money-input").on("input", function() {
                let input = $(this).val().replace(/\D/g, ""); // Bỏ tất cả ký tự không phải số
                let formatted = input.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                $(this).val(formatted);
            });

            // Khởi tạo flatpickr cho các trường ngày tháng
            flatpickr("#start_date", {
                enableTime: true,
                dateFormat: "d-m-Y H:i",
                altInput: true,
                altFormat: "d-m-Y H:i",
                allowInput: true,
                locale: "vn"
            });


            flatpickr("#end_date", {
                enableTime: true,
                dateFormat: "d-m-Y H:i",
                altInput: true,
                altFormat: "d-m-Y H:i",
                allowInput: true,
                locale: "vn"
            });


            $('.album').imageUploader({
                preloaded: [],
                imagesInputName: 'images',
                preloadedInputName: 'old',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 15,
            });

        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/image-uploader.min.css') }}">
    <style>
        .modal-backdrop.show {
            z-index: 1001 !important;
        }

        .seo-box {
            border-radius: 6px;
            background-color: #fff;
        }

        .seo-preview a.title {
            font-size: 18px;
            color: #1a0dab;
            text-decoration: none;
        }

        .seo-preview .url {
            color: #006621;
            font-size: 14px;
        }

        .seo-preview .date {
            color: #6a6a6a;
            font-size: 14px;
        }

        .seo-preview .desc {
            color: #545454;
            font-size: 14px;
        }

        .form-label {
            font-weight: 500;
        }
    </style>
@endpush
