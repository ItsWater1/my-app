<?php
// C'est la page d'accueil du site quand on se connecte en utilisateur. 

session_start();
include('ressources/nav_accueil.php');
include('ressources/footer.php');

if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
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
            background: rgba(255, 255, 255, 0.5); /* Fond partiellement transparent */
            z-index: 1000; /* Assure que la nav est au-dessus du diaporama */
        }
        .slideshow-container {
            position: relative;
            width: 100%;
            height: calc(100vh - 68px); /* Ajustez en fonction de la hauteur du footer */
            top: 0;
        }
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s;
        }
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .text {
            position: absolute;
            top: 90%; /* Ajustez cette valeur pour déplacer le texte verticalement */
            left: 20px;
            color: white;
            font-size: 20px;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
        }
        .active {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="slideshow-container">
        <!-- Slides -->
        <div class="slide active">
            <img src="/my-app/ressources/diapo/1.jpg" alt="Image 1">
            <div class="text">Bienvenue sur notre site !</div>
        </div>
        <div class="slide">
            <img src="/my-app/ressources/diapo/2.jpg" alt="Image 2">
            <div class="text">Bienvenue sur notre site !</div>
        </div>
        <div class="slide">
            <img src="/my-app/ressources/diapo/3.jpg" alt="Image 3">
            <div class="text">Bienvenue sur notre site !</div>
        </div>
        <div class="slide">
            <img src="/my-app/ressources/diapo/4.jpg" alt="Image 4">
            <div class="text">Bienvenue sur notre site !</div>
        </div>
    </div>
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000);
    </script>
</body>
</html>

