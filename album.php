<?php
include('ressources/nav.php');
include('ressources/footer.php');
include('DB/DB_connexion.php'); 
include('album/imageModel.php'); 

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
    <title>Visualisation de l'album photo</title>
    <!-- Liens Bootstrap -->
    <link rel="stylesheet" href="/my-app/ressources/album.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 mb-5"> <!-- Ajout de la classe mb-5 pour la marge basse -->
    <h2 class="text-center mb-4">Album photo</h2>
    <div class="row justify-content-center">
        <?php
            // Définir le fuseau horaire
            date_default_timezone_set('Europe/Zurich');
            // Créer une instance du modèle
            $imageModel = new ImageModel($conn);
            // Récupérer toutes les images
            $images = $imageModel->getAllImages();

            // Afficher les images
            foreach ($images as $image) {
                echo '<div class="col-md-3">';
                echo '<div class="image-container">';
                echo '<img src="album/uploads/' . $image['filename'] . '" alt="Photo" class="img-thumbnail" data-toggle="modal" data-target="#imageModal' . $image['id_image'] . '">';
                echo '<div class="image-details">';
                echo '<p><strong>Date :</strong> ' . date('d.m.Y', strtotime($image['date'])) . '</p>';
                echo '<p><strong>Lieu :</strong> ' . $image['NomLieu'] . '</p>';
                echo '</div>'; // Fermeture de la div "image-details"
                echo '</div>'; // Fermeture de la div "image-container"
                echo '</div>';
                // Modal for large image
                echo '<div class="image-modal" id="imageModal' . $image['id_image'] . '">';
                echo '<span class="close" onclick="closeModal(' . $image['id_image'] . ')">&times;</span>';
                echo '<img class="image-modal-content" src="/my-app/album/uploads/' . $image['filename'] . '" alt="Photo">';
                echo '</div>';
            }
        ?>
    </div>
</div>
    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to open modal
        function openModal(id) {
            $('#imageModal' + id).css('display', 'block');
        }

        // Function to close modal
        function closeModal(id) {
            $('#imageModal' + id).css('display', 'none');
        }
    </script>
</body>
</html>

