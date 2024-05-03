<?php
// Requête pour le flux RSS.

include ('DB_connexion.php');

$manif = $conn->query('SELECT * FROM t_manif WHERE date > NOW() ORDER BY date ASC LIMIT 0,25');

$closestDateQuery = $conn->query('SELECT date FROM t_manif WHERE date > NOW() ORDER BY date ASC LIMIT 0,1');
$closestDateResult = $closestDateQuery->fetch_assoc();
$closestDate = isset($closestDateResult['date']) ? $closestDateResult['date'] : '';

?>
