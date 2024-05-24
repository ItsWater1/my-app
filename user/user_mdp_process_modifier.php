<?php
// Processus de modification du mot de passe

// Inclure la connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Démarrer une session pour maintenir et vérifier l'état de connexion de l'utilisateur
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Récupérer les données du formulaire envoyées via POST
$nouveauMDP = $_POST['nouveauMDP'];
$user = $_POST['user'];

// Hasher le nouveau mot de passe pour une sécurité accrue
$MDPhash = hash('sha256', 'i;151-120#' . $nouveauMDP);

// Préparer une requête SQL pour mettre à jour le mot de passe de l'utilisateur
$queryMDP = "UPDATE t_utilisateur SET mdp=? WHERE user=?";
$stmt = $conn->prepare($queryMDP);
$stmt->bind_param("ss", $MDPhash, $user);

// Exécuter la requête
$stmt->execute();

// Vérifier les erreurs lors de l'exécution de la requête
if ($stmt->error) {
    die("Erreur lors de la modification du mot de passe : " . $stmt->error);
}

// Fermer le statement pour libérer les ressources
$stmt->close();

// Fermer la connexion à la base de données
$conn->close();

// Rediriger vers la page des utilisateurs après la modification
header("Location: /my-app/users.php");
exit();
?>
