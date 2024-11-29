<?php
require_once __DIR__ . '/../config.php';



class UserModel {
    private $db;

    public function __construct() {
        $this->db = config::getConnection(); // Appel à la méthode statique

    }

    // Vérifier l'utilisateur
    public function verifyUser($email, $password) {
        $query = "SELECT * FROM (
                    SELECT id, nom, prenom, email, motDePasse, 'client' AS type FROM clients
                    UNION ALL
                    SELECT id, nom, prenom, email, motDePasse, 'formateur' AS type FROM formateurs
                  ) AS users
                  WHERE email = :email AND motDePasse = :password";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':email' => $email,
            ':password' => $password
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // Renvoie l'utilisateur ou false
    }
}
?>
