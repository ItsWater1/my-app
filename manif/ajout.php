<?php
include('../DB/liste_ajout.php');
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
    <title>Ajouter une manifestation</title>
    <link rel="stylesheet" type="text/css" href="/my-app/ressources/styles.css" />
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <br />
        <h2>Ajouter une manifestation</h2>
        <form action="/my-app/manif/process_ajout.php" method="post" id="addForm">
            <div class="form-group">
                <label for="Nom">Nom :</label>
                <input type="text" id="Nom" name="Nom" required>
                <div id="NomFeedback" class="invalid-feedback alert alert-danger d-none"></div>
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
                            $selected = ($row["id_lieu"] == $lieu) ? "selected" : ""; // Vérifie si l'option correspond à la valeur actuelle
                            echo "<option value='" . $row["id_lieu"] . "' $selected>" . $row["NomLieu"] . "</option>";
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
                            $selected = ($row["id_type"] == $type) ? "selected" : ""; // Vérifie si l'option correspond à la valeur actuelle
                            echo "<option value='" . $row["id_type"] . "' $selected>" . $row["TypeManif"] . "</option>";
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
    <script src="/my-app/bootstrap/boostrap.min.js"></script>
    <script>
        document.getElementById('addForm').addEventListener('submit', function(event) {
            var NomInput = document.getElementById('Nom');
            var nomPattern = /^[a-zA-Z\s]*$/;

            if (!nomPattern.test(NomInput.value)) {
                NomInput.classList.add('is-invalid');
                document.getElementById('NomFeedback').textContent = 'Le format de la donnée entrée est invalide.';
                document.getElementById('NomFeedback').classList.remove('d-none');
                event.preventDefault();
            } else {
                NomInput.classList.remove('is-invalid');
                document.getElementById('NomFeedback').classList.add('d-none');
            }
        });
    </script>
</body>
</html>

