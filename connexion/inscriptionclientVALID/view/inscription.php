<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>Inscription</h1>
    <div class="container">
        <form id="inscriptionForm" method="POST" action="Verification.php">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
                <div class="error" id="nomError"></div>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
                <div class="error" id="prenomError"></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <div class="error" id="emailError"></div>
            </div>
            <div class="form-group">
                <label for="motDePasse">Mot de passe</label>
                <input type="password" id="motDePasse" name="motDePasse" required>
                <div class="error" id="motDePasseError"></div>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" required>
                <div class="error" id="telephoneError"></div>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
    <script>
        document.getElementById('inscriptionForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Réinitialiser les messages d'erreur
            document.querySelectorAll('.error').forEach(error => error.textContent = ''); 

            // Validation du formulaire
            const nom = document.getElementById('nom').value.trim();
            if (nom === '') {
                document.getElementById('nomError').textContent = 'Le nom est obligatoire.';
                isValid = false; 
            }

            const prenom = document.getElementById('prenom').value.trim();
            if (prenom === '') {
                document.getElementById('prenomError').textContent = 'Le prénom est obligatoire.';
                isValid = false;
            }

            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '' || !emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Veuillez entrer un email valide.';
                isValid = false;
            }

            const motDePasse = document.getElementById('motDePasse').value;
            const motDePasseRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!motDePasseRegex.test(motDePasse)) {
                document.getElementById('motDePasseError').textContent = 'Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un symbole.';
                isValid = false;
            }

            const telephone = document.getElementById('telephone').value.trim();
            const telephoneRegex = /^\d{8}$/;
            if (!telephoneRegex.test(telephone)) {
                document.getElementById('telephoneError').textContent = 'Le téléphone doit contenir exactement 8 chiffres.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Empêcher l'envoi du formulaire si validation échoue
            }
        });
    </script>
</body>
</html>
