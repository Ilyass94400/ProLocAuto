<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie | Espace Commercial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        /* Message NON LU : Blanc et Gras */
        .message-row.unread {
            background-color: #ffffff;
            font-weight: 700;
            color: #000;
            border-left: 4px solid #0d6efd; /* Petite barre bleue */
        }
        /* Message LU : Gris et Normal */
        .message-row.read {
            background-color: #f8f9fa;
            font-weight: 400;
            color: #6c757d;
            border-left: 4px solid transparent;
        }
        /* Curseur main pour montrer qu'on peut cliquer */
        .clickable-row {
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .clickable-row:hover {
            background-color: #f1f1f1 !important;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('commercial.dashboard') }}">
                <i class="fas fa-arrow-left me-2"></i> Retour Dashboard
            </a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">Messagerie</span>
                <form action="{{ route('commercial.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-inbox text-primary"></i> Boîte de réception</h1>
            <span class="badge bg-primary">{{ count($messages) }} messages</span>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%"></th>
                                <th style="width: 20%">Expéditeur</th>
                                <th style="width: 55%">Sujet & Aperçu</th>
                                <th style="width: 20%" class="text-end">Reçu le</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                                <!-- La ligne entière est cliquable -->
                                <tr id="row-{{ $message->id }}" 
                                    class="message-row clickable-row {{ $message->lu ? 'read' : 'unread' }}"
                                    onclick="openMessage({{ $message->id }})">
                                    
                                    <td class="text-center">
                                        <span id="icon-{{ $message->id }}">
                                            @if($message->lu)
                                                <i class="fas fa-envelope-open text-muted"></i>
                                            @else
                                                <i class="fas fa-envelope text-primary"></i>
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ $message->name }}</td>
                                    <td>
                                        <span class="text-primary">{{ $message->subject }}</span>
                                        <span class="text-muted small"> - {{ Str::limit($message->message, 50) }}</span>
                                        
                                        <!-- Bouton caché pour déclencher la modal -->
                                        <button id="btn-open-{{ $message->id }}" class="d-none" data-bs-toggle="modal" data-bs-target="#msgModal-{{ $message->id }}"></button>
                                    </td>
                                    <td class="text-end small">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                </tr>

                                <!-- MODAL DE LECTURE -->
                                <div class="modal fade" id="msgModal-{{ $message->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title">{{ $message->subject }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3 border-bottom pb-2">
                                                    <strong>De :</strong> {{ $message->name }} &lt;{{ $message->email }}&gt;<br>
                                                    <strong>Date :</strong> {{ $message->created_at->format('d/m/Y à H:i') }}
                                                </div>
                                                <div class="p-3 bg-light rounded" style="white-space: pre-wrap;">{{ $message->message }}</div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="mailto:{{ $message->email }}?subject=RE: {{ $message->subject }}" class="btn btn-primary">
                                                    <i class="fas fa-reply"></i> Répondre
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">Aucun message.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT D'ANIMATION -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openMessage(id) {
            // 1. Ouvrir la fenêtre modale
            document.getElementById('btn-open-' + id).click();

            // 2. Changer le style visuel (Griser)
            const row = document.getElementById('row-' + id);
            const icon = document.getElementById('icon-' + id);
            
            if (row.classList.contains('unread')) {
                row.classList.remove('unread');
                row.classList.add('read');
                icon.innerHTML = '<i class="fas fa-envelope-open text-muted"></i>'; // Changer l'icône

                // 3. Dire au serveur "C'est lu !"
                fetch(`/commercial/message/${id}/lu`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                });
            }
        }
    </script>
</body>
</html>