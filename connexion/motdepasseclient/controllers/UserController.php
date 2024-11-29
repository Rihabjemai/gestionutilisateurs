<?php
// Inclure le modèle User
require_once '../models/User.php';

// Vérifier si les données sont envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées en JSON
    $input = json_decode(file_get_contents('php://input'), true);

    // Vérifier si les données nécessaires sont présentes
    if (isset($input['email'], $input['oldPassword'], $input['newPassword'])) {
        $email = $input['email'];
        $oldPassword = $input['oldPassword'];
        $newPassword = $input['newPassword'];

        // Créer une instance de la classe User
        $user = new User();

        // Vérifier dans la table clients
        $existingUser = $user->verifyUserInClients($email, $oldPassword);

        // Vérifier dans la table formateurs si l'utilisateur n'existe pas dans clients
        if (!$existingUser) {
            $existingUser = $user->verifyUserInFormateurs($email, $oldPassword);
        }

        if ($existingUser) {
            // Si l'utilisateur existe, mettre à jour le mot de passe dans la bonne table
            if (isset($existingUser['motDePasse'])) {
                $user->updatePasswordInClients($email, $newPassword);
            } else {
                $user->updatePasswordInFormateurs($email, $newPassword);
            }

            echo json_encode(['success' => true, 'message' => 'Mot de passe mis à jour avec succès.']);
        } else {
            // Si l'utilisateur n'est pas trouvé ou les informations sont incorrectes
            echo json_encode(['success' => false, 'message' => 'Email ou ancien mot de passe incorrect.']);
        }
    } else {
        // Si les données sont manquantes
        echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
    }
}
