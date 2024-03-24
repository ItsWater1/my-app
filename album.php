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

// Définir le fuseau horaire
date_default_timezone_set('Europe/Zurich');

$imageModel = new ImageModel($conn);
$images = $imageModel->getAllImages();
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
<div class="container mt-5">
    <h2 class="text-center mb-4">Album Photo</h2>
    <div class="row justify-content-center">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3">
                <div class="image-container">
                    <img src="/my-app/album/uploads/<?= $image['filename'] ?>" alt="Photo" class="img-thumbnail">
                    <div class="image-details">
                        <p>
                            <?= $image['NomLieu'] ?>
                            , le <?= date('d.m.Y', strtotime($image['date'])) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>

