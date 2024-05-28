<?php
// Page d'affichage pour les admins -> permet la suppression des images.

// Démarrage de la session pour maintenir et vérifier l'état de connexion de l'utilisateur.
session_start();

// Vérifie si l'utilisateur est connecté et a les droits administrateur.
if (!isset($_SESSION['username']) || !$_SESSION['admin']) {
    header("Location: /my-app/login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas admin
    exit();
}

// Inclusion des fichiers nécessaires pour la connexion à la base de données, la barre de navigation, le pied de page, et le modèle d'image.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav_adm.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/album/Image_model.php");

// Définition du fuseau horaire pour une gestion correcte des dates.
date_default_timezone_set('Europe/Zurich');

// Création d'une instance du modèle d'image pour récupérer toutes les images.
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
    <h2 class="text-center mb-4">Administration des images</h2>
    <div class="row justify-content-left">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3">
                <div class="image-container">
                    <!-- Lien pour supprimer chaque image, avec un style visuel clair pour l'action de suppression. -->
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
