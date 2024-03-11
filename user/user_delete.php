<?php
include('../DB/DB_connexion.php');

session_start();

// Récupérer le nom de l'utilisateur à supprimer depuis le paramètre de l'URL
$user = $_GET['user'];

    // Supprimer l'utilisateur
    $query = "DELETE FROM t_utilisateur WHERE user='$user'";
    $result = $conn->query($query);

    if (!$result) {
    die("Erreur lors de la suppression de la manifestation : " . $conn->error);
    }   

    // Fermer la connexion à la base de données
    $conn->close();

    // Rediriger vers la page d'index après la suppression
    header("Location: ../users.php");
    exit();
?>