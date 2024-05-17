<?php
// Fichier du processus de suppression des manifestations. Contient les requêtes SQL.

include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

session_start();

// Récupérer le nom de la manifestation à supprimer depuis le paramètre de l'URL
$nomManifestation = $_GET['nomManifestation'];

// Requête préparée pour supprimer les enregistrements liés dans t_manif_avoir_lieu
$queryDeleteAvoirLieu = "DELETE FROM t_manif_avoir_lieu WHERE fk_manif IN (SELECT id_manif FROM t_manif WHERE Nom=?)";
$stmtDeleteAvoirLieu = $conn->prepare($queryDeleteAvoirLieu);
$stmtDeleteAvoirLieu->bind_param("s", $nomManifestation);
$stmtDeleteAvoirLieu->execute();

if ($stmtDeleteAvoirLieu->error) {
    die("Erreur lors de la suppression des enregistrements liés : " . $stmtDeleteAvoirLieu->error);
}

$stmtDeleteAvoirLieu->close();

// Requête préparée pour supprimer les enregistrements liés dans t_manif_avoir_type
$queryDeleteAvoirType = "DELETE FROM t_manif_avoir_type WHERE fk_manif IN (SELECT id_manif FROM t_manif WHERE Nom=?)";
$stmtDeleteAvoirType = $conn->prepare($queryDeleteAvoirType);
$stmtDeleteAvoirType->bind_param("s", $nomManifestation);
$stmtDeleteAvoirType->execute();

if ($stmtDeleteAvoirType->error) {
    die("Erreur lors de la suppression des enregistrements liés : " . $stmtDeleteAvoirType->error);
}

$stmtDeleteAvoirType->close();

// Requête préparée pour supprimer la manifestation
$query = "DELETE FROM t_manif WHERE Nom=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nomManifestation);
$stmt->execute();

if ($stmt->error) {
    die("Erreur lors de la suppression de la manifestation : " . $stmt->error);
}

$stmt->close();

// Fermer la connexion à la base de données
$conn->close();

// Rediriger vers la page d'index après la suppression
header("Location: /my-app/admin.php");
exit();
?>
