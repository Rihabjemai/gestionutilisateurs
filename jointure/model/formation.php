<?php
require_once '../config.php';  // Fichier de configuration pour la connexion à la base de données


class Formation {
    private $idFormation;
    private $idClient;
    private $idFormateur;
    private $dateFormation;

    // Constructeur
    public function __construct($idFormation = null, $idClient = null, $idFormateur = null, $dateFormation = null) {
        $this->idFormation = $idFormation;
        $this->idClient = $idClient;
        $this->idFormateur = $idFormateur;
        $this->dateFormation = $dateFormation;
    }

    // Méthode pour récupérer toutes les formations
    public static function getAllFormations() {
        $sql = "SELECT * FROM formations";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Méthode pour récupérer les formations par client
    public static function getFormationsByClient($idClient) {
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

    // Méthode pour ajouter une formation
    public static function addFormation($idClient, $idFormateur, $dateFormation) {
        $sql = "INSERT INTO formations (idClient, idFormateur, dateFormation) VALUES (:idClient, :idFormateur, :dateFormation)";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idClient' => $idClient,
                'idFormateur' => $idFormateur,
                'dateFormation' => $dateFormation
            ]);
            return true;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Méthode pour supprimer une formation
    public static function deleteFormation($idFormation) {
        $sql = "DELETE FROM formations WHERE idFormation = :idFormation";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['idFormation' => $idFormation]);
            return true;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Méthode pour mettre à jour une formation
    public static function updateFormation($idFormation, $idClient, $idFormateur, $dateFormation) {
        $sql = "UPDATE formations SET idClient = :idClient, idFormateur = :idFormateur, dateFormation = :dateFormation WHERE idFormation = :idFormation";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idFormation' => $idFormation,
                'idClient' => $idClient,
                'idFormateur' => $idFormateur,
                'dateFormation' => $dateFormation
            ]);
            return true;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
