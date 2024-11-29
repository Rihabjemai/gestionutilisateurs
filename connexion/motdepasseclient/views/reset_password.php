<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <style>
        /* Style global */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;  /* Fond clair de base */
    background-image: url('background.jpg'); /* Remplacez cette URL par votre image */
    background-size: cover;  /* Couvre toute la zone de la page */
    background-position: center center;  /* Centrer l'image */
    background-attachment: fixed;  /* Garder l'image fixe lors du défilement */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;  /* Pleine hauteur de l'écran */
    margin: 0;  /* Supprimer les marges par défaut */
}

/* Style de la zone du formulaire */
.container {
    background: white;  /* Fond blanc pour le formulaire */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;  /* Limite la largeur à 400px */
    text-align: center;
}

/* Formulaire et champs */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Erreurs */
.error {
    color: red;
    font-size: 12px;
    display: none;
}

/* Responsivité pour petites tailles d'écrans */
@media (max-width: 600px) {
    .container {
        width: 90%;
        padding: 15px;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Réinitialiser le mot de passe</h2>
        <form id="resetForm">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" >
                <span id="emailError" class="error">Veuillez entrer un email valide.</span>
            </div>
            <div class="form-group">
                <label for="oldPassword">Ancien mot de passe :</label>
                <input type="password" id="oldPassword" >
                <span id="oldPasswordError" class="error">L'ancien mot de passe est requis.</span>
            </div>
            <div class="form-group">
                <label for="newPassword">Nouveau mot de passe :</label>
                <input type="password" id="newPassword" >
                <span id="newPasswordError" class="error">Le mot de passe doit contenir au moins 8 caractères, dont une lettre majuscule, une lettre minuscule et un chiffre.</span>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirmez le nouveau mot de passe :</label>
                <input type="password" id="confirmPassword" >
                <span id="confirmPasswordError" class="error">Les mots de passe ne correspondent pas.</span>
            </div>
            <button type="submit">Réinitialiser</button>
        </form>
    </div>

    <script>
        document.getElementById('resetForm').addEventListener('submit', async function (event) {
            event.preventDefault(); // Empêche l'envoi classique du formulaire pour utiliser une validation

            let isValid = true;

            // Réinitialiser les messages d'erreur
            document.querySelectorAll('.error').forEach(error => error.style.display = 'none');

            // Récupérer les valeurs du formulaire
            const email = document.getElementById('email').value.trim();
            const oldPassword = document.getElementById('oldPassword').value.trim();
            const newPassword = document.getElementById('newPassword').value.trim();
            const confirmPassword = document.getElementById('confirmPassword').value.trim();

            // Validation de l'email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '' || !emailRegex.test(email)) {
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            }

            // Validation de l'ancien mot de passe
            if (oldPassword === '') {
                document.getElementById('oldPasswordError').style.display = 'block';
                isValid = false;
            }

            // Validation du nouveau mot de passe
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            if (newPassword === '' || !passwordRegex.test(newPassword)) {
                document.getElementById('newPasswordError').style.display = 'block';
                isValid = false;
            }

            // Validation de la confirmation du mot de passe
            if (newPassword !== confirmPassword) {
                document.getElementById('confirmPasswordError').style.display = 'block';
                isValid = false;
            }

            // Si le formulaire est valide, envoyer les données via AJAX
            if (isValid) {
                try {
                    const response = await fetch('controllers/UserController.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ email, oldPassword, newPassword }),
                    });

                    const result = await response.json();

                    if (result.success) {
                        
                        if (confirm(result.message)) {
                            
                            window.location.href = 'http://localhost/cnxekherhal';  

                        }
                    } else {
                        alert(result.message);
                    }
                } catch (error) {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue. Veuillez réessayer.');
                }
            }
        });
    </script>

</body>
</html>
