<?php
include('../DB/DB_connexion.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
    // Récupérer les données
    $ancienNom = $_POST['ancienNom'];
    $nouveauNom = $_POST['nouveauNom'];
    $nouvelleDate = $_POST['nouvelleDate'];
    $nouveauLieu = $_POST['nouveauLieu'];
    $nouveauType = $_POST['nouveauType'];
    $nouveauBenefice = $_POST['nouveauBenefice'];

    // Mise à jour de la table t_manif (si on écrit aucun la valeur NULL est définie)
    if ($nouveauBenefice === "0") {
        $queryManif = "UPDATE t_manif SET Nom=?, Date=?, Benefice=NULL WHERE Nom=?";
        $stmtManif = $conn->prepare($queryManif);
        $stmtManif->bind_param("sss", $nouveauNom, $nouvelleDate, $ancienNom);
    } 
    else {
        $queryManif = "UPDATE t_manif SET Nom=?, Date=?, Benefice=? WHERE Nom=?";
        $stmtManif = $conn->prepare($queryManif);
        $stmtManif->bind_param("ssss", $nouveauNom, $nouvelleDate, $nouveauBenefice, $ancienNom);
    }

    $resultManif = $stmtManif->execute();

    if (!$resultManif) {
        die("Erreur lors de la modification de la manifestation : " . $conn->error);
    }

    $stmtManif->close();

    // Mise à jour la table t_lieu
    $queryLieu = "UPDATE t_manif_avoir_lieu
                SET fk_lieu = ?
                WHERE fk_manif = (SELECT id_manif FROM t_manif WHERE Nom = ?)";
    $stmtLieu = $conn->prepare($queryLieu);
    $stmtLieu->bind_param("is", $nouveauLieu, $nouveauNom);
    $resultLieu = $stmtLieu->execute();

    if (!$resultLieu) {
        die("Erreur lors de la mise à jour du lieu : " . $stmtLieu->error);
    }

    $stmtLieu->close();

    // Mise à jour la table t_type
    $queryType = "UPDATE t_manif_avoir_type
                SET fk_type = ?
                WHERE fk_manif = (SELECT id_manif FROM t_manif WHERE Nom = ?)";
    $stmtType = $conn->prepare($queryType);
    $stmtType->bind_param("is", $nouveauType, $nouveauNom);
    $resultType = $stmtType->execute();

    if (!$resultType) {
        die("Erreur lors de la modification du type : " . $conn->error);
    }

    $stmtType->close();

    $conn->close();

    header("Location: ../admin.php");
    exit();
?>