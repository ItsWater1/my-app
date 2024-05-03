<?php
session_start();

include('../ressources/nav.php');
include('../ressources/footer.php');

if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

include('../DB/DB_connexion.php'); // Inclure le fichier de connexion à la base de données
include('imageModel.php'); // Inclure le modèle

$imageModel = new ImageModel($conn); // Créer une instance du modèle

// Récupérer la liste des lieux depuis le modèle
$listeLieux = $imageModel->getDistinctLieux();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'album photo</title>
    <!-- Liens Bootstrap -->
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Ajouter une nouvelle photo</h2>
                    </div>
                    <div class="card-body">
                        <form action="image_upload.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image :</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date :</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="lieu" class="form-label">Lieu :</label>
                                <select name="lieu" id="lieu" class="form-control" required>
                                    <option value="">Sélectionnez un lieu</option>
                                    <?php
                                        // Afficher les lieux récupérés depuis le modèle
                                        foreach ($listeLieux as $lieu) {
                                            echo "<option value=\"" . $lieu['id_lieu'] . "\">" . $lieu['NomLieu'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/bootstrap/boostrap.min.js"></script>
</body>
</html>

<?php
// Code PHP pour le traitement du formulaire et l'ajout d'image
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $filename = $_FILES['image']['name'];
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];
    $user_id = $_SESSION['user_id']; // Supposons que l'ID de l'utilisateur est stocké dans la session

    // Appeler la fonction d'insertion d'image du modèle
    $imageModel->insertImage($filename, $date, $lieu, $user_id);

    // Redirection après l'ajout de l'image
    header("Location: some_page.php");
    exit();
}
?>
