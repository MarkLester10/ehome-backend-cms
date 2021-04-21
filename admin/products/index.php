<?php
include '../../path.php';
$title = "E-Home | Products";
require_once ROOT_PATH . "/app/Controllers/ProductController.php";
require_once ROOT_PATH . "/app/middlewares/AuthMiddleware.php";
include ROOT_PATH . '/app/includes/admin/header.php';
include ROOT_PATH . '/app/includes/admin/sidebar.php';
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Products</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
  <div class="card-body">
    <div class="mb-4">
      <a href="/admin/products/create.php" class="btn primary-btn">
        <div class="d-flex align-items-center">
          <i class="fa fa-plus-square mr-2"></i>
          Add Product
        </div>
      </a>
    </div>
    <hr>
    <?php include ROOT_PATH . '/app/includes/messages.php' ?>

    <div class="row">
      <div class="col-sm-12 table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Slug</th>
              <th>Category</th>
              <th>Sub-Category</th>
              <th>Tag</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $key => $product) : ?>
            <tr>
              <td><?php echo $key + 1 ?></td>
              <td><?php echo $product['name'] ?></td>
              <td><?php echo $product['slug'] ?></td>
              <td>
                <?php $category = selectOne('categories', ['id' => $product['category_id']])  ?>
                <span class="badge bg-info"><?php echo $category['name'] ?></span>
              </td>
              <td>
                <?php $subcategory = selectOne('subcategories', ['id' => $product['subcategory_id']])  ?>
                <span class="badge bg-info"><?php echo $subcategory['name'] ?></span>
              </td>
              <td>
                <span class="badge bg-success"><?php echo $product['tag'] ?></span>
              </td>
              <td><?php echo formattedTime($product['created_at']) ?></td>
              <td class="align-middle">
                <a href="/admin/products/edit.php?product=<?php echo $product['slug'] ?>&id=<?php echo $product['id'] ?>"
                  class="btn text-success"><i class="fa fa-edit"></i></a>
                <form action="index.php" class="d-inline-block" method="POST">
                  <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                  <button type="submit" name="delete-product"
                    onclick="return confirm('Are you sure you want to delete this product?')" class="btn text-danger"><i
                      class="fa fa-trash"></i></button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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