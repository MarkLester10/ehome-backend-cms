<?php
include '../../path.php';
$title = "E-Home | Categories";
require_once ROOT_PATH . "/app/Controllers/CategoryController.php";
require_once ROOT_PATH . "/app/middlewares/AuthMiddleware.php";
include ROOT_PATH . '/app/includes/admin/header.php';
include ROOT_PATH . '/app/includes/admin/sidebar.php';
?>


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Categories</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Categories</li>
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
          Add Category
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
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories as $key => $category) : ?>
            <tr>
              <td><?php echo $key + 1 ?></td>
              <td><?php echo $category['name'] ?></td>
              <td><?php echo $category['slug'] ?></td>
              <td><?php echo formattedTime($category['created_at']) ?></td>
              <td class="align-middle">
                <button class="btn text-success edit-btn" data-toggle="modal" data-id="<?php echo $category['id'] ?>"
                  data-slug="<?php echo $category['slug'] ?>" data-name="<?php echo $category['name'] ?>">
                  <i class="fa fa-edit"></i></button>
                <form action="index.php" class="d-inline-block" method="POST">
                  <input type="hidden" name="id" value="<?php echo $category['id'] ?>">
                  <button type="submit" name="delete-category"
                    onclick="return confirm('Are you sure you want to delete this category? All related subcategories, products and images will also be deleted. This process cannot be undone.')"
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
  <div class="modal-dialog">
    <form action="index.php" method="post">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title primary-color font-weight-bold">EHOME | Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter category name" name="name"
                  onkeyup="slugify(this.value)" required>
              </div>
              <div class="form-group">
                <input type="hidden" readonly class="form-control" name="slug" id="slug">
              </div>

            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="add-category" class="btn primary-btn">Save</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



<div class="modal fade in" id="modal-edit">
  <div class="modal-dialog">
    <form action="index.php" method="post">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title primary-color font-weight-bold">EHOME | Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="id" name="id">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter category name" name="name"
                  onkeyup="slugify(this.value)" required>
              </div>
              <div class="form-group">
                <input type="hidden" readonly class="form-control slug" name="slug" id="slug2">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="edit-category" class="btn primary-btn">Save Changes</button>
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