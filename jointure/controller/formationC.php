<?php

require_once '../config.php';

require_once '../model/formation.php';

class formationC {
    // Méthode pour afficher les formations par client
    function afficherFormationsParClient($idClient) {
        $sql = "SELECT f.idFormation, f.dateFormation, c.nom AS nomClient, c.prenom AS prenomClient, frm.nom AS nomFormateur, frm.prenom AS prenomFormateur
                FROM formations f
                INNER JOIN clients c ON f.idClient = c.id
                INNER JOIN formateurs frm ON f.idFormateur = frm.id
                WHERE f.idClient = :idClient";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['idClient' => $idClient]);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
