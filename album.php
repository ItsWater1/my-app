<?php
include('ressources/nav.php');
include('ressources/footer.php');

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
</head>

<body>


</body>

</html>