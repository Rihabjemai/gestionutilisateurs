<?php
require_once 'Models/UserModel.php';

class UserController {
    public function login() {
        // Vérifier si la méthode est POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->verifyUser($email, $password);

            if ($user) {
                session_start();
                $_SESSION['user'] = $user['nom'] . ' ' . $user['prenom'];
                $_SESSION['type'] = $user['type'];

                // Rediriger vers le tableau de bord après connexion
                header('Location: Views/dashboard.php');
                exit();
            } else {
                // Afficher une erreur en cas de connexion échouée
                $error = "Email ou mot de passe incorrect.";
                require 'Views/error.php';
            }
        } else {
            // Affiche le formulaire de connexion
            require 'Views/login.php';
        }
    }
}
?>
