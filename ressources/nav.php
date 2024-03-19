 <head>
 <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
</head>
 
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            
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
                        <a class="nav-link" href="/my-app/album/uploadform.php">Ajouter une photo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>