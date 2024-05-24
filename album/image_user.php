<?php
// Page d'affichage pour les admins -> permet la suppression des images.

// Démarrage de la session pour maintenir l'état de connexion de l'utilisateur
session_start();

// Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclusion des fichiers nécessaires pour la connexion à la base de données, la barre de navigation, le pied de page, et le modèle d'image
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/album/ImageModel.php");

// Définir le fuseau horaire pour gérer correctement les dates
date_default_timezone_set('Europe/Zurich');

// Création d'une instance du modèle d'image pour récupérer les images
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
                    <!-- Lien pour supprimer l'image, avec une icône de suppression (×) -->
                    <a href="image_delete.php?id=<?= $image['id_image'] ?>" class="delete-link">&times;</a>
                    <!-- Affichage de l'image téléversée -->
                    <img src="/my-app/album/uploads/<?= $image['filename'] ?>" alt="Photo" class="img-thumbnail">
                    <div class="image-details">
                        <!-- Détails supplémentaires sur l'image peuvent être ajoutés ici -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
