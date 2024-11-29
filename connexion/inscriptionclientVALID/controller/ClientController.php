<?php
include_once '../Model/Client.php';

class ClientController {
    public function registerUser($client) {
        // Connexion à la base de données (modifiez selon votre configuration)
        $pdo = new PDO('mysql:host=localhost;dbname=ClientPHP', 'root', '');

        // Requête d'insertion des données du client dans la base de données
        $query = "INSERT INTO clients (nom, prenom, email, motDePasse, telephone, adresse)
                  VALUES (:nom, :prenom, :email, :motDePasse, :telephone, :adresse)";
        $stmt = $pdo->prepare($query);

        // Exécution de la requête avec les données du client
        $stmt->execute([
            ':nom' => $client->nom,
            ':prenom' => $client->prenom,
            ':email' => $client->email,
            ':motDePasse' => $client->motDePasse,
            ':telephone' => $client->telephone,
            ':adresse' => $client->adresse
        ]);
    }
}
?>
