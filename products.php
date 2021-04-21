<?php
include "path.php";
if (!isset($_GET['category'])  || !isset($_GET['subcategory']) || !isset($_GET['subcategory_id'])) {
  header('Location: ' . BASE_URL . "/");
  exit();
}
$title = "EHOME | {$_GET['meta_title']}";
include ROOT_PATH . '/app/includes/header.php';
$products = selectAll('products', ['subcategory_id' => $_GET['subcategory_id']]);
$subcategory = selectOne('subcategories', ['id' => $_GET['subcategory_id']]);
// dump($products);
?>

<section class="mbr-section--bg-adapted mbr-parallax-background mbr-after-navbar" id="header8-ok" data-rv-view="797"
  style="background-image: url(assets/imgs/subcategories/<?php echo $subcategory['banner'] ?>)">
  <div class="intro intro15" style="padding-top: 240px; padding-bottom: 0px">
    <div class="mbr-overlay" style="opacity: 0.3; background-color: rgb(0, 0, 0)"></div>
    <div class="container">
      <div class="row center-content">
        <div class="col-md-5">
          <h3 class="mbr-title-font">
            <span style="font-weight: normal"><?php echo $subcategory['name'] ?></span>
          </h3>
          <p></p>
          <div class="space40"></div>
        </div>

        <div class="col-md-7">
          <div class="hl-container pull-right"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="mbr-gallery mbr-section mbr-section--no-padding mbr-slider-carousel" id="gallery3-ps" data-rv-view="800"
  style="
        background-color: rgb(220, 220, 220);
        padding-top: 6rem;
        padding-bottom: 4.5rem;
      ">
  <!-- Filter -->
  <div class="mbr-gallery-filter container gallery-filter-active">

  </div>

  <!-- Gallery -->
  <div class="container mbr-gallery-layout-default">
    <div>
      <div class="row mbr-gallery-row">
        <?php foreach ($products as $key => $product) : ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mbr-gallery-item" data-tags="<?php echo $product['tag']; ?>"
          data-video-url="false">
          <figcaption class="mbr-figure__caption mbr-figure__caption--std-grid">
            <div class="mbr-caption-background"></div>
            <small
              class="mbr-figure__caption-small mbr-title-font"><strong><?php echo $product['name'] ?></strong></small>
          </figcaption>

          <a class="productImage" data-toggle="modal" href="#lb-gallery3-ps" data-slide-to="<?php echo $key ?>"
            data-id="<?php echo $product['id'] ?>">
            <?php $previewImage = selectOne('product_images', ['product_id' => $product['id']]) ?>
            <img alt="" src="assets/imgs/products/<?php echo  $previewImage['image'] ?>" />
            <span class="icon glyphicon glyphicon-search"></span>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>

  <input type="hidden" ref="productId" id="pid" @click="loadProductImages()">
  <!-- Lightbox -->
  <div class="modal fade" id="lb-gallery3-ps" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y:scroll">
    <div class="modal-dialog" style="width: 90%; margin:20px auto;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title">Product Images</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row justify-content-around">
              <div class="col-md-4" style="padding: 40px; border: 1px solid #ccc;"
                v-for="productImage in productsImages" :key="productImage.id">
                <img class="w-100 object-fit-cover" :src="'assets/imgs/products/'+productImage.image" alt="" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  </div>





</section>


<?php include ROOT_PATH . '/app/includes/footer.php'; ?>