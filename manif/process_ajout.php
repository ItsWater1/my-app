<?php
include('../DB/DB_connexion.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.html");
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les données du formulaire
    $nom = $_POST['Nom'];
    $date = $_POST['Date'];
    $lieu = $_POST['Lieu'];
    $type = $_POST['Type'];

    // Créer les données dans la table manif
    $sqlInsertManif = "INSERT INTO t_manif (nom, date) VALUES (?, ?)";
    
    // Utiliser une requête préparée pour éviter les injections SQL
    $stmt = $conn->prepare($sqlInsertManif);
    $stmt->bind_param("ss", $nom, $date);

    // Exécuter la requête d'insertion
    if ($stmt->execute()) {
        echo "La manifestation a été ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la manifestation : " . $stmt->error;
    }

    $stmt->close();

    // Récupérer l'id de la nouvelle manifestation
    $newManifId = $conn->insert_id;

    // Insérer une nouvelle entrée dans la table t_manif_avoir_lieu
    $queryLieu = "INSERT INTO t_manif_avoir_lieu (fk_manif, fk_lieu) VALUES (?, (SELECT id_lieu FROM t_lieu WHERE NomLieu = ?))";
    
    $stmtLieu = $conn->prepare($queryLieu);
    $stmtLieu->bind_param("ss", $newManifId, $lieu);
    $resultLieu = $stmtLieu->execute();

    if (!$resultLieu) {
        die("Erreur lors de l'ajout du lieu : " . $stmtLieu->error);
    }

    $stmtLieu->close();

    // Insérer une nouvelle entrée dans la table t_manif_avoir_lieu
    $queryType = "INSERT INTO t_manif_avoir_type (fk_manif, fk_type) VALUES (?, (SELECT id_type FROM t_type WHERE TypeManif = ?))";
 
    $stmtType = $conn->prepare($queryType);
    $stmtType->bind_param("ss", $newManifId, $type);
    $resultType = $stmtType->execute();

    if (!$resultType) {
     die("Erreur lors de l'ajout du lieu : " . $stmtType->error);
    }

    $stmtType->close();
    $conn->close();

    header("Location: ../admin.php");
    exit();
}
?>
