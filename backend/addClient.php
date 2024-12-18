<?php
require "ClientC.php";
require "Client.php";

$error = "";

$clientC = new ClientC();

if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["motDePasse"]) &&
    isset($_POST["telephone"]) &&
    isset($_POST["adresse"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["motDePasse"]) &&
        !empty($_POST["telephone"]) &&
        !empty($_POST["adresse"])
    ) {
        // Création de l'objet client
        $client = new Client(
            null,
            $_POST['nom'],
            $_POST["prenom"],
            $_POST["email"],
            $_POST["motDePasse"],
            $_POST["telephone"],
            $_POST["adresse"]
        );

        // Ajout du client dans la base de données
        $clientC->addClient($client);

        // Redirection vers la liste des clients
        header('Location: index.html');
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #000000; /* Black background */
        color: #FFD700; /* Yellow text color */
        margin: 0;
        padding: 0;
    }

    a {
        display: inline-block;
        margin: 20px 0;
        text-decoration: none;
        color: #FFD700; /* Yellow for links */
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
        color: #ffcc00; /* Light yellow on hover */
    }

    form {
        max-width: 500px;
        margin: 40px auto;
        background: #000000; /* Black background for the form */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: #FFD700; /* Yellow text inside form */
        border: 1px solid #FFD700; /* Bordure jaune autour du formulaire */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 10px;
        vertical-align: top;
    }

    label {
        font-weight: bold;
        color: #FFD700; /* Yellow for labels */
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-top: 4px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: white; /* White background for inputs */
        color: #000; /* Black text in inputs */
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #FFD700; /* Yellow border on focus */
        outline: none;
        box-shadow: 0 0 4px rgba(255, 215, 0, 0.4); /* Light yellow shadow on focus */
    }

    input[type="submit"],
    input[type="reset"] {
        background-color: #FFD700; /* Yellow for buttons */
        color: black;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    input[type="reset"] {
        background-color: #6c757d; /* Gray for reset button */
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
        opacity: 0.9;
    }

    .error {
        font-size: 12px;
        color: red;
        margin-top: 5px;
        display: block;
    }

    #error {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }

    input[type="submit"]:hover {
        background-color: #e0a800; /* Dark yellow on hover */
    }

    input[type="reset"]:hover {
        background-color: #5a6268; /* Dark gray on hover */
    }

    span.error {
        color: red;
    }
    </style>
</head>
<body>
    <a href="javascript:void(0)" id="Retour-button">Retour</a>
    <hr>

    <div id="error" style="color: red;">
        <?php echo $error; ?>
    </div>

    <form id="ajoutForm" action="addClient.php" method="POST">
        <table>
            <tr>
                <td><label for="nom">Nom :</label></td>
                <td>
                    <input type="text" id="nom" name="nom" />
                    <span id="nomError" class="error" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <td><label for="prenom">Prénom :</label></td>
                <td>
                    <input type="text" id="prenom" name="prenom" />
                    <span id="prenomError" class="error" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email :</label></td>
                <td>
                    <input type="email" id="email" name="email" />
                    <span id="emailError" class="error" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <td><label for="motDePasse">Mot de passe :</label></td>
                <td>
                    <input type="password" id="motDePasse" name="motDePasse" />
                    <span id="motDePasseError" class="error" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <td><label for="telephone">Téléphone :</label></td>
                <td>
                    <input type="text" id="telephone" name="telephone" />
                    <span id="telephoneError" class="error" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <td><label for="adresse">Adresse :</label></td>
                <td>
                    <input type="text" id="adresse" name="adresse" />
                    <span id="adresseError" class="error" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Enregistrer">
                    <input type="reset" value="Réinitialiser">
                </td>
            </tr>
        </table>
    </form>

    <script>
        document.getElementById('ajoutForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Reset des erreurs
            document.querySelectorAll('.error').forEach(error => error.textContent = '');

            // Validation du nom
            const nom = document.getElementById('nom').value.trim();
            if (nom === '') {
                document.getElementById('nomError').textContent = 'Le nom est obligatoire.';
                isValid = false;
            }

            // Validation du prénom
            const prenom = document.getElementById('prenom').value.trim();
            if (prenom === '') {
                document.getElementById('prenomError').textContent = 'Le prénom est obligatoire.';
                isValid = false;
            }

            // Validation de l'email
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '' || !emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Veuillez entrer un email valide.';
                isValid = false;
            }

            // Validation du mot de passe
            const motDePasse = document.getElementById('motDePasse').value;
            const motDePasseRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!motDePasseRegex.test(motDePasse)) {
                document.getElementById('motDePasseError').textContent = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole.';
                isValid = false;
            }

            // Validation du téléphone
            const telephone = document.getElementById('telephone').value.trim();
            const telephoneRegex = /^\d{8}$/;
            if (!telephoneRegex.test(telephone)) {
                document.getElementById('telephoneError').textContent = 'Le téléphone doit contenir exactement 8 chiffres.';
                isValid = false;
            }

            // Validation de l'adresse
            const adresse = document.getElementById('adresse').value.trim();
            if (adresse === '') {
                document.getElementById('adresseError').textContent = 'L\'adresse est obligatoire.';
                isValid = false;
            }

            // Si les validations échouent, on empêche l'envoi du formulaire
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
