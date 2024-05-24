<?php
// Formulaire de modification des manifestations (page admin).

// Inclusion des options de lieu et type depuis une source externe pour remplir les listes déroulantes.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/liste_ajout.php");
// Démarre une session pour maintenir l'état de connexion de l'utilisateur.
session_start();

// Vérifie si l'utilisateur est connecté et a les droits administrateur.
if (!isset($_SESSION['username']) || !$_SESSION['admin']) {
    header("Location: /my-app/login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas admin
    exit();
}

// Récupère les informations actuelles de la manifestation à partir des paramètres GET.
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
    <link rel="stylesheet" href="/my-app/bootstrap/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; 
        }
        .container {
            margin-top: 50px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-5">Modifier la manifestation</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Formulaire de soumission pour les modifications avec les champs pré-remplis -->
                <form action="/my-app/manif/process_modifier.php" method="post" id="modifierForm">
                    <input type="hidden" name="ancienNom" value="<?php echo $nomManifestation; ?>"> 
                    <div class="form-group">
                        <label for="nouveauNom">Nouveau Nom :</label>
                        <input type="text" id="nouveauNom" name="nouveauNom" value="<?php echo $nomManifestation; ?>" class="form-control" required>
                        <div id="nouveauNomFeedback" class="invalid-feedback alert alert-danger d-none"></div>
                    </div>
                    <div class="form-group">
                        <label for="nouvelleDate">Nouvelle Date :</label>
                        <input type="date" id="nouvelleDate" name="nouvelleDate" value="<?php echo $date; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nouveauLieu">Nouveau Lieu :</label>
                        <select id="nouveauLieu" name="nouveauLieu" class="form-control" required>
                            <?php
                            // Affiche les options de lieu avec l'option actuelle comme sélectionnée par défaut.
                            echo "<option value='$lieu' selected>$lieu</option>";
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
                        <select id="nouveauType" name="nouveauType" class="form-control" required>
                            <?php
                            // Affiche les options de type de manifestation avec l'option actuelle comme sélectionnée.
                            echo "<option value='$type' selected>$type</option>";
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
                        <input type="text" id="nouveauBenefice" name="nouveauBenefice" class="form-control" required>
                        <div id="nouveauBeneficeFeedback" class="invalid-feedback alert alert-danger d-none"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>
    <script>
        // Script JavaScript pour valider les champs du formulaire avant la soumission.
        document.getElementById('modifierForm').addEventListener('submit', function(event) {
            var nouveauNomInput = document.getElementById('nouveauNom');
            var nouveauBeneficeInput = document.getElementById('nouveauBenefice');

            var nomPattern = /^[a-zA-Z\s]*$/; // Vérifie que le nom ne contient que des lettres et des espaces.
            var beneficePattern = /^\d+$/; // Vérifie que le bénéfice est un nombre.

            // Validation conditionnelle pour s'assurer que les données entrées sont correctes.
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
