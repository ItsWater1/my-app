<?php
// Barre de navigation de l'interface utilisateur (uniquement l'accueil pour aller avec les images).

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
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .navbar {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 10px 0;
            display: flex; /* Utilisation de flexbox pour une disposition cohérente */
            align-items: center; /* Alignement des éléments verticalement au centre */
            justify-content: space-between; /* Répartition égale des éléments dans la barre */
        }

        .navbar a, .navbar button {
            background: none; /* Fond transparent pour les liens et boutons */
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .navbar a:hover, .navbar button:hover {
            background: rgba(255, 255, 255, 0.2); /* Léger highlight au survol */
        }
        .navbar-brand img {
            height: 40px; /* Taille spécifique pour le logo */
            vertical-align: middle;
            border: none;
        }
        .navbar .btn-danger {
            color: white;
            background-color: #d9534f;
            border-color: #d43f3a;
            padding: 10px 20px;
        }
        .navbar .btn-danger:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }
        .nav-link {
            color: blue; /* Couleur spécifique pour les liens */
        }
        .nav-link:hover {
            color: white; /* Couleur du texte au survol */
        }
    </style>


</head>
<body>
    <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="container-fluid"> 
            <a href="/my-app/accueil.php" class="navbar-brand">
                <img src="/my-app/images/logo.png" alt="Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                    <?php if(isset($_SESSION['username']) && isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/admin.php">Vue admin</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex" action="/my-app/logout.php" method="post">
                    <button type="submit" class="btn btn-danger">Se déconnecter</button>
                </form>
            </div>
        </div>
    </nav>
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>