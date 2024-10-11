<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\AppointifyUser;
use App\Models\Notification;

class BookingController extends Controller
{
    public function bookPost(Request $request)
    {
        // Fetch user data from tblsignup using the email (or any unique identifier)
        $user = AppointifyUser::where('email', $request->input('email'))->first();

        if ($user) {
            // Validate incoming request
            $request->validate([
                'address' => 'nullable|string|max:255',
                'phonenumber' => 'nullable|string|max:255', 
                'date' => 'required|date',
                'afternoon-session' => 'required|string',
                'payment' => 'required|string',
            ]);

            // Insert data into the booking table
            $booking = new Booking();
            $booking->fullname = $user->fullname;

            // Use the address from the request or the user's existing address if not provided
            $booking->address = $request->input('address') ?? $user->address; // Take the input address if provided, otherwise use user's existing address

            $booking->phonenumber = $request->input('phonenumber') ?? $user->phonenumber;
            $booking->email = $user->email;
            $booking->date = $request->input('date');
            $booking->session_time = $request->input('afternoon-session');
            $booking->payment_method = $request->input('payment'); 
            $booking->save();

            return redirect()->route('Mainfolder.userHomepage');
        } else {
            return back()->withErrors(['error' => 'User not found']);
        }
    }
    public function sendReminderToUser($bookingId)
{
    // Fetch the booking information from the booking table
    $booking = \DB::table('bookings')->where('id', $bookingId)->first();

    if ($booking) {
        // Fetch the user's information from the tblsignup table using the email from the booking
        $user = \DB::table('tblsignup')->where('email', $booking->email)->first();

        if ($user) {
            // Prepare the reminder message
            $reminderMessage = "Hello " . $user->fullname . ",\n\n"
                            . "This is a reminder for your appointment on " 
                            . $booking->date . " at " . $booking->session_time . ".\n\n"
                            . "Thank you!";

            // Save the reminder message in the notifications table
            \DB::table('notifications')->insert([
                'id' => $user->id, // Store the user's ID to associate the reminder
                'message' => $reminderMessage,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Log the reminder message
            \Log::info("Reminder sent to " . $user->fullname . ": " . $reminderMessage);
            
            // Store this message in a session to display on the frontend
            return redirect()->back()->with('success', 'Reminder sent successfully to ' . $user->fullname);
        } else {
            // If no user found with the email in tblsignup
            return redirect()->back()->with('error', 'No user found with the provided email in the booking.');
        }
    }

    return redirect()->back()->with('error', 'Booking not found');
}


}
