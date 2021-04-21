<?php
include '../../path.php';
$title = "E-Home | Add Product Photos";
if (!isset($_GET['product']) && !isset($_GET['id'])) {
  redirect('admin/products/index');
}
require_once ROOT_PATH . "/app/Controllers/ProductController.php";
require_once ROOT_PATH . "/app/middlewares/AuthMiddleware.php";
include ROOT_PATH . '/app/includes/admin/header.php';
include ROOT_PATH . '/app/includes/admin/sidebar.php';
$product = selectOne('products', ['id' => $_GET['id']]);
?>


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Add Product Photos</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/products/create.php">Create Product</a></li>
          <li class="breadcrumb-item active">Photos for (<?php echo $product['name'] ?>)</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<div class="content">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4"><?php echo $product['name'] ?></h1>
      <p class="lead font-weight-bold">Tag: <span class="badge bg-info"><?php echo $product['tag'] ?></span></p>
      <p class="lead font-weight-bold">Category: <span
          class="badge bg-primary"><?php echo selectOne('categories', ['id' => $product['category_id']])['name'] ?></span>
      </p>
      <p class="lead">You are about to add product photos to <?php echo $product['name'] ?></p>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col card">
        <div class="card-header">
          <div class="btns">
            <button class="imgbuts btn btn-success">Browse...</button>
            <button class="btn primary-btn btn-md-2 " id='post_send' onclick="save_muliple_image()">Upload</button>
          </div>
          <div class="py-3">
            <div class="progress" style="height: 25px;">
              <div class="progress-bar" role="progressbar" style="width:0%;">
                <span class="sr-only">0</span>
              </div>
            </div>
            <div class="success_msg w-100 p-4">File has uploaded successfully!</div>
          </div>
        </div>


        <div class="card-body">
          <form action="method" name="upload-file" class="main_form" id="form-upload-file"
            enctype="multipart/form-data">
            <input type="hidden" id="product_id" value="<?php echo $product['id'] ?>">
            <div class="ui-block">
              <aside class="suggested-posts">
                <div class="suggested-posts-container">
                  <div class="row" id="message_box"></div>
                </div>
              </aside>
            </div>
          </form>
        </div>

        <div class="card-footer go-back">
          <a href="/admin/products/index.php" class="btn btn-success">Go back to Products Page</a>
          <a href='<?php echo BASE_URL . "/admin/products/edit.php?product={$product['slug']}&id={$product['id']}" ?>'
            class="btn primary-btn"> <i class="fa fa-eye"></i> See Product</a>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
<!-- /.content-wrapper -->


<?php
include ROOT_PATH . '/app/includes/admin/footer.php';
?>