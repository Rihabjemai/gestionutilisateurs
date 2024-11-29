<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Connexion</h2>
            <form id="connexionForm" method="POST" action="/cnxekherhal/index.php?action=login">
                <div class="input-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Votre email ou téléphone">
                    <div id="emailError" class="error"></div>
                </div>

                <div class="input-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe">
                    <div id="passwordError" class="error"></div>
                </div>

                <button type="submit">Se connecter</button>
                <div class="create-account">
                    <p>Pas encore de compte ? <a href="inscriptionclientVALID/view/inscription.php">Créez un compte</a></p>
                    <p>Mot de passe oublié ? <a href="motdepasseclient">Réinitialiser le mot de passe</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('connexionForm').addEventListener('submit', function (event) {
            let isValid = true;

            // Réinitialiser les messages d'erreur
            document.querySelectorAll('.error').forEach(error => error.textContent = '');

            // Validation de l'email
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '' || !emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Veuillez entrer un email valide.';
                isValid = false;
            }

            // Validation du mot de passe
            const motDePasse = document.getElementById('password').value;
            const motDePasseRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!motDePasseRegex.test(motDePasse)) {
                document.getElementById('passwordError').textContent =
                    'Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un symbole.';
                isValid = false;
            }

            // Bloquer l'envoi si la validation échoue
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>

</html>
