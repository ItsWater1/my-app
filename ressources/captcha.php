<?php
// Code de création du captcha. 

session_start();

// Générer un nombre entre 1000 et 9999
$_SESSION['captcha'] = mt_rand(1000,9999);
$img = imagecreate(65, 30);
$font = '28DaysLater.ttf';

// créer le fond de l'image du captcha
$bg = imagecolorallocate($img, 255, 255,255);

// Choix de la couleur du texte
$textcolor = imagecolorallocate($img, 0,0,0);

// génération du texte de l'image
imagettftext($img, 23, 0, 0, 30, $textcolor, $font, $_SESSION['captcha']);

header('Content-type:image/jpeg');
imagejpeg($img);
imagedestroy($img);
?>