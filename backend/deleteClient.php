<?php
require "ClientC.php";


// Instanciation de l'objet formateurC
$clientC = new ClientC();

// Vérification de la présence de l'ID dans l'URL avant de tenter la suppression
if (isset($_GET["id"])) {
    $clientC->deleteclient($_GET["id"]);
    // Redirection après suppression
    header('Location: listClients.php');
    exit();  // Pour éviter l'exécution supplémentaire après la redirection
} else {
    echo "Aucun ID de formateur spécifié.";
}
?>
