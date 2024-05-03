<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

$user = $_GET['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
    <title>Modifier le mot de passe</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <br />
        <?php echo "<h2>Modifier le mot de passe de : $user</h2>";?>
        <form action="/my-app/user/user_mdp_process_modifier.php" method="post">
            <div class="form-group">
                <label for="nouveauMDP">Nouveau mot de passe :</label>
                <input type="text" id="nouveauMDP" name="nouveauMDP"required>
            </div>
            <input type="hidden" name="user" value="<?php echo $user; ?>">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
            </div>

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>
</body>
</html>
