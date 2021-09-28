<?php
// $d = new DateTime();
// $d->setTimestamp(1598518934);
// $d->setTimezone(new DateTimeZone("-0400"));
// echo $d->format("Y-m-d H:i:s");
// Create a 300x100 image
// putenv('GDFONTPATH=' . realpath('.'));
$im = imagecreatetruecolor(180, 50);
$back = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
$black = imagecolorallocate($im, getRandColor(), getRandColor(), getRandColor());

// Make the background red
imagefilledrectangle($im, 0, 0, 179, 49, $back);

// Path to our ttf font file
$font_file = __DIR__ . '/arial.ttf';

function getRandInt()
{
    static $a;
    if (!isset($a)) $a = "";
    $a = $a . (empty(random_int(0, 1)) ? random_int(0, 9) : chr(empty(random_int(0, 1)) ? random_int(65, 90) : random_int(97, 122)));
    if (strlen($a) < 4) return getRandInt();
    return $a;
}

function getRandColor()
{
    static $hex = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F'];
    return hexdec(array_rand($hex) . array_rand($hex));
}

// Draw the text 'PHP Manual' using font size 13
$text = getRandInt();
imagefttext($im, 40, random_int(-4, 4), random_int(0, 50), random_int(35, 45), $black, $font_file, $text);
$f = fopen(__DIR__ . '/tmp_text', 'w');
fwrite($f, $text);
fclose($f);
// Set alphablending to on
imagesetthickness($im, 5);
imageline($im, random_int(0, 10), random_int(10, 40), random_int(90, 100), random_int(10, 40), $black);
imageline($im, random_int(90, 100), random_int(10, 40), random_int(170, 179), random_int(10, 40), $black);
imagefilter($im, IMG_FILTER_PIXELATE, 3);
imagealphablending($im, true);

// Output image to the browser
header('Content-Type: image/png');

imagejpeg($im, "php://output");
imagedestroy($im);
