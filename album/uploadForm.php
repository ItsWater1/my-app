<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

include('../DB/DB_connexion.php'); // Inclure le fichier de connexion à la base de données
include('imageModel.php'); // Assurez-vous que le chemin est correct

// Récupérer la liste des lieux depuis la base de données
$listeLieux = array();

$sql = "SELECT * FROM t_lieu"; // Sélectionner tous les lieux
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $listeLieux[] = $row; // Ajouter chaque lieu à la liste
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'album photo</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />
    <!-- Liens Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                                        // Afficher les lieux récupérés depuis la base de données
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
