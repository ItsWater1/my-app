<?php
// Fichier du processus de modification des manifestations. Il contient les requêtes SQL.

// Inclut le fichier de connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Démarre la session pour accéder aux variables de session
session_start();

// Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Récupère les données envoyées par le formulaire
$ancienNom = $_POST['ancienNom'];
$nouveauNom = $_POST['nouveauNom'];
$nouvelleDate = $_POST['nouvelleDate'];
$nouveauLieu = $_POST['nouveauLieu'];
$nouveauType = $_POST['nouveauType'];
$nouveauBenefice = $_POST['nouveauBenefice'];

// Met à jour les informations de la manifestation. Utilise NULL pour le bénéfice si spécifié comme "aucun"
if ($nouveauBenefice === "0") {
    $queryManif = "UPDATE t_manif SET Nom=?, Date=?, Benefice=NULL WHERE Nom=?";
    $stmtManif = $conn->prepare($queryManif);
    $stmtManif->bind_param("sss", $nouveauNom, $nouvelleDate, $ancienNom);
} else {
    $queryManif = "UPDATE t_manif SET Nom=?, Date=?, Benefice=? WHERE Nom=?";
    $stmtManif = $conn->prepare($queryManif);
    $stmtManif->bind_param("ssss", $nouveauNom, $nouvelleDate, $nouveauBenefice, $ancienNom);
}

$resultManif = $stmtManif->execute();

// Vérifie le succès de la requête et gère les erreurs
if (!$resultManif) {
    die("Erreur lors de la modification de la manifestation : " . $conn->error);
}
$stmtManif->close();

// Met à jour le lieu de la manifestation
$queryLieu = "UPDATE t_manif_avoir_lieu SET fk_lieu = ?
              WHERE fk_manif = (SELECT id_manif FROM t_manif WHERE Nom = ?)";
$stmtLieu = $conn->prepare($queryLieu);
$stmtLieu->bind_param("is", $nouveauLieu, $nouveauNom);
$resultLieu = $stmtLieu->execute();

if (!$resultLieu) {
    die("Erreur lors de la mise à jour du lieu : " . $stmtLieu->error);
}
$stmtLieu->close();

// Met à jour le type de la manifestation
$queryType = "UPDATE t_manif_avoir_type SET fk_type = ?
              WHERE fk_manif = (SELECT id_manif FROM t_manif WHERE Nom = ?)";
$stmtType = $conn->prepare($queryType);
$stmtType->bind_param("is", $nouveauType, $nouveauNom);
$resultType = $stmtType->execute();

if (!$resultType) {
    die("Erreur lors de la modification du type : " . $stmtType->error);
}
$stmtType->close();

// Ferme la connexion à la base de données
$conn->close();

// Redirige l'utilisateur vers la page d'administration après la mise à jour
header("Location: /my-app/admin.php");
exit();
?>
