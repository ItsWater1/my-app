<?php
include('../DB/DB_connexion.php');
include('imageModel.php');

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créer une instance du modèle
    $imageModel = new ImageModel($conn);
    
    // Récupérer les données soumises par le formulaire
    $filename = $_FILES["image"]["name"];
    $date = $_POST["date"];
    $lieu = $_POST["lieu"];
    
    // Générer un identifiant unique pour le nom de fichier
    $random_chars = uniqid();
    $filename_with_random = $random_chars . "_" . $filename; // Ajout de caractères aléatoires au nom du fichier
    
    // Chemin de destination pour l'image téléversée
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($filename_with_random);
    
    // Téléverser l'image
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insérer les informations de l'image dans la base de données
        $imageModel->insertImage($filename_with_random, $date, $lieu); // Utiliser le nom de fichier avec les caractères aléatoires
        echo "L'image a été téléversée avec succès.";
    } else {
        echo "Une erreur s'est produite lors du téléversement de l'image.";
    }
}
    header("Location: uploadForm.php");
    exit();
?>
