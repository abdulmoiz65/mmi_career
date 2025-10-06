<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Exception;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $nameParts = explode(' ', $googleUser->getName(), 2);
            $firstName = $nameParts[0] ?? '';
            $lastName  = $nameParts[1] ?? '';

            // 🔹 Check if this Google ID is already linked to another account
            $conflict = User::where('google_id', $googleUser->getId())
                ->where('email', '!=', $googleUser->getEmail())
                ->first();

            if ($conflict) {
                return redirect()->route('login.form')
                    ->with('error', 'This Google account is already linked to another user.');
            }

            // 🔹 Check if user already exists by email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'username'   => Str::slug($googleUser->getName()) . '-' . Str::random(5),
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'email'      => $googleUser->getEmail(),
                    'google_id'  => $googleUser->getId(),
                    'password'   => bcrypt(Str::random(16)),
                ]);
            } else {
                $user->update([
                    'google_id'  => $googleUser->getId(),
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                ]);
            }

            // ✅ Always enforce email verification (new or existing user)
            if (is_null($user->email_verified_at)) {
                $user->forceFill(['email_verified_at' => now()])->save();
            }

            Auth::login($user);

            return redirect()->route('user.index')
                ->with('success', 'Logged in with Google successfully!');

        } catch (Exception $e) {
            \Log::error('Google login error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('login.form')
                ->with('error', 'Google login failed. Please try again.');
        }
    }
}
