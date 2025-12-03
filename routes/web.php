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

<<<<<<< HEAD
use App\Http\Controllers\OfferController;

Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');


use App\Http\Controllers\ReviewController;

Route::get('/review', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/review', [ReviewController::class, 'store'])->name('reviews.store');

=======

// --- 2. PAGES PUBLIQUES ---
>>>>>>> origin/samadmin
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


// --- 3. LES OFFRES SPÉCIFIQUES (NOUVEAU) ---
// Ces routes servent à afficher les annonces triées par type
Route::get('/tarifs', [TarifController::class, 'index'])->name('tarif'); // Liste générale
Route::get('/offrea', [TarifController::class, 'showA'])->name('offre.a'); // Type 1
Route::get('/offreb', [TarifController::class, 'showB'])->name('offre.b'); // Type 2
Route::get('/offrec', [TarifController::class, 'showC'])->name('offre.c'); // Type 3


// --- 4. ESPACE CLIENT CONNECTÉ ---
Route::middleware(['auth'])->group(function () {
    Route::get('/clients/accueil', [ClientAreaController::class, 'index'])->name('clients.accueil');
    Route::get('/clients/mon-compte', [AccountController::class, 'index'])->name('clients.mon-compte');
});


// --- 5. ESPACE ADMIN (PROTÉGÉ) ---

// Connexion Admin
Route::get('/admin', [AdminController::class, 'showLogin'])->name('admin.login'); // Renommé pour éviter conflit
Route::post('/admin', [AdminController::class, 'authenticate'])->name('admin.auth');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Zone de gestion (Il faut être connecté en tant qu'ADMIN)
Route::middleware(['auth:admin'])->group(function () {
    
    // Accueil Admin (Tableau de bord)
    Route::get('/accueiladmin', [AdminController::class, 'index'])->name('admin.home');

    // >>> NOUVELLES ROUTES POUR GERER LES ANNONCES <<<
    // Ajouter une annonce
    Route::post('/admin/annonce', [AdminController::class, 'storeAnnonce'])->name('admin.annonce.store');
    
    // Supprimer une annonce
    Route::delete('/admin/annonce/{id}', [AdminController::class, 'deleteAnnonce'])->name('admin.annonce.delete');
});



// Route pour afficher la page du formulaire (celle du bouton)
Route::get('/annonceadmin', [AdminController::class, 'createAnnonce'])->name('admin.annonce.create');

// Route pour traiter le formulaire (quand on clique sur Publier)
Route::post('/admin/annonce', [AdminController::class, 'storeAnnonce'])->name('admin.annonce.store');



### Étape 4 : Vérifier le CONTRÔLEUR (`AdminController.php`)

//Enfin, ton contrôleur doit avoir la fonction `createAnnonce` pour afficher la page. Ajoute-la si elle n'y est pas :

