@extends('backend.layout.index')

@section('title', 'Danh sách nhãn')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách nhãn</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Danh sách nhãn</h4>
            <div class="card-tools">
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">Tạo nhãn</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tên nhãn</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th style="text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.labels.index') }}',
                columns: [{
                        data: 'id', // Đây là số thứ tự
                        name: 'id',
                        width: '5%',
                    },
                    {
                        data: 'image',
                        name: 'image',
                        searchable: false,
                        orderable: false,
                        width: '8%',
                    },
                    {
                        data: 'title',
                        name: 'title',
                        render: function(data, type, row) {
                            return `<a href="{{ route('admin.labels.edit', '__id__') }}">${data}</a>`
                                .replace('__id__', row.id);
                        },
                        width: '25%',
                    },
                    {
                        data: 'position',
                        name: 'position',
                        searchable: false,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        width: '10%',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                    }
                ],
                order: [
                    [0, 'desc']
                ],
            });

            $(document).on('change', '.update-status', function() {

                function showToast(icon, title) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: icon,
                        title: title
                    });
                }

                const id = $(this).data('id');

                let checkbox = $(this);
                let isChecked = checkbox.is(':checked');

                let newStatus = isChecked ? 1 : 0;

                $.ajax({
                    url: '{{ route('admin.labels.update.status') }}',
                    type: 'POST',
                    data: {
                        id: id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // $('#myTable').DataTable().ajax.reload();

                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: response.message,
                            });

                        } else {
                            checkbox.prop('checked', !isChecked);
                            Swal.fire('Lỗi!',
                                'Có lỗi xảy ra. Vui lòng thử lại!',
                                'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Lỗi!', 'Có lỗi xảy ra. Vui lòng thử lại.',
                            'error');
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                let url = $(this).data('url');

                Swal.fire({
                    title: 'Xác nhận',
                    text: "Bạn có chắc chắn muốn xóa nhãn?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa!',
                    cancelButtonText: 'Không'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.success) {
                                    $('#myTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thành công',
                                        text: response.message,
                                    })
                                } else {
                                    Swal.fire('Lỗi!',
                                        'Có lỗi xảy ra. Vui lòng thử lại sau!',
                                        'error');
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            })
        })
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
@endpush
