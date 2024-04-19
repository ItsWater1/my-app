<?php
// Fichier de connexion à la base de données.

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Module151_jeunesse";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>