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
        /*Style de la navigation*/
        body, html {
            margin: 0;  
            padding: 0; 
            height: 100%; 
        }
        .navbar {
            background-color: lightblue; 
            position: fixed; 
            width: 100%; 
            top: 0; 
            z-index: 1000; 
            padding: 10px 0; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            color: white; 
        }
        .navbar a, .navbar button {
            background: none; 
            padding: 10px 20px; 
            margin: 0 10px; 
            border-radius: 5px; .
            transition: background 0.3s ease; 
        }
        .navbar a:hover, .navbar button:hover {
            background: rgba(255, 255, 255, 0.2); 
        }
        .navbar-brand img {
            height: 40px; 
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="/my-app/accueil.php" class="navbar-brand">
                <img src="/my-app/images/logo.png" alt="Logo">
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
                    <button type="submit" class="btn btn-danger">Se déconnecter</button>
                </form>
            </div>
        </div>
    </nav>
    
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
