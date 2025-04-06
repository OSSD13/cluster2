@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="card shadow rounded-6">
        {{-- Header --}}
        <div class="card-header text-white d-flex justify-content-between align-items-center px-3 py-2" style="background-color: #FFA726;">
            <h4 class="mb-0 fw-bold">WeConnect</h4>
            <button class="btn btn-light d-md-none"><i class="fas fa-bars"></i></button>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <div class="text-center mb-4">
                <h2 class="fw-bold">User Manage <i class="fas fa-user-edit"></i></h2>
                <h5 class="text-muted">User Tables</h5>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th style="min-width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-nowrap">{{ $user->name }}</td>
                            <td class="text-nowrap">{{ $user->email }}</td>
                            <td>
                                <div class="d-flex flex-column flex-md-row gap-1 justify-content-center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm w-100 w-md-auto">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="w-100 w-md-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100 w-md-auto">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add User Button --}}
            <div class="text-center mt-4">
                <a href="{{ route('users.create') }}" class="btn btn-lg fw-bold rounded-pill text-white px-4 py-2" style="background-color: #28a745;">เพิ่มบัญชีผู้ใช้</a>
            </div>
        </div>
    </div>
</div>

@endsection
