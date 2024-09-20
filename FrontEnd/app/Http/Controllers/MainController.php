<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function homepage(){
        return view('Mainfolder.homepage');
    }

    public function login(){
        return view('Mainfolder.login');
    }
    public function signup(){
        return view('Mainfolder.signup');
    }
    public function userHomepage(){
        return view('Mainfolder.userHomepage');
    }
    public function book(){
        return view('Mainfolder.BookingPage');
    }
}
