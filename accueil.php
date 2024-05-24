<?php
// C'est la page d'accueil du site quand on se connecte en utilisateur. 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav_accueil.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");

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
        .nav-link.nav-link-dark {
            color: black; /* Couleur pour fond clair */
        }

        .nav-link.nav-link-light {
            color: white; /* Couleur pour fond foncé */
        }

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
            height: calc(100vh - 68px); /* Hauteur du footer */
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
        const slides = document.querySelectorAll('.slide');
        const links = document.querySelectorAll('.nav-link');
        let currentSlide = 0; // Déclarer une seule fois

        function updateLinkColors() {
            // Supprimer toutes les classes de couleur préalables
            links.forEach(link => {
                link.classList.remove('nav-link-dark', 'nav-link-light');
            });

            // Ajouter la classe en fonction de l'image visible
            if (currentSlide === 1 || currentSlide === 3) { // Supposons que les images paires sont claires et impaires foncées
                links.forEach(link => link.classList.add('nav-link-dark'));
            } else {
                links.forEach(link => link.classList.add('nav-link-light'));
            }
        }

        function changeSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
            updateLinkColors();
        }

        document.addEventListener('DOMContentLoaded', () => {
            setInterval(changeSlide, 5000); // Déplacer setInterval dans DOMContentLoaded
            updateLinkColors(); // Mise à jour initiale des couleurs
        });
</script>

</body>
</html>

