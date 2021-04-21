<?php
require_once ROOT_PATH . "/app/config/db.php";
require_once ROOT_PATH . "/app/helpers/Redirect.php";
require_once ROOT_PATH . "/app/helpers/Sanitize.php";
require_once ROOT_PATH . "/app/helpers/ViewFormatter.php";
require_once ROOT_PATH . "/app/helpers/ImageHelper.php";
$categories = selectAll('categories');
$subcategories = selectAll('subcategories');
$products = selectAll('products');

// ADD
if (isset($_POST['add-product'])) {
  $request = sanitize($_POST, 'post');
  $id = create('products', [
    'name' => $request['name'],
    'slug' => $request['slug'],
    'subcategory_id' => $request['subcategory_id'],
    'category_id' => $request['category_id'],
    'tag  ' => $request['tag'],
  ]);
  ($id > 0) ?
    header('Location: ' . BASE_URL . "/admin/products/addphotos.php?product={$request['slug']}&id={$id}")
    : redirectWithMessage('admin/products/index', ['error' => 'Something went wrong ❌']);
}


// UPDATE
if (isset($_POST['update-product'])) {
  $request = $_POST;
  $res = update('products', 'id', $request['id'], [
    'name' => $request['name'],
    'slug' => $request['slug'],
    'subcategory_id' => $request['subcategory_id'],
    'category_id' => $request['category_id'],
    'tag  ' => $request['tag'],
  ]);
  redirectWithMessage('admin/products/index', ['success' => 'Product updated successfully! 🚀']);
}




// DELETE
if (isset($_POST['delete-product'])) {
  $id = $_POST['id'];
  $product_images = selectAll('product_images', ['product_id' => $id]);
  foreach ($product_images as $product_image) {
    remove($product_image['image'], 'products');
  }
  $res = delete('products',  ['id' => $id]);
  ($res === 1)
    ? redirectWithMessage('admin/products/index', ['success' => 'Product deleted successfully 🚀'])
    : redirectWithMessage('admin/products/index', ['error' => 'Something went wrong ❌']);
}


// DELETE IMAGE
if (isset($_POST['delete-product-image'])) {
  $productId = $_POST['productId'];
  $productSlug = $_POST['productSlug'];
  $imageId = $_POST['imageId'];
  $imageName = $_POST['imageName'];
  remove($imageName, 'products');
  $res = delete('product_images',  ['id' =>  $imageId]);
  if ($res === 1) {
    header('Location: ' . BASE_URL . "/admin/products/edit.php?product={$productSlug}&id={$productId}");
    exit();
  }
}