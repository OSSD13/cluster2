@extends('layouts.layout_admin')

@section('content')

<!-- ฟอร์มกรอกข้อมูลจั้ฟฟ -->
<main class="pt-4">
    <div class="container">
        <h2 class="text-black text-2xl font-semibold">แก้ไขบัญชีผู้ใช้งาน</h2>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่านใหม่</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
</main>

@endsection
