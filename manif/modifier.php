<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.html");
    exit();
}

$nomManifestation = $_GET['nomManifestation'];
$date = $_GET['date'];
$lieu = $_GET['lieu'];
$type = $_GET['type'];
$benefice = $_GET['benefice'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
    <title>Modifier la manifestation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br />
        <h2>Modifier la manifestation</h2>
        <form action="process_modifier.php" method="post">
            <input type="hidden" name="ancienNom" value="<?php echo $nomManifestation; ?>">
            <div class="form-group">
                <label for="nouveauNom">Nouveau Nom de Manifestation :</label>
                <input type="text" id="nouveauNom" name="nouveauNom" value="<?php echo $nomManifestation; ?>" required>
            </div>
            <div class="form-group">
                <label for="nouvelleDate">Nouvelle Date :</label>
                <input type="date" id="nouvelleDate" name="nouvelleDate" value="<?php echo $date; ?>" required>
            </div>
            <div class="form-group">
                <label for="nouveauLieu">Nouveau Lieu :</label>
                <input type="text" id="nouveauLieu" name="nouveauLieu" value="<?php echo $lieu; ?>" required>
            </div>
            <div class="form-group">
                <label for="nouveauType">Nouveau Type :</label>
                <input type="text" id="nouveauType" name="nouveauType" value="<?php echo $type; ?>" required>
            </div>
           <div class="form-group">
                <label for="nouveauBenefice">Nouveau Benefice :</label>
                <input type="float" id="nouveauBenefice" name="nouveauBenefice" value="<?php echo $benefice; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
