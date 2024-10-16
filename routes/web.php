<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\UrlClickController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [ShortUrlController::class, 'index'])->name('home');

// Create the load more route for AJAX
Route::get('/load-more-urls', [ShortUrlController::class, 'loadMoreUrls'])->name('loadMoreUrls');

// Routes accessible only to guests (not authenticated users)
Route::middleware('guest')->group(function () {
    // Registration Routes
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [ShortUrlController::class, 'dashboard'])->name('dashboard');
    Route::post('/shorten', [ShortUrlController::class, 'create'])->name('shorten');
//    Route::get('/analytics/{shortCode}', [ShortUrlController::class, 'analytics'])->name('analytics');
    Route::get('/get-url-analytics/{id}', [ShortUrlController::class, 'getUrlAnalytics']);
});


Route::get('/{shortCode}', [ShortUrlController::class, 'redirect'])->name('redirect');

