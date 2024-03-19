<?php
include('ressources/nav_adm.php');
include('ressources/footer.php');

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</head>
<body>
<div class="container">
        <br />
        <h2>Gestion des utilisateurs</h2>
        <br />
        <table class="table">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Niveau de droit</th>
                    <th>Action</th>
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
        fetch('DB/user_afficher.php')
            .then(response => response.json())
            .then(data => {

                // Insère les données dans le tableau HTML
                const tableBody = document.getElementById('table-body');
                data.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${row.user}</td>
                    <td>${row.level}</td>
                    <td>
                        <div class="text-center">
                            <a href="user/user_mdp_modifier.php?user=${encodeURIComponent(row.user)}" class="btn btn-sm btn-danger">Modifier le mot de passe</a>
                            <a href="user/user_lvl_modifier.php?user=${encodeURIComponent(row.user)}" class="btn btn-sm btn-warning">Modifier le niveau de droit</a>
                            <a href="user/user_delete.php?user=${encodeURIComponent(row.user)}" class="btn btn-sm btn-danger">Supprimer l'utilisateur</a>
                        </div>
                    </td>`
                    ;

                    tableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    </script>

            <div class="text-center">
            <a href="user/user_create.php" class="btn btn-lg btn-success">Créer un utilisateur</a>
            </div>
</body>
</html>