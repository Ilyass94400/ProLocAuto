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
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\DemandeClientController;
use App\Http\Controllers\DemandeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. AUTHENTIFICATION CLIENTS ---
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

// --- OFFRES ---
Route::get('/tarifs', [TarifController::class, 'index'])->name('tarif'); 
Route::get('/offrea', [TarifController::class, 'showA'])->name('offre.a'); 
Route::get('/offreb', [TarifController::class, 'showB'])->name('offre.b'); 
Route::get('/offrec', [TarifController::class, 'showC'])->name('offre.c'); 

// --- 3. ESPACE CLIENT CONNECTÉ ---
Route::middleware(['auth'])->group(function () {
    Route::get('/clients/accueil', [ClientAreaController::class, 'index'])->name('clients.accueil');
    Route::get('/clients/mon-compte', [AccountController::class, 'index'])->name('clients.mon-compte');
    
    // PROFIL --

    Route::get('/clients/dashboard-perso', [AccountController::class, 'dashboard'])->name('clients.dashboard.tableaudebord');
    
    // 2. Traiter la modification des infos (Nom, Email ou Mot de passe)
    Route::put('/clients/profile/update', [AccountController::class, 'updateProfile'])->name('clients.profile.update');

    // Réservation
    Route::get('/reserver/{id}', [DemandeController::class, 'showForm'])->name('client.reservation.form');
    Route::post('/reserver/{id}', [DemandeController::class, 'submitForm'])->name('client.reserver.submit');
    Route::put('/reservation/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::post('/reservation/{id}/annuler', [ReservationController::class, 'annuler'])->name('reservation.annuler');
    
    // Anciennes routes
    Route::get('/reservation/{id}', [ReservationController::class, 'create'])->name('reservation.create');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::post('/annonce/{id}/demander', [DemandeClientController::class, 'store'])->name('demande.store');
});

// --- 4. ESPACE COMMERCIAL ---
Route::prefix('commercial')->name('commercial.')->group(function () {
    Route::middleware('guest:commercial')->group(function () {
        Route::get('/', [CommercialController::class, 'showLogin'])->name('login');
        Route::post('/', [CommercialController::class, 'authenticate'])->name('login.submit');
    });
    Route::middleware('auth:commercial')->group(function () {
        Route::get('/dashboard', [CommercialController::class, 'index'])->name('dashboard');
        Route::post('/logout', [CommercialController::class, 'logout'])->name('logout');
        Route::post('/valider/{id}', [CommercialController::class, 'valider'])->name('valider');
        Route::post('/refuser/{id}', [CommercialController::class, 'refuser'])->name('refuser');
    });
});

// --- 5. ESPACE ADMIN ---
Route::get('/admin', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'authenticate'])->name('admin.auth');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/accueiladmin', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/annonceadmin', [AdminController::class, 'manageAnnonces'])->name('admin.annonces.manage');
    Route::get('/annonceadmin/{id}/edit', [AdminController::class, 'editAnnonceInManager'])->name('admin.annonces.edit_mode');
    Route::post('/admin/annonce', [AdminController::class, 'storeAnnonce'])->name('admin.annonce.store');
    Route::put('/admin/annonce/{id}', [AdminController::class, 'updateAnnonce'])->name('admin.annonce.update');
    Route::delete('/admin/annonce/{id}', [AdminController::class, 'deleteAnnonce'])->name('admin.annonce.delete');
    Route::get('/reservation', [AdminController::class, 'showManualReservationPage'])->name('admin.reservation.page');
    Route::post('/admin/reservation/store', [AdminController::class, 'storeManualReservation'])->name('admin.reservation.store');
    Route::get('/admincommercial', [AdminController::class, 'createCommercial'])->name('admin.commercial.create');
    Route::post('/admincommercial', [AdminController::class, 'storeCommercial'])->name('admin.commercial.store');
});