@extends('layouts.adminmenu')

@section('admin_content')


<div class="container py-4">
    <div class="card shadow rounded-6">
        {{-- Header --}}
        <div class="card-header text-white d-flex justify-content-between align-items-center px-3 py-2" style="background-color: #f97316;">
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
                                    <a href="{{ url('/adduser') }}" class="btn btn-warning btn-sm">Edit</a>
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
                <button class="btn btn-lg fw-bold rounded-pill text-white" style="background-color: #28a745;">เพิ่มบัญชีผู้ใช้</a>
            </form>
        </div>
    </div>
</div>
@endsection