<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Import Mail facade here
use App\Mail\AppointmentReminderMail; // Import the Mailable class here
use Illuminate\Support\Facades\Notification; // Ensure Notification is imported
use App\Models\AdminModel;
use App\Models\Booking;

class AdminController extends Controller
{
    public function adminLogin(Request $request) {
        $request->validate([
            "username" => "required",
        ]);

        // Check if the admin exists based on the username
        $admin = AdminModel::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if (!$admin) {
            return redirect()->route('Mainfolder.login')->with('error', 'Admin not found.');
        }

        // Set the admin session
        session(['admin' => $admin]);
        session(['admin_id' => $admin->id]);

        return redirect(route('Mainfolder.adminDashboard'));
    }

    public function adminView() {
        return view('Mainfolder.adminDashboard');
    }

    public function adminAppointments() {
        $appointments = Booking::all(); // Use Eloquent for better readability
        return view('Mainfolder.adminAppointment', ['appointments' => $appointments]);
    }
    public function showProfile()
    {
        $userEmail = auth()->user()->email; // Adjust this based on your user authentication
        $notifications = Notification::where('user_email', $userEmail)->get();

        return view('profile', compact('notifications'));
    }
}
