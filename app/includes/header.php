<?php
require_once ROOT_PATH . "/app/Controllers/HomeController.php";
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Site made with Mobirise Website Builder v4.4.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.4.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo BASE_URL . '/assets/images/e-logo-128x12820-128x128.png' ?>"
    type="image/x-icon">
  <meta name="description"
    content="EHOME IMPROVEMENT CENTER is your DIY and hardware depot, providing total solutions to your construction and home improvement needs. ">
  <title><?php echo  $title ?? 'EHOME Improvement Center' ?></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/bootstrap/css/bootstrap.min.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/socicon/css/socicon.min.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/font-awesome/css/font-awesome.min.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/font-un/css/style.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/dropdown-menu/style.light.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/unicore/css/style.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/mobirise-slider/style.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/mobirise-gallery/style.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/mobirise/css/mbr-additional.css' ?>" type="text/css">

</head>

<body>
  <div id="app">
    <section id="dropdown-menu-vt" data-rv-view="0">

      <nav class="navbar navbar-dropdown mbr-title-font transparent navbar-fixed-top bg-color">

        <div class="container">

          <div class="navbar-brand">
            <a href="/" class="navbar-logo"><img src="<?php echo BASE_URL . '/assets/images/logo-3-128x128.png' ?>"
                alt="EHome Improvement Center Inc."></a>
            <a class="text-white" href="/">EHOME</a>
          </div>

          <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse"
            data-target="#exCollapsingNavbar">
            ☰
          </button>

          <ul class="nav-dropdown collapse pull-xs-right navbar-toggleable-sm nav navbar-nav" id="exCollapsingNavbar">
            <li class="nav-item"><a class="nav-link link" href="/">HOME</a></li>
            <li class="nav-item dropdown"><a class="nav-link link dropdown-toggle" data-toggle="dropdown-submenu"
                href="https://mobirise.com/" aria-expanded="false">OUR PRODUCTS</a>
              <div class="dropdown-menu">
                <?php foreach ($categories as $category) : ?>
                <div class="dropdown"><a class="dropdown-item dropdown-toggle" href="https://mobirise.com/"
                    data-toggle="dropdown-submenu" aria-expanded="false"><?php echo $category['name'] ?></a>
                  <div class="dropdown-menu dropdown-submenu">
                    <?php $subcategories = selectAll('subcategories', ['category_id' => $category['id']]) ?>
                    <?php foreach ($subcategories as $subcategory) : ?>
                    <a class="dropdown-item"
                      href="/products.php?category=<?php echo $category['slug'] ?>&subcategory=<?php echo $subcategory['slug'] ?>&subcategory_id=<?php echo $subcategory['id'] ?>&meta_title=<?php echo $subcategory['name'] ?>">
                      <?php echo $subcategory['name'] ?>
                    </a>
                    <?php endforeach; ?>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </li>
            <li class="nav-item"><a class="nav-link link" href="/AboutUs.php" aria-expanded="false">ABOUT US</a></li>
            <li class="nav-item"><a class="nav-link link" href="/Career.php" aria-expanded="false">CAREER</a></li>
          </ul>

        </div>

      </nav>

    </section>