<?php
session_start();

include('ressources/nav.php');
include('ressources/footer.php');
include('DB/DB_connexion.php'); 
include('album/imageModel.php'); 

if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Définir le fuseau horaire
date_default_timezone_set('Europe/Zurich');

$imageModel = new ImageModel($conn);


// Récupérer les dates distinctes 
$listeDates = $imageModel->getDistinctYears();

// Récupérer les lieux distincts
$listeLieux = $imageModel->getDistinctLieux();

// Initialisation des variables
$lieuFilter = isset($_GET['lieu']) ? $_GET['lieu'] : null;
$anneeFilter = isset($_GET['annee']) ? $_GET['annee'] : null;

// Initialisation du tableau (vide)
$images = array();

// Filtre par localisation
if (!empty($lieuFilter)) {
    $images = $imageModel->getByLocation($lieuFilter);
} else {
    // Si aucun filtre par lieu n'est spécifié, récupérer toutes les images
    $images = $imageModel->getAllImages();
}

// Filtre par année (check du filtre par lieu)
if (!empty($anneeFilter) && !empty($images)) {
    $images = array_filter($images, function($image) use ($anneeFilter) {
        // Vérifier si l'année de l'image correspond à l'année filtrée
        return substr($image['date'], 0, 4) == $anneeFilter;
    });
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisation de l'album photo</title>
    <!-- Liens Bootstrap -->
    <link rel="stylesheet" href="/my-app/ressources/album.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Album Photo</h2>

    <form action="" method="get" class="mb-3">
    <div class="row">
        <div class="col-md-6">
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

<div>
    <?php 
        // Si aucun résultat trouvé avec les filtres, afficher un message approprié
        if (empty($images)) {
            echo "<h3>Aucune image trouvée.</h3>";
        }
    ?>
</div>

    <div class="row justify-content-center">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3">
                <div class="image-container">
                    <img src="/my-app/album/uploads/<?= $image['filename'] ?>" alt="Photo" class="img-thumbnail">
                    <div class="image-details">
                        <p>
                            <?= $image['NomLieu']?>
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
