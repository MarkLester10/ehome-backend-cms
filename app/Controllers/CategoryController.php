<?php
require_once ROOT_PATH . "/app/config/db.php";
require_once ROOT_PATH . "/app/helpers/Redirect.php";
require_once ROOT_PATH . "/app/helpers/Sanitize.php";
require_once ROOT_PATH . "/app/helpers/ViewFormatter.php";
require_once ROOT_PATH . "/app/helpers/ImageHelper.php";
$categories = selectAll('categories');
$subcategories = selectAll('subcategories');

if (isset($_POST['add-category'])) {
  $request = sanitize($_POST, 'post');
  $id = create('categories', [
    'name' => $request['name'],
    'slug' => $request['slug'],
  ]);
  ($id > 0) ?
    redirectWithMessage('admin/categories/index', ['success' => 'Category created successfully! 🚀'])
    : redirectWithMessage('admin/categories/index', ['error' => 'Something went wrong ❌']);
}

// EDIT

if (isset($_POST['edit-category'])) {
  $request = sanitize($_POST, 'post');
  $res = update('categories', 'id', $request['id'], [
    'name' => $request['name'],
    'slug' => $request['slug'],
  ]);
  ($res > 0) ?
    redirectWithMessage('admin/categories/index', ['success' => 'Category updated successfully! 🚀'])
    : redirectWithMessage('admin/categories/index', ['error' => 'Something went wrong ❌']);
}



if (isset($_POST['delete-category'])) {
  $id = $_POST['id'];
  $subcategories = selectAll('subcategories', ['category_id' => $id]);
  foreach ($subcategories as $subcategory) {
    remove($subcategory['banner'], 'subcategories');
  }
  $res = delete('categories',  ['id' => $id]);
  ($res === 1)
    ? redirectWithMessage('admin/categories/index', ['success' => 'Category deleted successfully 🚀'])
    : redirectWithMessage('admin/categories/index', ['error' => 'Something went wrong ❌']);
}


// CONTROLLERS FOR SUBCATEGORY


// Create
if (isset($_POST['add-subcategory'])) {
  $request = $_POST;
  $banner =  upload($_FILES, 'image', 'subcategories');
  if ($banner == 0) {
    redirectWithMessage('admin/categories/subcategories/index', ['error' => 'Invalid File Format ❌ - Valid Extension (png, jpeg, jpg)']);
  }
  $id = create('subcategories', [
    'name' => $request['name'],
    'slug' => $request['slug'],
    'category_id' => $request['category_id'],
    'banner' =>  $banner,
  ]);
  if ($id > 0) {
    foreach ($request['tags'] as $tag) {
      create('tags', [
        'name' => $tag,
        'subcategory_id' => $id,
      ]);
    }
    redirectWithMessage('admin/categories/subcategories/index', ['success' => 'Subcategory created successfully! 🚀']);
  }
  redirectWithMessage('admin/categories/subcategories/index', ['error' => 'Something went wrong ❌']);
}


// update
if (isset($_POST['update-subcategory'])) {
  $request = $_POST;
  $banner = $request['imageBanner'];
  if (!empty($_FILES['image']['name'])) {
    remove($banner, 'subcategories');
    $banner = upload($_FILES, 'image', 'subcategories');
  }
  $res = update('subcategories', 'id', $request['id'], [
    'name' => $request['name'],
    'slug' => $request['slug'],
    'category_id' => $request['category_id'],
    'banner' =>  $banner,
  ]);
  delete('tags', ['subcategory_id' => $request['id']]);
  foreach ($request['tags'] as $tag) {
    create('tags', [
      'name' => $tag,
      'subcategory_id' => $request['id'],
    ]);
  }
  redirectWithMessage('admin/categories/subcategories/index', ['success' => 'Sub-Category updated successfully! 🚀']);
}


// Delete
if (isset($_POST['delete-subcategory'])) {
  $id = $_POST['id'];
  $subcategory = selectOne('subcategories', ['id' => $id]);
  if (remove($subcategory['banner'], 'subcategories')) {
    $res = delete('subcategories',  ['id' => $id]);
    ($res === 1)
      ? redirectWithMessage('admin/categories/subcategories/index', ['success' => 'SubCategory deleted successfully 🚀'])
      : redirectWithMessage('admin/categories/subcategories/index', ['error' => 'Something went wrong ❌']);
  }
}