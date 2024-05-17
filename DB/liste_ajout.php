<?php
// Fichier qui fait la requête pour les lieux et les types de manifestations.
// Est utilisé sur la page admin pour l'ajout ou la modification de manifs.

// Inclure le fichier de connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Requête préparée pour récupérer les lieux
$sqlLieu = "SELECT * FROM t_lieu WHERE id_lieu IN (?, ?) ORDER BY NomLieu";
$stmtLieu = $conn->prepare($sqlLieu);
$stmtLieu->bind_param("ii", $id_lieu_1, $id_lieu_2);

// Définir les valeurs des paramètres pour la requête des lieux
$id_lieu_1 = 1;
$id_lieu_2 = 2;

// Exécuter la requête préparée pour les lieux
$stmtLieu->execute();
$resultLieu = $stmtLieu->get_result();

// Requête préparée pour récupérer les types de manifestation
$sqlType = "SELECT * FROM t_type";
$stmtType = $conn->prepare($sqlType);

// Exécuter la requête préparée pour les types de manifestation
$stmtType->execute();
$resultType = $stmtType->get_result();
?>
