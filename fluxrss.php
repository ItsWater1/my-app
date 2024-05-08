<?php
// C'est la page qui permet de générer le flux RSS. 
// Fuseau horaire
date_default_timezone_set('Europe/Zurich');

// inclure les requêtes et la connexion à la DB
include('/DB/DB_connexion.php');
include('/DB/requeterss.php');
?>

<!-- Création du flux RSS -->
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Mon site</title>
        <?php if ($closestDate) { ?>
            <lastBuildDate>Prochaine manifestation : <?= date('d M Y', strtotime($closestDate)) ?></lastBuildDate>
        <?php } ?>
        <?php while ($a = $manif->fetch_assoc()) { ?>
            <item>
                <title><?= isset($a['nom']) ? $a['nom'] : '' ?></title>
                <pubDate><?= isset($a['date']) ? date(DATE_RSS, strtotime($a['date'])) : '' ?></pubDate>
            </item>
        <?php } ?>
    </channel>
</rss>
