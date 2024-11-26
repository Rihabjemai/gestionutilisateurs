<?php
if (isset($_POST['idClient'])) {
    require_once '../controller/formationC.php';
    $formationC = new formationC();
    $formations = $formationC->afficherFormationsParClient($_POST['idClient']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formations du client</title>

    <style>
        /* Style général de la page */
        body {
            background-color: #000000; /* Fond noir */
            font-family: Arial, sans-serif;
            color: #fff;  /* Texte blanc */
            margin: 0;
            padding: 20px;
            height: 100vh;  /* Hauteur de la fenêtre */
            display: flex;
            justify-content: center; /* Centrer horizontalement */
            align-items: center; /* Centrer verticalement */
            flex-direction: column;
        }

        /* Style du titre avec animation */
        h2 {
            text-align: center;
            color: #FFD700;  /* Jaune pour le titre */
            margin-bottom: 20px;
            opacity: 0;  /* Initialement invisible */
            transform: translateY(-50px); /* Déplacé vers le haut */
            animation: slideIn 1s forwards; /* Animation de l'apparition du titre */
        }

        /* Animation du titre */
        @keyframes slideIn {
            to {
                opacity: 1; /* Rendre le titre visible */
                transform: translateY(0); /* Remettre le titre à sa position d'origine */
            }
        }

        /* Style du tableau */
        .formation-table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #333333; /* Gris foncé pour le fond du tableau */
            opacity: 0; /* Tableau invisible au début */
            animation: fadeIn 1s 1s forwards; /* Animation d'apparition du tableau */
        }

        /* Animation du tableau */
        @keyframes fadeIn {
            to {
                opacity: 1; /* Rendre le tableau visible */
            }
        }

        .formation-table th, .formation-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #fff;  /* Bordure blanche */
        }

        .formation-table th {
            background-color: #FFD700; /* Jaune pour les en-têtes */
            color: black;
        }

        .formation-table tr:nth-child(even) {
            background-color: #555; /* Gris foncé pour les lignes paires */
        }

        .formation-table tr:nth-child(odd) {
            background-color: #444; /* Gris plus foncé pour les lignes impaires */
        }

        .formation-table td {
            color: #fff;  /* Texte blanc dans les cellules */
        }
    </style>
</head>
<body>

    <!-- Titre avec animation -->
    <?php if (isset($formations) && !empty($formations)) { ?>
        <h2>Formations de ce client</h2>
        <table class="formation-table">
            <tr>
                <th>Formation ID</th>
                <th>Nom Client</th>
                <th>Prénom Client</th>
                <th>Nom Formateur</th>
                <th>Prénom Formateur</th>
                <th>Date Formation</th>
            </tr>
            <?php
            foreach ($formations as $formation) {
                echo "<tr>
                        <td>{$formation['idFormation']}</td>
                        <td>{$formation['nomClient']}</td>
                        <td>{$formation['prenomClient']}</td>
                        <td>{$formation['nomFormateur']}</td>
                        <td>{$formation['prenomFormateur']}</td>
                        <td>{$formation['dateFormation']}</td>
                    </tr>";
            }
            ?>
        </table>
    <?php } else { ?>
        <h2>Aucune formation disponible pour ce client</h2>
    <?php } ?>

</body>
</html>
