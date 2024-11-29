<?php
require "trainerc.php";
require "trainer.php";

$error = ""; // Initialisation de la variable d'erreur
$formateur = null; // Déclaration de l'objet formateur
$formateurC = new formateurC(); // Instance du contrôleur

// Vérifier si l'ID est passé via GET (ou POST si vous redirigez correctement)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Récupérer les données du formateur en utilisant l'ID
    $formateur = $formateurC->showtrainer($id);
    if (!$formateur) {
        echo "Formateur introuvable.";
        exit;
    }
} else {
    echo "ID de formateur non spécifié.";
    exit;
}

// Vérifier si le formulaire est soumis
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
        // Création de l'objet Formateur avec les données du formulaire
        $formateur = new formateur(
            $_POST['id'], // ID existant
            $_POST['nom'],
            $_POST["prenom"],
            $_POST["email"],
            $_POST["motdepasse"],
            $_POST["specialite"],
            $_POST["experience"],
            $_POST["adresse"]
        );

        // Mise à jour du formateur dans la base de données
        $formateurC->updatetrainer($formateur, $_POST['id']);

        // Redirection vers la liste des formateurs
        header('Location: index.html');
        exit;
    } else {
        $error = "Tous les champs doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour formateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000000; /* Arrière-plan noir */
            color: #fff; /* Texte blanc */
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #FFD700; /* Jaune pour les titres */
            text-align: center;
            margin: 20px 0;
            animation: colorChange 3s infinite; /* Animation ajoutée */
        }

        @keyframes colorChange {
            0% {
                color: #FFD700; /* Jaune au début */
            }
            50% {
                color: #ffcc00; /* Jaune plus clair à mi-chemin */
            }
            100% {
                color: #28a745; /* Vert à la fin de l'animation */
            }
        }

        a {
            text-decoration: none;
            color: #FFD700; /* Jaune pour les liens */
            font-weight: bold;
        }

        a:hover {
            color: #ffcc00; /* Légèrement plus clair au survol */
            text-decoration: underline;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #808080; /* Gris pour la table */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #000; /* Noir pour le formulaire */
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

        input[type="submit"],
        input[type="reset"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        input[type="reset"] {
            background-color: #6c757d;
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
    </style>
</head>
<body>

    <div class="container">
        <h1>Mettre à jour formateur</h1>
        <a href="index.html">Retour à la liste des formateurs</a>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <form id="updatetrainer" action="updatetrainer.php?id=<?php echo $formateur['id']; ?>" method="POST">
            <table>
                <!-- Hidden field for ID -->
                <input type="hidden" name="id" value="<?php echo $formateur['id']; ?>">

                <tr>
                    <td><label for="nom">Nom :</label></td>
                    <td><input type="text" id="nom" name="nom" value="<?php echo $formateur['nom']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom :</label></td>
                    <td><input type="text" id="prenom" name="prenom" value="<?php echo $formateur['prenom']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td><input type="email" id="email" name="email" value="<?php echo $formateur['email']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="motdepasse">Mot de passe :</label></td>
                    <td><input type="password" id="motdepasse" name="motdepasse" value="<?php echo $formateur['motdepasse']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="specialite">Spécialité :</label></td>
                    <td><input type="text" id="specialite" name="specialite" value="<?php echo $formateur['specialite']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="experience">Expérience :</label></td>
                    <td><input type="text" id="experience" name="experience" value="<?php echo $formateur['experience']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="adresse">Adresse :</label></td>
                    <td><input type="text" id="adresse" name="adresse" value="<?php echo $formateur['adresse']; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Mettre à jour">
                        <input type="reset" value="Réinitialiser">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body> 
</html>