<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$user = $_GET['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />
    <title>Modifier le mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br />
        <?php echo "<h2>Modifier le mot de passe de : $user</h2>";?>
        <form action="user_mdp_process_modifier.php" method="post">
            <div class="form-group">
                <label for="nouveauMDP">Nouveau Mot de passe :</label>
                <input type="text" id="nouveauMDP" name="nouveauMDP"required>
            </div>
            <input type="hidden" name="user" value="<?php echo $user; ?>">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
            </div>

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
