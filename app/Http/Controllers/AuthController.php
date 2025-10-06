<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyOtpMail;
use Illuminate\Support\Str;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ]);
    
        $user = User::create([
            'username'  => $request->username,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
    
        // Generate OTP
        $otp = rand(100000, 999999);
        $user->emailverify_otp = $otp;
        $user->emailverify_otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();
    
        // Send mail
        Mail::to($user->email)->send(new VerifyOtpMail($user, $otp));
    
        Auth::login($user);
    
        return redirect()->route('verification.notice')
            ->with('success', 'We sent a verification code to your email. Please verify before applying.');
    }

    public function showVerifyForm()
    {
        return view('auth.verify-email');
    }
    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
    
        $user = $request->user();
    
        if (!$user->emailverify_otp || $user->emailverify_otp_expires_at < Carbon::now()) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }
    
        if ($request->otp != $user->emailverify_otp) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }
    
        $user->email_verified_at = Carbon::now();
        $user->emailverify_otp = null;
        $user->emailverify_otp_expires_at = null;
        $user->save();
    
        return redirect()->route('user.index')->with('success', 'Your email has been verified!');
    }
    
    public function resendOtp(Request $request)
    {
        $user = $request->user();
    
        $otp = rand(100000, 999999);
        $user->emailverify_otp = $otp;
        $user->emailverify_otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();
    
        Mail::to($user->email)->send(new VerifyOtpMail($user, $otp));
    
        return back()->with('success', 'A new verification code has been sent to your email.');
    }
    


public function showLogin()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    // Find the user first
    $user = User::where('email', $request->email)->first();

    if (! $user) {
        return back()->withErrors([
            'email' => 'We can’t find an account with that email address.',
        ])->onlyInput('email');
    }

    if (! Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => 'The password you entered is incorrect.',
        ])->onlyInput('email');
    }

    // Check email verification before logging them in
    if (is_null($user->google_id) && ! $user->hasVerifiedEmail()) {
        return redirect()->route('verification.notice')
            ->with('error', 'Please verify your email with OTP before logging in.');
    }

    // Now attempt login
    if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended(route('user.index'))
            ->with('success', 'Welcome back, '.$user->first_name.'!');
    }

    // Fallback (rare)
    return back()->withErrors([
        'email' => 'Login failed. Please try again.',
    ]);
}



public function logout(Request $request)
{
    try {
        Auth::logout();
    } catch (\Exception $e) {
        // already logged out or session missing
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login.form')->with('success', 'You have been logged out.');
}


protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        // Flash message before redirect
        session()->flash('error', 'Please login to apply for this job.');
        return route('login.form');
    }
}



}
