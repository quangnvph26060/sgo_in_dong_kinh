@extends('backend.layout.index')

@section('title', 'Cập nhật bài viết')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.news.index') }}">Bài viết</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới bài viết</li>
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

    <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label fw-bold">Tiêu đề</label>
                                <input type="text" name="subject" class="form-control" placeholder="Tiêu đề"
                                    value="{{ old('subject') }}">
                            </div>

                            <div class="mb-3 col-lg-12 position-relative">
                                <label for="slug" class="form-label fw-bold">Slug</label>
                                <input value="{{ old('slug') }}" type="text" class="form-control" name="slug"
                                    id="slug" placeholder="Nhập slug">
                            </div>

                            <div class="mb-3 col-lg-6 position-relative">
                                <label for="short_name" class="form-label fw-bold">Tiêu đề rút ngọn</label>
                                <input value="{{ old('short_name') }}" type="text" class="form-control" name="short_name"
                                    id="short_name" placeholder="Tiêu đề rút ngọn">
                            </div>

                            <div class="mb-3 col-lg-6 position-relative">
                                <label for="view" class="form-label fw-bold">Lượt xem</label>
                                <input value="{{ old('view') }}" type="text" class="form-control" name="view"
                                    id="view" placeholder="Lượt xem">
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="summary" class="form-label fw-bold">Mô tả ngắn</label>
                                <textarea rows="4" name="summary" class="form-control" placeholder="Nội dung ngắn">{{ old('summary') }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="article" class="form-label fw-bold">Nội dung</label>
                                <textarea name="article" class="form-control ckeditor" id="article" placeholder="Nội dung">{!! old('article') !!}</textarea>
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
                                <a href="#" class="title d-block">{{ old('seo_title') ?? old('name') }}</a>
                                <div class="url">
                                    {{ config('app.url') }}/{{ old('slug') }}</div>
                                <div class="date mt-1">
                                    {{ now()->locale('vi')->translatedFormat('l, j \T\h\á\n\g n, Y') }} -
                                    <span class="desc">{{ Str::words(old('seo_description'), 30, '...') }}</span>
                                </div>
                            </div>

                            <hr>

                            <div class="seo-edit-section" style="display: none">
                                <div class="mb-3 position-relative">
                                    <label for="seo_title" class="form-label">SEO Title</label>
                                    <input type="text" class="form-control" name="seo_title" id="seo_title"
                                        placeholder="SEO Title" value="{{ old('seo_title') }}">
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="seo_description" class="form-label">SEO description</label>
                                    <textarea class="form-control" name="seo_description" id="seo_description" rows="3" placeholder="SEO description">{{ old('seo_description') }}</textarea>
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
                        <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-secondary fs-6"><i
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
                        <h4 class="card-title fs-6">Ngày đăng</h4>
                    </div>
                    <div class="form-group">
                        <input type='text' class="form-control" value="{{ old('posted_at') }}" id="posted_at"
                            name="posted_at" />
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Là bài viết nổi bật?</h3>
                    </div>

                    <div class="form-group">
                        <div class="radio-container">
                            <label class="toggle">
                                <input type="checkbox" class="status-change update-status" name="is_favorite"
                                    @checked(old('is_favorite') == 1) value="1">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title fs-6">Danh mục</h4>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <select name="category_id" class="form-select">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}" @selected(old('category_id') === $id)>{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title fs-6">Ảnh đại diện</h3>
                    </div>

                    <div class="form-group">
                        <img class="img-fluid img-thumbnail w-100" id="show_featured_image" style="cursor: pointer"
                            src="{{ showImage('') }}" alt=""
                            onclick="document.getElementById('featured_image').click();">

                        <input type="file" class="form-control d-none" id="featured_image" name="featured_image"
                            accept="image/*" onchange="previewImage(event, 'show_featured_image')">
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Tags</h3>
                    </div>

                    <div class="form-group">
                        <select class="form-control select-tags" name="tags[]" multiple="multiple">
                            @foreach ($allTags as $tag)
                                <option @selected(in_array($tag->id, old('tags', []))) value="{{ $tag->id }}">{{ $tag->tag }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('backend/library/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(function() {
            // convertSlug("#slug");

            flatpickr("#posted_at", {
                dateFormat: "d-m-Y",
                altInput: true,
                altFormat: "d-m-Y",
                allowInput: true,
                locale: "vn",
                onReady: function(selectedDates, dateStr, instance) {
                    instance.altInput.setAttribute("placeholder", "d-m-Y");
                }
            });

            $('.btn-trigger-show-seo-detail').on('click', function(e) {
                e.preventDefault();
                $('.seo-edit-section').toggle();
            });

            $('.select-tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "Nhập hoặc chọn tag",
            });
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
