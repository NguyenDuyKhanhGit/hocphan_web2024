<?php
include_once 'header.php';
include_once 'slider.php';
?>

<div class="container">

  <div class="content">

    <div class="row mt-3 mb-3">
      <?php
      $getall_category = $cat->show_category_fontend();
      if ($getall_category) {
        while ($result_allcat = $getall_category->fetch()) {

      ?>
          <div class="col-2">
            <button style="width: 100% ; color: white; font-weight: bold;" type="button" class="btn btn-success">
              <a style="color:white;" href="productbycart.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a>
            </button>
          </div>
      <?php
        }
      }
      ?>
    </div>










    <div class="row">
      <?php
      $product_binhthuong = $product->getproduct_binhthuong();
      if ($product_binhthuong) {
        while ($result = $product_binhthuong->fetch()) {

      ?>

          <div class="col-12 col-sm-6 col-md-3  image">
            <a href="trangchitiet.php?proid=<?php echo $result['productId'] ?>">
              <img class="d-block w-100" src="public/uploads/<?php echo $result['image_1'] ?>" alt="" />
            </a>
            <h2><?php echo $result['productName'] ?></h2>
            <p><?php echo $fm->textShorten($result['productdesc'], 20) ?></p>
            <p><span><?php echo $fm->format_currency($result['price']) . ' ' . 'VND' ?></span></p>
          </div>
      <?php
        }
      }
      ?>

    </div>
  </div>
</div>


<?php
include_once 'footer.php';

?>