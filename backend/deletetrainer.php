<?php

require "trainerc.php";


// Instanciation de l'objet formateurC
$formateurC = new formateurC();

// Vérification de la présence de l'ID dans l'URL avant de tenter la suppression
if (isset($_GET["id"])) {
    $formateurC->deletetrainer($_GET["id"]);
    // Redirection après suppression
    header('Location: listtrainer.php');
    exit();  // Pour éviter l'exécution supplémentaire après la redirection
} else {
    echo "Aucun ID de formateur spécifié.";
}
?>
