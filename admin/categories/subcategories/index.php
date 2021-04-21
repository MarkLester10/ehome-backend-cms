<?php
include '../../../path.php';
$title = "E-Home | Sub-Categories";
require_once ROOT_PATH . "/app/Controllers/CategoryController.php";
require_once ROOT_PATH . "/app/middlewares/AuthMiddleware.php";
include ROOT_PATH . '/app/includes/admin/header.php';
include ROOT_PATH . '/app/includes/admin/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Sub-Categories</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/categories/index.php">Categories</a></li>
          <li class="breadcrumb-item active">Sub-Categories</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
  <div class="card-body">
    <div class="mb-4">
      <button type="button" class="btn primary-btn" data-toggle="modal" data-target="#modal-default">
        <div class="d-flex align-items-center">
          <i class="fa fa-plus-square mr-2"></i>
          Add Sub Category
        </div>
      </button>
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
              <th>Tags</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($subcategories as $key => $subcategory) : ?>
            <tr>
              <td><?php echo $key + 1 ?></td>
              <td><?php echo $subcategory['name'] ?></td>
              <td><?php echo $subcategory['slug'] ?></td>
              <td>
                <?php $category = selectOne('categories', ['id' => $subcategory['category_id']])  ?>
                <span class="badge bg-info"><?php echo $category['name'] ?></span>
              </td>
              <td>
                <?php $tags = selectAll('tags', ['subcategory_id' => $subcategory['id']])  ?>
                <?php foreach ($tags as $tag) : ?>
                <span class="badge bg-success"><?php echo $tag['name'] ?></span>
                <?php endforeach; ?>
              </td>
              <td><?php echo formattedTime($subcategory['created_at']) ?></td>
              <td class="align-middle">
                <a href="/admin/categories/subcategories/edit.php?subcategory=<?php echo $subcategory['slug'] ?>&id=<?php echo $subcategory['id'] ?>"
                  class="btn text-success"><i class="fa fa-edit"></i></a>
                <form action="index.php" class="d-inline-block" method="POST">
                  <input type="hidden" name="id" value="<?php echo $subcategory['id'] ?>">
                  <button type="submit" name="delete-subcategory"
                    onclick="return confirm('Are you sure you want to delete this subcategory?')"
                    class="btn text-danger"><i class="fa fa-trash"></i></button>
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


<div class="modal fade in" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form action="index.php" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title primary-color font-weight-bold">EHOME | Sub-Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Name" onkeyup="slugify(this.value)"
                required>
            </div>
            <div class="form-group col-md-6">
              <label>Slug</label>
              <input type="text" readonly class="form-control" name="slug" id="slug" placeholder="Slug">
              <small class="text-muted">This field is autofill</small>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Parent Category</label>
              <select name="category_id" class="form-control" required>
                <option value="">Please Select a Category</option>
                <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id'] ?>">
                  <?php echo $category['name'] ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Tags</label>
              <select id="tags" name="tags[]" multiple required>
                <option value="">Please Add Tags</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>Banner</label>
            <input type="file" name="image" class="form-control" required onchange="displayImage(this)">
          </div>
          <div class="form-group text-center mt-5">
            <label class="d-block">Image Preview</label>
            <img src="<?php echo BASE_URL . '/assets/images/ehome3-2000x1333.jpg' ?>" id="imageDisplay" class="w-100"
              alt="EHome">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="add-subcategory" class="btn primary-btn">Save</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
<!-- /.content-wrapper -->


<?php
include ROOT_PATH . '/app/includes/admin/footer.php';
?>