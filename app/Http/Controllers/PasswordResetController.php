<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    // Show forgot form
    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    // Send OTP to email (throttled)
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = strtolower($request->email);
        $key = 'password-otp:' . sha1($email);

        // limit 5 tries per 10 minutes
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['email' => "Too many requests. Try again in {$seconds} seconds."]);
        }

        try {
            $user = User::where('email', $email)->firstOrFail();

            // generate secure 6-digit OTP
            $otp = random_int(100000, 999999);

            // store hashed OTP + expiry
            $user->otp = Hash::make((string) $otp);
            $user->otp_expires_at = now()->addMinutes(10);
            $user->save();

            // send email (sync). If you have queues configured, dispatch the mailable to the queue instead.
            Mail::to($user->email)->send(new OtpMail($otp, 10));

            // increment rate limiter
            RateLimiter::hit($key, 60 * 10); // decay 10 minutes

            // persist email to session for convenience on OTP page
            session(['password_reset_email' => $email]);

            return redirect()->route('password.otpForm')
                             ->with('success', 'OTP sent to your email.');
        } catch (\Exception $e) {
            Log::error('Error sending OTP: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return back()->withErrors(['email' => 'Unable to send OTP at this time. Please try again later.']);
        }
    }

    // Show OTP form
    public function showOtpForm(Request $request)
    {
        $email = session('password_reset_email', old('email'));
        return view('auth.verify-otp', compact('email'));
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|digits:6',
        ]);

        $email = strtolower($request->email);
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Account not found.']);
        }

        // check expiry
        if (!$user->otp_expires_at || $user->otp_expires_at->isPast()) {
            return back()->withErrors(['otp' => 'OTP expired. Please request a new one.']);
        }

        // verify hashed otp
        if (!Hash::check($request->otp, $user->otp)) {
            // optional: record failed attempt using RateLimiter to prevent brute force
            $key = 'password-otp-verify:' . sha1($email);
            RateLimiter::hit($key, 60 * 10);
            if (RateLimiter::tooManyAttempts($key, 6)) {
                $seconds = RateLimiter::availableIn($key);
                return back()->withErrors(['otp' => "Too many attempts. Try again in {$seconds} seconds."]);
            }
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        // OTP valid: clear limiter & mark session for reset
        RateLimiter::clear('password-otp:' . sha1($email));
        RateLimiter::clear('password-otp-verify:' . sha1($email));

        session(['password_reset_verified' => true, 'password_reset_email' => $email]);

        return redirect()->route('password.resetForm')->with('success', 'OTP verified. You can now reset your password.');
    }

    // Show reset form
    public function showResetForm(Request $request)
    {
        if (!session('password_reset_verified') || !session('password_reset_email')) {
            return redirect()->route('password.forgot')->with('error', 'Please verify your email first.');
        }
        return view('auth.reset-password');
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $email = strtolower($request->email);

        // guard: ensure session was verified
        if (!session('password_reset_verified') || session('password_reset_email') !== $email) {
            return redirect()->route('password.forgot')->with('error', 'Session expired or invalid. Please start over.');
        }

        try {
            $user = User::where('email', $email)->firstOrFail();

            $user->password = Hash::make($request->password);
            // clear OTP fields
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            session()->forget(['password_reset_verified', 'password_reset_email', 'password_reset_email']);

            auth()->login($user);

            return redirect()->route('login')->with('success', 'Password updated.');
        } catch (\Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return redirect()->route('password.forgot')->with('error', 'Unable to reset password. Please try again later.');
        }
    }
}
