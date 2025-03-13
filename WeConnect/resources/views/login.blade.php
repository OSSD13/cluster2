@extends('layout.default')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-box">
        <div class="card shadow-lg">
            <div class="card-body login-card-body p-4">
                <div class="text-center mb-4">
                    <h3><b>Admin</b>LTE</h3>
                </div>
                <p class="text-center text-muted">Sign in to start your session</p>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ url('/login')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </form>

                <div class="text-center my-3">
                    <p class="text-muted">- OR -</p>
                </div>

                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-primary">
                        <i class="bi bi-facebook me-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-danger">
                        <i class="bi bi-google me-2"></i> Sign in using Google+
                    </a>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ url('/register') }}" class="text-muted">Register a new membership</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
