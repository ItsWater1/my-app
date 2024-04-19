<?php 
// Fichier qui fait la requête pour les lieux et les types de manifestations. 
// Est utilisé sur la page admin pour l'ajout ou la modification de manifs. 

// Inclure le fichier de connexion à la base de données
include('/DB_connexion.php');

// Requête pour récupérer les lieux
$sqlLieu = "SELECT * FROM t_lieu 
WHERE id_lieu in(1,2)
ORDER BY NomLieu";
$resultLieu = $conn->query($sqlLieu);

// Requête pour récupérer les types de manifestation
$sqlType = "SELECT * FROM t_type";
$resultType = $conn->query($sqlType);
?>
