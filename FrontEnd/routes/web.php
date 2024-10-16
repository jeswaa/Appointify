<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BookingController;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::middleware(['web'])->group(function () {
    Route::get('auth/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('auth.google');

    Route::get('auth/google/callback', [MainController::class, 'googleCallback']);
});

Route::get('/appointify',[MainController::class, 'homepage'])->name('Mainfolder.homepage');

Route::get('/appointify/login',[MainController::class, 'login'])->name('Mainfolder.login');
Route::post('/appointify/login',[MainController::class, 'loginPost'])->name('login.post');
Route::get('/appointify/signup',[MainController::class, 'signup'])->name('Mainfolder.signup');
Route::post('/appointify/signup',[MainController::class, 'signupPost'])->name('signup.post');

Route::post('/appointify/login/loginAdmin', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::get('/appointify/adminDashboard',[AdminController::class, 'adminView'])->name('Mainfolder.adminDashboard');
Route::get('/appointify/adminDashboard/Appointments',[AdminController::class, 'adminAppointments'])->name('Mainfolder.adminAppointment');
Route::get('/appointify/logout', [MainController::class, 'logout'])->name('logout');


Route::post('/send-reminder/{bookingId}', [BookingController::class, 'sendReminderToUser'])->name('send.reminder');

Route::get('/appointify/userhomepage/UserProfile', [MainController::class, 'profile'])->name('Mainfolder.profile');
Route::get('/appointify/profileedit',[MainController::class,  'profileEdit'])->name('Mainfolder.editprofile_user');
Route::get('/appointify/userhomepage/UserProfile/about',[MainController::class,  'about'])->name('Mainfolder.about');
Route::get('/appointify/userhomepage/UserProfile/appointment',[MainController::class,  'appointment'])->name('Mainfolder.appointment');



Route::get('/appointify/userhomepage',[MainController::class, 'userHomepage'])->name('Mainfolder.userHomepage');
Route::get('/appointify/book',[MainController::class, 'book'])->name('Mainfolder.BookingPage');
Route::post('/appointify/book',[BookingController::class, 'bookPost'])->name('booking.post');
