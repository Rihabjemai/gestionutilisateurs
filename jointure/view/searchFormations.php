<?php
// Inclure le fichier clientC.php à l'aide du bon chemin relatif
require_once '../controller/ClientC.php';  // Chemin relatif correct pour inclure le contrôleur

$clientC = new ClientC();  // Crée une instance du contrôleur ClientC
$clients = $clientC->listclient();  // Récupère tous les clients de la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de sélection de client</title>

    <style>
        /* Style général de la page */
        body {
            background-color: #000000; /* Fond noir */
            font-family: Arial, sans-serif;
            color: #fff;  /* Texte blanc */
            margin: 0;
            padding: 0;
            height: 100vh;  /* Hauteur de la fenêtre */
            display: flex;
            justify-content: center; /* Centrer horizontalement */
            align-items: center; /* Centrer verticalement */
        }

        /* Style du formulaire */
        form {
            background-color: #333333; /* Fond gris foncé pour le formulaire */
            border: 1px solid #fff;  /* Bordure blanche */
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Ombre subtile */
        }

        /* Style du label */
        label {
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
            color: #FFD700;  /* Jaune pour le label */
        }

        /* Style du select (menu déroulant) */
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #555; /* Gris foncé */
            color: #fff;  /* Texte blanc */
        }

        /* Style du bouton de soumission */
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #FFD700;  /* Jaune pour le bouton */
            color: black;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FFA500;  /* Jaune plus clair lors du survol */
        }

        /* Style des options du select */
        option {
            padding: 10px;
            background-color: #555; /* Gris foncé pour les options */
        }

        /* Style pour le message d'absence de client */
        option {
            color: #FFD700; /* Jaune pour le message "Aucun client trouvé" */
        }
    </style>
</head>
<body>
    <form method="POST" action="resultFormations.php">
        <label for="idClient">Sélectionnez un client :</label>
        <select name="idClient">
            <?php
            // Vérifie si des clients ont été récupérés
            if ($clients) {
                foreach ($clients as $client) {
                    echo "<option value='{$client['id']}'>{$client['nom']} {$client['prenom']}</option>";
                }
            } else {
                echo "<option>Aucun client trouvé</option>";
            }
            ?>
        </select>
        <input type="submit" value="Voir Formations">
    </form>
</body>
</html>
