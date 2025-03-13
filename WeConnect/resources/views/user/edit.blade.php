@extends('layouts.default')

@section('content')
<div class="register-box">
    <div class="register-logo">
      <a href=""><b>Edit</b>User</a>
    </div>
    <!-- /.register-logo -->
    <div class="card">
      <div class="card-body register-card-body">
        <p class="register-box-msg">Edit User</p>
        <form action="{{ url('/user') }}" method="post" id="editForm">
            @csrf
            @method('put')
            <input type="hidden" name="id"
            value="{{ $user->id}}" >
          <div class="input-group mb-3">
            <input type="text" value="{{ $user->name}}" name="name" class="form-control" placeholder="Full Name">
            <div class="input-group-text"><span class="bi bi-person"></span></div>
          </div>
          <div class="input-group mb-3">
            <input type="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Email">
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
          </div>
          {{-- <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>
          <!--begin::Row-->
          <div class="row">
            <div class="col-8">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div> --}}
            <!-- /.col -->
            <div class="col-4">
              <div class="d-grid gap-2">
                {{-- <button type="submit" class="btn btn-primary">Sign In</button> --}}
                <button type="submit" class="btn btn-primary" onclick="showSuccessMessage(event)">Sign In</button>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!--end::Row-->
        </form>
        <!-- /.social-auth-links -->
      </div>
      <!-- /.register-card-body -->
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        // แสดง Success message เมื่อกด Sign In
        function showSuccessMessage(event) {
            event.preventDefault(); // ป้องกันการส่ง form ทันที
            Swal.fire({
                icon: 'success',
                title: 'User updated successfully!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                //แสดงข้อความ Success
                document.getElementById('editForm').submit();
            });
        }
    </script>
@endsection
