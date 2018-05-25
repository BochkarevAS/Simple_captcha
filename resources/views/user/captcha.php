<?php

session_start();

$symbols = 4;
$char = '';
$lower = true; // Нужно ли символы приводить к нижнему регистру
$alphabet = [
    'a','A','b','B','c','C','d','D','e','E','f','F','g','G','h','H','i','I','j',
    'J','k','K','l','L','m','M','n','N','o','O','p','P','q','Q','r','R','s','S','t','T','u','U',
    'v','V','w','W','z','Z','Y','y','x','X','1','2','3','4','5','6','7','8','9','0'
];

for ($i = 0; $i < $symbols; $i++) {
    $char = $char . $alphabet[mt_rand(0, count($alphabet))];
}

if ($lower) {
    $char = strtolower($char);
}

$_SESSION['random'] = $char;

$im = imagecreatetruecolor(100, 38);

$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 150, 150, 150);
$black = imagecolorallocate($im, 0, 0, 0);

imagefilledrectangle($im, 0, 0, 200, 35, $black);

$font = __DIR__ . '/font/font.ttf';

imagettftext($im, 20, 4, 22, 30, $grey, $font, $char);
imagettftext($im, 20, 4, 15, 32, $white, $font, $char);

header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

header ("Content-type: image/gif");
imagegif($im);
imagedestroy($im);