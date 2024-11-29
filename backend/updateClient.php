<?php
require "ClientC.php";
require "Client.php";

$error = "";
$client = null;
$clientC = new ClientC();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $client = $clientC->showclient($id);
    if (!$client) {
        echo "Client introuvable.";
        exit;
    }
} else {
    echo "ID de client non spécifié.";
    exit;
}

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
        $client = new Client(
            $_POST['id'],
            $_POST['nom'],
            $_POST["prenom"],
            $_POST["email"],
            $_POST["motDePasse"],
            $_POST["telephone"],
            $_POST["adresse"]
        );

        $clientC->updateclient($client, $id);
        header('Location: index.html');
        exit;
    } else {
        $error = "Tous les champs doivent être remplis.";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000000; /* Arrière-plan noir */
            color: #FFD700; /* Texte en jaune */
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
            color: #FFD700; /* Jaune pour les labels */
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
            background-color: #28a745; /* Vert pour les boutons */
            color: white;
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
            background-color: #218838; /* Vert foncé au survol */
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

    <?php if ($client): ?>
        <form id="updateForm" action="updateClient.php" method="POST">
        <table>
                <tr>
                    <td><label for="nom">Nom :</label></td>
                    <td><input type="text" id="nom" name="nom" value="<?= htmlspecialchars($client['nom']); ?>"  /></td>
                    <td><span id="nomError" class="error"></span></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom :</label></td>
                    <td><input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($client['prenom']); ?>"  /></td>
                    <td><span id="prenomError" class="error"></span></td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td><input type="email" id="email" name="email" value="<?= htmlspecialchars($client['email']); ?>" /></td>
                    <td><span id="emailError" class="error"></span></td>
                </tr>
                <tr>
                    <td><label for="motDePasse">Mot de passe :</label></td>
                    <td><input type="password" id="motDePasse" name="motDePasse" value="<?= htmlspecialchars($client['motDePasse']); ?>"  /></td>
                    <td><span id="motDePasseError" class="error"></span></td>
                </tr>
                <tr>
                    <td><label for="telephone">Téléphone :</label></td>
                    <td><input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($client['telephone']); ?>"  /></td>
                    <td><span id="telephoneError" class="error"></span></td>
                </tr>
                <tr>
                    <td><label for="adresse">Adresse :</label></td>
                    <td><input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($client['adresse']); ?>"  /></td>
                    <td><span id="adresseError" class="error"></span></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Mettre à jour">
                        <input type="reset" value="Réinitialiser">
                    </td>
                </tr>
            </table>
            <input type="hidden" name="id" value="<?= htmlspecialchars($client['id']); ?>" />
        </form>
    <?php else: ?>
        <p>Aucun client trouvé.</p>
    <?php endif; ?>

    <script>
        document.getElementById('updateForm').addEventListener('submit', function(event) {
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
            const motDePasse = document.getElementById('motDePasse').value;
            const motDePasseRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            if (motDePasse === '' || !motDePasseRegex.test(motDePasse)) {
                document.getElementById('motDePasseError').textContent = 'Le mot de passe doit contenir au moins 8 caractères, un chiffre, une lettre majuscule et un caractère spécial.';
                isValid = false;
            }

            // Validation du téléphone
            const telephone = document.getElementById('telephone').value.trim();
            const telephoneRegex = /^[0-9]{8}$/;
            if (telephone === '' || !telephoneRegex.test(telephone)) {
                document.getElementById('telephoneError').textContent = 'Veuillez entrer un numéro de téléphone valide.';
                isValid = false;
            }

            // Validation de l'adresse
            const adresse = document.getElementById('adresse').value.trim();
            if (adresse === '') {
                document.getElementById('adresseError').textContent = 'L\'adresse est obligatoire.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
