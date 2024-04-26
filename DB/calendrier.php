<?php
// Requête qui récupère le les manifestations et leurs dates afin de les ajouter dans le calendrier (calendar.php). 
// ATTENTON SECURISER LES REQUETES DANS TOUT LE DOSSIER 

include ('DB_connexion.php');

// Exécute la requête SQL
$sql = "SELECT
    m.Nom AS NomManifestation,
    m.Date
FROM
    t_manif m
WHERE
    m.Nom IS NOT NULL AND m.Nom <> ''
ORDER BY Date;
";

$result = $conn->query($sql);

// Vérifier si la requête s'est bien déroulée
if (!$result) {
    die("Erreur dans la requête SQL : " . $conn->error);
}

// Récupérer les résultats sous forme de tableau
$events = array();
while ($row = $result->fetch_assoc()) {
    $date = $row['Date'];
    $events[$date][] = $row['NomManifestation'];
}

// Convertir le tableau en format JSON
echo json_encode($events);

// Fermer la connexion à la base de données
$conn->close();
?>
