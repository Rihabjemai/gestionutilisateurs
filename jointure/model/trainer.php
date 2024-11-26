<?php
class Formateur {
    // Attributs privés
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $motdepasse;
    private $specialite;
    private $experience;
    public $adresse;

    // Constructeur
    public function __construct($id = null, $nom,$prenom, $email,$motdepasse, $specialite, $experience,$adresse) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->motdepasse = $motdepasse;
        $this->specialite = $specialite;
        $this->experience = $experience;
        $this->adresse= $adresse;
    }

    public function getId()
    {
        return $this->id;
    }


    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }


    public function setPrenom($prenom)
    {
        $this->prenom = $péenom;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getMotdepasse()
    {
        return $this->motdepasse;
    }


    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }
    public function getSpecialite()
    {
        return $this->specialite;
    }


    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }


    public function getExperience()
    {
        return $this->experience;
    }


    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }


    public function settAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }






   
        

    
}
?>
