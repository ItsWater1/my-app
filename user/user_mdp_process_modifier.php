<?php
// Processus de modification du mot de passe

include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Récupère les données du formulaire
$nouveauMDP = $_POST['nouveauMDP'];
$user = $_POST['user'];

// Utilisez votre propre hachage pour le nouveau mot de passe
$MDPhash = hash('sha256', 'i;151-120#' . $nouveauMDP);

// Requête préparée pour mettre à jour le mot de passe de l'utilisateur
$queryMDP = "UPDATE t_utilisateur SET mdp=? WHERE user=?";
$stmt = $conn->prepare($queryMDP);
$stmt->bind_param("ss", $MDPhash, $user);
$stmt->execute();

if ($stmt->error) {
    die("Erreur lors de la modification du mot de passe : " . $stmt->error);
}

// Ferme la requête préparée
$stmt->close();

// Ferme la connexion à la base de données
$conn->close();

// Redirige vers la page des utilisateurs après la modification
header("Location: /my-app/users.php");
exit();
?>
