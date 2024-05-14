<?php
// Cette page sert aux administrateurs à gérer les utilisateurs. 

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /my-app/login.php");
    exit();
}
include('ressources/nav_adm.php');
include('ressources/footer.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="/my-app/bootstrap/boostrap.bundle.min.js"></script>
    
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
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/boostrap.min.js"></script>

    <script>
        // Récupère les données depuis le fichier PHP
        fetch('/my-app/DB/user_afficher.php')
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
            <a href="/my-app/user/user_create.php" class="btn btn-lg btn-success">Créer un utilisateur</a>
            </div>
</body>
</html>