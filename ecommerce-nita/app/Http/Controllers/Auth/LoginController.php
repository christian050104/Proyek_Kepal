<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function loginWithOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'otp' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    if ($user->otp !== $request->otp || Carbon::now()->greaterThan($user->otp_expires_at)) {
        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    Auth::login($user); // Login sukses
    $user->update(['otp' => null, 'otp_expires_at' => null]); // Reset OTP

    return redirect()->route('home')->with('success', 'Login successful.');
}

}
