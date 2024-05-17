<?php
// Processus de modification du niveau de droits de l'utilisateur

include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Récupère les données du formulaire
$nouveaulvl = $_POST['nouveaulvl'];
$user = $_POST['user'];

// Requête préparée pour mettre à jour le niveau de droits de l'utilisateur
$querylvl = "UPDATE t_utilisateur SET level=? WHERE user=?";
$stmt = $conn->prepare($querylvl);
$stmt->bind_param("ss", $nouveaulvl, $user);
$stmt->execute();

if ($stmt->error) {
    die("Erreur lors de la modification du niveau de droits : " . $stmt->error);
}

// Ferme la requête préparée
$stmt->close();

// Ferme la connexion à la base de données
$conn->close();

// Redirige vers la page des utilisateurs après la modification
header("Location: /my-app/users.php");
exit();
?>
