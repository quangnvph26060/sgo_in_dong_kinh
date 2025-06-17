@extends('backend.layout.index')
@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Danh sách sản phẩm</h4>
            <div class="card-tools">
                <a href="{{ route('admin.product.add') }}" class="btn btn-primary btn-sm">Thêm mới sản phẩm (+)</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input" id="check-all"></th>
                            <th>#</th>
                            <th>SKU</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th>Tên ngắn</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Giá khuyến mãi</th>
                            <th>Trạng thái</th>
                            <th style="text-align: center">Hành động</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#myTable').DataTable({
                // dom: 'Bfrtip',
                // buttons: [
                //     'excel', 'pdf'
                // ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.product.index') }}',
                columns: [{
                        data: 'id',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="row-checkbox form-check-input"  value="${row.id}">`;
                        }
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'sku',
                        name: 'sku',
                        width: '5%'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        width: '10%'

                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return '<a href="' + '{{ route('admin.product.detail', '__id__') }}'
                                .replace('__id__', row.id) + '">' + data + '</a>';
                        },
                    },
                    {
                        data: 'short_name',
                        name: 'short_name',
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        render: function(data, type, row) {
                            return formatPrice(data);
                        }
                    },
                    {
                        data: 'sale_price',
                        name: 'sale_price',
                        render: function(data, type, row) {
                            return formatPrice(data);
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ],
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
                                model: "Product",
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

            $(document).on('click', '.delete-btn', function() {
                let url = $(this).data('url');

                Swal.fire({
                    title: 'Xác nhận',
                    text: "Bạn có chắc chắn muốn xóa sản phẩm này?",
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
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal
                                                .stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: response.message
                                    });
                                } else {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal
                                                .stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "error",
                                        title: response.message
                                    });
                                }
                            },
                            error: function(xhr) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal
                                            .stopTimer;
                                        toast.onmouseleave = Swal
                                            .resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "error",
                                    title: response.message
                                });
                            }
                        });
                    }
                });
            })

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
                    url: '{{ route('admin.product.change.status') }}',
                    type: 'POST',
                    data: {
                        id: id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            // $('#myTable').DataTable().ajax.reload();

                            toastr.success(response.message);

                        } else {
                            checkbox.prop('checked', !isChecked);

                            toastr.success('Có lỗi xảy ra. Vui lòng thử lại!');
                        }
                    },
                    error: function() {
                        toastr.success('Có lỗi xảy ra. Vui lòng thử lại!');
                    }
                });
            });

        })
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        table tr td:last-child {
            text-align: center;
        }
    </style>
@endpush
