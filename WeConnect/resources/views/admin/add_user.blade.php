@extends('layouts.layout_admin')

@section('content')
    <!-- ฟอร์มกรอกข้อมูลจั้ฟฟ -->
    <main>
        <div class="container">
            <h2 class="text-black text-2xl font-semibold">เพิ่มบัญชีผู้ใช้</h2>
            <form action="{{ url('/adduser') }}" method="post">
                @csrf
                <div class="mb-3 mt-6">
                    <label for="username" class="form-label required">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" id="username" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label required">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label required">รหัสผ่าน</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label required">ตำแหน่ง</label>
                    <select id="position" class="form-control" name="role" required>
                        <option value="position"  disabled selected hidden>กรุณาเลือกตำแหน่ง</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
                <div class="flex justify-center mt-6">
                    <button class="bg-green-500 text-white px-3 py-1 rounded-full text-lg hover:bg-green-600">
                        ยืนยันข้อมูล
                    </button>
                </div>
            </form>
        </div>
    </main>

@endsection
