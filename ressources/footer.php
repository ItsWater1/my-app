<?php
// Footer du site
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <style>
        /* Style du footer qui restera fixé au bas de la page */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            background-color: #f2f2f2; /* Couleur de fond claire */
            padding: 10px;
            z-index: 1000; /* S'assure que le footer reste au-dessus des autres éléments de contenu */
            font-family: Arial, sans-serif; /* Police standard pour une apparence nette et professionnelle */
        }

        /* Style des liens dans le footer */
        .footer-links a {
            color: #007BFF; /* Couleur bleue standard pour les liens */
            text-decoration: none; /* Supprime le soulignement des liens */
            margin: 0 10px; /* Espacement entre les liens */
        }

        /* Style des liens au survol pour améliorer l'interactivité */
        .footer-links a:hover {
            text-decoration: underline; /* Ajoute un soulignement au survol pour indiquer l'interactivité */
        }
    </style>
</head>
<body>

<footer>
    <!-- Contenu du footer avec texte de droit d'auteur et liens utiles -->
    <div class="footer-content">
        © 2024 Jeunesse Treycovagnes Chamblon. Tous droits réservés.
    </div>
    <div class="footer-links">
        <a href="/my-app/ressources/mentions_legales.php">Mentions légales</a>|
        <a href="/my-app/ressources/politique_de_confidentialite.php">Politique de confidentialité</a>|
        <a href="mailto:arthur.wuthrich@eduvaud.ch">Contact</a>
    </div>
</footer>

</body>
</html>
