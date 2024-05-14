<?php
// Barre de navigation de l'interface utilisateur, les admins peuvent basculer entre la vue admin et utilisateur via cette barre.

if (session_id() === '') {
    session_start();
}
?>

 
 <head>
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />

    <style>
    .navbar-custom {
        background-color: lightblue; /* Couleur de fond */
        display: flex;
        align-items: center; /* Aligner verticalement les éléments */
    }

    .navbar-custom .nav-link {
        color: #000; /* Couleur du texte */
        transition: color 0.3s; /* Transition de couleur */
        padding: 8px 15px; /* Ajuster selon besoin */
    }

    .navbar-custom .nav-link:hover {
        color: blue; /* Couleur au survol */
        text-decoration: none; /* Enlever le soulignement */
    }

    .navbar-custom .btn-danger {
        background-color: #d9534f; /* Rouge plus vif */
        border-color: #d43f3a; /* Bordure un peu plus sombre */
        padding: 6px 15px; /* Assurez que le padding correspond aux nav-links */
        margin-top: 10px; /* Ajuster en fonction des besoins pour aligner verticalement */
    }

    .navbar-custom .btn-danger:hover {
        background-color: #c9302c; /* Rouge au survol */
        border-color: #ac2925; /* Bordure au survol */
    }

    .form-inline {
        display: flex;
        align-items: center; /* Ceci aide à aligner le bouton avec les liens */
    }
    </style>
</head>
 
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid"> 
            <form class="me-auto" action="/my-app/logout.php" method="post">
                <button type="submit" class="btn btn-danger">Se déconnecter</button>
            </form>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
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
                        <!-- Ce lien ne s'affichera que si l'utilisateur est connecté en tant qu'admin -->
                        <li>    
                            <a class="nav-link" href="/my-app/admin.php">Vue admin</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
