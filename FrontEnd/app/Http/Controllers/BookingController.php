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

}
