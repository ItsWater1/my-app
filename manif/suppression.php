<?php
include('../DB/DB_connexion.php');

session_start();

// Récupérer le nom de la manifestation à supprimer depuis le paramètre de l'URL
$nomManifestation = $_GET['nomManifestation'];

   // Supprimer les enregistrements liés dans t_manif_avoir_lieu
   $queryDeleteAvoirLieu = "DELETE FROM t_manif_avoir_lieu WHERE fk_manif IN (SELECT id_manif FROM t_manif WHERE Nom='$nomManifestation')";
   $resultDeleteAvoirLieu = $conn->query($queryDeleteAvoirLieu);

   if (!$resultDeleteAvoirLieu) {
       die("Erreur lors de la suppression des enregistrements liés : " . $conn->error);
   }

   // Supprimer les enregistrements liés dans t_manif_avoir_type
   $queryDeleteAvoirType = "DELETE FROM t_manif_avoir_type WHERE fk_manif IN (SELECT id_manif FROM t_manif WHERE Nom='$nomManifestation')";
   $resultDeleteAvoirType = $conn->query($queryDeleteAvoirType);

   if (!$resultDeleteAvoirType) {
    die("Erreur lors de la suppression des enregistrements liés : " . $conn->error);
   }


    // Supprimer la manifestation
    $query = "DELETE FROM t_manif WHERE Nom='$nomManifestation'";
    $result = $conn->query($query);

    if (!$result) {
    die("Erreur lors de la suppression de la manifestation : " . $conn->error);
    }   

    // Fermer la connexion à la base de données
    $conn->close();

    // Rediriger vers la page d'index après la suppression
    header("Location: /my-app/admin.php");
    exit();
?>