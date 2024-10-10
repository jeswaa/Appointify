<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminModel;

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
    
    

    public function adminView(){
        return view('Mainfolder.adminDashboard');
    }
}
