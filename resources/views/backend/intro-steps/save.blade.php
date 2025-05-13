@extends('backend.layout.index')
@section('title', 'Cấu hình hướng dẫn')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.intro-steps.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề lớn (title):</label>
                    <input type="text" class="form-control" name="title"
                        value="{{ old('title', $introSteps->title ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="video_url">Video hướng dẫn (video_url):</label>
                    <input type="file" class="form-control" name="video_url" accept="video/*">
                </div>
                <hr>
                <label><b>Các bước hướng dẫn (luôn hiển thị 3 bước):</b></label>
                <div id="steps-fixed">
                    @php
                        $contents = old('content', $introSteps->content ?? []);
                        if (is_string($contents)) {
                            $contents = json_decode($contents, true);
                        }
                    @endphp
                    @for ($i = 0; $i < 3; $i++)
                        <div class="step-block mb-3 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="d-block">Ảnh bước {{ $i + 1 }}</label>
                                        <img class="img-fluid img-thumbnail" id="show_image_{{ $i }}"
                                            style="cursor: pointer;" src="{{ showImage($contents[$i]['image'] ?? '') }}"
                                            alt=""
                                            onclick="document.getElementById('image_{{ $i }}').click();">
                                        <input type="file" name="contents[{{ $i }}][image]"
                                            id="image_{{ $i }}" class="form-control d-none" accept="image/*"
                                            onchange="previewImage(event, 'show_image_{{ $i }}')">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="d-block">Tiêu đề bước {{ $i + 1 }}</label>
                                        <input type="text" class="form-control"
                                            name="contents[{{ $i }}][title]"
                                            value="{{ $contents[$i]['title'] ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung bước {{ $i + 1 }}</label>
                                        <textarea class="form-control" name="contents[{{ $i }}][desc]" rows="4">{{ $contents[$i]['desc'] ?? '' }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endfor
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm">Lưu cấu hình</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
