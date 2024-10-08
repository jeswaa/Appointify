<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback() {
        try {
            // Fetch the user from Google
            $googleUser = Socialite::driver('google')->user();
            
            // Log the retrieved user info for debugging
            \Log::info('Google user info: ', $googleUser->toArray());
    
            // Check if the user already exists in your database
            $user = AppointifyUser::where('email', $googleUser->getEmail())->first();
    
            if (!$user) {
                // If the user doesn't exist, create a new user
                $user = new AppointifyUser();
                $user->fullname = $googleUser->getName();
                $user->email = $googleUser->getEmail();
                $user->username = $googleUser->getEmail();
                $user->uploadimage = $googleUser->getAvatar();
                $user->password = bcrypt(Str::random(16));
                $user->save();
            }
    
            // Log user login
            session(['user' => $user]);
            session(['user_id' => $user->id]);
            return redirect()->route('Mainfolder.userHomepage');
    
        } catch (\Exception $e) {
            \Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('Mainfolder.login')->with('error', 'Login failed. Please try again.');
        }
    }
}
