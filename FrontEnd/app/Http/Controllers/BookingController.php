<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\AppointifyUser;

class BookingController extends Controller
{
    public function bookPost(Request $request)
    {
        // Fetch user data from tblsignup using the email (or any unique identifier)
        $user = AppointifyUSer::where('email', $request->input('email'))->first();

        if ($user) {
            // Insert data into the booking table
            $booking = new Booking();
            $booking->fullname = $user->fullname;
            $booking->address = $user->address;
            $booking->phonenumber = $user->phonenumber;
            $booking->email = $user->email;
            $booking->session_time = $request->input('afternoon-session'); // Get the selected session time
            $booking->payment_method = $request->input('payment'); // Get the selected payment method
            $booking->save();

            return redirect()->route('Mainfolder.userHomepage'); // Redirect to a success page
        } else {
            return back()->withErrors(['error' => 'User not found']);
        }
    }
}
