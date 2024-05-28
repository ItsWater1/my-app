<?php
// Page de la politique de confidentialité

// Démarre la session pour maintenir et vérifier l'état de connexion de l'utilisateur.
session_start();

// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion.
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclut les fichiers de navigation et de pied de page pour maintenir une structure cohérente sur le site.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de confidentialité</title>
    <style>
        /*Style de la page*/
        body {
            margin: 0;
            padding: 0; 
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 70px; 
            padding: 20px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Politique de confidentialité</h1>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
        <p>Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>
    </div>
</body>
</html>
