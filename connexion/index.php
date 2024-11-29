<?php
require_once 'Controllers/UserController.php';

// Récupérer l'action depuis l'URL
$action = $_GET['action'] ?? 'login'; // Par défaut, affiche la page de connexion

// Initialiser le contrôleur
$controller = new UserController();

// Gérer les actions
if ($action === 'login') {
    $controller->login();
} else {
    require 'Views/error.php'; // Affiche la page d'erreur pour les actions inconnues
}
?>
