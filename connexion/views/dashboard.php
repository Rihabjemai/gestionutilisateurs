<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Tableau de bord</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .welcome-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1.welcome {
            font-size: 2.5em;
            color: #6c63ff;
            margin-bottom: 20px;
        }

        h1.welcome span {
            display: inline-block;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        h1.welcome span:nth-child(1) { animation-delay: 0.1s; }
        h1.welcome span:nth-child(2) { animation-delay: 0.3s; }
        h1.welcome span:nth-child(3) { animation-delay: 0.5s; }
        h1.welcome span:nth-child(4) { animation-delay: 0.7s; }
        h1.welcome span:nth-child(5) { animation-delay: 0.9s; }
        h1.welcome span:nth-child(6) { animation-delay: 1.1s; }
        h1.welcome span:nth-child(7) { animation-delay: 1.3s; }
        h1.welcome span:nth-child(8) { animation-delay: 1.5s; }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        p {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            font-size: 1em;
            font-weight: bold;
            color: #6c63ff;
            padding: 10px 20px;
            border: 2px solid #6c63ff;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        a:hover {
            background-color: #6c63ff;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1 class="welcome">
            <span>B</span><span>i</span><span>e</span><span>n</span><span>v</span><span>e</span><span>n</span><span>u</span><span>e</span>
        </h1>
        <?php
        session_start();
        if (isset($_SESSION['user'])) {
            echo "<p>Bonjour, " . htmlspecialchars($_SESSION['user']) . " ! Nous sommes ravis de vous voir ici.</p>";
            echo '<a href="votre_site.php">Accéder au site</a>';
        } else {
            echo "<p>Accès refusé. Veuillez vous connecter pour continuer.</p>";
            echo '<a href="connexion.php">Se connecter</a>';
        }
        ?>
    </div>
</body>
</html>
