<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AppointifyUser;

class MainController extends Controller
{
    public function homepage(){
        return view('Mainfolder.homepage');
    }

    public function login(){
        return view('Mainfolder.login');
    }
    public function loginPost(Request  $request){
        $request->validate([
            "username" => "required",
            "password" => "required",
        ]);
        $user = AppointifyUser::where('username', $request->username)->first();
        if ($user && password_verify($request->password, $user->password)) {
            session(['user' => $user]);
            session(['user_id' => $user->id]);
            return redirect(route('Mainfolder.userHomepage'));
        }
        return redirect(route('Mainfolder.login'))->with('error', 'Invalid Username or Password');
    }
    public function signup(){
        return view('Mainfolder.signup');
    }
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

    public function userHomepage(){
        return view('Mainfolder.userHomepage');
    }
    public function profile() {
        $userId = session('user_id');
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your profile.');
        }
    
        $user = AppointifyUser::find($userId);
    
        if ($user) {
            return view('Mainfolder.profile', [
                'user' => $user,
            ]);
        } else {
            return redirect()->route('Mainfolder.userHomepage')->with('error', 'User not found.');
        }
    }

    protected function getCurrentUserId() {
        return session('user_id');
    }
    
    
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

    public function bookPost(Request $request){
        $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phonenumber' => 'required|numeric',
            'email' => 'required|email',
            'session-time' => 'required',
            'payment-method' => 'required',
        ]);
        $booking = new Booking();
        $booking->fullname = $request->fullname;
        $booking->address = $request->address;
        $booking->phonenumber = $request->phonenumber;
        $booking->email = $request->email;
        $booking->session_time = $request->input('session-time');
        $booking->payment_method = $request->input('payment-method');
        $booking->user_id = session('user_id');

        $booking->save();

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    
    public function profileEdit(){
        return view('Mainfolder.editprofile_user');
   }
}
