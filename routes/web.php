<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ClientController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ClientAreaController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommercialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ClientController::class, 'login']);
Route::post('/logout', [ClientController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');


Route::get('/review', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/review', [ReviewController::class, 'store'])->name('reviews.store');


Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('clients.accueil');
    } else {
        return view('prolocauto');
    }
});

Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/review', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/review', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::resource('avis', AvisController::class)->only(['index', 'store']);


Route::get('/tarifs', [TarifController::class, 'index'])->name('tarif');
Route::get('/offrea', [TarifController::class, 'showA'])->name('offre.a'); 
Route::get('/offreb', [TarifController::class, 'showB'])->name('offre.b'); 
Route::get('/offrec', [TarifController::class, 'showC'])->name('offre.c'); 



Route::middleware(['auth'])->group(function () {
    Route::get('/clients/accueil', [ClientAreaController::class, 'index'])->name('clients.accueil');
    Route::get('/clients/mon-compte', [AccountController::class, 'index'])->name('clients.mon-compte');
});


Route::get('/admin', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'authenticate'])->name('admin.auth');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    
    
    Route::get('/accueiladmin', [AdminController::class, 'index'])->name('admin.home');

   
    Route::post('/admin/annonce', [AdminController::class, 'storeAnnonce'])->name('admin.annonce.store');
    
    
    Route::delete('/admin/annonce/{id}', [AdminController::class, 'deleteAnnonce'])->name('admin.annonce.delete');
});



Route::get('/annonceadmin', [AdminController::class, 'createAnnonce'])->name('admin.annonce.create');


Route::post('/admin/annonce', [AdminController::class, 'storeAnnonce'])->name('admin.annonce.store');

Route::get('/commercial', [CommercialController::class, 'index'])->name('commercial.index');
Route::post('/commercial', [CommercialController::class, 'store'])->name('commercial.store_devis');
