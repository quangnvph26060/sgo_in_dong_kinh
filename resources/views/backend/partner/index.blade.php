@extends('backend.layout.index')

@section('title', 'Danh sách đối tác')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách đối tác</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Danh sách đối tác</h4>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Tạo danh
                    mục</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th style="text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTables sẽ tự động thêm dữ liệu vào đây -->
                    </tbody>
                </table>


            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.partners.save') }}" id="partnerForm" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="createModalLabel">Tạo đối tác</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <img class="img-fluid img-thumbnail w-100" id="show_image" style="cursor: pointer"
                                    src="{{ showImage('') }}" alt=""
                                    onclick="document.getElementById('image').click();">
                                <input type="file" name="image" id="image" class="form-control d-none"
                                    accept="image/*" onchange="previewImage(event, 'show_image')">
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="mb-3 col-lg-9">
                                        <label for="name" class="form-label">Tên đối tác</label>
                                        <input type="text" name="name" class="form-control" placeholder="Tên đối tác"
                                            required>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="location" class="form-label">Vị trí</label>
                                        <input type="text" name="location" class="form-control" placeholder="Vị trí"
                                            required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <div class="radio-container">
                                            <label class="toggle">
                                                <input type="checkbox" class="status-change" name="status" data-id="">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('global/js/toastr.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.partners.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: '5%'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        width: '8%',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'location',
                        name: 'location',
                        orderable: false,
                        searchable: false,
                        width: '8%'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        width: '10%',
                        className: 'text-center',
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: '15%',
                        className: 'text-center',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        width: '10%',
                        className: 'text-center'
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).attr('data-id', data.id);
                },
            });


            // Xử lý form submit
            $('#partnerForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = $(this).attr('action');
                var method = $(this).attr('method');

                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#createModal').modal('hide');
                            datgin.success('Đã tạo đối tác thành công.', 'success')

                            table.ajax.reload(null, false);
                            $('#partnerForm')[0].reset();
                            $('#show_image').attr('src', '{{ showImage('') }}');
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        for (var key in errors) {
                            errorMessage += errors[key][0] + '\n';
                        }
                        datgin.error(errorMessage, 'error')
                    }
                });
            });

            // Xử lý nút edit
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');

                let url = '{{ route('admin.partners.edit', ':id') }}'.replace(':id', id);

                $.get(url, function(response) {
                    if (response.success) {
                        var partner = response.data;
                        $('#createModalLabel').text('Chỉnh sửa đối tác');
                        $('#partnerForm').attr('action', "{{ route('admin.partners.save', ':id') }}"
                            .replace(':id', id));
                        $('input[name="name"]').val(partner.name);
                        $('input[name="location"]').val(partner.location);
                        $('#show_image').attr('src', partner.image);
                        $('input[name="status"]').data('id', partner.id);
                        $('input[name="status"]').prop('checked', partner.status == 1 ? true : false);
                        $('#createModal').modal('show');
                    }
                });
            });

            // Xử lý nút delete
            $(document).on('click', '.delete-btn', function() {
                var url = $(this).data('url');

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Bạn không thể hoàn tác sau khi xóa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    datgin.success(response.message, 'success')
                                    table.ajax.reload(null, false);
                                }
                            },
                            error: function() {
                                datgin.error('Có lỗi xảy ra khi xóa.', 'error')
                            }
                        });
                    }
                });
            });

            // Xử lý thay đổi trạng thái
            $(document).on('change', '.update-status', function() {
                var id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;
                var url = '{{ route('admin.partners.update-status') }}';

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            datgin.success(response.message, 'success')
                        }
                    },
                    error: function() {
                        datgin.error('Có lỗi xảy ra khi cập nhật trạng thái.', 'error')
                        $(this).prop('checked', !status);
                    }
                });
            });

            // Reset form khi đóng modal
            $('#createModal').on('hidden.bs.modal', function() {
                $('#createModalLabel').text('Tạo đối tác');
                $('#partnerForm').attr('action', '{{ route('admin.partners.save') }}');
                $('#partnerForm')[0].reset();
                $('#show_image').attr('src', '{{ showImage('') }}');
                $('.status-change').data('id', '');
            });
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('global/css/toastr.css') }}">

    <style>
        .ui-sortable-helper {
            display: table;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .ui-sortable-placeholder {
            visibility: visible !important;
            background: #f8f9fa;
        }

        .handle {
            cursor: move;
            text-align: center;
        }

        .btn-group .btn {
            margin: 0 2px;
        }
    </style>
@endpush
