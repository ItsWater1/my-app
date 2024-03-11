<?php
include('DB_connexion.php');

// Requête SQL
$sql = "SELECT 
    user,
    level
FROM t_utilisateur
ORDER BY level";

$result = $conn->query($sql);

// Récupère les r�sultats sous forme de tableau
$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Convertit le tableau en format JSON
echo json_encode($rows);

// Ferme la connexion � la base de donn�es
$conn->close();
?>