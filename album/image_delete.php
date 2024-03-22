<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

include('../DB/DB_connexion.php');
include('imageModel.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $image_id = $_GET['id'];
    $imageModel = new ImageModel($conn);
    $success = $imageModel->deleteImage($image_id);

    if ($success) {
        // Suppression réussie dans la base de données, maintenant supprimer le fichier
        $filename = $imageModel->getImageFilename($image_id);
        $file_path = "../uploads/{$filename}"; // Assurez-vous que le chemin est correct

        // Vérifier si le fichier existe avant de tenter de le supprimer
        if (file_exists($file_path)) {
            unlink($file_path); // Supprime le fichier image du dossier
        }
    }

    header("Location: /my-app/album/image_admin.php");
    exit();
}
?>
