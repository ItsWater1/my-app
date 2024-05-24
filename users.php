<?php
// Cette page sert aux administrateurs à gérer les utilisateurs. 

// Démarre une session et vérifie si l'utilisateur est connecté et a les droits administrateur.
session_start();
if (!isset($_SESSION['username']) || !$_SESSION['admin']) {
    header("Location: /my-app/login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas admin
    exit();
}

// Inclusion des fichiers de navigation et de pied de page pour l'administrateur.
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/nav_adm.php");
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/ressources/footer.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link href="/my-app/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="/my-app/bootstrap/bootstrap.bundle.min.js"></script>
    
</head>
<body>
<div class="container">
        <br />
        <h2>Gestion des utilisateurs</h2> <!-- Titre de la page pour la gestion des utilisateurs -->
        <br />
        <!-- Tableau affichant les utilisateurs et leurs droits -->
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

    <!-- Inclusion des scripts JavaScript pour la manipulation dynamique des données -->
    <script src="/my-app/JS/jquery-3.7.1.js"></script>
    <script src="/my-app/JS/popper.min.js"></script>
    <script src="/my-app/bootstrap/bootstrap.min.js"></script>

    <script>
        // Script pour récupérer les données des utilisateurs depuis un fichier PHP et les afficher dans un tableau
        fetch('/my-app/DB/user_afficher.php')
            .then(response => response.json())
            .then(data => {
                // Insertion des données des utilisateurs dans le tableau HTML
                const tableBody = document.getElementById('table-body');
                data.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${row.user}</td>
                    <td>${row.level}</td>
                    <td>
                        <div class="text-center">
                            <!-- Liens pour modifier le mot de passe, le niveau de droit ou supprimer l'utilisateur -->
                            <a href="user/user_mdp_modifier.php?user=${encodeURIComponent(row.user)}" class="btn btn-sm btn-danger">Modifier le mot de passe</a>
                            <a href="user/user_lvl_modifier.php?user=${encodeURIComponent(row.user)}" class="btn btn-sm btn-warning">Modifier le niveau de droit</a>
                            <a href="user/user_delete.php?user=${encodeURIComponent(row.user)}" class="btn btn-sm btn-danger">Supprimer l'utilisateur</a>
                        </div>
                    </td>`;
                    tableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    </script>

            <div class="text-center">
            <!-- Lien pour créer un nouvel utilisateur -->
            <a href="/my-app/user/user_create.php" class="btn btn-lg btn-success">Créer un utilisateur</a>
            </div>
</body>
</html>
