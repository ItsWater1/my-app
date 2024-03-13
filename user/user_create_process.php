<?php
include('../DB/DB_connexion.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$user = $_POST['user'];
$mdp = $_POST['mdp'];
$lvl = $_POST['lvl'];

$hash = hash('sha256', 'i;151-120#' . $mdp);

// Créer les données dans la table manif
$sqlCreateUser = "INSERT INTO t_utilisateur (user, Mdp, Level) VALUES (?, ?, ?)";
    
// Utiliser une requête préparée pour éviter les injections SQL
$stmt = $conn->prepare($sqlCreateUser);
$stmt->bind_param("sss", $user, $hash, $lvl);

// Exécuter la requête d'insertion
if ($stmt->execute()) {
     echo "L'utilisateur a été créé avec succès";
} 
    else {
     echo "Erreur lors de la création de l'utilisateur : " . $stmt->error;
    }

 $stmt->close();

 $conn->close();

header("Location: ../users.php");
exit();
?>
