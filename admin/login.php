<?php
include '../path.php';
require_once ROOT_PATH . "/app/Controllers/AuthController.php";
require_once ROOT_PATH . "/app/middlewares/GuestsMiddleware.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Home | Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL . '/node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css' ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo BASE_URL . '/node_modules/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL . '/node_modules/admin-lte/dist/css/adminlte.min.css' ?>">

  <style>
    .mbr-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.6;
      background-color: rgb(0, 0, 0)
    }
  </style>
</head>

<body class="hold-transition login-page" style="background-image: url(<?php echo BASE_URL . '/assets/images/ehome3-2000x1333.jpg' ?>)">
  <div class="mbr-overlay"></div>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header d-flex align-items-center justify-content-center text-center">
        <img src="<?php echo BASE_URL . '/assets/images/logo-3-128x128.png' ?>" alt="" style="width: 80px;">
        <a href="../../index2.html" class="h1 ml-3"><b>Home</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="login.php" method="post">
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <input type="email" class="form-control <?php echo (count($errors) > 0 && array_key_exists('email', $errors)) ? 'is-invalid' : '' ?>" placeholder="Email" name="email" value="<?php echo $email ?>">
            <small class="invalid-feedback">
              <?php if (count($errors) > 0 && array_key_exists('email', $errors)) : ?>
                <?php echo $errors['email'] ?>
              <?php endif; ?>
            </small>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <input type="password" name="password" class="form-control <?php echo (count($errors) > 0 && array_key_exists('password', $errors)) ? 'is-invalid' : '' ?>" placeholder="Password">
            <small class="invalid-feedback">
              <?php if (count($errors) > 0 && array_key_exists('password', $errors)) : ?>
                <?php echo $errors['password'] ?>
              <?php endif; ?>
            </small>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="login-btn" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo BASE_URL . '/node_modules/admin-lte/plugins/jquery/jquery.min.js' ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo BASE_URL . '/node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo BASE_URL . '/node_modules/admin-lte/dist/js/adminlte.min.js' ?>"></script>
</body>

</html>