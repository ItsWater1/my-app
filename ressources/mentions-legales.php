<?php
// Page des mentions légales

// Démarrage de la session et redirection vers la page de connexion si l'utilisateur n'est pas connecté.
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclusion des éléments de navigation et du pied de page du site.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions Légales</title>
    <style>
        body {
            margin: 0; /* Aucune marge pour le corps entier de la page */
            padding: 0; /* Aucun padding pour un rendu propre et aligné */
            font-family: Arial, sans-serif; /* Utilisation d'une police de caractères standard et lisible */
        }
        .container {
            margin-top: 70px; /* Espace au-dessus du conteneur pour éviter la superposition avec la barre de navigation */
            padding: 20px; /* Espacement intérieur pour un meilleur rendu du texte */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mentions Légales</h1> <!-- Titre de la section des mentions légales -->
        <!-- Paragraphe expliquant les mentions légales (texte fictif utilisé ici) -->
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
        <p>Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>
    </div>
</body>
</html>
