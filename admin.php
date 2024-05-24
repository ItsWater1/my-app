<?php
// C'est la page d'accueil admin, elle contient le tableau des manifestations avec les boutons pour les gérer (suppression, modification, ajout).

// Démarre une session et vérifie si l'utilisateur est connecté et a les droits administrateur.
session_start();
if (!isset($_SESSION['username']) || !$_SESSION['admin']) {
    header("Location: /my-app/login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas admin
    exit();
}

// Inclut les fichiers pour la navigation et le pied de page administrateur
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
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
    
</head>

<body>
    <div class="container">
        <br />
        <h2>Gestion des manifestations</h2> <!-- Titre de la section -->
        <br />
        <table class="table"> <!-- Tableau pour afficher les manifestations -->
            <thead>
                <tr>
                    <th>Manifestation</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Type</th>
                    <th>Bénéfice</th>
                    <th>Action</th> <!-- Colonne pour les actions de gestion -->
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>
    </div>

    <!-- Scripts pour le traitement et l'affichage des données des manifestations -->
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
                    // Vérifie si le bénéfice est null et remplace par "Aucun" ou ajoute ".-" sinon
                    const beneficeDisplay = row.Benefice === null ? "Aucun" : `${row.Benefice} CHF`;

                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td>${row.NomManifestation}</td>
                                    <td>${row.Date}</td>
                                    <td>${row.NomLieu}</td>
                                    <td>${row.TypeManif}</td>
                                    <td>${beneficeDisplay}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="manif/modifier.php?nomManifestation=${encodeURIComponent(row.NomManifestation)}&date=${encodeURIComponent(row.Date)}&lieu=${encodeURIComponent(row.NomLieu)}&type=${encodeURIComponent(row.TypeManif)}&benefice=${encodeURIComponent(row.Benefice)}" class="btn btn-sm btn-warning">Modifier la manifestation</a>
                                            <a href="manif/suppression.php?nomManifestation=${encodeURIComponent(row.NomManifestation)}" class="btn btn-sm btn-danger">Supprimer la manifestation</a>
                                        </div>
                                    </td>`;
                    tableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    </script>


    <div class="text-center">
        <a href="manif/ajout.php" class="btn btn-lg btn-success">Ajouter une manifestation</a> <!-- Bouton pour ajouter une nouvelle manifestation -->
    </div>
</body>
</html>
