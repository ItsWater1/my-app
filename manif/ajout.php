<?php
include('../DB/liste_ajout.php');
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
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
    <title>Modifier la manifestation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br />
        <h2>Ajouter une manifestation</h2>
        <form action="process_ajout.php" method="post">
            <div class="form-group">
                <label for="Nom">Nom de la Manifestation :</label>
                <input type="text" id="Nom" name="Nom" required>
            </div>
            <div class="form-group">
                <label for="Date">Date :</label>
                <input type="date" id="Date" name="Date" required>
            </div>
            <div class="form-group">
                <label for="Lieu">Lieu :</label>
                <select id="Lieu" name="Lieu" required>
                    <?php
                    // Afficher les options pour Lieu
                    if ($resultLieu->num_rows > 0) {
                        while ($row = $resultLieu->fetch_assoc()) {
                            echo "<option value='" . $row["id_lieu"] . "'>" . $row["NomLieu"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Type">Type :</label>
                <select id="Type" name="Type" required>
                    <?php
                    // Afficher les options pour Type
                    if ($resultType->num_rows > 0) {
                        while ($row = $resultType->fetch_assoc()) {
                            echo "<option value='" . $row["id_type"] . "'>" . $row["TypeManif"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
