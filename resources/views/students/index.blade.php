@extends('template.master')
@section('title', 'Quản lý Sinh viên')
@section('content')
    <div class="container-fluid">
        
        <!-- Hiển thị thông báo thành công (từ Controller) -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Nút Thêm Sinh viên -->
        <div class="row mb-4">
            <div class="col-12">
                <!-- Chuyển button thành thẻ a để chuyển hướng sang trang Create -->
                <a href="{{ route('students.create') }}" class="add-room-btn text-decoration-none d-inline-block">
                    <i class="fas fa-plus"></i> Thêm Sinh viên Mới
                </a>
            </div>
        </div>

        <!-- Khung chứa bảng -->
        <div class="professional-table-container">
            <!-- Tiêu đề bảng -->
            <div class="table-header">
                <h4><i class="fas fa-user-graduate me-2"></i>Danh sách Sinh viên</h4>
                <p>Quản lý thông tin sinh viên được tích hợp vào hệ thống</p>
            </div>

            <!-- Bảng dữ liệu Sinh viên -->
            <div class="table-responsive">
                <table class="professional-table table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col"><i class="fas fa-id-card me-1"></i> Mã SV</th>
                            <th scope="col"><i class="fas fa-user me-1"></i> Họ Tên</th>
                            <th scope="col"><i class="fas fa-envelope me-1"></i> Email</th>
                            <th scope="col"><i class="fas fa-phone me-1"></i> Số điện thoại</th>
                            <th scope="col"><i class="fas fa-cog me-1"></i> Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td><strong>{{ $student->student_code }}</strong></td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone ?? 'Chưa cập nhật' }}</td>
                                <td>
                                    <!-- Nút Sửa -->
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <!-- Nút Xóa (Dùng form để bảo mật) -->
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="fas fa-folder-open fa-2x text-muted mb-2 d-block"></i>
                                    Chưa có dữ liệu sinh viên nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Chân bảng -->
            <div class="table-footer">
                <h3><i class="fas fa-users me-2"></i>Tổng số: {{ $students->count() }} sinh viên</h3>
            </div>
        </div>
    </div>
@endsection