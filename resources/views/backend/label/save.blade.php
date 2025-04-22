@extends('backend.layout.index')

@section('title', !empty($label) ? 'Cập nhật nhã' : 'Thêm mới nhãn')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.news.index') }}">Nhãn</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ !empty($label) ? "Cập nhật nhãn - {$label->title}" : 'Thêm mới nhãn' }}
            </li>
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
        $action = isset($label) ? route('admin.labels.update', $label->id) : route('admin.labels.store');
    @endphp

    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        @csrf

        @isset($label)
            @method('PUT')
        @endisset

        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 mb-3 position-relative">
                                <label for="title" class="form-label fw-bold">Tên nhãn</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Tên nhãn" value="{{ old('title', $label->title ?? '') }}">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="position" class="form-label fw-bold">Vị trí</label>
                                <input type="number" name="position" class="form-control" id="position"
                                    placeholder="Vị trí" value="{{ old('position', $label->position ?? '') }}">
                            </div>

                            <div class="mb-3 col-md-12 position-relative">
                                <label for="description" class="form-label fw-bold">Mô tả</label>
                                <textarea rows="4" name="description" id="description" class="form-control" placeholder="Mô tả">{{ old('description', $label->description ?? '') }}</textarea>
                            </div>

                            <div class="mb-3 col-md-12 position-relative">
                                <label for="products" class="form-label fw-bold">Sản phẩm</label>
                                <input type="search" class="form-control" placeholder="Tìm kiếm sản phẩm..."
                                    id="search-product">

                                <div id="result-product"
                                    class="position-absolute w-100 bg-white border rounded shadow mt-1 d-none"
                                    style="z-index: 1000; max-height: 200px; overflow-y: auto;max-width: 836px;">
                                    <!-- sản phẩm sẽ render ở đây -->
                                    <div id="product-list">

                                    </div>
                                    <div class="d-flex justify-content-between border-top p-2">
                                        <button id="prev-page" class="btn btn-sm btn-outline-secondary">Prev</button>
                                        <button id="next-page" class="btn btn-sm btn-outline-secondary">Next</button>
                                    </div>
                                </div>

                                <hr>

                                <div class="selected-product">
                                    @foreach ($products as $product)
                                        <div
                                            class="d-flex align-items-center justify-content-between p-2 border rounded mb-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ showImage($product->image) }}" alt="{{ $product->name }}"
                                                    width="50" height="50" class="rounded">
                                                <span class="fw-bold">{{ $product->name }}</span>
                                            </div>
                                            <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                                            <button class="btn-close remove-selected" aria-label="Close"></button>
                                        </div>
                                    @endforeach
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
                        <a href="{{ route('admin.labels.index') }}" class="btn btn-sm btn-outline-secondary fs-6"><i
                                class="fas fa-arrow-left ms-2"></i> Quay lại</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="fs-6 card-title">Trạng thái</h3>
                    </div>

                    <div class="form-group">
                        <select class="form-select" name="status" id="status">
                            <option value="1" {{ old('status', $label->status ?? 1) == 1 ? 'selected' : '' }}>Công
                                khai</option>
                            <option value="2" {{ old('status', $label->status ?? '') == 2 ? 'selected' : '' }}>Tạm
                                dừng</option>
                        </select>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title fs-6">Ảnh đại diện</h3>
                    </div>

                    <div class="form-group">
                        <img class="img-fluid img-thumbnail w-100" id="show_image" style="cursor: pointer"
                            src="{{ showImage($label->image ?? '') }}" alt=""
                            onclick="document.getElementById('image').click();">

                        <input type="file" class="form-control d-none" id="image" name="image"
                            accept="image/*" onchange="previewImage(event, 'show_image')">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {

            let page = 1;
            let lastKeyword = '';
            let path = '{{ config('app.url') }}/storage/';
            let selectedProductIds = @json($products ? $products->pluck('id')->toArray() : []);

            function fetchProducts(keyword, pageNum = 1) {
                $.ajax({
                    url: '{{ route('admin.product.products.search') }}',
                    data: {
                        q: keyword,
                        page: pageNum
                    },
                    success: function(data) {
                        $('#product-list').html('');

                        if (data.length === 0) {
                            $('#product-list').html(
                                '<div class="p-2 text-muted">Không có kết quả</div>');
                            $('#selected-product').removeClass('d-none');

                            // Disable cả 2 nút nếu không có gì
                            $('#next-page').prop('disabled', true);
                            $('#prev-page').prop('disabled', page === 1);
                            return;
                        }

                        data.forEach(product => {
                            const isSelected = selectedProductIds.includes(product.id);

                            $('#product-list').append(`
                                <div class="d-flex align-items-center border-bottom p-3 gap-3 product-item ${isSelected ? 'disabled pointer-events-none opacity-50' : ''}"
                                    style="cursor: pointer;"
                                    data-product-id="${product.id}">
                                    <img src="${path + product.image}" class="rounded img-fluid" width="80px" height="80px" />
                                    <span class="fs-6 fw-bold">${product.name}</span>
                                </div>
                            `);
                        });

                        // Hiện popup
                        $('#result-product').removeClass('d-none');

                        // Logic để disable hoặc enable nút
                        $('#prev-page').prop('disabled', page === 1); // trang đầu tiên thì disable Prev
                        $('#next-page').prop('disabled', data.length <
                            10); // ít hơn 5 sản phẩm thì không cho Next
                    }

                });
            }

            // Ẩn popup khi click ra ngoài
            $(document).on('mousedown', function(e) {
                const $popup = $('#result-product');

                // Nếu click không nằm trong popup hoặc input tìm kiếm
                if (!$popup.is(e.target) && $popup.has(e.target).length === 0 && !$(e.target).is(
                        '#search-product')) {
                    $popup.addClass('d-none');
                }
            });

            $('#search-product').on('focus', function() {
                if ($('#product-list .product-item').length) $('#result-product').removeClass('d-none');
            })

            $('#search-product').on('input', function() {
                const keyword = $(this).val().trim();
                if (keyword.length >= 3) {
                    page = 1;
                    lastKeyword = keyword;
                    fetchProducts(keyword, page);
                } else {
                    $('#selected-product').addClass('d-none');
                }
            });

            $('#next-page').on('click', function() {
                page++;
                fetchProducts(lastKeyword, page);
            });

            $('#prev-page').on('click', function() {
                if (page > 1) {
                    page--;
                    fetchProducts(lastKeyword, page);
                }
            });

            // Click chọn sản phẩm
            $(document).on('click', '.product-item', function() {
                const productName = $(this).find('span').text(); // Lấy tên sản phẩm từ <span>
                const productImage = $(this).find('img').attr('src'); // Lấy ảnh nếu muốn
                const id = $(this).data('product-id');

                if (selectedProductIds.includes(id)) return

                // Hiển thị sản phẩm đã chọn
                $('.selected-product').append(`
                    <div class="d-flex align-items-center justify-content-between p-2 border rounded mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <img src="${productImage}" alt="${productName}" width="50" height="50" class="rounded">
                            <span class="fw-bold">${productName}</span>
                        </div>
                        <input type="hidden" name="product_id[]" value="${id}">
                        <button class="btn-close remove-selected" aria-label="Close"></button>
                    </div>
                `);

                selectedProductIds.push(id);

                $('#result-product').addClass('d-none'); // Ẩn danh sách gợi ý
            });

            $(document).on('click', '.remove-selected', function() {
                const parent = $(this).closest('.selected-product > div');
                const id = parent.find('input[type="hidden"]').val();

                // Xoá khỏi danh sách đã chọn
                selectedProductIds = selectedProductIds.filter(pid => pid != id);

                // Xoá HTML sản phẩm hiển thị
                parent.remove();
            });



            updateCharCount('#title', 255);
            updateCharCount('#description', 160);

        });
    </script>
@endpush

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .product-item {
            transition: background 0.2s ease-out;
        }

        .product-item:hover {
            background: rgba(128, 128, 128, .3);
            transition: background 0.2s ease-in-out;
        }

        .selected-product {
            margin-top: 10px;
        }
    </style>
@endpush
