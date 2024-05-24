<?php
// Navigation pour la page admin.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body, html {
            margin: 0;  // Élimine les marges pour assurer que la barre de navigation couvre toute la largeur.
            padding: 0; // Aucun padding pour une apparence uniforme.
            height: 100%; // Hauteur totale pour empêcher les débordements inattendus.
        }
        .navbar {
            background-color: lightblue; // Fond bleu clair pour une distinction visuelle.
            position: fixed; // Fixe la barre de navigation en haut de la page.
            width: 100%; // Largeur complète pour une couverture totale.
            top: 0; // Positionnée tout en haut de la page.
            z-index: 1000; // Assure qu'elle reste au-dessus des autres contenus.
            padding: 10px 0; // Padding vertical pour un bon espacement interne.
            display: flex; // Flexbox pour un alignement flexible des éléments.
            align-items: center; // Centre les éléments verticalement.
            justify-content: space-between; // Distribue l'espace entre les éléments uniformément.
            color: white; // Texte en blanc pour contraste avec le fond.
        }
        .navbar a, .navbar button {
            background: none; // Fond transparent pour un look épuré.
            padding: 10px 20px; // Padding suffisant pour rendre les clics faciles.
            margin: 0 10px; // Marge autour des liens pour de l'espace.
            border-radius: 5px; // Coins arrondis pour une esthétique douce.
            transition: background 0.3s ease; // Transition fluide pour le survol.
        }
        .navbar a:hover, .navbar button:hover {
            background: rgba(255, 255, 255, 0.2); // Surbrillance légère au survol.
        }
        .navbar-brand img {
            height: 40px; // Hauteur fixe du logo pour la cohérence.
            vertical-align: middle; // Alignement vertical pour correspondre aux autres éléments.
            border: none; // Pas de bordure autour du logo.
        }
        .navbar .btn-danger {
            color: white; // Texte blanc pour un contraste fort.
            background-color: #d9534f; // Rouge vif pour une visibilité accrue.
            border-color: #d43f3a; // Bordure un peu plus foncée que le fond.
            padding: 10px 20px; // Padding généreux pour un confort tactile.
        }
        .navbar .btn-danger:hover {
            background-color: #c9302c; // Rouge plus foncé au survol.
            border-color: #ac2925; // Bordure adaptée au changement de fond.
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="/my-app/accueil.php" class="navbar-brand">
                <img src="/my-app/images/logo.png" alt="Logo"> // Logo de la compagnie.
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/my-app/admin.php">Gestion des manifestations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/my-app/users.php">Gestion des utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/my-app/album/image_admin.php">Gestion des images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/my-app/accueil.php">Interface utilisateur</a>
                </li>
                </ul>
                <form class="d-flex" action="/my-app/logout.php" method="post">
                    <button type="submit" class="btn btn-danger">Se déconnecter</button> // Bouton de déconnexion clairement visible.
                </form>
            </div>
        </div>
    </nav>
    
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
