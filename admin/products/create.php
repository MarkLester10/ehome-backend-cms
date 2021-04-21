<?php
include '../../path.php';
$title = "E-Home | Create Product";
require_once ROOT_PATH . "/app/Controllers/ProductController.php";
require_once ROOT_PATH . "/app/middlewares/AuthMiddleware.php";
include ROOT_PATH . '/app/includes/admin/header.php';
include ROOT_PATH . '/app/includes/admin/sidebar.php';
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create Product</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/products/index.php">Products</a></li>
          <li class="breadcrumb-item active">Create Product</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card card-primary">
          <div class="card-header bg-warning">
            <h3 class="card-title text-white">Product Details</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="create.php">
            <div class="card-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" onkeyup="slugify(this.value)"
                  required>
              </div>
              <div class="form-group">
                <label>Slug</label>
                <input type="text" readonly class="form-control" name="slug" id="slug" placeholder="Slug">
                <small class="text-muted">This field is autofill</small>
              </div>

              <div class="form-group">
                <label>Parent Category</label>
                <select name="category_id" ref="categoryId" class="form-control" @change="loadSubCategories" required>
                  <option value="">Please select a category</option>
                  <?php foreach ($categories as $category) : ?>
                  <option value="<?php echo $category['id'] ?>">
                    <?php echo $category['name'] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Sub-Category</label>
                <select name="subcategory_id" v-model="subCategoryId" class="form-control" @change="loadTags" required>
                  <option value="">Please select a subcategory</option>
                  <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">
                    {{ subcategory.name }}
                  </option>
                </select>
              </div>

              <div class="form-group">
                <label>Tag</label>
                <select name="tag" class="form-control" required>
                  <option value="">Please select a tag</option>
                  <option v-for="tag in tags" :key="tag.id" :value="tag.name">
                    {{ tag.name }}
                  </option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <a href="/admin/products/index.php" class="btn btn-default pull-left">Cancel</a>
              <button type="submit" name="add-product" class="btn primary-btn ml-2">Proceed and Add Photos</button>
            </div>
          </form>
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