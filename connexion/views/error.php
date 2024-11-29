<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur d'authentification</title>
    <style>
        /* Arrière-plan de la page */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('background.jpg'); /* Remplacez 'background.jpg' par le chemin de votre image */
            background-size: cover;
            background-position: center;
        }

        /* Conteneur de l'erreur */
        .error-container {
            background: rgba(255, 255, 255, 0.9); /* Fond blanc semi-transparent */
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .error-container h1 {
            font-size: 2.5em;
            color: #e74c3c; /* Rouge vif pour attirer l'attention */
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .error-container p {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 20px;
            line-height: 1.6;
            animation: fadeIn 2s ease-in-out;
        }

        .error-container a {
            display: inline-block;
            text-decoration: none;
            font-size: 1em;
            color: white;
            background-color: #e74c3c;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            animation: fadeIn 2.5s ease-in-out;
        }

        .error-container a:hover {
            background-color: #c0392b;
        }

        /* Animation pour les éléments */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Oups !</h1>
        <p>
            L'adresse e-mail ou le mot de passe est incorrect.<br>
            Vérifiez vos informations et essayez à nouveau.
        </p>
        <a href="connexion.php">Retour à la page de connexion</a>
    </div>
</body>
</html>
