<?php
// C'est la page d'accueil admin, elle contient le tableau des manifestations avec les boutons pour les gérer (suppression, modification, ajout).
session_start();
if (!isset($_SESSION['username']) || !$_SESSION['admin']) {
    header("Location: /my-app/login.php");
    exit();
}

include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav_adm.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="/my-app/bootstrap/boostrap.bundle.min.js"></script>
    
</head>

<body>
    <div class="container">
        <br />
        <h2>Gestion des manifestations</h2>
        <br />
        <table class="table">
            <thead>
                <tr>
                    <th>Manifestation</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Type</th>
                    <th>Bénéfice</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>
    </div>

    <!-- Inclure le CDN Bootstrap JS -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/boostrap.min.js"></script>

    <script>
        // Récupère les données depuis le fichier PHP
        fetch('/my-app/DB/tableau.php')
            .then(response => response.json())
            .then(data => {

                // Remplace les valeurs null par "aucun"
               data.forEach(row => {
            if (row.Benefice === null) {
                row.Benefice = "Aucun";
            }});

                // Insère les données dans le tableau HTML
                const tableBody = document.getElementById('table-body');
                data.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td>${row.NomManifestation}</td>
                                        <td>${row.Date}</td>
                                        <td>${row.NomLieu}</td>
                                        <td>${row.TypeManif}</td>
                                        <td>${row.Benefice}</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="manif/modifier.php?nomManifestation=${encodeURIComponent(row.NomManifestation)}&date=${encodeURIComponent(row.Date)}&lieu=${encodeURIComponent(row.NomLieu)}&type=${encodeURIComponent(row.TypeManif)}&benefice=${encodeURIComponent(row.Benefice)}" class="btn btn-sm btn-warning">Modifier la manifestation</a>
                                                <a href="manif/suppression.php?nomManifestation=${encodeURIComponent(row.NomManifestation)}" class="btn btn-sm btn-danger">Supprimer la manifestation</a>
                                            </div>
                                        </td>`
                    tableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    </script>

    <div class="text-center">
        <a href="manif/ajout.php" class="btn btn-lg btn-success">Ajouter une manifestation</a>
    </div>
</body>
</html>