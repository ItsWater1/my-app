<?php
// Page d'accueil du site

// Démarre une nouvelle session ou reprend une session existante
session_start();

// Redirige vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclut les fichiers pour la navigation et le pied de page
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
        /* Styles spécifiques pour les liens de navigation et le corps de la page */
        .nav-link.nav-link-dark {
            color: black; 
        }

        .nav-link.nav-link-light {
            color: white; 
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
            background: rgba(255, 255, 255, 0.5); 
            z-index: 1000; 
        }
        .slideshow-container {
            position: relative;
            width: 100%;
            height: calc(100vh - 68px); 
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
            top: 90%; 
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
        <!-- Diapositives du carrousel d'images -->
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
        // Script pour le contrôle du carrousel d'images
        const slides = document.querySelectorAll('.slide');
        const links = document.querySelectorAll('.nav-link');
        let currentSlide = 0; // Index de l'image courante

        function updateLinkColors() {
            // Supprime et ajoute des classes pour changer la couleur des liens en fonction du diaporama
            links.forEach(link => {
                link.classList.remove('nav-link-dark', 'nav-link-light');
            });

            // Logique pour déterminer la couleur du lien basée sur l'image courante
            if (currentSlide === 1 || currentSlide === 3) { // Supposons que les images paires sont claires et impaires foncées
                links.forEach(link => link.classList.add('nav-link-dark'));
            } else {
                links.forEach(link => link.classList.add('nav-link-light'));
            }
        }

        function changeSlide() {
            // Change l'image active dans le diaporama
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
            updateLinkColors(); // Mise à jour des couleurs des liens
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Initialise le diaporama et met à jour les couleurs au démarrage
            setInterval(changeSlide, 5000); // Change d'image toutes les 5 secondes
            updateLinkColors();
        });
</script>

</body>
</html>