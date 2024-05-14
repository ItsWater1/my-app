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
            background: rgba(255, 255, 255, 0); /* Uniquement le fond est transparent */
            z-index: 1000;
            padding: 10px 0;
        }
        .navbar a, .navbar button {
            background: rgba(0, 0, 0, 0.5); /* Fond semi-transparent pour les liens et boutons */
            color: white; /* Couleur du texte */
            padding: 10px 20px; /* Padding pour augmenter la taille et l'espacement */
            margin: 0 10px; /* Marge autour des boutons et liens */
            border-radius: 5px; /* Bordures arrondies pour les boutons */
            transition: background 0.3s ease; /* Transition pour un effet au survol */
        }
        .navbar a:hover, .navbar button:hover {
            background: rgba(0, 0, 0, 0.8); /* Fond plus foncé au survol */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid"> 
            <a href="/my-app/accueil.php" class="navbar-brand">Logo</a>
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
