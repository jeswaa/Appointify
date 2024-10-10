<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\AppointifyUser;
use App\Models\Booking;

class MainController extends Controller
{
    // Home page
    public function homepage(){
        return view('Mainfolder.homepage');
    }

    // Login page
    public function login(){
        return view('Mainfolder.login');
    }

    // Login post processing
    public function loginPost(Request $request){
        $request->validate([
            "username" => "required",
            "password" => "required",
        ]);

        // Allow login with either username or email
        $user = AppointifyUser::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if (!$user) {
            return redirect()->route('Mainfolder.login')->with('error', 'User not found.');
        }

        if (!password_verify($request->password, $user->password)) {
            return redirect()->route('Mainfolder.login')->with('error', 'Incorrect password.');
        }

        // Successful login
        session(['user' => $user]);
        session(['user_id' => $user->id]);

        return redirect(route('Mainfolder.userHomepage'));
    }

    // Signup page
    public function signup(){
        return view('Mainfolder.signup');
    }

    // Signup post processing
    public function signupPost(Request $request){
        $request->validate([
            "fullname" => "required",
            "address" => "required",
            "phonenumber" => "required|string",
            "gender" => "required",
            "uploadimage" => "required|image",
            "username" => "required",
            "password" => "required",
            "email" => "required|email|unique:users",
        ]);

        $user = new AppointifyUser();
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->phonenumber = $request->phonenumber;
        $user->gender = $request->gender;

        if ($request->hasFile('uploadimage')) {
            $user->uploadimage = $request->file('uploadimage')->store('uploads', 'public');
        }

        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;

        if ($user->save()) {
            return redirect(route('Mainfolder.login'));
        }
    }

    // User homepage
    public function userHomepage(){
        return view('Mainfolder.userHomepage');
    }

    // Profile page
    public function profile() {
        $userId = session('user_id');
    
        if (!$userId) {
            return redirect()->route('Mainfolder.login')->with('error', 'You must be logged in to view your profile.');
        }
    
        $user = AppointifyUser::find($userId);
    
        if ($user) {
            // Use external image URL directly, if exists
            $profileImage = (Str::startsWith($user->uploadimage, 'http'))
                ? $user->uploadimage
                : asset('storage/' . $user->uploadimage);
    
            return view('Mainfolder.profile', [
                'user' => $user,
                'profileImage' => $profileImage,
            ]);
        } else {
            return redirect()->route('Mainfolder.userHomepage')->with('error', 'User not found.');
        }
    }

    // Helper method to get current user ID
    protected function getCurrentUserId() {
        return session('user_id');
    }

    // Booking page
    public function book(){
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->route('Mainfolder.login')->with('error', 'You must be logged in to book an appointment.');
        }
        
        $user = AppointifyUser::find($userId);

        if ($user) {
            return view('Mainfolder.BookingPage', compact('user'));
        } else {
            return redirect()->route('Mainfolder.userHomepage')->with('error', 'User not found.');
        }
    }

    // Google login callback
    public function googleCallback() {
        try {
            // Fetch the user from Google
            $googleUser = Socialite::driver('google')->user();
            
            // Log the retrieved user info for debugging
            Log::info('Google user info:', [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar()
            ]);

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
            return redirect()->route('Mainfolder.signup')->with('error', 'Login failed. Please try again.');
        }
    }

    // About page (uses profile template with isAboutPage flag)
    public function about(){
        $userId = session('user_id');
    
        if (!$userId) {
            return redirect()->route('Mainfolder.login')->with('error', 'You must be logged in to view this page.');
        }
    
        $user = AppointifyUser::find($userId);
        
        if ($user) {
            $profileImage = (Str::startsWith($user->uploadimage, 'http'))
                ? $user->uploadimage
                : asset('storage/' . $user->uploadimage);
    
            return view('Mainfolder.profile', [
                'user' => $user,
                'profileImage' => $profileImage,
                'isAboutPage' => true, // Flag to indicate it's the about page
            ]);
        } else {
            return redirect()->route('Mainfolder.userHomepage')->with('error', 'User not found.');
        }
    }
    

    // Appointment page (uses profile template with isAppointmentPage flag)
    public function appointment() {
        $userId = session('user_id');
    
        if (!$userId) {
            return redirect()->route('Mainfolder.login')->with('error', 'You must be logged in to view your appointments.');
        }
    
        $user = AppointifyUser::find($userId);
    
        if ($user) {
            $appointments = Booking::where('email', $user->email)
                ->orderBy('date', 'asc') // Sorting by date in ascending order to show latest to oldest
                ->get();
    
            $profileImage = (Str::startsWith($user->uploadimage, 'http'))
                ? $user->uploadimage
                : asset('storage/' . $user->uploadimage);
    
            return view('Mainfolder.profile', [
                'user' => $user,
                'profileImage' => $profileImage,
                'isAppointmentPage' => true,
                'appointments' => $appointments
            ]);
        } else {
            return redirect()->route('Mainfolder.userHomepage')->with('error', 'User not found.');
        }
    }
    
}
