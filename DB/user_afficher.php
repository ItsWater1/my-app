<?php
// Fichier qui récupère l'utilisateur et son niveau de droits. Utilisé pour la création et la modification d'utilisateur (page admin).

include($_SERVER['DOCUMENT_ROOT'] . "/my-app/DB/DB_connexion.php");

// Requête SQL préparée
$sql = "SELECT 
    user,
    level
FROM t_utilisateur
ORDER BY level";

// Préparation de la requête préparée
$stmt = $conn->prepare($sql);

// Exécution de la requête préparée
$stmt->execute();

// Récupération des résultats
$result = $stmt->get_result();

// Initialisation du tableau pour stocker les résultats
$rows = array();

// Boucle pour récupérer les lignes de résultats
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Convertit le tableau en format JSON
echo json_encode($rows);

// Fermeture de la requête préparée
$stmt->close();

// Fermeture de la connexion à la base de données
$conn->close();
?>
