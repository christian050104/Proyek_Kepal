<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\mail\SendOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Generate OTP
    $otp = Str::random(6);
    $otpExpiresAt = Carbon::now()->addMinute(); // OTP hanya berlaku 1 menit

    // Simpan data user sementara di session
    Session::put('user_data', [
        'username' => $request->username,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'otp' => $otp,
        'otp_expires_at' => $otpExpiresAt,
    ]);

    // Kirim OTP ke email menggunakan Mail facade
    Mail::to($request->email)->send(new SendOtpNotification($otp));

    return redirect()->route('register.verify')->with('success', 'OTP telah dikirim ke email Anda.');
}


    public function showVerifyOtpForm()
    {
        return view('auth.verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string']);

        $userData = Session::get('user_data');

        if (!$userData || $request->otp !== $userData['otp'] || Carbon::now()->greaterThan($userData['otp_expires_at'])) {
            return back()->withErrors(['otp' => 'OTP tidak valid atau sudah kedaluwarsa.']);
        }

        // Simpan user di database
        $user = User::create([
            'username' => $userData['username'],
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
        ]);

        // Hapus data session
        Session::forget('user_data');

        // Login user
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Anda telah login.');
    }
}


