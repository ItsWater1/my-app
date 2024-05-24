<?php
// Formulaire de modification du mot de passe de l'utilisateur

// Démarrage de la session pour maintenir et vérifier l'état de connexion de l'utilisateur.
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion.
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Récupérer le nom d'utilisateur à partir de l'URL pour pré-remplir le formulaire.
$user = $_GET['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
    <title>Modifier le mot de passe</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; // Couleur de fond douce pour une lecture confortable.
        }
        .container {
            margin-top: 50px; // Espace au-dessus du contenu pour éviter l'overlap avec la navbar.
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modifier le mot de passe de : <?php echo $user; ?></h2> // Affiche dynamiquement le nom de l'utilisateur.
        <form action="/my-app/user/user_mdp_process_modifier.php" method="post">
            <div class="form-group">
                <label for="nouveauMDP">Nouveau mot de passe :</label>
                <input type="text" id="nouveauMDP" name="nouveauMDP" required class="form-control"> // Champ pour entrer le nouveau mot de passe.
            </div>
            <input type="hidden" name="user" value="<?php echo $user; ?>"> // Champ caché pour transmettre en toute sécurité le nom de l'utilisateur.
            <button type="submit" class="btn btn-primary">Modifier</button> // Bouton pour soumettre le formulaire.
        </form>
    </div>

    <!-- Scripts JavaScript pour Bootstrap -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>
</body>
</html>
