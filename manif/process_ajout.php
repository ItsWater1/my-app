<?php
// Fichier du processus d'ajout d'une manifestation, contient les requêtes SQL. 

// Inclusion de la connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Démarrage de la session pour vérifier l'état de connexion de l'utilisateur
session_start();

// Vérifie si l'utilisateur est connecté et a les droits administrateur.
if (!isset($_SESSION['username']) || !$_SESSION['admin']) {
    header("Location: /my-app/login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas admin
    exit();
}

// Vérifier si le formulaire a été soumis via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des données du formulaire
    $nom = $_POST['Nom'];
    $date = $_POST['Date'];
    $lieu = $_POST['Lieu'];
    $type = $_POST['Type'];

    // Préparation de la requête SQL pour insérer la nouvelle manifestation
    $sqlInsertManif = "INSERT INTO t_manif (nom, date) VALUES (?, ?)";
    $stmt = $conn->prepare($sqlInsertManif);
    $stmt->bind_param("ss", $nom, $date);

    // Exécution de la requête d'insertion et gestion des erreurs
    if ($stmt->execute()) {
        echo "La manifestation a été ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la manifestation : " . $stmt->error;
    }
    $stmt->close();

    // Récupération de l'ID de la manifestation ajoutée
    $newManifId = $conn->insert_id;

    // Insertion du lieu associé à la nouvelle manifestation
    $queryLieu = "INSERT INTO t_manif_avoir_lieu (fk_manif, fk_lieu) VALUES (?, ?)";
    $stmtLieu = $conn->prepare($queryLieu);
    $stmtLieu->bind_param("is", $newManifId, $lieu);
    $resultLieu = $stmtLieu->execute();

    if (!$resultLieu) {
        die("Erreur lors de l'ajout du lieu : " . $stmtLieu->error);
    }
    $stmtLieu->close();

    // Insertion du type de manifestation
    $queryType = "INSERT INTO t_manif_avoir_type (fk_manif, fk_type) VALUES (?, ?)";
    $stmtType = $conn->prepare($queryType);
    $stmtType->bind_param("is", $newManifId, $type);
    $resultType = $stmtType->execute();

    if (!$resultType) {
        die("Erreur lors de l'ajout du type : " . $stmtType->error);
    }
    $stmtType->close();

    // Fermeture de la connexion à la base de données
    $conn->close();

    // Redirection vers la page d'administration après l'ajout réussi
    header("Location: /my-app/admin.php");
    exit();
}
?>
