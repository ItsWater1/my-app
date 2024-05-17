<?php
// Suppression de l'utilisateur

include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Récupérer le nom de l'utilisateur à supprimer depuis le paramètre de l'URL
$user = $_GET['user'];

// Requête préparée pour supprimer l'utilisateur
$query = "DELETE FROM t_utilisateur WHERE user=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user);
$stmt->execute();

if ($stmt->error) {
    die("Erreur lors de la suppression de l'utilisateur : " . $stmt->error);
}

// Fermer la requête préparée
$stmt->close();

// Fermer la connexion à la base de données
$conn->close();

// Rediriger vers la page des utilisateurs après la suppression
header("Location: /my-app/users.php");
exit();
?>
