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
    <title>Modifier les droits</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <br />
        <?php echo "<h2>Modifier le niveau de droit de : $user</h2>";?>
        <form action="/my-app/user/user_lvl_process_modifier.php" method="post">
            <div class="form-group">
                <label for="nouveaulvl">Nouveau niveau de droits :</label>
                <select id="nouveaulvl" name="nouveaulvl"required>
                    <option>0</option>
                    <option>1</option>
                </select>
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
