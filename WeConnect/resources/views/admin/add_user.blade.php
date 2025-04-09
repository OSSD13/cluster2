@extends('layouts.layout_admin')

@section('content')
<main class="pt-4">
    <div class="container mx-auto px-4">
        <h2 class="text-black text-2xl font-semibold mb-6">เพิ่มบัญชีผู้ใช้</h2>
        <form action="{{ url('/adduser') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700 mb-1">ชื่อผู้ใช้ <span class="text-red-500">*</span></label>
                <input type="text" class="w-full px-4 py-2 border rounded-md" id="username" name="name" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-1">อีเมล <span class="text-red-500">*</span></label>
                <input type="email" class="w-full px-4 py-2 border rounded-md" id="email" name="email" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-1">รหัสผ่าน <span class="text-red-500">*</span></label>
                <input type="password" class="w-full px-4 py-2 border rounded-md" id="password" name="password" required>
            </div>
            <div class="mb-4">
                <label for="position" class="block text-gray-700 mb-1">ตำแหน่ง <span class="text-red-500">*</span></label>
                <select id="position" class="w-full px-4 py-2 border rounded-md" name="role" required>
                    <option value="position" disabled selected hidden>กรุณาเลือกตำแหน่ง</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                </select>
            </div>
            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-full text-lg hover:bg-green-600 transition duration-200">
                    ยืนยันข้อมูล
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
