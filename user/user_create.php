<?php
// Formulaire de création de l'utilisateur

// Démarre une session et redirige l'utilisateur non authentifié vers la page de connexion.
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
    <title>Création d'utilisateur</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Création d'un nouvel utilisateur</h2> 
        <form action="/my-app/user/user_create_process.php" method="post" id="addUser">
            <div class="form-group">
                <label for="user">Nom d'utilisateur :</label>
                <input type="text" id="user" name="user" required class="form-control">
                <div id="userFeedback" class="invalid-feedback alert alert-danger d-none"></div>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe :</label>
                <input type="text" id="mdp" name="mdp" required class="form-control">
            </div>
            <div class="form-group">
                <label for="lvl">Niveau de droits :</label>
                <select id="lvl" name="lvl" required class="form-control">
                    <option>0</option> 
                    <option>1</option> 
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>

    <!-- Scripts JavaScript pour Bootstrap et validation côté client -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>

    <script>
        // Ajout d'un gestionnaire d'événements pour la soumission du formulaire
        document.getElementById('addUser').addEventListener('submit', function(event) {
            var userInput = document.getElementById('user');
            var userPattern = /^[a-zA-Z\s]*$/; // Expression régulière pour valider le format du nom d'utilisateur.

            // Vérifie si le nom d'utilisateur correspond au motif défini
            if (!userPattern.test(userInput.value)) {
                userInput.classList.add('is-invalid'); // Ajoute la classe pour indiquer une erreur.
                document.getElementById('userFeedback').textContent = 'Le format de la donnée entrée est invalide.';
                document.getElementById('userFeedback').classList.remove('d-none'); // Affiche le message d'erreur.
                event.preventDefault(); // Empêche la soumission du formulaire si invalide.
            } else {
                userInput.classList.remove('is-invalid'); // Retire la classe d'erreur si le format est valide.
                document.getElementById('userFeedback').classList.add('d-none'); // Cache le message d'erreur.
            }
        });
    </script>
</body>
</html>
