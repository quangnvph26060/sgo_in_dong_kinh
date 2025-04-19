@extends('backend.layout.index')

@section('title', 'Danh sách bài viết')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Danh sách hỗ trợ</h4>
            <div class="card-tools">
                <a href="{{ route('admin.supports.create') }}" class="btn btn-primary btn-sm">Thêm mới (+)</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Số điện thoại</th>
                            <th>Eamil</th>
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
            let path = "{{ config('app.url') }}/storage/"
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.supports.index') }}',
                columns: [{
                        data: 'DT_RowIndex', // Đây là số thứ tự
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, row) {
                            return `<img src="${path+data}" alt="Image" style="width: 50px; height: 50px; border-radius: 50%;">`;
                        }
                    },
                    {
                        data: 'title',
                        name: 'title',
                        render: function(data, type, row) {
                            return `<a href="{{ route('admin.supports.edit', '__id__') }}" >${data}</a>`
                                .replace('__id__', row.id);
                        }
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'email',
                        name: 'email' // Updated to match the correct name
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],
                columnDefs: [{
                    targets: 5,
                    orderable: false
                }],
                order: [
                    [0, 'desc']
                ],
            });


            $(document).on('click', '.delete-btn', function() {
                let url = $(this).data('url');

                Swal.fire({
                    title: 'Xác nhận',
                    text: "Bạn có chắc chắn muốn xóa bài viết?",
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
                                if (response.status) {
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
