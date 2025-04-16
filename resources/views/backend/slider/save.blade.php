@extends('backend.layout.index')
@section('title', 'Thêm trình chiếu ảnh')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Thêm Trình Chiếu Ảnh</h4>
            <button class="btn btn-primary btn-sm" id="add-slider">Thêm (+)</button>
        </div>
        <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data" id="slider-form">
            @csrf
            <div class="card-body" id="slider-container">
                <!-- Slider đầu tiên -->
                @foreach ($sliders as $index => $item)
                    <div class="slider-box {{ !$loop->last ? 'border-bottom my-3' : '' }}" data-index="{{ $item->id }}">
                        <button type="button" class="btn btn-danger btn-sm remove-slider ms-2">X</button>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img class="img-fluid img-thumbnail w-100" id="show_slider_{{ $item->id }}"
                                        style="cursor: pointer; height: 200px;"
                                        src="{{ showImage($item->image, 'banner-defaut.jpg') }}" alt=""
                                        onclick="$('#slider_input_{{ $item->id }}').click();">
                                    <input type="file" name="sliders[{{ $item->id }}][image]"
                                        id="slider_input_{{ $item->id }}" class="form-control d-none" accept="image/*"
                                        onchange="previewImage(event, 'show_slider_{{ $item->id }}')">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="mb-2 col-md-10">
                                        <input type="text" class="form-control"
                                            name="sliders[{{ $item->id }}][title]" id="title_{{ $item->id }}"
                                            placeholder="Tiêu đề" value="{{ $item->title }}">
                                    </div>
                                    <div class="mb-2 col-md-2">
                                        <input type="number" class="form-control"
                                            name="sliders[{{ $item->id }}][position]"
                                            id="position_{{ $item->id }}" value="{{ $index + 1 }}">
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <input type="text" class="form-control" name="sliders[{{ $item->id }}][url]"
                                        id="url_{{ $item->id }}" placeholder="Url" value="{{ $item->url }}">
                                </div>

                                <div class="mb-2">
                                    <textarea data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm thẻ <br> để xuống dòng." class="form-control"
                                        name="sliders[{{ $item->id }}][content]" id="content_{{ $item->id }}" rows="2"
                                        placeholder="Nội dung">{{ $item->content }}</textarea>
                                </div>

                                <div class="mb-2">
                                    <input type="text" class="form-control"
                                        name="sliders[{{ $item->id }}][button_text]"
                                        id="button_text_{{ $item->id }}" placeholder="Button Text"
                                        value="{{ $item->button_text }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary btn-sm"><i
                        class="fas fa-arrow-left me-2"></i>Quay lại</a>
            </div>
        </form>
    </div>


@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">

    <script>
        $(document).on('click', '.remove-slider', function() {
            $(this).closest('.slider-box').remove();
        });

        $(document).ready(function() {
            let index = "{{ $sliders->max('id') + 1 }}";

            // Xử lý khi nhấn nút Thêm
            $('#add-slider').on('click', function() {

                const newSlider = `
                    <div class="slider-box" data-index="${index}">
                        <button type="button" class="btn btn-danger btn-sm remove-slider ms-2">X</button>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img class="img-fluid img-thumbnail w-100" id="show_slider_${index}"
                                        style="cursor: pointer; height: 200px;"
                                        src="{{ showImage('', 'banner-defaut.jpg') }}" alt=""
                                        onclick="$('#slider_input_${index}').click();">
                                    <input type="file" name="sliders[${index}][image]"
                                        id="slider_input_${index}" class="form-control d-none" accept="image/*"
                                        onchange="previewImage(event, 'show_slider_${index}')">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="mb-2 col-md-10">
                                        <input type="text" class="form-control"
                                            name="sliders[${index}][title]" id="title_${index}"
                                            placeholder="Tiêu đề">
                                    </div>
                                    <div class="mb-2 col-md-2">
                                        <input type="number" class="form-control"
                                            name="sliders[${index}][position]"
                                            id="position_${index}" value="0">
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <input type="text" class="form-control"
                                        name="sliders[${index}][url]" id="url_${index}"
                                        placeholder="Url">
                                </div>

                                <div class="mb-2">
                                    <textarea class="form-control" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm thẻ <br> để xuống dòng." name="sliders[${index}][content]" id="content_${index}"
                                        rows="2" placeholder="Nội dung"></textarea>
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control"
                                        name="sliders[${index}][button_text]"
                                        id="button_text_${index}" placeholder="Button Text">
                                </div>
                            </div>
                        </div>
                    </div>`;

                $('#slider-container').append(newSlider);
                index++;
            });

            $('#slider-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);

                        if (response.status) {
                            window.location.reload();
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;

                            console.log(errors);

                        }
                    }
                });
            })
        });
    </script>
@endpush

@push('styles')
    <style>
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .form-group {
            padding: 7px !important;
        }
    </style>
@endpush
