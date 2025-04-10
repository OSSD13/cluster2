@extends('layouts.layout_admin')

@section('content')
<style>

    .toggle-btn {
        position: absolute;

        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>
<main class="pt-4">
    <div class="container mx-auto px-4">
        <h2 class="text-black text-2xl font-semibold mb-6">แก้ไขบัญชีผู้ใช้</h2>
        <form action="{{ route('user.update', $user->usr_id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="username" class="block text-xl mb-1">Username<span class="text-red-500">*</span></label>
                <input type="text" class="text-gray-500 w-full px-4 py-2 border rounded-md" value="{{ $user->name }}" id="username" name="name" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-xl mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" class="text-gray-500 w-full px-4 py-2 border rounded-md"  value="{{ $user->email }}" name="email" required>
            </div>
            <label for="password" class="block text-xl mb-1">Password</label>
            <div class="mb-4 relative ">
                <!-- Input Field -->
                <input type="password" class="w-full px-4 py-2 border rounded-md pr-10" id="password" name="password" >

                <!-- Eye Icon -->
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-xl" id="toggle-password">👁️</span>
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-full text-lg hover:bg-green-600 transition duration-200">
                    ยืนยันข้อมูล
                </button>
            </div>
        </form>
    </div>
    <script>
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute of the password field
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Toggle the icon
            togglePassword.textContent = type === 'password' ? '🙈' : '👁️';
        });
    </script>
</main>
@endsection
