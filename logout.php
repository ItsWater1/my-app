<?php
session_start();

// D�truire toutes les donn�es de session
session_destroy();

// Rediriger vers la page de connexion
header("Location: login.php");
exit();
?>
