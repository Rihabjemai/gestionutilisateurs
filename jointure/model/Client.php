<?php
class Client {
    private $id;
    private $nom;
    private $prenom; // Enlever l'accent pour éviter les conflits
    private $email;
    private $motDePasse;
    private $telephone;
    private $adresse;

    public function __construct($id = null, $nom = "", $prenom = "", $email = "", $motDePasse = "", $telephone = "", $adresse = "") {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; }
    public function getPrenom() { return $this->prenom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }
    public function getMotDePasse() { return $this->motDePasse; }
    public function setMotDePasse($motDePasse) { $this->motDePasse = $motDePasse; }
    public function getTelephone() { return $this->telephone; }
    public function setTelephone($telephone) { $this->telephone = $telephone; }
    public function getAdresse() { return $this->adresse; }
    public function setAdresse($adresse) { $this->adresse = $adresse; }
}
?>
