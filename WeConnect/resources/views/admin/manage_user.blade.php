@extends('layouts.layout_admin')
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">User Manage </h1>
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach ($users as $user)
                            <div class="bg-white p-6 shadow-md rounded-xl">
                                <h2 class="text-lg font-bold">{{ $user->name }}</h2>
                                <p class="text-gray-600">{{ $user->email }}</p>

                                <div class="flex space-x-3 mt-4 justify-end">
                                    <!-- Edit Button -->
                                    <a href="{{ route('user.editform', $user->usr_id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>
                                    <form action="{{  url('/usermanage') }}" method="POST">
                                        @csrf
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('user.delete', $user->usr_id) }}" method="POST" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="min-width: 80px;">Delete</button>
                                    </form>


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
        <div class="flex justify-center mt-6">
            <button class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
                เพิ่มบัญชีผู้ใช้
            </button>
        </div>
    </form>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: "หากลบแล้วจะไม่สามารถกู้คืนได้!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
    </script>
