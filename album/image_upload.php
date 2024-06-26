<?php
// Processus d'ajout des images. L'image est ajoutée dans la base de données et dans le dossier uploads. 

// Démarrage de la session pour vérifier l'authentification de l'utilisateur
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclusion des fichiers de connexion à la base de données et du modèle d'image
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/album/Image_model.php");

// Vérification si la méthode de requête est POST pour traiter le formulaire d'upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si le fichier uploadé est une image
    $file_info = getimagesize($_FILES["image"]["tmp_name"]);

    if ($file_info !== false) {
        // Types d'images autorisés
        $allowed_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
        if (in_array($file_info[2], $allowed_types)) {
            // L'image est valide, procéder à l'upload
            $filename = $_FILES["image"]["name"];
            $date = $_POST["date"];
            $lieu = $_POST["lieu"];
            // Récupérer l'ID de l'utilisateur à partir de la session
            $user_id = $_SESSION['user_id'];

            // Créer une instance du modèle d'image
            $imageModel = new ImageModel($conn);

            // Générer un identifiant unique pour le nom de fichier
            $random_chars = uniqid();
            $filename_with_random = $random_chars . "_" . $filename; // Ajout de caractères aléatoires au nom du fichier
            
            // Définir le chemin de destination pour l'image uploadée
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($filename_with_random);
            
            // Téléverser l'image
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insérer les informations de l'image dans la base de données
                $imageModel->insertImage($filename_with_random, $date, $lieu, $user_id); // Utiliser le nom de fichier avec les caractères aléatoires
                header("Location: /my-app/album/upload_form.php");
            } else {
                echo "Une erreur s'est produite lors du téléversement de l'image.";
            }
        } else {
            // Le fichier téléversé n'est pas une image valide
            $error_message = "Le fichier téléversé n'est pas une image valide.";
        }
    } else {
        // Impossible de détecter le type de fichier
        $error_message = "Impossible de détecter le type de fichier.";
    }

    // Si une erreur s'est produite, rediriger vers le formulaire avec le message d'erreur
    if (isset($error_message)) {
        $_SESSION['error_message'] = $error_message;
        header("Location: /my-app/album/upload_Form.php");
        exit();
    }
}
?>
