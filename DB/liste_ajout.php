<?php 
// Inclure le fichier de connexion à la base de données
include('/DB_connexion.php');

// Requête pour récupérer les lieux
$sqlLieu = "SELECT * FROM t_lieu";
$resultLieu = $conn->query($sqlLieu);

// Requête pour récupérer les types de manifestation
$sqlType = "SELECT * FROM t_type";
$resultType = $conn->query($sqlType);
?>
