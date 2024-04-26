<?php
// Ce code sert à vérifier que la connexion est correcte. Il redirige aussi sur la bonne page en fonction de notre niveau de droits.
// PREPARER LA REQUETE

session_start();
require_once('DB/DB_connexion.php');

// Initialisation de la variable du message d'erreur
$error_message = "";

// Vérification du captcha
if(isset($_POST['captcha'])){
    if($_POST['captcha'] == $_SESSION['captcha']) {
        // Captcha valide, poursuivre avec la vérification de l'authentification
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
                    $_SESSION['admin'] = ($row['Level'] == 1); // Stocker le statut d'administrateur dans la session
                    $_SESSION['user_id'] = $row['id_utilisateur'];
                    
                    // Redirection en fonction du niveau d'administration
                    if ($_SESSION['admin']) {
                        header("Location: /my-app/admin.php");
                    } else {
                        header("Location: /my-app/index.php");
                    }
                    exit(); 
                } else {
                    $error_message = "Identifiant ou mot de passe incorrect.";
                }
            } else {
                $error_message = "Identifiant ou mot de passe incorrect.";
            }
        }
    } else {
        $error_message = "Captcha invalide.";
    }
}

// JavaScript pour afficher la boîte de dialogue d'erreur si nécessaire et rediriger vers login.php
if(!empty($error_message)) {
    echo "<script>alert('$error_message'); window.location.href = '/my-app/login.php';</script>";
}
?>