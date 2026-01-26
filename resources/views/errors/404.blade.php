<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Introuvable | ProLocAuto</title>
    <!-- On garde Bootstrap pour la cohérence -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #007BFF;
            --background-light: #f4f7f6;
            --text-color: #333;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-light);
            color: var(--text-color);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin: 0;
        }

        .error-container {
            background: white;
            padding: 60px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            max-width: 600px;
            width: 90%;
            position: relative;
            overflow: hidden;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 40px;
        }

        .btn-home {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-home:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
            color: white;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        
        .decoration-icon {
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 10rem;
            color: rgba(0, 123, 255, 0.05);
            transform: rotate(15deg);
        }
    </style>
</head>
<body>

    <div class="error-container">
        
    
        <i class="fas fa-search decoration-icon"></i>

        <div class="error-code">404</div>
        <h2>Oups !</h2>
        <p>Désolé, il n'y a rien à voir ici.<br>La page que vous recherchez n'existe pas ou a été déplacée.</p>

        <a href="{{ url('/') }}" class="btn-home">
            <i class="fas fa-home me-2"></i> Retour à l'accueil
        </a>
    </div>

</body>
</html>