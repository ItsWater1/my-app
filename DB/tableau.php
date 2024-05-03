<?php
// Requête afin de créer le tableau qui contient toutes les manifestations.

include('DB_connexion.php');

// Requête préparée pour récupérer les informations sur les manifestations
$sql = "SELECT
    m.Nom AS NomManifestation,
    m.Date,
    m.Benefice,
    l.NomLieu,
    t.TypeManif
FROM
    t_manif m
JOIN
    t_manif_avoir_lieu mal ON m.id_manif = mal.fk_manif
JOIN
    t_lieu l ON mal.fk_lieu = l.id_lieu
JOIN
    t_manif_avoir_type mat ON m.id_manif = mat.fk_manif
JOIN
    t_type t ON mat.fk_type = t.id_type
WHERE
    m.Nom IS NOT NULL AND m.Nom <> ''
ORDER BY Date";

// Préparation de la requête préparée
$stmt = $conn->prepare($sql);

// Exécution de la requête préparée
$stmt->execute();

// Récupération des résultats
$result = $stmt->get_result();

// Initialisation du tableau pour stocker les résultats
$rows = array();

// Boucle pour récupérer les lignes de résultats
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Convertit le tableau en format JSON
echo json_encode($rows);

// Ferme la requête préparée
$stmt->close();

// Ferme la connexion à la base de données
$conn->close();
?>
