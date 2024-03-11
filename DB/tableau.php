<?php
include 'DB_connexion.php';

// Ex�cute la requ�te SQL
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
ORDER BY Date;
";

$result = $conn->query($sql);

// R�cup�re les r�sultats sous forme de tableau
$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Convertit le tableau en format JSON
echo json_encode($rows);

// Ferme la connexion � la base de donn�es
$conn->close();
?>
