<?php
require '../config.php';

class ClientC {
    public function listclient() {
        $sql = "SELECT * FROM clients";
        $db = config::getConnexion();
        try {
            return $db->query($sql)->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function deleteclient($id)
    {
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
}
?>
