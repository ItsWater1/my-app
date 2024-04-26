<?php
// Démarre la session
session_start();

// Vérifie si des données sont stockées en session
if(isset($_SESSION['user_id'])) {
    $id_utilisateur = $_SESSION['user_id'];
} else {
    $id_utilisateur = "Aucun utilisateur connecté.";
}

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "Aucun utilisateur connecté.";
}

if(isset($_SESSION['admin'])) {
    $admin_status = $_SESSION['admin'] ? "Administrateur" : "Utilisateur standard";
} else {
    $admin_status = "Statut d'utilisateur inconnu.";
}

// Vérifie si le bouton a été cliqué
if(isset($_POST['afficher'])) {
    echo "ID Utilisateur : " . $id_utilisateur . "<br>";
    echo "Nom d'utilisateur : " . $username . "<br>";
    echo "Statut : " . $admin_status . "<br>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Bouton Session</title>
</head>
<body>

<form method="post" action="">
    <input type="submit" name="afficher" value="Afficher la session">
</form>

</body>
</html>