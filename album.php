<?php
// C'est la page qui affiche les images sur le site, on peut aussi trier les images par date ou lieu.
 
// Démarrage de session et redirection vers la page de connexion si l'utilisateur n'est pas authentifié.
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclusion des fichiers de ressources nécessaires.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/album/image_model.php");

// Réglage du fuseau horaire pour l'Europe/Zurich.
date_default_timezone_set('Europe/Zurich');

// Création d'un objet ImageModel pour gérer les opérations sur les images.
$imageModel = new ImageModel($conn);

// Récupération des lieux et des années distincts pour les filtres.
$listeDates = $imageModel->getDistinctYears();
$listeLieux = $imageModel->getDistinctLieux();

// Initialisation des filtres à partir des paramètres GET de la requête.
$lieuFilter = isset($_GET['lieu']) ? $_GET['lieu'] : null;
$anneeFilter = isset($_GET['annee']) ? $_GET['annee'] : null;

// Chargement des images selon les filtres appliqués.
$images = array();
if (!empty($lieuFilter)) {
    $images = $imageModel->getByLocation($lieuFilter);
} else {
    $images = $imageModel->getAllImages();
}

if (!empty($anneeFilter) && !empty($images)) {
    $images = array_filter($images, function($image) use ($anneeFilter) {
        return substr($image['date'], 0, 4) == $anneeFilter; // Filtrage par année.
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisation de l'album photo</title>
    <link rel="stylesheet" href="/my-app/ressources/album.css">
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Album Photo</h2>
    <form action="" method="get" class="mb-3">
    <div class="row">
        <div class="col-md-6">
            <!-- Sélection de lieu pour le filtrage -->
            <label for="selectLieu" class="form-label">Filtrer par lieu :</label>
            <select name="lieu" id="selectLieu" class="form-control">
                <option value="">Tous les lieux</option>
                <?php foreach ($listeLieux as $lieuOption): ?>
                    <option value="<?= $lieuOption['id_lieu'] ?>" <?= ($lieuFilter == $lieuOption['id_lieu']) ? 'selected' : '' ?>>
                        <?= $lieuOption['NomLieu'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <!-- Sélection d'année pour le filtrage -->
            <label for="selectAnnee" class="form-label">Filtrer par année :</label>
            <select name="annee" id="selectAnnee" class="form-control">
                <option value="">Toutes les années</option>
                    <?php foreach ($listeDates as $year): ?>
                        <option value="<?= $year ?>" <?= ($anneeFilter == $year) ? 'selected' : '' ?>>
                            <?= $year ?>
                        </option>
                    <?php endforeach; ?>
            </select>
        </div>
    </div>
        <button type="submit" class="btn btn-primary mt-3">Filtrer</button>
    </form>

    <!-- Affichage des images selon les filtres appliqués. -->
    <div>
        <?php 
        if (empty($images)) {
            echo "<h3>Aucune image trouvée.</h3>";
        }
        ?>
    </div>
    <div class="row justify-content-left">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3">
                <div class="image-container">
                    <img src="/my-app/album/uploads/<?= $image['filename'] ?>" alt="Photo" class="img-thumbnail">
                    <div class="image-details">
                        <p><?= $image['NomLieu'] ?>, le <?= date('d.m.Y', strtotime($image['date'])) ?></p>
                        <p>Ajouté par <?= isset($image['user']) ? $image['user'] : 'Utilisateur inconnu' ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
