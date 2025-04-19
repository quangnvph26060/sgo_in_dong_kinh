@extends('backend.layout.index')

@section('title', $title)

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Library</li>
        </ol>
    </nav>

    @php
        $route = !empty($support) ? route('admin.supports.update', $support->id) : route('admin.supports.store');
    @endphp

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">

        @csrf

        @if (!empty($support))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title" required
                                value="{{ old('title', $support->title ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required
                                value="{{ old('phone_number', $support->phone_number ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ old('email', $support->email ?? '') }}">
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary">Lưu</button>

                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ảnh</h4>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid img-thumbnail w-100" id="show_image" style="cursor: pointer"
                            src="{{ showImage($support->image ?? '') }}" alt=""
                            onclick="document.getElementById('image').click();">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="file" name="image" id="image" class="form-control d-none" accept="image/*"
                            onchange="previewImage(event, 'show_image')">
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
