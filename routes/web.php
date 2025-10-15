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



Route::get('/', function () {
    return ('Bienvenue, chers entrepreneurs !');
});

use App\Http\Controllers\Auth\ClientController;
Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ClientController::class, 'login']);
Route::post('/logout', [ClientController::class, 'logout'])->name('logout');
Route::get('/', function(){
    return view('acceuil');
});
Route::get('/reservation', function(){
    return "Liste de vos réservations";
});
Route::get('/recherche', function(){
    return "Recherche";
});
Route::get('/contact', function(){
    return "Page de contact";
});
