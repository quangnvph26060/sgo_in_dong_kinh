@extends('backend.layout.index')

@section('title', 'Cập nhật bài viết')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.news.index') }}">Bài viết</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa bài viết - {{ $news->subject }}</li>
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

    <form action="{{ route('admin.news.update', $news) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12 mb-3 position-relative">
                                <label for="subject" class="form-label fw-bold">Tiêu đề</label>
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="Tiêu đề" value="{{ old('subject', $news->subject) }}">
                            </div>

                            <div class="mb-3 col-lg-12 position-relative">
                                <label for="slug" class="form-label fw-bold">Slug</label>
                                <input value="{{ old('slug', $news->slug) }}" type="text" class="form-control"
                                    name="slug" id="slug" placeholder="Nhập slug">
                            </div>

                            <div class="mb-3 col-lg-6 position-relative">
                                <label for="short_name" class="form-label fw-bold">Tiêu đề rút ngọn</label>
                                <input value="{{ old('short_name', $news->short_name) }}" type="text"
                                    class="form-control" name="short_name" id="short_name" placeholder="Tiêu đề rút ngọn">
                            </div>

                            <div class="mb-3 col-lg-6 position-relative">
                                <label for="view" class="form-label fw-bold">Lượt xem</label>
                                <input value="{{ old('view', $news->view) }}" type="text" class="form-control"
                                    name="view" id="view" placeholder="Lượt xem">
                            </div>

                            <div class="mb-3 col-md-12 position-relative">
                                <label for="summary" class="form-label fw-bold">Mô tả ngắn</label>
                                <textarea rows="4" name="summary" id="summary" class="form-control" placeholder="Nội dung ngắn">{{ old('summary', $news->summary) }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="article" class="form-label fw-bold">Nội dung</label>
                                <textarea name="article" class="form-control ckeditor" id="article" placeholder="Nội dung">{!! old('article', $news->article) !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="fs-6 card-title">Tối ưu hóa công cụ tìm kiếm</h3>
                    </div>
                    <div class="card-body">
                        <div class="seo-box">
                            <div class="seo-preview mb-3">
                                <a href="#" class="title d-block">{{ $news->seo_title }}</a>
                                <div class="url">
                                    {{ config('app.url') }}/{{ $news->slug }}</div>
                                <div class="date mt-1">
                                    {{ $news->created_at->locale('vi')->translatedFormat('l, j \T\h\á\n\g n, Y') }} -
                                    <span
                                        class="desc">{{ $news->seo_description ? Str::words($news->seo_description, 30, '...') : 'Đang cập nhật...' }}</span>
                                </div>
                            </div>

                            <hr>

                            <div class="seo-edit-section">
                                <div class="row">
                                    <div class="mb-3 position-relative col-lg-12">
                                        <label for="seo_title" class="form-label fw-bold">Tiêu đề seo</label>
                                        <input type="text" class="form-control" name="seo_title" id="seo_title"
                                            placeholder="SEO Title" value="{{ $news->seo_title }}">
                                    </div>

                                    <div class="mb-3 position-relative col-lg-12">
                                        <label for="seo_description" class="form-label fw-bold">Mô tả seo</label>
                                        <textarea class="form-control" name="seo_description" id="seo_description" rows="3" placeholder="SEO description">{{ $news->seo_description }}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                {{-- Điểm SEO --}}
                @php
                    $seoScoreValue = $seoData['seoScoreValue'] ?? 0;
                    $analysis = $seoData['analysis'] ?? [];
                    $hasWarning = $seoData['hasWarning'] ?? false;

                    $seoColor = 'bg-danger'; // đỏ mặc định (dưới 50)
                    $badgeClass = 'bg-danger';

                    if ($seoScoreValue >= 80) {
                        $seoColor = 'bg-success'; // xanh lá (tốt)
                        $badgeClass = 'bg-success';
                    } elseif ($seoScoreValue >= 50) {
                        $seoColor = 'bg-warning'; // vàng (trung bình)
                        $badgeClass = 'bg-warning text-dark';
                    }
                @endphp

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">Điểm SEO tổng thể</h5>
                            <span class="badge {{ $badgeClass }} fs-6" id="seo-score-badge">
                                {{ $seoScoreValue }}/100
                            </span>
                        </div>
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar {{ $seoColor }}" id="seo-score-progress" role="progressbar"
                                style="width: {{ $seoScoreValue }}%;" aria-valuenow="{{ $seoScoreValue }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- List SEO --}}
                <div class="" id="result">
                    @include('backend.news.seo', ['seoData' => $seoData])

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
                            <option value="1" {{ $news->status == 1 ? 'selected' : '' }}>Công khai</option>
                            <option value="2" {{ $news->status == 2 ? 'selected' : '' }}>Tạm dừng</option>
                        </select>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title fs-6">Ngày đăng</h4>
                    </div>
                    <div class="form-group">
                        <input type='text' class="form-control"
                            value="{{ old('posted_at', $news->posted_at->format('d-m-Y')) }}" id="posted_at"
                            name="posted_at" placeholder="d-m-Y" />
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
                                    @checked($news->is_favorite == 1) value="1">
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
                                    <option value="{{ $id }}" @selected($id === $news->category_id)>{{ $name }}
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
                            src="{{ showImage($news->featured_image) }}" alt=""
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
                                <option @selected(in_array($tag->id, old('tags', $tagSelectedId))) value="{{ $tag->tag }}">{{ $tag->tag }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Từ khóa seo</h3>
                    </div>

                    <div class="form-group">
                        <select class="form-control select-keywords" name="seo_keywords[]" id="seo_keywords"
                            multiple="multiple">
                            @foreach ($news->seo_keywords ?? [] as $keyword)
                                <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
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
            let seoTimeout;

            autoGenerateSlug('#subject', '#slug')
            updateCharCount('#subject', 250)
            updateCharCount('#slug', 250)
            updateCharCount('#summary', 156)
            updateCharCount('#seo_title', 250)
            updateCharCount('#seo_description', 160)

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

            $('.select-keywords').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "Nhập hoặc chọn tag",
            });

            $('#seo_title').on('input', function() {
                let seoTitle = $(this).val();

                if (seoTitle.trim() === "") seoTitle = '.....'

                $('.seo-preview a').text(seoTitle)
            })

            $('#slug').on('input', function() {
                let slug = $(this).val();

                if (slug.trim() === "") slug = '{{ config('app.url') }}'

                $('.seo-preview .url').text(slug)
            })

            $('#seo_description').on('input', function() {
                let seoDescription = $(this).val();

                if (seoDescription.trim() === "") seoDescription = '.....'

                $('.seo-preview .desc').text(seoDescription)
            })

            $('#subject, #slug, #summary, #article, #seo_title, #seo_description').on(
                'input',
                function() {
                    clearTimeout(seoTimeout);
                    seoTimeout = setTimeout(runSeoAnalysis, 500);
                }
            );

            $('.select-keywords').on('change', function() {
                clearTimeout(seoTimeout);
                seoTimeout = setTimeout(runSeoAnalysis, 500);
            });

            CKEDITOR.instances['article'].on('change', function() {
                clearTimeout(seoTimeout);
                seoTimeout = setTimeout(runSeoAnalysis, 500);
            });

            function runSeoAnalysis() {
                let article = CKEDITOR.instances['article'].getData();
                let seoTitle = $('#seo_title').val()
                let seoDescription = $('#seo_description').val();
                let slug = $('#slug').val();
                let summary = $('#summary').val();
                let seoKeywords = $('#seo_keywords').val();

                $.ajax({
                    url: "{{ route('admin.seo.analysis.live') }}",
                    method: "POST",
                    data: {
                        article,
                        seoKeywords,
                        seoTitle,
                        seoDescription,
                        slug,
                        summary
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#seo-score-badge').removeClass().addClass(
                                `badge ${response.badgeClass} fs-6`).text(response.seoScoreVal +
                                '/100');
                            $('#seo-score-progress').removeClass().addClass(
                                `progress-bar ${response.seoColor}`).css('width', response
                                .seoScoreVal + '%')

                            $('#result').html(response.html);
                        }
                    },
                    error: function(xhr) {
                        console.error('Lỗi SEO:', xhr);
                    }
                });
            }
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
