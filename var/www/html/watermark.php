<?php
$path = dirname(__FILE__);

$img  = $_REQUEST['img'];

$orginal_image = $path."/".$img;
$ext = strtolower(pathinfo($orginal_image, PATHINFO_EXTENSION));
if($ext=="png")
{
  $photo = imagecreatefrompng($orginal_image);  
}
else if($ext=="jpeg" || $ext=="jpg")
{
  $photo = imagecreatefromjpeg($orginal_image);  
}
$watermark = imagecreatefrompng($path."/images/35mm.png");
// This is the key. Without ImageAlphaBlending on, the PNG won't render correctly.
imagealphablending($photo, true);
// Copy the watermark onto the master, $offset px from the bottom right corner.
$offset = 10;
imagecopy($photo, $watermark, imagesx($photo) - imagesx($watermark) - $offset, imagesy($photo) - imagesy($watermark) - $offset, 0, 0, imagesx($watermark), imagesy($watermark));
// Output to the browser - please note you should save the image once and serve that instead on a production website.
header("Content-Type: image/jpeg");
imagejpeg($photo);
?>