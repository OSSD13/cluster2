@extends('layouts.layout_admin')

@section('content')

<!-- ฟอร์มกรอกข้อมูลจั้ฟฟ -->
<main class="pt-4">
    <div class="container">
        @csrf
        @method('PUT')
        <h2 class="text-black text-2xl font-semibold">แก้ไขบัญชีผู้ใช้งาน</h2>
<<<<<<< HEAD
        <form >
            <div class="mb-3 mt-6">
                <label for="email" class="form-label required">อีเมล</label>
                <input type="email" class="form-control" id="email" required>
            </div>
=======
        <form action="{{ route('user.update', $user->usr_id) }}" method="POST">
            @csrf
            @method('PUT')

>>>>>>> 390197afd6b4ffda29b827902caf08e18d3d0c15
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label>Password (เว้นไว้ถ้าไม่ต้องการเปลี่ยน)</label>
                <input type="password" name="password" class="form-control">
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
