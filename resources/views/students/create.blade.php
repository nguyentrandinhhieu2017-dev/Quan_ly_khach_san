@extends('template.app')

@section('content')
<div class="container">
    <h2>Thêm Sinh viên</h2>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Mã Sinh viên</label>
            <input type="text" name="student_code" class="form-control">
        </div>
        <div class="mb-3">
            <label>Họ Tên</label>
            <input type="text" name="full_name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Lưu lại</button>
    </form>
</div>
@endsection