<?php
include_once 'header.php';
include_once 'slider.php';
?>

<div class="content">

  <div class="row">

    <h1 style="text-align: center;">SẢN PHẨM NỔI BẬT </h1>
    <div style="display: flex; " class="text-h1"></div>
    <?php
    $product_feathered = $product->getproduct_feathered();
    if ($product_feathered) {
      while ($result = $product_feathered->fetch()) {

    ?>

        <div class="col-12 col-sm-6 col-md-3  image">
          <a href="trangchitiet.php?proid=<?php echo $result['productId'] ?>">
            <img class="d-block w-100" src="public/uploads/<?php echo $result['image_1'] ?>" alt="" /></a>
          <h2><?php echo $result['productName'] ?></h2>
          <p><?php echo $fm->textShorten($result['productdesc'], 30) ?></p>
          <p><span><?php echo $fm->format_currency($result['price']) . ' ' . 'VND' ?></span></p>
        </div>
    <?php
      }
    }
    ?>





    <h1 style="text-align: center;">SẢN PHẨM MỚI </h1>
    <div style="display: flex; " class="text-h1"></div>
    <?php
    $product_new = $product->getproduct_new();
    if ($product_new) {
      while ($result = $product_new->fetch()) {

    ?>

        <div class="col-12 col-sm-6 col-md-3  image">
          <a href="trangchitiet.php?proid=<?php echo $result['productId'] ?>">
            <img class="d-block w-100" src="public/uploads/<?php echo $result['image_1'] ?>" alt="" /></a>
          <h2><?php echo $result['productName'] ?></h2>
          <p><?php echo $fm->textShorten($result['productdesc'], 30) ?></p>
          <p><span><?php echo $fm->format_currency($result['price']) . ' ' . 'VND' ?></span></p>
        </div>

    <?php
      }
    }
    ?>





  </div>

</div>




<?php
include_once 'footer.php';

?>