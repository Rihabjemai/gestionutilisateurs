<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

include_once '../Model/Client.php';
include_once '../Controller/ClientController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $motDePasse = htmlspecialchars($_POST['motDePasse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $adresse = htmlspecialchars($_POST['adresse']);

    // Création d'un objet Client
    $client = new Client($nom, $prenom, $email, $motDePasse, $telephone, $adresse);

    // Enregistrement via le contrôleur
    $clientController = new ClientController();
    $clientController->registerUser($client);

    // Envoi de l'email de bienvenue
    $mail = new PHPMailer(true);
    $emailEnvoye = false;

    try {
        // Configuration du serveur de messagerie
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rihabjemai81@gmail.com'; // Adresse e-mail d'envoi
        $mail->Password = 'iksi ibnu ookj xwpr';    // Mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurer les destinataires
        $mail->setFrom('rihabjemai81@gmail.com', 'Votre site');
        $mail->addAddress($email); // Adresse e-mail du client

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Bienvenue sur notre site kanzi';
        $mail->Body = "
        <h1>Bienvenue, $prenom $nom !</h1>
        <p>Nous sommes ravis de vous compter parmi nos membres. Votre inscription a été réalisée avec succès.</p>
        ";

        // Envoyer l'email
        $mail->send();
        $emailEnvoye = true;

    } catch (Exception $e) {
        // En cas d'erreur d'envoi
        $emailEnvoye = false;
    }

    // Afficher le message de bienvenue
    echo "
    <!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Inscription réussie</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background: url('background.jpg') no-repeat center center fixed;
                background-size: cover;
                color: white;
            }
            .message {
                text-align: center;
                background: rgba(255, 255, 255, 0.8);
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
                animation: fadeIn 1s ease-in-out;
            }
            .message h1 {
                color: #4CAF50;
                margin-bottom: 10px;
                font-size: 24px;
            }
            .message p {
                color: #333;
                margin-bottom: 20px;
                font-size: 16px;
            }
            .message a {
                text-decoration: none;
                color: white;
                background-color: #4CAF50;
                padding: 10px 20px;
                border-radius: 5px;
                font-weight: bold;
                font-size: 14px;
                transition: background-color 0.3s ease;
            }
            .message a:hover {
                background-color: #45a049;
            }
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
    <body>
        <div class='message'>
            <h1>Bienvenue, $prenom $nom !</h1>
            <p>Votre inscription a été réalisée avec succès.</p>";
            if ($emailEnvoye) {
                echo "<p style='color: green;'>Un email de bienvenue a été envoyé à votre adresse e-mail.</p>";
            } else {
                echo "<p style='color: red;'>L'email de bienvenue n'a pas pu être envoyé. Veuillez vérifier vos paramètres.</p>";
            }
            echo "
            <a href='/path/to/your/site'>Accéder au site</a>
        </div>
    </body>
    </html>
    ";
}
?>
