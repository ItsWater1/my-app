<?php
// Formulaire de modification des manifestations (page admin).

include('../DB/liste_ajout.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
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
    <link rel="shortcut icon" type="image/x-icon" href="/my-app/images/logo.png" />
    <title>Modifier la manifestation</title>
    <link rel="stylesheet" type="text/css" href="../ressources/styles.css" />
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <br/>
        <h2>Modifier la manifestation</h2>
        <form action="/my-app/manif/process_modifier.php" method="post" id="modifierForm">
            <input type="hidden" name="ancienNom" value="<?php echo $nomManifestation; ?>">
            <div class="form-group">
                <label for="nouveauNom">Nouveau Nom :</label>
                <input type="text" id="nouveauNom" name="nouveauNom" value="<?php echo $nomManifestation; ?>" required>
                <div id="nouveauNomFeedback" class="invalid-feedback alert alert-danger d-none"></div>
            </div>
            <div class="form-group">
                <label for="nouvelleDate">Nouvelle Date :</label>
                <input type="date" id="nouvelleDate" name="nouvelleDate" value="<?php echo $date; ?>" required>
            </div>
            <div class="form-group">
                <label for="nouveauLieu">Nouveau Lieu :</label>
                <select id="nouveauLieu" name="nouveauLieu" required>
                    <?php
                    // Afficher l'option pour $lieu en premier
                    echo "<option value='$lieu' selected>$lieu</option>";

                    // Afficher les autres options pour Lieu
                    if ($resultLieu->num_rows > 0) {
                        while ($row = $resultLieu->fetch_assoc()) {
                            if ($row["id_lieu"] != $lieu) {
                                echo "<option value='" . $row["id_lieu"] . "'>" . $row["NomLieu"] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nouveauType">Nouveau Type :</label>
                <select id="nouveauType" name="nouveauType" required>
                    <?php
                    // Afficher l'option pour $type en premier
                    echo "<option value='$type' selected>$type</option>";

                    // Afficher les autres options pour type
                    if ($resultType->num_rows > 0) {
                        while ($row = $resultType->fetch_assoc()) {
                            if ($row["id_type"] != $type) {
                                echo "<option value='" . $row["id_type"] . "'>" . $row["TypeManif"] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nouveauBenefice">Nouveau Bénéfice :</label>
                <input type="text" id="nouveauBenefice" name="nouveauBenefice" required>
                <div id="nouveauBeneficeFeedback" class="invalid-feedback alert alert-danger d-none"></div>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/boostrap.min.js"></script>
    <script>
        document.getElementById('modifierForm').addEventListener('submit', function(event) {
            var nouveauNomInput = document.getElementById('nouveauNom');
            var nouveauBeneficeInput = document.getElementById('nouveauBenefice');

            var nomPattern = /^[a-zA-Z\s]*$/;
            var beneficePattern = /^\d+$/;

            if (!nomPattern.test(nouveauNomInput.value)) {
                nouveauNomInput.classList.add('is-invalid');
                document.getElementById('nouveauNomFeedback').textContent = 'Le format de la donnée entrée est invalide.';
                document.getElementById('nouveauNomFeedback').classList.remove('d-none');
                event.preventDefault();
            } else {
                nouveauNomInput.classList.remove('is-invalid');
                document.getElementById('nouveauNomFeedback').classList.add('d-none');
            }

            if (!beneficePattern.test(nouveauBeneficeInput.value)) {
                nouveauBeneficeInput.classList.add('is-invalid');
                document.getElementById('nouveauBeneficeFeedback').textContent = 'Le format de la donnée entrée est invalide.';
                document.getElementById('nouveauBeneficeFeedback').classList.remove('d-none');
                event.preventDefault();
            } else {
                nouveauBeneficeInput.classList.remove('is-invalid');
                document.getElementById('nouveauBeneficeFeedback').classList.add('d-none');
            }
        });
    </script>
</body>
</html>
