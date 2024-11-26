<?php
require "config2.php";

class FormateurC
{
    // Liste tous les formateurs
    public function listtrainer()
    {
        $sql = "SELECT * FROM formateurs"; 
        $db = config::getConnection();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Supprime un formateur par ID
    public function deletetrainer($id)
    {
        $sql = "DELETE FROM formateurs WHERE id = :id"; 
        $db = config::getConnection();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
            // Vérification que la suppression a bien eu lieu
            if ($req->rowCount() > 0) {
                echo "Formateur supprimé avec succès.";
            } else {
                echo "Aucun formateur trouvé avec cet ID.";
            }
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Ajoute un nouveau formateur
    public function addTrainer($trainer)
{
    $sql = "INSERT INTO formateurs (nom, prenom, email, motdepasse, specialite, experience, adresse) 
            VALUES (:nom, :prenom, :email, :motdepasse, :specialite, :experience, :adresse)";
    $db = config::getConnection();

    try {
        // Préparez la requête
        $query = $db->prepare($sql); 

        // Hachage du mot de passe (si nécessaire)
        $hashedPassword = password_hash($trainer->getMotdepasse(), PASSWORD_DEFAULT);

        // Exécutez la requête avec les paramètres
        $query->execute([
            'nom' => $trainer->getNom(),
            'prenom' => $trainer->getPrenom(),
            'email' => $trainer->getEmail(),
            'motdepasse' => $hashedPassword, // Utilisez un mot de passe sécurisé
            'specialite' => $trainer->getSpecialite(),
            'experience' => $trainer->getExperience(),
            'adresse' => $trainer->getAdresse(),
        ]);
        echo "Formateur ajouté avec succès.";
    } catch (Exception $e) {
        echo 'Erreur: ' . $e->getMessage();
        echo ' Trace: ' . $e->getTraceAsString(); // Afficher la trace complète pour plus d'informations
    }
}

    // Affiche un formateur spécifique par ID
    public function showtrainer($id)
    {
        $sql = "SELECT * FROM formateurs WHERE id = :id"; 
        $db = config::getConnection();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Met à jour les informations d'un formateur
    public function updatetrainer($formateur, $id)
    {
        $sql = "UPDATE formateurs SET 
                nom = :nom, 
                prenom = :prenom, 
                email = :email, 
                motdepasse = :motdepasse, 
                specialite = :specialite,
                experience = :experience, 
                adresse = :adresse 
                WHERE id = :id";

        $db = config::getConnection();
        try {
            $query = $db->prepare($sql);
            // Laissez le mot de passe en clair dans la requête pour les mises à jour uniquement si nécessaire
            $query->bindValue(':nom', $formateur->getNom());
            $query->bindValue(':prenom', $formateur->getPrenom());
            $query->bindValue(':email', $formateur->getEmail());
            $query->bindValue(':motdepasse', $formateur->getMotdepasse());  // Si vous ne voulez pas modifier le mot de passe, omettez cette ligne
            $query->bindValue(':specialite', $formateur->getSpecialite());
            $query->bindValue(':experience', $formateur->getExperience());
            $query->bindValue(':adresse', $formateur->getAdresse());
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            $query->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
