<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\AppointifyUser;
use App\Models\Booking;
use App\Models\Feedback;

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

        // Check if user exists
        if (!$user) {
            return redirect()->route('Mainfolder.login')->with('error', 'User not found');
        }

        // Check if password is correct
        if (!password_verify($request->password, $user->password)) {
            return redirect()->route('Mainfolder.login')->with('error', 'Incorrect password, Please try again!');
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
    public function signupPost(Request $request)
    {
        $request->validate([
            "fullname" => "required|string|max:255",
            "address" => "required|string|max:255",
            "phonenumber" => "required|string|max:15",
            "gender" => "required|string|max:10",
            "uploadimage" => "required|image|mimes:jpeg,png,jpg|max:2048",
            "username" => "required|string|max:255|",
            "password" => [
                "required",
                "string",
                "min:8", // At least 8 characters
                "regex:/[0-9]/", // At least one number
                "regex:/[!@#$%^&*(),.?\":{}|<>]/", // At least one special character
            ],
            "email" => "required|email|unique:users|max:255",
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
            return redirect(route('Mainfolder.login'))->with('success', 'Account created successfully!');
        }

        // Handle failure case if needed
        return redirect()->back()->with('error', 'There was an error creating your account.');
    }


    // User homepage
    public function userHomepage(){
        return view('Mainfolder.userHomepage');
    }

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
    
            // Fetch notifications for the user using user_id
            $notifications = DB::table('notifications')
                ->where('user_id', $user->id) // Change this line
                ->orderBy('created_at', 'desc')
                ->get();
    
            return view('Mainfolder.profile', [
                'user' => $user,
                'profileImage' => $profileImage,
                'notifications' => $notifications, // Pass notifications to the view
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
            
            // Fetch notifications for the user using the user_id
           // Fetch notifications for the user using user_id
            $notifications = DB::table('notifications')
            ->where('user_id', $user->id) // Change this line
            ->orderBy('created_at', 'desc')
            ->get();

    
            return view('Mainfolder.profile', [
                'user' => $user,
                'profileImage' => $profileImage,
                'isAboutPage' => true,
                'notifications' => $notifications, // Pass notifications to the view
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
                ->orderBy('date', 'asc')
                ->get();
    
            $profileImage = (Str::startsWith($user->uploadimage, 'http'))
                ? $user->uploadimage
                : asset('storage/' . $user->uploadimage);
            
            // Fetch notifications for the user using user_id
            $notifications = DB::table('notifications')
                ->where('user_id', $user->id) // Change this line
                ->orderBy('created_at', 'desc')
                ->get();
    
            return view('Mainfolder.profile', [
                'user' => $user,
                'profileImage' => $profileImage,
                'isAppointmentPage' => true,
                'appointments' => $appointments,
                'notifications' => $notifications, // Pass notifications to the view
            ]);
        } else {
            return redirect()->route('Mainfolder.userHomepage')->with('error', 'User not found.');
        }
    }
    public function logout()
    {
        // Clear session data or custom session handling
        session()->flush(); // Clears all session data
        
        // Redirect to login or homepage
        return redirect()->route('Mainfolder.homepage')->with('success', 'Logged out successfully.');
    }
     // Insert feedback
     public function addFeedback(Request $request)
    {
        // Validate the request data
        $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'feedback_message' => 'required|string|max:255',
        ]);

        // Create a new feedback record
        Feedback::create([
            'star' => $request->star,
            'feedback_message' => $request->feedback_message,
        ]);

        // Redirect or return a response
        return redirect()->route('Mainfolder.BookingPage')->with('success', 'Feedback submitted successfully!');
    }
    public function getFeedbacks()
    {
        try {
            $feedbacks = Feedback::all();

            if ($feedbacks->isEmpty()) {
                Log::warning('No feedbacks found.');
            } else {
                Log::info('Feedbacks retrieved successfully:', $feedbacks->toArray());
            }

            return response()->json(['feedbacks' => $feedbacks]);
        } catch (\Exception $e) {
            Log::error('Error retrieving feedbacks: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while retrieving feedbacks.'], 500);
        }
    }
    // Delete feedback by ID
     public function deleteFeedback($id)
     {
         $feedback = Feedback::find($id);
 
         if ($feedback) {
             if ($feedback->uploadimage) {
                 Storage::disk('public')->delete($feedback->uploadimage);
             }
             $feedback->delete();
             return redirect()->back()->with('success', 'Feedback deleted successfully.');
         }
 
         return redirect()->back()->with('error', 'Feedback not found.');
     }

}
