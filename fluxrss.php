<?php
// Set the timezone to your desired value
date_default_timezone_set('Europe/Zurich');

// Include necessary files
include('/DB/DB_connexion.php');
include('/DB/requeterss.php');
?>

<!-- Création du flux RSS -->
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Mon site</title>
        <?php if ($closestDate) { ?>
            <lastBuildDate>Prochaine manifestation : <?= date('D, d M Y', strtotime($closestDate)) ?></lastBuildDate>
        <?php } ?>
        <?php while ($a = $manif->fetch_assoc()) { ?>
            <item>
                <title><?= isset($a['nom']) ? $a['nom'] : '' ?></title>
                <pubDate><?= isset($a['date']) ? date(DATE_RSS, strtotime($a['date'])) : '' ?></pubDate>
            </item>
        <?php } ?>
    </channel>
</rss>
