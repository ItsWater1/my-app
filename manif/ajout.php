<?php
// Formulaire de création d'une manifestation (page admin).

// Inclut les options pour les champs de formulaire "Lieu" et "Type"
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/liste_ajout.php");

// Démarre une session pour maintenir l'état de connexion de l'utilisateur
session_start();

// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
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
    <link rel="stylesheet" href="/my-app/bootstrap/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; // Couleur de fond pour une apparence propre et moderne
        }
        .container {
            margin-top: 50px; // Marge pour éloigner le formulaire de la partie supérieure de la page
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Ajouter une manifestation</h2>
        <form action="/my-app/manif/process_ajout.php" method="post" id="addForm">
            <div class="form-group">
                <label for="Nom">Nom :</label>
                <input type="text" id="Nom" name="Nom" class="form-control" required>
                <div id="NomFeedback" class="invalid-feedback alert alert-danger d-none"></div>
            </div>
            <div class="form-group">
                <label for="Date">Date :</label>
                <input type="date" id="Date" name="Date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Lieu">Lieu :</label>
                <select id="Lieu" name="Lieu" class="form-control" required>
                    <?php
                    // Dynamiquement remplir les options de lieu à partir de la base de données
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
                <select id="Type" name="Type" class="form-control" required>
                    <?php
                    // Dynamiquement remplir les options de type à partir de la base de données
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

    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>
    <script>
        // Validation JavaScript pour s'assurer que le nom de la manifestation est conforme aux attentes
        document.getElementById('addForm').addEventListener('submit', function(event) {
            var NomInput = document.getElementById('Nom');
            var nomPattern = /^[a-zA-Z\s]*$/; // Regex pour valider que le nom contient uniquement des lettres et des espaces

            if (!nomPattern.test(NomInput.value)) {
                NomInput.classList.add('is-invalid');
                document.getElementById('NomFeedback').textContent = 'Le format de la donnée entrée est invalide.';
                document.getElementById('NomFeedback').classList.remove('d-none');
                event.preventDefault(); // Empêcher la soumission du formulaire si non valide
            } else {
                NomInput.classList.remove('is-invalid');
                document.getElementById('NomFeedback').classList.add('d-none');
            }
        });
    </script>
</body>
</html>
