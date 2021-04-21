<?php
include '../../path.php';
$title = "E-Home | Edit Product";
require_once ROOT_PATH . "/app/Controllers/ProductController.php";
if (!isset($_GET['product']) && !isset($_GET['id'])) {
  redirect('admin/products/index');
}
require_once ROOT_PATH . "/app/middlewares/AuthMiddleware.php";
include ROOT_PATH . '/app/includes/admin/header.php';
include ROOT_PATH . '/app/includes/admin/sidebar.php';
$product = selectOne('products', ['id' => $_GET['id']]);
$productImages = selectAll('product_images', ['product_id' => $product['id']]);
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Product</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/products/index.php">Products</a></li>
          <li class="breadcrumb-item active">Edit Product <?php echo $product['name'] ?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header bg-warning">
            <h3 class="card-title text-white">Product Details</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
            <div class=" card-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" onkeyup="slugify(this.value)"
                  required value="<?php echo $product['name'] ?>">
              </div>
              <div class="form-group">
                <label>Slug</label>
                <input type="text" readonly class="form-control" name="slug" id="slug" placeholder="Slug"
                  value="<?php echo $product['slug'] ?>">
                <small class="text-muted">This field is autofill</small>
              </div>

              <div class="form-group">
                <label>Parent Category</label>
                <select name="category_id" ref="categoryId" class="form-control" @change="loadSubCategories" required>
                  <option value="">Please select a category</option>
                  <?php foreach ($categories as $category) : ?>
                  <option value="<?php echo $category['id'] ?>"
                    <?php echo ($category['id'] == $product['category_id']) ? 'selected' : '' ?>>
                    <?php echo $category['name'] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Sub-Category</label>
                <select name="subcategory_id" ref="subCategoryId" v-model="subCategoryId" class="form-control"
                  @change="loadTags" required>
                  <option value="">Please select a subcategory</option>
                  <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id"
                    :selected="subcategory.id == <?php echo $product['subcategory_id'] ?>">
                    {{ subcategory.name }}
                  </option>
                </select>
              </div>

              <input type="hidden" id="subCategoryId" v-model="subCategoryId"
                value="<?php echo $product['subcategory_id'] ?>">

              <div class="form-group">
                <label>Tag</label>
                <select name="tag" class="form-control" required>
                  <option value="">Please select a tag</option>
                  <option v-for="tag in tags" :key="tag.id" :value="tag.name"
                    :selected="tag.name == '<?php echo $product['tag'] ?>'">
                    {{ tag.name }}
                  </option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <a href="/admin/products/index.php" class="btn btn-default pull-left">Cancel</a>
              <button type="submit" name="update-product" class="btn primary-btn ml-2">Save Changes</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header bg-info">
            <h3 class="card-title text-white">Product Images</h3>
          </div>

          <div class="card-body">
            <div class="row">
              <?php foreach ($productImages as $productImage) : ?>
              <div class="col-md-4 border p-4">
                <img src='<?php echo BASE_URL . "/assets/imgs/products/{$productImage['image']}" ?>'
                  class="w-100 object-fit-cover" alt="">
                <form action="edit.php" class="d-inline-block mt-2" method="POST">
                  <input type="hidden" name="productId" value="<?php echo $product['id'] ?>">
                  <input type="hidden" name="productSlug" value="<?php echo $product['slug'] ?>">
                  <input type="hidden" name="imageId" value="<?php echo $productImage['id'] ?>">
                  <input type="hidden" name="imageName" value="<?php echo $productImage['image'] ?>">
                  <button type="submit" name="delete-product-image"
                    onclick="return confirm('Are you sure you want to delete this image?')" class="btn text-danger"><i
                      class="fa fa-trash"></i></button>
                </form>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="card-footer">
            <a class="btn primary-btn"
              href='<?php echo  BASE_URL . "/admin/products/addphotos.php?product={$product['slug']}&id={$product['id']}" ?>'>
              Upload More Photos
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.content -->




</div>
<!-- /.content-wrapper -->


<?php
include ROOT_PATH . '/app/includes/admin/footer.php';
?>