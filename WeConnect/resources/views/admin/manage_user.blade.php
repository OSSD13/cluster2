@extends('layouts.layout_admin')
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">บัญชีผู้ใช้ทั้งหมด</h1>
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
                                    <a href="{{ route('admin.user_edit', ['id' => $user->id]) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ url('/users/' . $user->id) }}" id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-btn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                                data-id="{{ $user->id }}">
                                            Delete
                                        </button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'ลบบัญชีนี้หรือไม่?',
                        text: "หากลบแล้วจะไม่สามารถกู้คืนได้!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'ตกลง',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${userId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
