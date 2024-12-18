@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                <!-- Card Header -->
                <div class="card-header bg-gradient-primary text-white text-center py-5">
                    <h2 class="mb-1">Welcome Back</h2>
                    <p class="mb-0">Log in to your account</p>
                </div>

                <!-- Card Body -->
                <div class="card-body p-5 bg-light">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-gradient-primary btn-lg rounded-pill">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <!-- Forgot Password -->
                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a href="{{ route('password.request') }}" class="text-primary">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-white text-center py-4">
                    <p class="mb-0">Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary fw-bold">Register here</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .bg-gradient-primary {
    background: linear-gradient(45deg, #1d4ed8, #2563eb, #3b82f6);
    color: white;
}

.btn-gradient-primary {
    background: linear-gradient(45deg, #2563eb, #3b82f6);
    color: white;
    border: none;
}

.btn-gradient-primary:hover {
    background: linear-gradient(45deg, #1d4ed8, #2563eb);
}

</style>