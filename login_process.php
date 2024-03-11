<?php
session_start();
require_once('DB/DB_connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $enteredPassword = $_POST['password'];

    $query = "SELECT * FROM t_utilisateur WHERE user='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['Mdp'];

        // Vérification du mot de passe en utilisant le hash
        if (hash('sha256', 'i;151-120#' . $enteredPassword) === $storedPassword) {
            $_SESSION['username'] = $username;

            // Vérifier le niveau d'administration
            if ($row['Level'] == 3) {
                header("Location: admin.php");
            } else {
                header("Location: index.php");
            }
        } else {
            echo "Identifiant ou mot de passe incorrect.";
        }
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
}
?>