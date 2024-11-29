<?php 
require "trainerc.php";
require "trainer.php";

$error = "";

$formateurC = new formateurC();

if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["motdepasse"]) &&
    isset($_POST["specialite"]) &&
    isset($_POST["experience"]) &&
    isset($_POST["adresse"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["motdepasse"]) &&
        !empty($_POST["specialite"]) &&
        !empty($_POST["experience"]) &&
        !empty($_POST["adresse"])
    ) {
        // Création de l'objet formateur
        $formateur = new Formateur(
            null,
            $_POST['nom'],
            $_POST["prenom"],
            $_POST["email"],
            $_POST["motdepasse"],
            $_POST["specialite"],
            $_POST["experience"],
            $_POST["adresse"]
        );

        // Ajout du formateur dans la base de données
        $formateurC->addtrainer($formateur);

        // Redirection vers la liste des formateurs
        header('Location: index.html');
        exit();
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un formateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000000; /* Arrière-plan noir */
            color: #FFD700; /* Texte jaune */
            margin: 0;
            padding: 0;
        }

        a {
            display: inline-block;
            margin: 20px 0;
            text-decoration: none;
            color: #FFD700; /* Jaune pour les liens */
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
            color: #ffcc00; /* Jaune clair au survol */
        }

        form {
            max-width: 500px;
            margin: 40px auto;
            background: #000000; /* Fond noir pour le formulaire */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #FFD700; /* Bordure jaune */
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
            color: #FFD700; /* Jaune pour les labels */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #FFD700;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #FFFFFF; /* Fond blanc pour les champs de saisie */
            color: #000000; /* Texte noir pour les champs de saisie */
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #FFD700; /* Jaune lors du focus */
            outline: none;
            box-shadow: 0 0 4px rgba(255, 215, 0, 0.4); /* Légère ombre jaune au focus */
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #FFD700; /* Jaune pour les boutons */
            color: #000000; /* Texte noir */
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="reset"] {
            background-color: #6c757d; /* Gris pour le bouton réinitialiser */
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
            background-color: #ffcc00; /* Jaune clair au survol */
        }

        input[type="reset"]:hover {
            background-color: #5a6268; /* Gris foncé au survol */
        }

        span.error {
            color: red;
        }
    </style>
</head>
<body>
<a href="javascript:void(0)" id="Retour-button">Retour</a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form id="addtrainer" action="addtrainer.php" method="POST">
        <table>
            <tr>
                <td><label for="nom">Nom :</label></td>
                <td>
                    <input type="text" id="nom" name="nom"  />
                    <span id="nomError" class="error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="prenom">Prénom :</label></td>
                <td>
                    <input type="text" id="prenom" name="prenom"  />
                    <span id="prenomError" class="error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email :</label></td>
                <td>
                    <input type="email" id="email" name="email" />
                    <span id="emailError" class="error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="motdepasse">Mot de passe :</label></td>
                <td>
                    <input type="password" id="motdepasse" name="motdepasse"  />
                    <span id="motdepasseError" class="error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="specialite">Spécialité :</label></td>
                <td>
                    <input type="text" id="specialite" name="specialite"  />
                    <span id="specialiteError" class="error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="experience">Expérience :</label></td>
                <td>
                    <input type="text" id="experience" name="experience"  />
                    <span id="experienceError" class="error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="adresse">Adresse :</label></td>
                <td>
                    <input type="text" id="adresse" name="adresse"  />
                    <span id="adresseError" class="error"></span>
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
        document.getElementById('addtrainer').addEventListener('submit', function(event) {
            let isValid = true;

            // Réinitialisation des erreurs
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
            const motdepasse = document.getElementById('motdepasse').value;
            const motdepasseRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!motdepasseRegex.test(motdepasse)) {
                document.getElementById('motdepasseError').textContent = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.';
                isValid = false;
            }

            // Validation de la spécialité
            const specialite = document.getElementById('specialite').value.trim();
            if (specialite === '') {
                document.getElementById('specialiteError').textContent = 'La spécialité est obligatoire.';
                isValid = false;
            }

            // Validation de l'expérience
            const experience = document.getElementById('experience').value.trim();
            if (experience === '') {
                document.getElementById('experienceError').textContent = 'L\'expérience est obligatoire.';
                isValid = false;
            }

            // Validation de l'adresse
            const adresse = document.getElementById('adresse').value.trim();
            if (adresse === '') {
                document.getElementById('adresseError').textContent = 'L\'adresse est obligatoire.';
                isValid = false;
            }

            // Si validation échoue, empêcher l'envoi du formulaire
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
