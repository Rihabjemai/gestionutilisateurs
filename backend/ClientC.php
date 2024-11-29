<?php
require "config.php";

class ClientC {

    // Fonction pour récupérer tous les clients
    public function listclient() {
        $sql = "SELECT * FROM clients";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    // Fonction pour récupérer les clients avec pagination et tri
    public function listclientPagination($start, $limit, $sort = 'asc') {
        // Valider le paramètre $sort pour qu'il soit 'asc' ou 'desc'
        $sort = ($sort === 'desc') ? 'desc' : 'asc';
    
        // Requête SQL pour récupérer les clients triés
        $sql = "SELECT * FROM clients ORDER BY nom " . $sort . " LIMIT :start, :limit";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':start', $start, PDO::PARAM_INT);
            $query->bindValue(':limit', $limit, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    // Méthode pour supprimer un client par ID
    public function deleteclient($id) {
        $sql = "DELETE FROM clients WHERE id = :id"; 
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
            // Vérification que la suppression a bien eu lieu
            if ($req->rowCount() > 0) {
                echo "client supprimé avec succès.";
            } else {
                echo "Aucun client trouvé avec cet ID.";
            }
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Méthode pour ajouter un client
    public function addClient($client) {
        $sql = "INSERT INTO clients (nom, prenom, email, motDePasse, telephone, adresse) 
                VALUES (:nom, :prenom, :email, :motDePasse, :telephone, :adresse)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':nom' => $client->getNom(),
                ':prenom' => $client->getPrenom(),
                ':email' => $client->getEmail(),
                ':motDePasse' => password_hash($client->getMotDePasse(), PASSWORD_DEFAULT),
                ':telephone' => $client->getTelephone(),
                ':adresse' => $client->getAdresse(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Méthode pour mettre à jour un client
    public function updateclient($client, $id) {
        $sql = "UPDATE clients SET nom = :nom, prenom = :prenom, email = :email, motDePasse = :motDePasse, telephone = :telephone, adresse = :adresse WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $id,
                ':nom' => $client->getNom(),
                ':prenom' => $client->getPrenom(),
                ':email' => $client->getEmail(),
                ':motDePasse' => password_hash($client->getMotDePasse(), PASSWORD_DEFAULT),
                ':telephone' => $client->getTelephone(),
                ':adresse' => $client->getAdresse(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Méthode pour afficher les détails d'un client par ID
    public function showclient($id) {
        $sql = "SELECT * FROM clients WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    public function searchClient($searchTerm) {
        $sql = "SELECT * FROM clients WHERE nom LIKE :search OR prenom LIKE :search";
        $db = config::getConnexion(); // Utilisation correcte de config::getConnexion()
        try {
            $query = $db->prepare($sql);
            $query->execute(['search' => '%' . $searchTerm . '%']);
            return $query->fetchAll(); // Retourne les clients correspondant au critère de recherche
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    

}
?>
