@extends('layouts.layout_admin')
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-2 flex items-center">
            User Manage
            <svg width="30" height="30" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="ml-2">
                <path
                    d="M8 8C9.65685 8 11 6.65685 11 5C11 3.34315 9.65685 2 8 2C6.34315 2 5 3.34315 5 5C5 6.65685 6.34315 8 8 8ZM10 5C10 6.10457 9.10457 7 8 7C6.89543 7 6 6.10457 6 5C6 3.89543 6.89543 3 8 3C9.10457 3 10 3.89543 10 5Z"
                    fill="black" />
                <path
                    d="M14 13C14 14 13 14 13 14H3C3 14 2 14 2 13C2 12 3 9 8 9C13 9 14 12 14 13ZM13 12.9965C12.9986 12.7497 12.8462 12.0104 12.1679 11.3321C11.5156 10.6798 10.2891 10 7.99999 10C5.71088 10 4.48435 10.6798 3.8321 11.3321C3.15375 12.0104 3.00142 12.7497 3 12.9965H13Z"
                    fill="black" />
            </svg>
        </h1>

        <form action="{{ route('admin.manage_user') }}" method="GET" class="mb-4 flex items-center gap-2 ">
            <div class="flex mx-auto ">
                <input type="text" name="search" placeholder="ค้นหาผู้ใช้" value="{{ request('search') }}"
                    class="border border-gray-300 rounded  px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded ml-2 ">ค้นหา</button>
            </div>
        </form>
        <div class="row d-flex justify-content-center ">
            <div class="  mx-auto w-auto">
                <div class="card p-3 py-4" style="max-height: 350px; overflow-y: auto; ">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach ($users as $user)
                            <div class="bg-white p-6 shadow-md rounded-xl flex flex-col h-auto">
                                <h2 class="text-lg font-bold">{{ $user->name }}</h2>
                                <p class="text-gray-600">{{ $user->email }}</p>

                                <div class="flex-grow"></div>

                                <div class="flex space-x-3 mt-4 justify-end mt-auto">
                                    <!-- Edit Button -->
                                    <a href="{{ url('/edituser/' . $user->usr_id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('user.delete', $user->usr_id) }}" method="POST"
                                        class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            style="min-width: 80px;">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ url('/adduser') }}" method="get">
        <div class="flex justify-center">
            <button class="bg-green-500 text-white px-6 p-2 rounded-full text-lg shadow-md hover:bg-green-600">
                เพิ่มบัญชีผู้ใช้
            </button>
        </div>
    </form>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'ลบบัญชีนี้หรือไม่',
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#B9B9B9',
                    confirmButtonColor: '#00BB1F',
                    cancelButtonText: 'ยกเลิก',
                    confirmButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();

                            Swal.fire({
                                title: "บัญชีผู้ใช้ถูกลบแล้ว",
                                icon: "success",
                                draggable: true
                            });
                    }
                });
            });
        });
    });
</script>
