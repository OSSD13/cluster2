@extends('layouts.adminmenu')
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WeConnect - แจ้งปัญหา</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Kanit (TH) & Outfit (EN) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_REAL_API_KEY&libraries=places"></script>

    <style>
      body {
        font-family: 'Kanit', 'Outfit', sans-serif;
      }

      :lang(en) {
        font-family: 'Outfit', sans-serif;
      }
    </style>
  </head>

@section('content')
<div class="container">
            <div class="text-center mb-4">
                <h1 class="text-2xl font-semibold mt-4 text-left px-6">User Manage<i class="fas fa-user-edit"></i></h1>

                <h2 class="text-muted">User Tables</h2>
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
