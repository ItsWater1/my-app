<?php
include('../DB/DB_connexion.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.html");
    exit();
}

$ancienNom = $_POST['ancienNom'];
$nouveauNom = $_POST['nouveauNom'];
$nouvelleDate = $_POST['nouvelleDate'];
$nouveauLieu = $_POST['nouveauLieu'];
$nouveauType = $_POST['nouveauType'];
$nouveauBenefice = $_POST['nouveauBenefice'];
// R�cup�rez les autres champs du formulaire ici

// Mettez � jour la table t_manif
$queryManif = "UPDATE t_manif SET Nom='$nouveauNom', Date='$nouvelleDate', Benefice='$nouveauBenefice' WHERE Nom='$ancienNom'";
$resultManif = $conn->query($queryManif);

if (!$resultManif) {
    die("Erreur lors de la modification de la manifestation : " . $conn->error);
}

// Mettez � jour la table t_lieu
$queryLieu = "UPDATE t_manif_avoir_lieu
              SET fk_lieu = (SELECT id_lieu FROM t_lieu WHERE NomLieu = '$nouveauLieu')
              WHERE fk_manif = (SELECT id_manif FROM t_manif WHERE Nom = '$nouveauNom')";
$resultLieu = $conn->query($queryLieu);

if (!$resultLieu) {
    die("Erreur lors de la modification du lieu : " . $conn->error);
}

// Mettez � jour la table t_type
$queryType = "UPDATE t_manif_avoir_type
              SET fk_type = (SELECT id_type FROM t_type WHERE TypeManif = '$nouveauType')
              WHERE fk_manif = (SELECT id_manif FROM t_manif WHERE Nom = '$nouveauNom')";
$resultType = $conn->query($queryType);

if (!$resultType) {
    die("Erreur lors de la modification du type : " . $conn->error);
}

$conn->close();

header("Location: ../admin.php");
exit();
?>