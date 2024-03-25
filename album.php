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

// Récupérer les lieux distincts
$listeLieux = $imageModel->getDistinctLieux();

// Obtenez l'année actuelle
$currentYear = date('Y');

// Créez un tableau d'années de 2016 à l'année actuelle
$years = range(2016, $currentYear);

// Inversez le tableau pour afficher les années dans l'ordre décroissant
$years = array_reverse($years);

// Récupérer les paramètres de filtrage s'ils ont été soumis
$lieuFilter = isset($_GET['lieu']) ? $_GET['lieu'] : null;
$anneeFilter = isset($_GET['annee']) ? $_GET['annee'] : null;

// Ajoutez le code de débogage ici
echo "Année filtrée : " . $anneeFilter;

// Récupérer les images en fonction des paramètres de filtrage
if ($lieuFilter !== null) {
    $images = $imageModel->getByLocation($lieuFilter);
} elseif ($anneeFilter !== null) {
    $images = $imageModel->getByYear($anneeFilter);
} else {
    $images = $imageModel->getAllImages();
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
                <?php foreach ($years as $year): ?>
                    <option value="<?= $year ?>" <?= ($anneeFilter == $year) ? 'selected' : '' ?>>
                        <?= $year ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Filtrer</button>
</form>

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
