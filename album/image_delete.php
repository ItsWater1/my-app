<?php
// Processus de suppression des images

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/album/ImageModel.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $image_id = $_GET['id'];
    $imageModel = new ImageModel($conn);
    $filename = $imageModel->getImageFilename($image_id);

    // Supprimer le fichier en premier sinon $file_path est faux
    $file_path = "uploads/{$filename}";
    if (file_exists($file_path)) {
        $success = unlink($file_path); 

        if (!$success) {
            $error = error_get_last();
            echo "Erreur lors de la suppression du fichier : " . $error['message'];
        }
    }

    // Supprimer l'enregistrement dans la base de données après avoir supprimé le fichier
    $success = $imageModel->deleteImage($image_id);

    if ($success) {
        if(isset($_SESSION['username']) && isset($_SESSION['admin']) && $_SESSION['admin']){
            header("Location: /my-app/album/image_admin.php");
        }
        else{ 
            header("Location: /my-app/album/image_user.php");
        }
    } 
    else {
        // Gérer les cas d'échec de suppression dans la base de données
        echo('Erreur lors de la suppression dans la base de données');
    }

}
?>