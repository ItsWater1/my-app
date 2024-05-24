<?php
// Processus de suppression des images

// Démarrage de la session pour accéder et vérifier les informations de l'utilisateur connecté
session_start();

// Rediriger l'utilisateur non connecté vers la page de connexion
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclusion des fichiers nécessaires pour la connexion à la base de données et les opérations sur les images
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/album/ImageModel.php");

// Vérifier si la requête est de type GET et contient l'identifiant de l'image
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $image_id = $_GET['id'];
    $imageModel = new ImageModel($conn);

    // Récupérer le nom de fichier de l'image à supprimer
    $filename = $imageModel->getImageFilename($image_id);

    // Construire le chemin complet du fichier image
    $file_path = "uploads/{$filename}";
    
    // Supprimer le fichier image du serveur
    if (file_exists($file_path)) {
        $success = unlink($file_path); 

        // Afficher une erreur si la suppression du fichier échoue
        if (!$success) {
            $error = error_get_last();
            echo "Erreur lors de la suppression du fichier : " . $error['message'];
        }
    }

    // Supprimer l'entrée de l'image dans la base de données si le fichier a été supprimé avec succès
    $success = $imageModel->deleteImage($image_id);

    // Rediriger l'utilisateur vers la page appropriée selon son statut d'administrateur
    if ($success) {
        if(isset($_SESSION['username']) && isset($_SESSION['admin']) && $_SESSION['admin']){
            header("Location: /my-app/album/image_admin.php");
        }
        else{ 
            header("Location: /my-app/album/image_user.php");
        }
    } 
    else {
        // Afficher un message d'erreur si la suppression dans la base de données échoue
        echo('Erreur lors de la suppression dans la base de données');
    }
}
?>
