@extends('layouts.app') 

@section('content')
<style>
    /* Styles personnalisés conservés pour l'aspect premium */
    :root {
        --proloc-primary: #1579E3; /* Nouveau bleu plus vif */
        --proloc-accent: #28a745; 
        --proloc-shadow: rgba(0, 0, 0, 0.12);
        --proloc-bg: #f5f6f7;
    }
    .form-container {
        max-width: 800px; /* Légèrement réduit car moins de champs */
        margin: 40px auto;
        padding: 40px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 20px var(--proloc-shadow);
    }
    .header-branding {
        text-align: center;
        margin-bottom: 30px;
    }
    .header-branding h1 {
        font-weight: 600;
        color: #343a40;
        font-size: 2.2rem;
    }
    .header-branding p {
        color: #6c757d;
        font-size: 1.1rem;
    }
    .section-title {
        border-bottom: 2px solid var(--proloc-primary);
        padding-bottom: 5px;
        margin-top: 35px;
        margin-bottom: 25px;
        font-weight: 500;
        color: var(--proloc-primary);
        font-size: 1.3rem;
    }
    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 12px 15px;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--proloc-primary);
        box-shadow: 0 0 0 0.2rem rgba(21, 121, 227, 0.25);
    }
    .btn-submit {
        background-color: var(--proloc-primary);
        border: none;
        color: white;
        padding: 15px 30px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        transition: background-color 0.3s, transform 0.1s;
    }
    .btn-submit:hover {
        background-color: #1059b0;
        transform: translateY(-1px);
    }
</style>

<div class="form-container">
    <div class="header-branding">
        <h1 class="mb-2">Demande de Devis <span style="color: var(--proloc-primary);">ProLocAuto</span></h1>
        <p>L'espace pensé pour les **Auto-entrepreneurs**.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('commercial.store_devis') }}">
        @csrf 

        <h3 class="section-title">1. Vos Coordonnées (Auto-entrepreneur)</h3>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="client_name" class="form-label">Nom et Prénom <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="client_name" name="client_name" required value="{{ old('client_name') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="company_name" class="form-label">Nom Commercial / Activité</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email Professionnel <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>
        </div>

        <h3 class="section-title">2. Votre Besoin en Coworking (Loc)</h3>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="space_type" class="form-label">Type d'Espace Souhaité <span class="text-danger">*</span></label>
                <select class="form-select" id="space_type" name="space_type" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="nomade" {{ old('space_type') == 'nomade' ? 'selected' : '' }}>Poste Nomade (Flex Desk)</option>
                    <option value="dedie" {{ old('space_type') == 'dedie' ? 'selected' : '' }}>Poste Dédié</option>
                    <option value="bureau_prive" {{ old('space_type') == 'bureau_prive' ? 'selected' : '' }}>Bureau Privé (1-2 pers.)</option>
                    <option value="salle_reunion" {{ old('space_type') == 'salle_reunion' ? 'selected' : '' }}>Salle de Réunion (Ponctuel)</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="nb_people" class="form-label">Nombre de Postes Requis <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="nb_people" name="nb_people" min="1" required value="{{ old('nb_people', 1) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="duration" class="form-label">Fréquence/Durée Estimée <span class="text-danger">*</span></label>
                <select class="form-select" id="duration" name="duration" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="journee" {{ old('duration') == 'journee' ? 'selected' : '' }}>Forfait Journée</option>
                    <option value="mensuel" {{ old('duration') == 'mensuel' ? 'selected' : '' }}>Abonnement Mensuel (Régulier)</option>
                    <option value="ponctuel" {{ old('duration') == 'ponctuel' ? 'selected' : '' }}>Usage Ponctuel (Heure/Demi-journée)</option>
                    <option value="trimestriel" {{ old('duration') == 'trimestriel' ? 'selected' : '' }}>Abonnement Trimestriel</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Date de Démarrage Souhaitée <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="start_date" name="start_date" required value="{{ old('start_date') }}">
            </div>
        </div>
        
        <h3 class="section-title">3. Votre Projet</h3>

        <div class="mb-4">
            <label for="additional_notes" class="form-label">Décrivez brièvement votre activité et vos besoins spécifiques (domiciliation, accès 24/7, besoin de salles, etc.)</label>
            <textarea class="form-control" id="additional_notes" name="additional_notes" rows="4">{{ old('additional_notes') }}</textarea>
        </div>
        
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-submit">
                Recevoir Mon Devis ProLocAuto
            </button>
        </div>

        <p class="text-center mt-3 text-muted" style="font-size: 0.8rem;">* Nous vous garantissons une réponse personnalisée sous 24h ouvrées.</p>

    </form>
</div>

@endsection