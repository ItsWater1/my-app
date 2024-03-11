<?php
include('../DB/DB_connexion.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.html");
    exit();
}

$nouveaulvl = $_POST['nouveaulvl'];
$user = $_POST['user'];

// Mettez à jour la table t_utilisateur
$querylvl = "UPDATE t_utilisateur SET level='$nouveaulvl' WHERE user='$user'";
$resultlvl = $conn->query($querylvl);

if (!$resultlvl) {
    die("Erreur lors de la modification du mot de passe : " . $conn->error);
}

$conn->close();

header("Location: ../users.php");
exit();
?>