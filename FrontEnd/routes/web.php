<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


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

Route::get('/appointify',[MainController::class, 'homepage'])->name('Mainfolder.homepage');

Route::get('/appointify/login',[MainController::class, 'login'])->name('Mainfolder.login');
Route::post('/appointify/login',[MainController::class, 'loginPost'])->name('login.post');
Route::get('/appointify/signup',[MainController::class, 'signup'])->name('Mainfolder.signup');
Route::post('/appointify/signup',[MainController::class, 'signupPost'])->name('signup.post');
Route::get('/appointify/userhomepage/UserProfile', [MainController::class, 'profile'])->name('Mainfolder.profile');
Route::get('/appointify/profileedit',[MainController::class,  'profileEdit'])->name('Mainfolder.editprofile_user');

Route::get('/appointify/userhomepage',[MainController::class, 'userHomepage'])->name('Mainfolder.userHomepage');
Route::get('/appointify/book',[MainController::class, 'book'])->name('Mainfolder.BookingPage');