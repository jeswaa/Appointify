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
        $booking = \DB::table('bookings')->where('id', $bookingId)->first();

        if ($booking) {
            $user = \DB::table('tblsignup')->where('email', $booking->email)->first();

            if ($user) {
                $formattedDate = date('F j, Y', strtotime($booking->date));
                $sessionTime = $booking->session_time;

                // Only show the user name in the reminder message
                $reminderMessage = "Hello, \n" . $user->fullname . "\nWe look forward to seeing you soon!";


                // Insert the notification with name only and store date and time separately
                \DB::table('notifications')->insert([
                    'user_id' => $user->id,
                    'message' => $reminderMessage,
                    'date' => $formattedDate,
                    'session_time' => $sessionTime,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                \Log::info("Reminder sent to " . $user->fullname . ": " . strip_tags($reminderMessage));

                return redirect()->back()->with('success', 'Reminder sent successfully to ' . $user->fullname);
            } else {
                return redirect()->back()->with('error', 'No user found with the provided email in the booking.');
            }
        }

        return redirect()->back()->with('error', 'Booking not found');
    }

    public function deleteReminder($notificationId)
    {
        // Find the notification by ID
        $notification = \DB::table('notifications')->where('id', $notificationId)->first();
    
        if ($notification) {
            // Delete the notification
            \DB::table('notifications')->where('id', $notificationId)->delete();
    
            \Log::info("Notification deleted for user ID: " . $notification->id);
    
            return redirect()->back()->with('success', 'Reminder deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Reminder not found.');
        }
    }


    public function getUserAppointments()
    {
        $userId = session('user_id'); // Fetch user ID from session

        if (!$userId) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $appointments = Booking::where('id', $userId)->get();

        $events = $appointments->map(function ($appointment) {
            return [
                'title' => 'Session at ' . $appointment->session_time, // Customize the title
                'start' => $appointment->date . 'T' . $appointment->session_time, // Start time
                'end' => $appointment->date . 'T' . $appointment->end_time, // End time (make sure to define end_time in your Booking model)
            ];
        });

        return response()->json($events);
    }
    public function showNotifications()
    {
        $userId = session('user_id'); // Fetch user ID from session

        if (!$userId) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Fetch notifications for the logged-in user
        $notifications = Notification::where('user_id', $userId)->get();

        return view('Mainfolder.profile', compact('notifications')); // Ensure this view file exists
    }

}
