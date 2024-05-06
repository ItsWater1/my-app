<?php
// Barre de navigation de l'interface utilisateur, les admins peuvent basculer entre la vue admin et utilisateur via cette barre.

if (session_id() === '') {
    session_start();
}
?>

 
 <head>
 <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
</head>
 
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

        <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
        <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
            
            <form class="me-auto" action="/my-app/logout.php" method="post">
                <button type="submit" class="btn btn-danger">Se déconnecter</button>
            </form>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/index.php">Vue "Tableau"</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/calendar.php">Vue "Calendrier"</a>
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