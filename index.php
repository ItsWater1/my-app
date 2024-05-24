<?php
// C'est la page du tableau des manifs

// Démarre une session et redirige vers la page de connexion si l'utilisateur n'est pas authentifié.
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}

// Inclut les fichiers de navigation et de pied de page pour une intégration uniforme à travers le site.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier Jeunesse T-C</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <br/>
        <h2>Jeunesse Treycovagnes - Chamblon 2024</h2> <!-- Titre de la page -->
        <br/>

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/my-app/fluxrss.php");?> <!-- Inclusion du flux RSS pour les mises à jour dynamiques -->

        <!-- Tableau affichant les détails des manifestations -->
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

    <!-- Inclusion des scripts JavaScript pour la gestion dynamique des données -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>

    <script>
        // Appel AJAX pour récupérer les données des manifestations
        fetch('/my-app/DB/tableau.php')
            .then(response => response.json())
            .then(data => {
                // Création et insertion des lignes dans le tableau HTML
                const tableBody = document.getElementById('table-body');
                data.forEach(row => {
                    // Vérifie si le bénéfice est null et remplace par "Aucun" ou ajoute "CHF" sinon
                    const beneficeDisplay = row.Benefice === null ? "Aucun" : `${row.Benefice} CHF`;

                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td>${row.NomManifestation}</td>
                                    <td>${row.Date}</td>
                                    <td>${row.NomLieu}</td>
                                    <td>${row.TypeManif}</td>
                                    <td>${beneficeDisplay}</td>
                                    `;
                    tableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    </script>
</body>
</html>
