@extends('layouts.adminmenu')

@section('admin_content')
    <!-- ฟอร์มกรอกข้อมูลจั้ฟฟ -->
    <main >
        <div class="container">
            <h2 class="text-black text-2xl font-semibold">แก้ไขบัญชีผู้ใช้งาน</h2>
            <form action="{{ url('/useraccount') }}" method="post">
                @csrf
                <div class="mb-3 mt-6">
                    <label for="email" class="form-label required">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label required">รหัสผ่าน</label>
                    <input type="password" class="form-control" id="password" name="password" required>
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
