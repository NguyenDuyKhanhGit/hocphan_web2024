<?php
include_once 'header.php';
include_once 'slider.php';
?>

<?php
$cat = new category();
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
  echo "<script>window.location = '404.php'</script>";
} else {
  $id = $_GET['catid'];
}
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

    <?php
    $name_cat = $cat->get_name_by_cat($id);
    if ($name_cat) {
      while ($result_name = $name_cat->fetch()) {
    ?>
        <div class="row">
          <h3>Danh mục : <?php echo $result_name['catName'] ?></h3>
      <?php
      }
    }
      ?>
      <?php
      $productbycat = $cat->get_product_by_cat($id);
      if ($productbycat) {
        while ($result = $productbycat->fetch()) {
      ?>
          <div class="col-12 col-sm-6 col-md-3  image">
            <a href="trangchitiet.php?proid=<?php echo $result['productId'] ?>">
              <img class="d-block w-100" src="public/uploads/<?php echo $result['image_1'] ?>" alt="">
            </a>
            <h2><?php echo $result['productName'] ?></h2>
            <p><?php echo $fm->textShorten($result['productdesc'], 20) ?></p>
            <p><span><?php echo $fm->format_currency($result['price']) . ' ' . 'VND' ?></span></p>

          </div>
      <?php
        }
      } else {
        echo 'Category Not Avalable';
      }

      ?>
        </div>
  </div>
</div>

<?php
include_once 'footer.php';
?>