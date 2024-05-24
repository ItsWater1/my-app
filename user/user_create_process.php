<?php
// Processus de création de l'utilisateur

// Inclure la connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Démarrer une session pour maintenir l'état de connexion
session_start();

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Récupérer les données envoyées par le formulaire
$user = $_POST['user'];
$mdp = $_POST['mdp'];
$lvl = $_POST['lvl'];

// Hasher le mot de passe pour une sécurité accrue
$hash = hash('sha256', 'i;151-120#' . $mdp);

// Requête SQL pour insérer les informations de l'utilisateur
$sqlCreateUser = "INSERT INTO t_utilisateur (user, Mdp, Level) VALUES (?, ?, ?)";
    
// Préparation de la requête pour éviter les injections SQL
$stmt = $conn->prepare($sqlCreateUser);
$stmt->bind_param("sss", $user, $hash, $lvl);

// Exécution de la requête d'insertion et gestion des erreurs
if ($stmt->execute()) {
    echo "L'utilisateur a été créé avec succès";
} else {
    echo "Erreur lors de la création de l'utilisateur : " . $stmt->error;
}

// Fermeture du statement et de la connexion
$stmt->close();
$conn->close();

// Redirection vers la page de gestion des utilisateurs
header("Location: /my-app/users.php");
exit();
?>
