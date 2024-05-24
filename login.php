<?php
// C'est la page de connexion du site, il faut entrer un nom d'utilisateur, un mot de passe et valider le captcha. 

// Initialisation de la session pour le suivi de l'utilisateur et gestion du CAPTCHA.
session_start();

// Vérification de la soumission du CAPTCHA et comparaison avec la valeur stockée en session.
if(isset($_POST['captcha'])){
    if($_POST['captcha'] == $_SESSION['captcha']) {
        echo "Captcha valide"; // Affiche un message si le CAPTCHA est correct.
    } else {
        echo "Captcha invalide"; // Affiche un message si le CAPTCHA est incorrect.
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <!-- Formulaire de connexion demandant nom d'utilisateur et mot de passe -->
        <form action="login_process.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <br>
            <!-- Champ pour le CAPTCHA pour vérifier que l'utilisateur n'est pas un robot -->
            <div>
                <img src="/my-app/ressources/captcha.php"/> <!-- Image générée pour le CAPTCHA -->
                <input type="text" class="form-control" name="captcha" placeholder="Entrez le Captcha" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
