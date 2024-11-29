LISTCLIENT <?php
require "ClientC.php";

$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1; // Assurez-vous que la page est positive
$clientsParPage = 2;
$start = ($page - 1) * $clientsParPage;

$sort = isset($_GET['sort']) && ($_GET['sort'] === 'desc') ? 'desc' : 'asc';

// Initialisation des variables pour la recherche
$searchTerm = isset($_GET['search']) ? htmlspecialchars(trim($_GET['search'])) : "";

// Création de l'objet ClientC
$c = new ClientC();

// Si une recherche est effectuée, filtrer les résultats
if (!empty($searchTerm)) {
    $tab = $c->searchClient($searchTerm); // Méthode pour rechercher des clients
    $totalClients = count($tab); // Nombre total de résultats trouvés
} else {
    // Si pas de recherche, on récupère les clients paginés
    $tab = $c->listclientPagination($start, $clientsParPage, $sort);
    $totalClients = count($c->listclient()); // Nombre total de clients
}

$totalPages = ceil($totalClients / $clientsParPage); // Calculer le nombre de pages
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
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

    /*  de pagination */
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

</head>
<body>

    <center>
        <h1>Liste des Clients</h1>
        
        <a href="javascript:void(0)" id="add-client-button">Ajouter un client</a>
    </center>

    <!-- Formulaire de recherche -->
    <form method="POST" action="listClients.php" class="search-client-form">
        <label for="search">Rechercher par nom ou prénom :</label>
        <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm); ?>" placeholder="Entrez un nom ou prénom">
        <input type="submit" name="update" value="rechercher">
        <input type="hidden" value="<?= htmlspecialchars($client['id']); ?>" name="id">
        
        <a href="javascript:void(0)" class="réinitialiser-client-button" data-id="<?= htmlspecialchars($client['id']); ?>">réinitialiser</a>
    </form>


    
    <div>
    <!-- Liens pour le tri -->
    <a href="javascript:void(0)" class="trier1-client-button">Trier par Nom (A-Z)</a>
    |
    <a href="javascript:void(0)" class="trier2-client-button">Trier par Nom (Z-A)</a>
</div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Mot de passe</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Mettre à jour</th>
            <th>Supprimer</th>
        </tr>

        <?php
        if ($totalClients > 0) {
            // Boucle pour afficher chaque client
            foreach ($tab as $client) {
        ?>
            <tr>
                <td><?= htmlspecialchars($client['id']); ?></td>
                <td><?= htmlspecialchars($client['nom']); ?></td>
                <td><?= htmlspecialchars($client['prenom']); ?></td>
                <td><?= htmlspecialchars($client['email']); ?></td>
                <td><?= htmlspecialchars($client['motDePasse']); ?></td>
                <td><?= htmlspecialchars($client['telephone']); ?></td>
                <td><?= htmlspecialchars($client['adresse']); ?></td>
                <td>
                    

                    <form method="POST" action="updateclient.php" class="update-client-form">
    <input type="submit" name="update" value="Modifier">
    <input type="hidden" value="<?= htmlspecialchars($client['id']); ?>" name="id">
</form>
                </td>
                <td>
                <a href="javascript:void(0)" class="delete-client-button" data-id="<?= htmlspecialchars($client['id']); ?>">Supprimer</a>
                </td>
            </tr>
        <?php
            }
        } else {
            // Si aucun client trouvé
            echo "<tr><td colspan='9'>Aucun client ne correspond à votre recherche.</td></tr>";
        }
        ?>
    </table>

    <!-- Liens de pagination -->
    <div class="pagination">
    <?php
    // Afficher les liens de pagination uniquement si pas de recherche
    if (empty($searchTerm)) {
        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $page) ? 'active' : '';
            echo '<a href="javascript:void(0);" class="pagination-link ' . $activeClass . '" data-page="' . $i . '" data-sort="' . $sort . '">' . $i . '</a>';
        }
    }
    ?>
</div>


</body>
</html>
