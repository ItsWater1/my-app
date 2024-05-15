<?php
// Page d'affichage pour les admins -> permet la suppression des images.
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

include('../DB/DB_connexion.php');
include('../ressources/nav.php');
include('../ressources/footer.php');
include('imageModel.php');

// Définir le fuseau horaire
date_default_timezone_set('Europe/Zurich');

$imageModel = new ImageModel($conn);

// Récupérer l'ID de l'utilisateur à partir de la session
$userID = $_SESSION['user_id'];

// Récupérer uniquement les images téléversées par l'utilisateur actuellement connecté
$images = $imageModel->getAllImagesByUser($userID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes images</title>
    <link rel="stylesheet" href="/my-app/ressources/album.css">
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="text-center mb-4">Mes images</h2>
    <div class="row justify-content-left">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3">
                <div class="image-container">
                    <a href="image_delete.php?id=<?= $image['id_image'] ?>" class="delete-link">&times;</a>
                    <img src="/my-app/album/uploads/<?= $image['filename'] ?>" alt="Photo" class="img-thumbnail">
                    <div class="image-details">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
