<?php
include('../DB/DB_connexion.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}
// PREPARER LA REQUETE

$nouveauMDP = $_POST['nouveauMDP'];
$user = $_POST['user'];

$MDPhash = hash('sha256', 'i;151-120#' . $nouveauMDP);

// Mettez à jour la table t_utilisateur
$queryMDP = "UPDATE t_utilisateur SET mdp='$MDPhash' WHERE user='$user'";
$resultMDP = $conn->query($queryMDP);

if (!$resultMDP) {
    die("Erreur lors de la modification du mot de passe : " . $conn->error);
}

$conn->close();

header("Location: /my-app/users.php");
exit();
?>