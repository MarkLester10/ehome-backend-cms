<?php
include "../../../path.php";
require_once ROOT_PATH . "/app/config/db.php";

$action = "";
$res = array();


if (isset($_GET['action'])) {
  $action = $_GET['action'];
}

if ($action == 'loadsubcategories') {
  $subcategories = selectAll('subcategories', ['category_id' => $_GET['category_id']]);
  if (!empty($subcategories)) {
    $res['subcategories'] = $subcategories;
  }
}
if ($action == 'loadproductimages') {
  $productImages = selectAll('product_images', ['product_id' => $_GET['product_id']]);
  if (!empty($productImages)) {
    $res['productImages'] = $productImages;
  }
}
if ($action == 'loadsubcategories') {
  $subcategories = selectAll('subcategories', ['category_id' => $_GET['category_id']]);
  if (!empty($subcategories)) {
    $res['subcategories'] = $subcategories;
  }
}

if ($action == 'loadtags') {
  $tags = selectAll('tags', ['subcategory_id' => $_GET['subcategory_id']]);
  if (!empty($tags)) {
    $res['tags'] = $tags;
  }
}

echo json_encode($res);