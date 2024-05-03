<?php
// Requête qui récupère les manifestations et leurs dates afin de les ajouter dans le calendrier (calendar.php).
// ATTENTION : SECURISER LES REQUETES DANS TOUT LE DOSSIER

include('DB_connexion.php');

// Préparation de la requête SQL
$sql = "SELECT
    m.Nom AS NomManifestation,
    m.Date
FROM
    t_manif m
WHERE
    m.Nom IS NOT NULL AND m.Nom <> ''
ORDER BY Date";

// Préparation de la requête préparée
$stmt = $conn->prepare($sql);

// Exécution de la requête préparée
$stmt->execute();

// Liaison des résultats à des variables
$stmt->bind_result($nomManifestation, $date);

// Initialisation du tableau d'événements
$events = array();

// Boucle pour récupérer les résultats
while ($stmt->fetch()) {
    $events[$date][] = $nomManifestation;
}

// Convertir le tableau en format JSON
echo json_encode($events);

// Fermer la requête préparée
$stmt->close();

// Fermer la connexion à la base de données
$conn->close();
?>
