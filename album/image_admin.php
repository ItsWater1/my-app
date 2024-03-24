<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

include('../DB/DB_connexion.php');
include('../ressources/nav_adm.php');
include('../ressources/footer.php');
include('imageModel.php');

$imageModel = new ImageModel($conn);
$images = $imageModel->getAllImages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des images</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Administration des images</h2>
    <div class="row justify-content-center">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3">
                <div class="image-container">
                    <img src="uploads/<?= $image['filename'] ?>" alt="Photo" class="img-thumbnail">
                    <div class="image-details">
                        <p><strong>Date :</strong> <?= date('d.m.Y', strtotime($image['date'])) ?></p>
                        <p><strong>Lieu :</strong> <?= $image['NomLieu'] ?></p>
                        <a href="image_delete.php?id=<?= $image['id_image'] ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
