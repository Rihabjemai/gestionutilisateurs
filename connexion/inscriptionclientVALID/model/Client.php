<?php
class Client {
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $motDePasse;
    public $telephone;
    public $adresse;

    // Le constructeur de la classe
    public function __construct($nom, $prenom, $email, $motDePasse, $telephone, $adresse) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
    }
}
?>
