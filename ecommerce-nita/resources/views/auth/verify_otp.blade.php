@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded">
                <!-- Header -->
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">{{ __('Verify OTP') }}</h3>
                    <small>Please enter the OTP sent to your email.</small>
                </div>

                <!-- Body -->
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.verify') }}">
                        @csrf

                        <!-- OTP -->
                        <div class="mb-4">
                            <label for="otp" class="form-label">{{ __('OTP') }}</label>
                            <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" required autofocus placeholder="Enter your OTP">
                            @error('otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Verify') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
