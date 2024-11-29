<?php
require_once '../config.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }

    // Vérifier si l'utilisateur existe avec l'email et l'ancien mot de passe (clients)
    public function verifyUserInClients($email, $oldPassword)
    {
        $query = $this->db->prepare('SELECT * FROM clients WHERE email = :email AND motDePasse = :motDePasse');
        $query->execute([
            'email' => $email,
            'motDePasse' => $oldPassword,
        ]);
        return $query->fetch();
    }

    // Vérifier si l'utilisateur existe avec l'email et l'ancien mot de passe (formateurs)
    public function verifyUserInFormateurs($email, $oldPassword)
    {
        $query = $this->db->prepare('SELECT * FROM formateurs WHERE email = :email AND motdepasse = :motdepasse');
        $query->execute([
            'email' => $email,
            'motdepasse' => $oldPassword,
        ]);
        return $query->fetch();
    }

    // Mettre à jour le mot de passe dans la table clients
    public function updatePasswordInClients($email, $newPassword)
    {
        $query = $this->db->prepare('UPDATE clients SET motDePasse = :motDePasse WHERE email = :email');
        $query->execute([
            'motDePasse' => $newPassword,
            'email' => $email,
        ]);
    }

    // Mettre à jour le mot de passe dans la table formateurs
    public function updatePasswordInFormateurs($email, $newPassword)
    {
        $query = $this->db->prepare('UPDATE formateurs SET motdepasse = :motdepasse WHERE email = :email');
        $query->execute([
            'motdepasse' => $newPassword,
            'email' => $email,
        ]);
    }
}
