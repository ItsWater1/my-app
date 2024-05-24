<?php
// Fichier du processus de suppression des manifestations. Contient les requêtes SQL.

// Démarrage de la session pour maintenir l'état de connexion de l'utilisateur
session_start();

// Inclure le fichier de connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Récupérer le nom de la manifestation à supprimer depuis le paramètre de l'URL
$nomManifestation = $_GET['nomManifestation'];

// Préparation de la requête pour supprimer les enregistrements liés dans t_manif_avoir_lieu
$queryDeleteAvoirLieu = "DELETE FROM t_manif_avoir_lieu WHERE fk_manif IN (SELECT id_manif FROM t_manif WHERE Nom=?)";
$stmtDeleteAvoirLieu = $conn->prepare($queryDeleteAvoirLieu);
$stmtDeleteAvoirLieu->bind_param("s", $nomManifestation);
$stmtDeleteAvoirLieu->execute();

// Gestion des erreurs pour la suppression des enregistrements liés dans t_manif_avoir_lieu
if ($stmtDeleteAvoirLieu->error) {
    die("Erreur lors de la suppression des enregistrements liés : " . $stmtDeleteAvoirLieu->error);
}
$stmtDeleteAvoirLieu->close();

// Préparation de la requête pour supprimer les enregistrements liés dans t_manif_avoir_type
$queryDeleteAvoirType = "DELETE FROM t_manif_avoir_type WHERE fk_manif IN (SELECT id_manif FROM t_manif WHERE Nom=?)";
$stmtDeleteAvoirType = $conn->prepare($queryDeleteAvoirType);
$stmtDeleteAvoirType->bind_param("s", $nomManifestation);
$stmtDeleteAvoirType->execute();

// Gestion des erreurs pour la suppression des enregistrements liés dans t_manif_avoir_type
if ($stmtDeleteAvoirType->error) {
    die("Erreur lors de la suppression des enregistrements liés : " . $stmtDeleteAvoirType->error);
}
$stmtDeleteAvoirType->close();

// Préparation de la requête pour supprimer la manifestation principale
$query = "DELETE FROM t_manif WHERE Nom=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nomManifestation);
$stmt->execute();

// Gestion des erreurs pour la suppression de la manifestation
if ($stmt->error) {
    die("Erreur lors de la suppression de la manifestation : " . $stmt->error);
}
$stmt->close();

// Fermeture de la connexion à la base de données
$conn->close();

// Redirection vers la page d'administration après la suppression réussie
header("Location: /my-app/admin.php");
exit();
?>
