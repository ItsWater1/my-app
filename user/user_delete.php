<?php
// Suppression de l'utilisateur

// Inclure la connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Démarrer une session pour vérifier l'état de connexion de l'utilisateur
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Récupérer le nom de l'utilisateur à supprimer depuis le paramètre de l'URL
$user = $_GET['user'];

// Préparation de la requête SQL pour supprimer l'utilisateur spécifié
$query = "DELETE FROM t_utilisateur WHERE user=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user);

// Exécution de la requête et vérification des erreurs
if ($stmt->execute()) {
    echo "L'utilisateur a été supprimé avec succès.";
} else {
    die("Erreur lors de la suppression de l'utilisateur : " . $stmt->error);
}

// Fermeture du statement et de la connexion pour libérer les ressources
$stmt->close();
$conn->close();

// Redirection vers la page de gestion des utilisateurs après l'opération
header("Location: /my-app/users.php");
exit();
?>
