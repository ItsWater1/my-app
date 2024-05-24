<?php
// Processus de modification du niveau de droits de l'utilisateur

// Inclure la connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Démarrer une session pour maintenir l'état de connexion de l'utilisateur
session_start();

// Vérifie si l'utilisateur est connecté et a les droits administrateur.
if (!isset($_SESSION['username']) || !$_SESSION['admin']) {
    header("Location: /my-app/login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas admin
    exit();
}
// Récupérer les données du formulaire envoyées via POST
$nouveaulvl = $_POST['nouveaulvl'];
$user = $_POST['user'];

// Préparer une requête SQL pour mettre à jour le niveau de droits de l'utilisateur
$querylvl = "UPDATE t_utilisateur SET level=? WHERE user=?";
$stmt = $conn->prepare($querylvl);
$stmt->bind_param("ss", $nouveaulvl, $user);

// Exécuter la requête
$stmt->execute();

// Vérifier les erreurs lors de l'exécution de la requête
if ($stmt->error) {
    die("Erreur lors de la modification du niveau de droits : " . $stmt->error);
}

// Fermer le statement pour libérer les ressources
$stmt->close();

// Fermer la connexion à la base de données
$conn->close();

// Rediriger vers la page des utilisateurs après la modification
header("Location: /my-app/users.php");
exit();
?>
