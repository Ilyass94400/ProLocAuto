<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Auth\ClientController;

Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ClientController::class, 'login']);
Route::post('/logout', [ClientController::class, 'logout'])->name('logout');
Route::get('/login', function () {return view('login');})->name('login');

use App\Http\Controllers\Auth\AuthController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

use App\Http\Controllers\OfferController;

Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');


use App\Http\Controllers\ReviewController;

Route::get('/avis', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/avis', [ReviewController::class, 'store'])->name('reviews.store');

//page d'accueil améliorée

Route::get('/', function () {
    return view('prolocauto');
});

use App\Http\Controllers\ClientAreaController;
use App\Http\Controllers\AccountController;

Route::middleware(['auth'])->group(function () {
    Route::get('/clients/accueil', [ClientAreaController::class, 'index'])->name('clients.accueil');
    Route::get('/clients/mon-compte', [AccountController::class, 'index'])->name('clients.mon-compte');
});


use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
