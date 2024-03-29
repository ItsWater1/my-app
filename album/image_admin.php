<?php
include('../DB/DB_connexion.php');
include('../ressources/nav_adm.php');
include('../ressources/footer.php');
include('imageModel.php');

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
    <title>Administration des images</title>
    <link rel="stylesheet" href="/my-app/ressources/album.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }

        .delete-link {
            position: absolute;
            top: 5px;
            right: 5px;
            color: white;
            background-color: rgba(255, 0, 0, 0.7);
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }

        .delete-link:hover {
            background-color: rgba(255, 0, 0, 0.9);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Administration des images</h2>
    <div class="row justify-content-center">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3">
                <div class="image-container">
                    <a href="image_delete.php?id=<?= $image['id_image'] ?>" class="delete-link">&times;</a>
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
