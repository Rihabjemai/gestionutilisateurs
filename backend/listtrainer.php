<?php
require "trainerc.php";

// Création de l'objet formateurC et récupération de la liste des formateurs
$c = new FormateurC();
$tab = $c->listtrainer();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des formateurs</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #000000; /* Arrière-plan noir */
    color: #fff; /* Texte blanc */
    margin: 0;
    padding: 0;
}

h1, h2 {
    color: #FFD700; /* Jaune pour les titres */
    text-align: center;
    margin: 20px 0;
    animation: colorChange 3s infinite; /* Animation ajoutée */
}

@keyframes colorChange {
    0% {
        color: #FFD700; /* Jaune au début */
    }
    50% {
        color: #ffcc00; /* Jaune plus clair à mi-chemin */
    }
    100% {
        color: #28a745; /* Vert à la fin de l'animation */
    }
}

a {
    text-decoration: none;
    color: #FFD700; /* Jaune pour les liens */
    font-weight: bold;
}

a:hover {
    color: #ffcc00; /* Légèrement plus clair au survol */
    text-decoration: underline;
}

table {
    margin: 20px auto;
    border-collapse: collapse;
    width: 80%;
    background-color: #808080; /* Gris pour la table */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #FFD700; /* Jaune pour les en-têtes */
    color: #000; /* Texte noir pour les en-têtes */
}

tr {
    background-color: #808080; /* Gris pour toutes les lignes */
}

tr:hover {
    background-color: #dcdcdc; /* Gris clair au survol */
}

input[type="submit"] {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}

input[type="submit"]:hover {
    background-color: #218838;
}

td a {
    display: inline-block;
    padding


    </style>
   

       
           
</head>
<body>

<center>
    <h1>Liste des formateurs</h1>
    <h2>
        <a href="addTrainer.php">Ajouter un formateur</a>
    </h2>
</center>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Mot de passe</th>
        <th>Spécialité</th>
        <th>Expérience</th>
        <th>Adresse</th>
        <th>Mettre à jour</th>
        <th>Supprimer</th>
    </tr>

    <?php
    // Boucle pour afficher chaque formateur
    foreach ($tab as $formateur) {
    ?>
        <tr>
            <td><?= htmlspecialchars($formateur['id']); ?></td>
            <td><?= htmlspecialchars($formateur['nom']); ?></td>
            <td><?= htmlspecialchars($formateur['prenom']); ?></td>
            <td><?= htmlspecialchars($formateur['email']); ?></td>
            <td><?= htmlspecialchars($formateur['motdepasse']); ?></td>
            <td><?= htmlspecialchars($formateur['specialite']); ?></td>
            <td><?= htmlspecialchars($formateur['experience']); ?></td>
            <td><?= htmlspecialchars($formateur['adresse']); ?></td>
            <td align="center">
                <form method="POST" action="updatetrainer.php">
                    <input type="submit" name="update" value="Modifier">
                    <input type="hidden" value="<?= htmlspecialchars($formateur['id']); ?>" name="id">
                </form>
            </td>
            <td>
                <a href="deletetrainer.php?id=<?= htmlspecialchars($formateur['id']); ?>">Supprimer</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

</body>
</html>
