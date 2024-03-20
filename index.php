<?php
include('ressources/nav.php');
include('ressources/footer.php');

session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
