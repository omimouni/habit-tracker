<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $userdata = Socialite::driver('google')->user();

            $user = User::where('email', $userdata->email)->first();
            if (!$user) {
                $user = User::create([
                    'name' => $userdata->name,
                    'email' => $userdata->email,
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user);
            return redirect()->route('landing-page');

        } catch (\Exception $e) {
            return redirect()->route('landing-page');
        }
    }
}
