<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Hiển thị danh sách sinh viên
     */
    public function index()
    {
        // Lấy toàn bộ sinh viên, sắp xếp mới nhất lên đầu
        $students = Student::orderBy('id', 'desc')->get();
        return view('students.index', compact('students'));
    }

    /**
     * Hiển thị form thêm sinh viên mới
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Xử lý lưu sinh viên mới vào database
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'student_code' => 'required|unique:students,student_code',
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:students,email',
            'phone'        => 'nullable|string|max:20',
        ], [
            'student_code.unique' => 'Mã sinh viên này đã tồn tại!',
            'email.unique'        => 'Email này đã được sử dụng!'
        ]);

        // Lưu vào DB
        Student::create($request->all());

        // Quay về trang danh sách kèm thông báo thành công
        return redirect()->route('students.index')->with('success', 'Đã thêm sinh viên thành công!');
    }

    /**
     * Hiển thị chi tiết 1 sinh viên (có thể bỏ qua nếu không dùng)
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Hiển thị form chỉnh sửa thông tin sinh viên
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Xử lý cập nhật thông tin sinh viên
     */
    public function update(Request $request, Student $student)
    {
        // Kiểm tra dữ liệu (bỏ qua check unique cho chính sinh viên đang sửa)
        $request->validate([
            'student_code' => 'required|unique:students,student_code,' . $student->id,
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:students,email,' . $student->id,
            'phone'        => 'nullable|string|max:20',
        ]);

        // Cập nhật DB
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Đã cập nhật thông tin thành công!');
    }

    /**
     * Xử lý xóa sinh viên
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Đã xóa sinh viên!');
    }
}