<?php
//php script for windows sever (WAMP) to output the about 21,032 chinese characters, in black font on white bg, into a directory as 50px x 50px individual .jpg picture files.

$font = 'C:\WINDOWS\Fonts\ARIALUNI.TTF';

//19968 to 41000 is the decimal range of the unihan numbers representing what seems to be the chinese characters.
for ($x=19968;$x<41000;$x++)
{

$im = imagecreatetruecolor(50, 50);
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 50, 50, $white);



$text = html_entity_decode(htmlspecialchars ( '&#'.$x.';', ENT_NOQUOTES , "UTF-8", 0 ),ENT_NOQUOTES,'UTF-8');
imagettftext($im, 20, 0, 10, 30, $black, $font, $text);

// start buffering
ob_start();
// output jpeg (or any other chosen) format & quality
imagejpeg($im, NULL, 85);
// capture output to string
$contents = ob_get_contents();
// end capture
ob_end_clean();

// be tidy; free up memory
imagedestroy($im);

// lastly (for the example) we are writing the string to a file. we are writing each individual .jpg file into the /images/ directory as a .jpg image file where the filename is the format: (the-decimal-unihan-number-of-that-character).jpg"
$fh = fopen("./images/".$x.".jpg", "a+" );
    fwrite( $fh, $contents );
fclose( $fh );



}



?> 
