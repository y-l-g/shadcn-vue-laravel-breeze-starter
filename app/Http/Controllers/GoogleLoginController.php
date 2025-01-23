<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser && $existingUser->google_id === null) {
            // User exists but hasn't linked Google account
            $existingUser->update(['google_id' => $googleUser->id]);
            Auth::login($existingUser);
        } else {
            // Create or update user with Google credentials
            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'email' => $googleUser->getEmail(),
                    'name' => $googleUser->getName(),
                    'password' => Hash::make(Str::password())
                ]
            );

            Auth::login($user);
        }

        return redirect(route('dashboard'))->with(
            'message',
            "Your have been authenticated!"
        );
    }
}
