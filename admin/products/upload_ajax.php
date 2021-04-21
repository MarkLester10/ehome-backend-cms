<?php
include_once '../../path.php';
require_once ROOT_PATH . "/app/config/db.php";
$dts = $_POST['dts'];
$pId = $_POST['productId'];
$ttt = explode(',', $dts);
$others_image_last = '';
$image_link =  ROOT_PATH . "/assets/imgs/products/"; //folder name
for ($i = 0; $i < sizeof($_FILES['upload_files']['name']); $i++) {
  if (in_array($i + 1, $ttt)) {
  } else {
    $new_file = md5(microtime());
    $image_type = $_FILES["upload_files"]["type"][$i];
    $image_name = $_FILES["upload_files"]["name"][$i];
    $image_error = $_FILES["upload_files"]["error"][$i];
    $image_temp_name = $_FILES["upload_files"]["tmp_name"][$i];
    if (($image_type == "image/jpeg") || ($image_type == "image/png") || ($image_type == "image/pjpeg") || ($image_type == "image/jpg")) {
      $test = explode('.', $image_name);
      $name = $new_file . '.' . end($test);
      $url = $image_link . $name;
      $info = getimagesize($image_temp_name);
      if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($image_temp_name);
      elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($image_temp_name);
      elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($image_temp_name);
      imagejpeg($image, $url, 80);
    }
    create('product_images', [
      'product_id' => $pId,
      'image' => $name
    ]);
  }
}