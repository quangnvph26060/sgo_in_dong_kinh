@extends('backend.layout.index')

@section('title', 'Cấu hình chung')

@section('content')
    <form action="{{ route('admin.contact.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Cấu hình chung</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" class="form-label fw-bold">Tiêu đề</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ $data->title }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company" class="form-label fw-bold">Tên công ty</label>
                                    <input type="text" name="company"
                                        class="form-control @error('company') is-invalid @enderror"
                                        value="{{ $data->company }}">
                                    @error('company')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label fw-bold">Kinh doanh</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ $data->phone }}">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ $data->email }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hotline" class="form-label fw-bold">Zalo</label>
                                    <input type="text" name="hotline"
                                        class="form-control @error('hotline') is-invalid @enderror"
                                        value="{{ $data->hotline }}">
                                    @error('hotline')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="form-label fw-bold">Địa chỉ</label>
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ $data->address }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="website" class="form-label fw-bold">Website</label>
                                    <input type="text" name="website"
                                        class="form-control @error('website') is-invalid @enderror"
                                        value="{{ $data->website }}" placeholder="Website">
                                    @error('website')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="working_time" class="form-label fw-bold">
                                        Thời gian làm việc</label>
                                    <input type="text" name="working_time"
                                        class="form-control @error('working_time') is-invalid @enderror"
                                        value="{{ $data->working_time }}">
                                    @error('working_time')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="copyright" class="form-label fw-bold">Chân trang</label>
                                    <input type="text" name="copyright"
                                        class="form-control @error('copyright') is-invalid @enderror"
                                        value="{{ $data->copyright }}">
                                    @error('copyright')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="introduce" class="form-label fw-bold">Giới thiệu về công ty</label>
                                    <textarea name="introduce" class="form-control ckeditor @error('introduce') is-invalid @enderror">{{ $data->introduce }}</textarea>
                                    @error('introduce')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="map" class="form-label fw-bold">Map</label>
                                    <input type="text" name="map"
                                        class="form-control @error('map') is-invalid @enderror"
                                        value="{{ $data->map }}">
                                    @error('map')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <label for="commits" class="form-label fw-bold">Cam kết</label>
                        <div id="input-container">
                            @forelse ($data->commits ?? [] as $key => $text)
                                <div class="row">
                                    <div class="col-lg-5 mb-3">
                                        <input type="file" name="commits[{{ $key }}][image]"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <input type="text" name="commits[{{ $key }}][text]"
                                            class="form-control" value="{{ $data->commits[$key]['text'] ?? '' }}"
                                            placeholder="Cơ sở">
                                    </div>
                                    <div class="col-lg-1 mb-3">
                                        @if ($key > 0)
                                            <button type="button" class="btn btn-sm btn-danger remove-row">-</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-success add-row"><i
                                                    class="bi bi-plus"></i></button>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-lg-5 mb-3">
                                        <input type="file" name="commits[0][image]" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <input type="text" name="commits[0][text]" class="form-control"
                                            value="" placeholder="Nội dung">
                                    </div>
                                    <div class="col-lg-1 mb-3">
                                        <button type="button" class="btn btn-sm btn-success add-row"><i
                                                class="bi bi-plus"></i></button>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_title" class="form-label fw-bold">Tiêu đề seo</label>
                                    <input type="text" name="seo_title"
                                        class="form-control @error('seo_title') is-invalid @enderror"
                                        value="{{ $data->seo_title }}">
                                    @error('seo_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_description" class="form-label fw-bold">Mô tả seo</label>
                                    <textarea name="seo_description" class="form-control @error('seo_description') is-invalid @enderror">{{ $data->seo_description }}</textarea>
                                    @error('seo_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Logo</h4>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid img-thumbnail w-100" id="show_logo" style="cursor: pointer"
                            src="{{ showImage($data->logo) }}" alt=""
                            onclick="document.getElementById('logo').click();">
                        @error('logo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="file" name="logo" id="logo" class="form-control d-none"
                            accept="image/*" onchange="previewImage(event, 'show_logo')">
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Icon</h4>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid img-thumbnail w-100" id="show_icon" style="cursor: pointer"
                            src="{{ showImage($data->icon) }}" alt=""
                            onclick="document.getElementById('icon').click();">
                        @error('icon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="file" name="icon" id="icon" class="form-control d-none"
                            accept="image/*" onchange="previewImage(event, 'show_icon')">
                    </div>
                </div>

                <div class="row mb-3 float-right">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Lưu cấu hình</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('backend/library/ckeditor/ckeditor.js') }}"></script>

    <script>
        let commitIndex = {{ count($data->commits ?? []) + 1 }}; // số lượng dòng ban đầu

        // Thêm dòng mới
        $(document).on('click', '.add-row', function() {
            var newRow = `
                <div class="row">
                    <div class="col-lg-5 mb-3">
                        <input type="file" name="commits[${commitIndex}][image]" class="form-control">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <input type="text" name="commits[${commitIndex}][text]" class="form-control" value="" placeholder="Nội dung">
                    </div>
                    <div class="col-lg-1 mb-3">
                        <button type="button" class="btn btn-sm btn-danger remove-row">-</button>
                    </div>
                </div>
            `;
            $('#input-container').append(newRow);
            reindexCommitRows(); // cập nhật lại name sau khi thêm
            commitIndex++; // Increment commitIndex after adding a new row
        });

        // Xóa dòng
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.row').remove();
            reindexCommitRows(); // cập nhật lại name sau khi xóa
        });

        // Hàm cập nhật lại chỉ số name
        function reindexCommitRows() {
            $('#input-container .row').each(function(index) {
                $(this).find('input[type="file"]').attr('name', `commits[${index}][image]`);
                $(this).find('input[type="text"]').attr('name', `commits[${index}][text]`);
            });

            commitIndex = $('#input-container .row').length;
        }
    </script>
@endpush

@push('styles')
    <!-- Tagify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.7.0/tagify.css">

    <style>
        .tagify__tag {
            margin-top: 3px !important;
        }


        .tags-look .tagify {
            display: block;
            white-space: normal;
            overflow-y: hidden;
            /* Ẩn thanh cuộn dọc */
            max-height: 150px;
            /* Giới hạn chiều cao nếu cần */
        }

        .tagify {
            max-height: 150px;
            /* Giới hạn chiều cao */
            overflow-y: auto;
            /* Thêm thanh cuộn dọc nếu quá dài */
        }

        .tagify__input {
            width: 100%;
            /* Đảm bảo input chiếm hết chiều rộng */
            overflow: hidden;
            /* Ẩn nội dung tràn */
        }
    </style>
@endpush
