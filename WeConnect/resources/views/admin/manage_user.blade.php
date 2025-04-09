@extends('layouts.layout_admin')

@section('content')

<div class="container">
    <div class="text-center mb-4">
        <h1 class="text-2xl font-semibold mt-4 text-center px-6">User Manage<i class="fas fa-user-edit"></i></h1>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="min-width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="text-nowrap">{{ $user->name }}</td>
                    <td class="text-nowrap">{{ $user->email }}</td>
                    <td>
                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                            <a href="{{ url('/admin.user/{id}/edit'.$user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{  url('/adduser') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Add User Button --}}
    <form action="{{  url('/adduser') }}" method="get">
        <div class="flex justify-center mt-6">
            <button class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
                เพิ่มบัญชีผู้ใช้
            </button>
        </div>
    </form>
</div>
</div>
</div>

@endsection
