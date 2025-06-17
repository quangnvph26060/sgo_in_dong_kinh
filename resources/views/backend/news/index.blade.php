@extends('backend.layout.index')

@section('title', 'Danh sách bài viết')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Danh sách bài viết</h4>
            <div class="card-tools">
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">Tạo bài viết</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input" id="check-all"></th>
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>Tiêu đề rút gọn</th>
                            <th>Danh mục</th>
                            <th>Ngày đăng</th>
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
            const table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.news.index') }}',
                columns: [{
                        data: 'id',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="row-checkbox form-check-input"  value="${row.id}">`;
                        }
                    }, {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'subject',
                        name: 'subject',
                        render: function(data, type, row) {
                            return `<a href="{{ route('admin.news.edit', '__id__') }}">${data}</a>`
                                .replace('__id__', row.id);
                        },
                        width: '25%',
                    },
                    {
                        data: 'short_name',
                        name: 'short_name'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'posted_at',
                        name: 'posted_at'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            if (!data) return '';
                            const date = new Date(data);
                            const day = String(date.getDate()).padStart(2, '0');
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const year = date.getFullYear();
                            return `${day}/${month}/${year}`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],
                order: [
                    [7, 'desc']
                ],
                language: {
                    // url: "/backend/assets/js/plugin/datatables/vi.json",
                },
                initComplete: function() {

                    const deleteBtn = $('<button>')
                        .attr('id', 'delete-selected')
                        .addClass(
                            'btn btn-danger btn-sm ms-2 d-none') // Ẩn mặc định, hiện khi có checkbox
                        .text('Xóa đã chọn');

                    // Thêm sau phần .dt-length (nằm trong .table-responsive)
                    $('.table-responsive .dt-length').after(deleteBtn);
                },
                language: {
                    lengthMenu: "Hiển thị _MENU_ bản ghi mỗi trang",
                    zeroRecords: "Không tìm thấy kết quả phù hợp",
                    info: "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ bản ghi",
                    infoEmpty: "Không có bản ghi nào",
                    infoFiltered: "(lọc từ tổng số _MAX_ bản ghi)",
                    search: "Tìm kiếm:",
                    paginate: {
                        first: "Đầu",
                        last: "Cuối",
                        next: "Sau",
                        previous: "Trước",
                    },
                }
            });

            table
                .on('order.dt search.dt', function() {
                    let i = 1;

                    table
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });
                })
                .draw();

            $(document).on('click', '#delete-selected', function() {
                const selectedIds = $('.row-checkbox:checked').map(function() {
                    return $(this).val();
                }).get(); // Lấy mảng ID

                if (selectedIds.length === 0) {
                    alert('Vui lòng chọn ít nhất một bản ghi để xóa.');
                    return;
                }

                Swal.fire({
                    title: "Bạn có chắc không?",
                    text: "Bạn sẽ không thể hoàn tác điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Đồng ý",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.bulk-operations.delete') }}',
                            type: 'POST',
                            data: {
                                ids: selectedIds,
                                model: "News",
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $('#check-all').prop('checked', false);
                                $('#delete-selected').addClass('d-none');
                                table.ajax.reload();
                                datgin.success(response.message)
                            },
                            error: function(xhr) {
                                datgin.error(xhr.responseJSON.message ||
                                    'Đã có lỗi xảy ra, vui lòng thử lại sau!')
                            }
                        });
                    }
                });

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

                Swal.fire({
                    title: 'Xác nhận',
                    text: `Bạn có chắc chắn muốn ${isChecked ? 'hiển thị' : 'ẩn'} bài viết này?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, cập nhật!',
                    cancelButtonText: 'Không'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.news.change-status') }}',
                            type: 'POST',
                            data: {
                                id: id,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.status) {
                                    $('#myTable').DataTable().ajax.reload();

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
                    } else {
                        checkbox.prop('checked', !isChecked);
                    }
                });
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
