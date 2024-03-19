<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />
    <title>Création d'utilisateur</title>
    <link rel="stylesheet" type="text/css" href="../ressources/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br />
        <?php echo "<h2>Création d'un nouvel utilisateur</h2>";?>
        <form action="user_create_process.php" method="post" id="addUser">
            <div class="form-group">
                <label for="user">Nom d'utilisateur :</label>
                <input type="text" id="user" name="user" required>
                <div id="userFeedback" class="invalid-feedback alert alert-danger d-none"></div>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe :</label>
                <input type="text" id="mdp" name="mdp"required>
            </div>
            <div class="form-group">
                <label for="lvl">Niveau de droits :</label>
                <select id="lvl" name="lvl"required>
                    <option>0</option>
                    <option>1</option>
                </select>


            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
