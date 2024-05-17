<?php
// C'est la page du tableau des manifs

session_start();
include('ressources/nav.php');
include('ressources/footer.php');

if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier Jeunesse T-C</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="/my-app/bootstrap/boostrap.bundle.min.js"></script>

</head>
<body>
    <div class="container">
        <br/>
            <h2>Jeunesse Treycovagnes - Chamblon 2024</h2>
        <br/>

        <?php include('fluxrss.php'); ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Manifestation</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Type Manifestation</th>
                    <th>Bénéfice</th>
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
                    }
                });

                // Insère les données dans le tableau HTML
                const tableBody = document.getElementById('table-body');
                data.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td>${row.NomManifestation}</td>
                    <td>${row.Date}</td>
                    <td>${row.NomLieu}</td>
                    <td>${row.TypeManif}</td>
                    <td>${row.Benefice}</td>`;
                    tableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    </script>
</body>
</html>
