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
    
    // Chemin de destination pour l'image téléversée
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($filename);
    
    // Téléverser l'image
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insérer les informations de l'image dans la base de données
        $imageModel->insertImage($filename, $date, $lieu); // Ajoutez le lieu en tant que paramètre
        echo "L'image a été téléversée avec succès.";
    } else {
        echo "Une erreur s'est produite lors du téléversement de l'image.";
    }
}
?>
