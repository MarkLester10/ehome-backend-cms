<?php
include '../../../path.php';
$title = "E-Home | Sub-Categories";
require_once ROOT_PATH . "/app/Controllers/CategoryController.php";
if (!isset($_GET['subcategory']) && !isset($_GET['id'])) {
  redirect('admin/categories/subcategories/index');
}
require_once ROOT_PATH . "/app/middlewares/AuthMiddleware.php";
include ROOT_PATH . '/app/includes/admin/header.php';
include ROOT_PATH . '/app/includes/admin/sidebar.php';

$subcategory = selectOne('subcategories', ['id' => $_GET['id'], 'slug' => $_GET['subcategory']]);
$tags = selectAll('tags', ['subcategory_id' => $_GET['id']]);
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit | Sub-Categories</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/categories/index.php">Categories</a></li>
          <li class="breadcrumb-item"><a href="/admin/categories/subcategories/index.php">Sub-Categories</a></li>
          <li class="breadcrumb-item active"><?php echo $subcategory['name'] ?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
  <form action="edit.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $subcategory['id'] ?>">
    <input type="hidden" name="imageBanner" value="<?php echo  $subcategory['banner'] ?>">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header bg-warning">
            <h3 class="card-title text-white">Product Derails</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Name" onkeyup="slugify(this.value)"
                required value="<?php echo $subcategory['name'] ?>">
            </div>
            <div class="form-group">
              <label>Slug</label>
              <input type="text" readonly class="form-control" name="slug" id="slug" placeholder="Slug"
                value="<?php echo $subcategory['slug'] ?>">
              <small class="text-muted">This field is autofill</small>
            </div>
            <div class="form-group">
              <label>Parent Category</label>
              <select name="category_id" class="form-control" required>
                <option value="">Please Select a Category</option>
                <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id'] ?>"
                  <?php echo ($subcategory['category_id'] === $category['id'] ? 'selected' : '') ?>>
                  <?php echo $category['name'] ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Tags</label>
              <select name="tags[]" multiple id="tags" required>
                <option value="">Please Add Tags</option>
                <?php foreach ($tags as $tag) : ?>
                <option value="<?php echo $tag['name'] ?>" selected>
                  <?php echo $tag['name'] ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Banner</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="exampleInputFile"
                    onchange="displayImage(this)">
                  <input type="file">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text">Upload</span>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <a href="/admin/categories/subcategories/index.php" type="button"
              class="btn btn-default pull-left">Cancel</a>
            <button type="submit" name="update-subcategory" class="btn primary-btn">Save Changes</button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <label class="d-block">Image Preview</label>
        <img src='<?php echo BASE_URL . "/assets/imgs/subcategories/{$subcategory['banner']}" ?>' id="imageDisplay"
          class="w-100" alt="EHome">
      </div>
    </div>
  </form>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include ROOT_PATH . '/app/includes/admin/footer.php';
?>