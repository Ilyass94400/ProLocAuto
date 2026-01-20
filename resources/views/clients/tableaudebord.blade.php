<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Informations | ProLocAuto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f8f9fa; font-family: 'Arial', sans-serif; }
        .info-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .info-label { color: #6c757d; font-size: 0.9em; text-transform: uppercase; letter-spacing: 1px; }
        .info-value { font-size: 1.2em; font-weight: bold; color: #333; }
        .btn-edit { background-color: #e9ecef; color: #495057; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: 0.3s; }
        .btn-edit:hover { background-color: #007BFF; color: white; }
    </style>
</head>
<body>

    <div class="container py-5">
        
        <!-- En-tête avec bouton retour -->
        <div class="d-flex align-items-center mb-5">
            <a href="{{ route('clients.mon-compte') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h1 class="mb-0 text-primary">Mes Informations Personnelles</h1>
        </div>

        <!-- Messages Flash -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <!-- CARTE NOM -->
                <div class="info-card">
                    <div>
                        <div class="info-label mb-1"><i class="fas fa-user me-2"></i>Nom Complet</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editInfoModal" title="Modifier">
                        <i class="fas fa-pen"></i>
                    </button>
                </div>

                <!-- CARTE EMAIL -->
                <div class="info-card">
                    <div>
                        <div class="info-label mb-1"><i class="fas fa-envelope me-2"></i>Adresse Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editInfoModal" title="Modifier">
                        <i class="fas fa-pen"></i>
                    </button>
                </div>

                <!-- CARTE MOT DE PASSE -->
                <div class="info-card">
                    <div>
                        <div class="info-label mb-1"><i class="fas fa-lock me-2"></i>Mot de passe</div>
                        <div class="info-value">••••••••••••</div>
                    </div>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPasswordModal" title="Modifier le mot de passe">
                        <i class="fas fa-pen"></i>
                    </button>
                </div>

                <div class="text-center mt-4 text-muted small">
                    Membre depuis le {{ $user->created_at->format('d/m/Y') }}
                </div>

            </div>
        </div>
    </div>

    <!-- ==================================== -->
    <!-- MODAL 1 : MODIFIER INFOS (Nom/Email) -->
    <!-- ==================================== -->
    <div class="modal fade" id="editInfoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Modifier mes informations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('clients.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom Complet</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Adresse Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================================== -->
    <!-- MODAL 2 : MODIFIER MOT DE PASSE      -->
    <!-- ==================================== -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Changer de mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('clients.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="alert alert-info small">
                            Le nouveau mot de passe doit contenir au moins 8 caractères.
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mot de passe actuel <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nouveau mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required minlength="8">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Confirmer le nouveau mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Changer le mot de passe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>