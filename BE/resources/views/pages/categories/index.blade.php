@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('content')
    <h3 class="py-3 mb-4">Quản lý danh mục</h3>

    <div class="row gy-4">
        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add new</a>
        </div>
        <!-- Data Tables -->
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-truncate">Name</th>
                                <th class="text-truncate">Type</th>
                                <th class="text-truncate">Description</th>
                                <th class="text-truncate">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($listUser))
                                @foreach ($listUser as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                Category name
                                            </div>
                                        </td>
                                        <td class="text-truncate">Category type</td>
                                        <td class="text-truncate">
                                            Category descriptions
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                                                class="btn rounded-pill me-2 btn-success">
                                                Edit
                                            </a>
                                            <button type="button" class="btn rounded-pill me-2 btn-danger deleteBtn"
                                                data-router="{{ route('dashboard-analytics') }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Data Tables -->
    </div>
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="confirmationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các nút xóa
            var deleteButtons = document.querySelectorAll('.deleteBtn');
            // Lấy nút xác nhận trong modal
            var confirmButton = document.querySelector('#confirmBtn');
            // Tạo đối tượng modal
            var modal = new bootstrap.Modal(document.querySelector('#confirmationModal'));
            // Biến lưu trữ đường dẫn router
            var router;

            // Thêm sự kiện click cho mỗi nút xóa
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Lấy đường dẫn router từ thuộc tính data-router của nút được nhấn
                    router = this.dataset.router;
                    // Hiển thị modal
                    modal.show();
                });
            });

            // Thêm sự kiện click cho nút xác nhận
            confirmButton.addEventListener('click', function() {
                // Ẩn modal
                modal.hide();
                // Chuyển hướng đến đường dẫn router đã lưu
                window.location.href = router;
            });
        });
    </script>
@endsection
