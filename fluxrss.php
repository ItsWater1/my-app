<?php
// C'est la page qui permet de générer le flux RSS. 

// Définition du fuseau horaire pour s'assurer que toutes les dates et heures sont correctes.
date_default_timezone_set('Europe/Zurich');

// Inclusion des fichiers pour la connexion à la base de données et les requêtes spécifiques au RSS.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/requete_rss.php");
?>

<!-- Début du document XML pour le flux RSS -->
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Mon site</title> <!-- Titre du flux RSS -->
        <?php if ($closestDate) { ?>
            <lastBuildDate>Prochaine manifestation : <?= date('d M Y', strtotime($closestDate)) ?></lastBuildDate> <!-- Affiche la date de la prochaine manifestation -->
        <?php } ?>
        <?php while ($a = $manif->fetch_assoc()) { ?>
            <item>
                <title><?= isset($a['nom']) ? $a['nom'] : '' ?></title> <!-- Titre de l'événement -->
                <pubDate><?= isset($a['date']) ? date(DATE_RSS, strtotime($a['date'])) : '' ?></pubDate> <!-- Date de publication de l'événement, formatée pour RSS -->
            </item>
        <?php } ?>
    </channel>
</rss>
