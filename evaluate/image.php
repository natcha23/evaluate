<?php
$img = '.'.$_GET['img'];
if(!file_exists($img)) {
	$path = dirname($img);
	$img  = $path.'/spacer.jpg';
	$w = 1;
	$h = 1;
} else {
	$w   = $_GET['w'];
	$h   = $_GET['h']?$_GET['h']:$_GET['w'];
}

header("content-type:image/jpeg");

$src_img = imagecreatefromjpeg($img);
$getsize = getimagesize($img);
$old_w = $getsize[0];
$old_h = $getsize[1];

if (($old_w < $w) and ($old_h < $h)) {
    $new_h = $old_h;
    $new_w = $old_w;
} else {
    if ($old_w > $old_h) {
        $how = $old_w / $w;
        $new_w = floor($old_w / $how);
        $new_h = floor($old_h / $how);
    } else {
        $how = $old_h / $h;
        $new_w = floor($old_w / $how);
        $new_h = floor($old_h / $how);
    }
}
$dst_img = imagecreatetruecolor($new_w, $new_h);
imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);

imagejpeg($dst_img, '', 90);
imagedestroy($src_img);
imagedestroy($dst_img);