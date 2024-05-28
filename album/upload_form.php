<?php
// Formulaire d'ajout d'image

// Démarrage de la session pour vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['username'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: /my-app/login.php");
    exit();
}

// Inclusion des fichiers nécessaires pour la barre de navigation, le pied de page, la connexion à la base de données et le modèle d'image
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/album/image_model.php");

// Créer une instance du modèle d'image
$imageModel = new ImageModel($conn);

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
    <style>
        body {
            background-color: #f8f9fa; /* Couleur de fond claire pour la page */
        }
        .container {
            margin-top: 50px; /* Marge supérieure pour espacer le contenu du haut de la page */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Ajouter une nouvelle photo</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        // Vérifier s'il y a un message d'erreur dans la session
                        if (isset($_SESSION['error_message'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                            // Une fois affiché, nettoyer la variable de session
                            unset($_SESSION['error_message']);
                        }
                        ?>
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
