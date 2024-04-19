<?php
// Fichier qui récupère l'utlisateur et son niveau de droits. Utilisé pour la création et modification d'utilisateur (page admin).

include('DB_connexion.php');

// Requête SQL
$sql = "SELECT 
    user,
    level
FROM t_utilisateur
ORDER BY level";

$result = $conn->query($sql);

// Récupère les résultats sous forme de tableau
$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Convertit le tableau en format JSON
echo json_encode($rows);

// Ferme la connexion à la base de données
$conn->close();
?>