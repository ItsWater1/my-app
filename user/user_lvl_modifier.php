<?php
// Formulaire de modification du niveau de droits de l'utilisateur

// Démarrage de la session pour maintenir et vérifier l'état de connexion de l'utilisateur
session_start();

// Vérifie si l'utilisateur est connecté et a les droits administrateur.
if (!isset($_SESSION['username']) || !$_SESSION['admin']) {
    header("Location: /my-app/login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas admin
    exit();
}

// Récupère le nom d'utilisateur à partir de l'URL pour pré-remplir le formulaire
$user = $_GET['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
    <title>Modifier les droits</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
        }
        .container {
            margin-top: 50px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <br />
        <h2>Modifier le niveau de droit de : <?php echo $user; ?></h2> 
        <form action="/my-app/user/user_lvl_process_modifier.php" method="post">
            <div class="form-group">
                <label for="nouveaulvl">Nouveau niveau de droits :</label>
                <select id="nouveaulvl" name="nouveaulvl" required class="form-control">
                    <option>0</option>
                    <option>1</option> 
                </select>
            </div>
            <input type="hidden" name="user" value="<?php echo $user; ?>"> 
            <button type="submit" class="btn btn-primary">Modifier</button> 
        </form>
    </div>

    <!-- Scripts JavaScript pour Bootstrap -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>
</body>
</html>
