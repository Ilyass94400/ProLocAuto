<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Imports des contrôleurs
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
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. CLIENTS ---
Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ClientController::class, 'login']);
Route::post('/logout', [ClientController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// --- 2. PUBLIC ---
Route::get('/', function () {
    if(Auth::check()){ return redirect()->route('clients.accueil'); } 
    else { return view('prolocauto'); }
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

// --- 3. ESPACE CLIENT CONNECTÉ ---
Route::middleware(['auth'])->group(function () {
    Route::get('/clients/accueil', [ClientAreaController::class, 'index'])->name('clients.accueil');
    Route::get('/clients/mon-compte', [AccountController::class, 'index'])->name('clients.mon-compte');
    
    Route::get('/reservation/{id}', [ReservationController::class, 'create'])->name('reservation.create');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
});

// --- 4. ESPACE ADMIN (PROTÉGÉ) ---
Route::get('/admin', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'authenticate'])->name('admin.auth');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    // Accueil
    Route::get('/accueiladmin', [AdminController::class, 'index'])->name('admin.home');

    // Gestion Annonces (Tout-en-un)
    Route::get('/annonceadmin', [AdminController::class, 'manageAnnonces'])->name('admin.annonces.manage');
    Route::get('/annonceadmin/{id}/edit', [AdminController::class, 'editAnnonceInManager'])->name('admin.annonces.edit_mode');
    Route::post('/admin/annonce', [AdminController::class, 'storeAnnonce'])->name('admin.annonce.store');
    Route::put('/admin/annonce/{id}', [AdminController::class, 'updateAnnonce'])->name('admin.annonce.update');
    Route::delete('/admin/annonce/{id}', [AdminController::class, 'deleteAnnonce'])->name('admin.annonce.delete');

    // --- C'EST ICI QUE TU AVAIS L'ERREUR (IL MANQUAIT CES LIGNES) ---
    Route::get('/reservation', [AdminController::class, 'showManualReservationPage'])->name('admin.reservation.page');
    Route::post('/admin/reservation/store', [AdminController::class, 'storeManualReservation'])->name('admin.reservation.store');
    // ----------------------------------------------------------------
});

// --- GESTION DES COMMERCIAUX ---
    
    // 1. Afficher la page de création (GET)
    Route::get('/admincommercial', [AdminController::class, 'createCommercial'])->name('admin.commercial.create');

    // 2. Enregistrer le commercial (POST)
    Route::post('/admincommercial', [AdminController::class, 'storeCommercial'])->name('admin.commercial.store');