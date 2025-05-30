@extends('backend.layout.index')

@section('title', 'Cập nhật danh mục')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.news.index') }}">Danh mục</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới danh mục</li>
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

    @php
        $action = isset($category) ? route('admin.category.update', $category->id) : route('admin.category.store');
    @endphp

    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        @csrf

        @if (isset($category))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12 mb-3 position-relative">
                                <label for="name" class="form-label fw-bold">Tên danh mục</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Tên danh mục" value="{{ old('name', $category->name ?? '') }}">
                            </div>

                            <div class="mb-3 col-lg-12 position-relative">
                                <label for="slug" class="form-label fw-bold">Slug</label>
                                <input value="{{ old('slug', $category->slug ?? '') }}" type="text" class="form-control"
                                    name="slug" id="slug" placeholder="Nhập slug">
                            </div>

                            <div class="mb-3 col-md-12 position-relative">
                                <label for="description" class="form-label fw-bold">Mô tả</label>
                                <textarea rows="4" name="description" id="description" class="form-control ckeditor" placeholder="Mô tả">{{ old('description', $category->description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="fs-6 card-title">Tối ưu hóa công cụ tìm kiếm</h3>
                        {{-- <a href="#" class="text-primary text-decoration-none btn-trigger-show-seo-detail">Edit SEO
                            meta</a> --}}
                    </div>
                    <div class="card-body">
                        <div class="seo-box">
                            <div class="seo-preview mb-3">
                                <a href="#"
                                    class="title d-block">{{ old('title_seo', $category->title_seo ?? '') ?? old('name', $category->name) }}</a>
                                <div class="url">
                                    {{ config('app.url') }}/{{ old('slug', $category->slug ?? '') }}</div>
                                <div class="date mt-1">
                                    {{ now()->locale('vi')->translatedFormat('l, j \T\h\á\n\g n, Y') }} -
                                    <span
                                        class="desc">{{ Str::words(old('description_seo', $category->description_seo ?? ''), 30, '...') }}</span>
                                </div>
                            </div>

                            <hr>

                            <div class="seo-edit-section">
                                <div class="row">
                                    <div class="mb-3 position-relative col-lg-12">
                                        <label for="title_seo" class="form-label">SEO Title</label>
                                        <input type="text" class="form-control" name="title_seo" id="title_seo"
                                            placeholder="SEO Title"
                                            value="{{ old('title_seo', $category->title_seo ?? '') }}">
                                    </div>

                                    <div class="mb-3 position-relative  col-lg-12">
                                        <label for="description_seo" class="form-label">SEO description</label>
                                        <textarea class="form-control" name="description_seo" id="description_seo" rows="3" placeholder="SEO description">{{ old('description_seo', $category->description_seo ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Xuất bản</h3>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary fs-6 me-2"><i class="fas fa-save me-2"></i>
                            Lưu</button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-outline-secondary fs-6"><i
                                class="fas fa-arrow-left ms-2"></i> Quay lại</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Trạng thái</h3>
                    </div>

                    <div class="form-group">
                        <select class="form-select" name="status" id="status">
                            <option value="1" {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}>Công
                                khai</option>
                            <option value="2" {{ old('status', $category->status ?? '') == 2 ? 'selected' : '' }}>Tạm
                                dừng</option>
                        </select>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Loại</h3>
                    </div>

                    <div class="form-group">
                        <select class="form-select" name="type" id="type">
                            <option value="">--- Chọn loại ---</option>
                            <option value="products" @selected(old('type', $category->type ?? '') == 'products')>Sản phẩm</option>
                            <option value="posts" @selected(old('type', $category->type ?? '') == 'posts')>Bài viết</option>
                        </select>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title fs-6">Ảnh đại diện</h3>
                    </div>

                    <div class="form-group">
                        <img class="img-fluid img-thumbnail w-100" id="show_image" style="cursor: pointer"
                            src="{{ showImage($category->image ?? '') }}" alt=""
                            onclick="document.getElementById('image').click();">

                        <input type="file" class="form-control d-none" id="image" name="image"
                            accept="image/*" onchange="previewImage(event, 'show_image')">
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title fs-6">Banner</h3>
                    </div>

                    <div class="form-group">
                        <img class="img-fluid img-thumbnail w-100" id="show_banner" style="cursor: pointer"
                            src="{{ showImage($category->banner ?? '') }}" alt=""
                            onclick="document.getElementById('banner').click();">

                        <input type="file" class="form-control d-none" id="banner" name="banner"
                            accept="image/*" onchange="previewImage(event, 'show_banner')">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('backend/library/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(function() {

            updateCharCount('#name', 255);
            updateCharCount('#description', 300);
            updateCharCount('#title_seo', 255);
            updateCharCount('#description_seo', 500);
            updateCharCount('#slug', 255);
            autoGenerateSlug('#name', '#slug');

            // $('.btn-trigger-show-seo-detail').on('click', function(e) {
            //     e.preventDefault();
            //     $('.seo-edit-section').toggle();
            // });

            $('.select-tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "Nhập hoặc chọn tag",
            });
        });
    </script>
@endpush

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
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
