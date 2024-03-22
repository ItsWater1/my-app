<head>
 <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
</head>
 
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">


            <form class="me-auto" action="/my-app/logout.php" method="post">
                <button type="submit" class="btn btn-danger">Se déconnecter</button>
            </form>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/admin.php">Gestion des manifestations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/users.php">Gestion des utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/my-app/album/image_admin.php">Gestion des images</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>