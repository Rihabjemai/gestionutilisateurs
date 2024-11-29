<?php

require "trainerc.php";

$c = new FormateurC();

// Récupérer le paramètre de tri (par défaut croissant)
$sort = isset($_GET['sort']) && $_GET['sort'] === 'desc' ? 'DESC' : 'ASC';

// Gestion de la recherche
$searchTerm = $_GET['search'] ?? null;

// Pagination
$limit = 1; // Nombre de formateurs par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

if ($searchTerm) {
    // Si un terme de recherche est défini, exécuter la recherche avec pagination et tri
    $tab = $c->searchTrainer($searchTerm, $start, $limit, $sort);
    if (empty($tab)) {
        $message = "Aucun formateur ne correspond à votre recherche.";
    }
    // Calculer le nombre total de formateurs après la recherche
    $totalFormateursCount = $c->countSearchResults($searchTerm);  // Nouvelle méthode pour compter les résultats de recherche
    $totalPages = ceil($totalFormateursCount / $limit);
} else {
    // Sinon, récupérer les formateurs avec pagination et tri
    $tab = $c->listTrainerPagination($start, $limit, $sort);  // Liste avec pagination et tri
    // Récupérer le nombre total de formateurs
    $totalFormateurs = $c->listtrainer(); // On récupère tous les formateurs
    $totalFormateursArray = $totalFormateurs->fetchAll(PDO::FETCH_ASSOC);
    $totalFormateursCount = count($totalFormateursArray);
    $totalPages = ceil($totalFormateursCount / $limit);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des formateurs</title>
    <style>
    /* Style pour la table */
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 20px 0;
        background-color: #808080; /* Gris pour la table (Code CSS num 1) */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        background-color: #FFD700; /* Jaune pour les en-têtes (Code CSS num 1) */
        color: #000; /* Texte noir pour les en-têtes */
    }

    /* Liens de pagination */
    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        margin: 0 5px;
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f2f2f2; /* Gris clair */
        color: #FFD700; /* Jaune pour les liens (Code CSS num 1) */
    }

    .pagination a.active {
        font-weight: bold;
        background-color: #dcdcdc; /* Gris clair au survol (Code CSS num 1) */
    }

    /* Ajouter un peu d'espace autour du contenu */
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #000000; /* Arrière-plan noir (Code CSS num 1) */
        color: #fff; /* Texte blanc (Code CSS num 1) */
    }

    a {
        text-decoration: none;
        color: #FFD700; /* Jaune pour les liens (Code CSS num 1) */
        font-weight: bold;
    }

    a:hover {
        color: #ffcc00; /* Légèrement plus clair au survol (Code CSS num 1) */
        text-decoration: underline;
    }
</style>
    
           
<body>

<center>
    <h1>Liste des formateurs</h1>

    <!-- Formulaire de recherche -->
    <form method="POST" action="listtrainer.php" class="search-trainer-form">
        <label for="search">Rechercher par nom ou prénom :</label>
        <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm); ?>" placeholder="Entrez un nom ou prénom">
        <input type="submit" name="update" value="rechercher">
        <input type="hidden" value="<?= htmlspecialchars($client['id']); ?>" name="id">
        
        <a href="javascript:void(0)" class="réinitialiser-trainer-button" data-id="<?= htmlspecialchars($client['id']); ?>">réinitialiser</a>
    </form>

    

    <!-- Message si aucun résultat -->
    <?php if (isset($message)) { ?>
        <p style="color: red;"><?= htmlspecialchars($message); ?></p>
    <?php } ?>

    
    <a href="javascript:void(0)" id="add-formateur-button">Ajouter un formateur</a>
    
    
        <!-- Ajouter des liens pour trier les formateurs -->
        <a href="javascript:void(0)" class="trier1-trainer-button">Trier par Nom (A-Z)</a>
        <a href="javascript:void(0)" class="trier2-trainer-button">Trier par Nom (Z-A)</a>
    
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
            <form method="POST" action="updatetrainer.php" class="update-trainer-form">
    <input type="submit" name="update" value="Modifier">
    <input type="hidden" value="<?= htmlspecialchars($formateur['id']); ?>" name="id">
</form>
            </td>
            <td>
            <a href="javascript:void(0)" class="delete-trainer-button" data-id="<?= htmlspecialchars($formateur['id']); ?>">Supprimer</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="javascript:void(0)" class="pagination-trainer-link" data-page="<?= $page - 1 ?>" data-sort="<?= $sort ?>" data-search="<?= htmlspecialchars($searchTerm) ?>">Précédent</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="javascript:void(0)" class="pagination-trainer-link <?= ($i == $page) ? 'active' : ''; ?>" data-page="<?= $i ?>" data-sort="<?= $sort ?>" data-search="<?= htmlspecialchars($searchTerm) ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="javascript:void(0)" class="pagination-trainer-link" data-page="<?= $page + 1 ?>" data-sort="<?= $sort ?>" data-search="<?= htmlspecialchars($searchTerm) ?>">Suivant</a>
    <?php endif; ?>
</div>



</body>
</html>
