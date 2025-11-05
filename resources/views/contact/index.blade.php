<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous | ProLocAuto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
    <style>
        :root {
            --primary-color: #007BFF;
            --text-color-dark: #333;
            --background-light: #f8f9fa;
            --border-color: #ddd;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-light);
            color: var(--text-color-dark);
        }
       
        .contact-container {
            max-width: 900px;
            margin: 100px auto 50px; /* Espace en haut pour la navbar */
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 10px;
        }

        .intro-text {
            text-align: center;
            margin-bottom: 40px;
            color: #6c757d;
        }

        .contact-info {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .info-card {
            text-align: center;
            padding: 20px;
            flex: 0 1 45%;
        }

        .info-card i {
            font-size: 2em;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .info-card p {
            margin: 5px 0;
            font-size: 1.1em;
            font-weight: bold;
        }

        /* Styles du Formulaire */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            box-sizing: border-box;
            font-family: inherit;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }
       
        .alert-success {
            padding: 15px;
            margin-bottom: 20px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.9em;
            display: block;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .contact-container {
                margin: 70px 20px 20px;
                padding: 20px;
            }
            .contact-info {
                flex-direction: column;
                gap: 20px;
            }
            .info-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    {{-- Pour garder le style cohérent, vous devriez inclure votre navbar ici --}}
    {{-- @include('layouts.navbar') --}}

    <div class="contact-container">
        <h1>Contactez ProLocAuto</h1>
        <p class="intro-text">Nous sommes là pour répondre à toutes vos questions concernant les réservations, les tarifs ou les visites d'espaces.</p>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="contact-info">
            <div class="info-card">
                <i class="fas fa-envelope"></i>
                <h3>Email Professionnel</h3>
                <p>contact@prolocauto.fr</p>
                <p>Notre équipe répond sous 24h.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-phone"></i>
                <h3>Service Client</h3>
                <p>+33 1 80 88 88 88</p>
                <p>Disponible de 9h à 18h, du lundi au vendredi.</p>
            </div>
        </div>
       
        <hr>

        <h2>Envoyez-nous un message</h2>
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Votre Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Votre Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
                @error('subject') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                @error('message') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Envoyer le message</button>
        </form>
    </div>

    {{-- N'oubliez pas d'inclure votre footer ici --}}
    {{-- @include('layouts.footer') --}}

</body>
</html>
