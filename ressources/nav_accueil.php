<?php
// Barre de navigation de l'interface utilisateur (uniquement l'accueil pour aller avec les images).

// Démarre une nouvelle session ou reprend une session existante pour maintenir l'état de connexion de l'utilisateur.
if (session_id() === '') {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
    <title>Page d'Accueil</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
    <style>
        /* Style général pour le corps et la barre de navigation */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .navbar {
            position: fixed; /* Fixe la barre de navigation en haut de la page */
            width: 100%;
            top: 0;
            z-index: 1000; /* S'assure que la navbar reste au-dessus des autres éléments */
            padding: 10px 0; /* Ajoute un padding vertical sans affecter les côtés */
            display: flex; /* Utilise flexbox pour un alignement et une répartition cohérents des éléments */
            align-items: center; /* Centre les éléments verticalement */
            justify-content: space-between; /* Distribue les espaces entre les éléments de manière égale */
        }

        /* Styles pour les liens et les boutons dans la navbar */
        .navbar a, .navbar button {
            background: none; /* Aucun fond pour un style épuré */
            padding: 10px 20px; /* Padding pour augmenter la zone cliquable */
            margin: 0 10px; /* Margin pour espacer les éléments */
            border-radius: 5px; /* Bordures arrondies pour les éléments interactifs */
            transition: background 0.3s ease; /* Transition pour l'effet de survol */
        }
        .navbar a:hover, .navbar button:hover {
            background: rgba(255, 255, 255, 0.2); /* Effet de survol pour indiquer l'interactivité */
        }
        .navbar-brand img {
            height: 40px; /* Hauteur fixe pour le logo pour assurer la cohérence */
        }
        .nav-link {
            color: blue; /* Définit la couleur des liens */
        }
        .nav-link:hover {
            color: white; /* Change la couleur au survol pour une meilleure visibilité */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="container-fluid">
            <!-- Logo et lien vers la page d'accueil -->
            <a href="/my-app/accueil.php" class="navbar-brand">
                <img src="/my-app/images/logo.png" alt="Logo">
            </a>
            <!-- Menu hamburger pour les résolutions plus petites -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Liens de navigation pour différentes sections du site -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/accueil.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/index.php">Tableau Manifs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/calendar.php">Calendrier Manifs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/album.php">Album photo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/album/image_user.php">Mes images</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/album/upload_form.php">Ajouter une photo</a>
                    </li>
                    <!-- Affichage conditionnel du lien d'administration si l'utilisateur est administrateur -->
                    <?php if(isset($_SESSION['username']) && isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/admin.php">Vue admin</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <!-- Bouton de déconnexion -->
                <form class="d-flex" action="/my-app/logout.php" method="post">
                    <button type="submit" class="btn btn-danger">Se déconnecter</button>
                </form>
            </div>
        </div>
    </nav>
</body>
</html>
