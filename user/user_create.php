<?php
// Formulaire de création de l'utilisateur
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
        <br />
        <?php echo "<h2>Création d'un nouvel utilisateur</h2>"; ?>
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

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>

    <script>
        document.getElementById('addUser').addEventListener('submit', function(event) {
            var userInput = document.getElementById('user');
            var userPattern = /^[a-zA-Z\s]*$/;

            if (!userPattern.test(userInput.value)) {
                userInput.classList.add('is-invalid');
                document.getElementById('userFeedback').textContent = 'Le format de la donnée entrée est invalide.';
                document.getElementById('userFeedback').classList.remove('d-none');
                event.preventDefault();
            } else {
                userInput.classList.remove('is-invalid');
                document.getElementById('userFeedback').classList.add('d-none');
            }
        });
    </script>
</body>
</html>
