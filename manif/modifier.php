<?php
include('../DB/liste_ajout.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
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
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />
    <title>Modifier la manifestation</title>
    <link rel="stylesheet" type="text/css" href="../ressources/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br/>
        <h2>Modifier la manifestation -- PENSER A MODIFIER LISTES</h2>
        <form action="process_modifier.php" method="post" id="modifierForm">
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
                <label for="nouveauType">Nouveau Type :</label>
                <select id="nouveauType" name="nouveauType" required>
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
            <div class="form-group">
                <label for="nouveauBenefice">Nouveau Bénéfice :</label>
                <input type="text" id="nouveauBenefice" name="nouveauBenefice" required>
                <div id="nouveauBeneficeFeedback" class="invalid-feedback alert alert-danger d-none"></div>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
