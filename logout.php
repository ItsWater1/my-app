<?php
session_start();

// Détruire toutes les données de session
session_destroy();

// Rediriger vers la page de connexion
header("Location: /my-app/login.php");
exit();
?>
