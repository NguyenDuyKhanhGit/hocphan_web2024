<?php include_once 'header_admin.php'; ?>
<?php include_once 'sidebar_admin.php'; ?>
<?php include_once 'controller/brand.php'; ?>
<?php include_once 'controller/category.php'; ?>
<?php include_once 'controller/product.php'; ?>

<?php
$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $insertProduct = $pd->insert_product($_POST, $_FILES);
}
?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>Thêm sản phẩm</h2>
    <div class="block">
      <?php
      if (isset($insertProduct)) {
        echo $insertProduct;
      }
      ?>
      <form action="productadd.php" method="post" enctype="multipart/form-data">
        <table class="form">

          <tr>
            <td>
              <label>Tên</label>
            </td>
            <td>
              <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
            </td>
          </tr>
          <tr>
            <td>
              <label>Danh mục</label>
            </td>
            <td>
              <select id="select" name="category">
                <option>Chọn danh mục</option>
                <?php
                $cat = new category();
                $catlist = $cat->show_category();
                if ($catlist) {
                  while ($result = $catlist->fetch()) {

                ?>
                    <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?>
                    </option>
                <?php
                  }
                }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label>Thương hiệu</label>
            </td>
            <td>
              <select id="select" name="brand">
                <option>Select Brand</option>
                <?php
                $brand = new brand();
                $brandlist = $brand->show_brand();
                if ($brandlist) {
                  while ($result = $brandlist->fetch()) {

                ?>
                    <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                    </option>
                <?php
                  }
                }
                ?>

              </select>
            </td>
          </tr>

          <tr>
            <td style="vertical-align: top; padding-top: 9px;">
              <label>Mô tả</label>
            </td>
            <td>
              <textarea name="productdesc" class="tinymce"></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label>Gía</label>
            </td>
            <td>
              <input type="text" name="price" placeholder="Enter Price..." class="medium" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Upload Image</label>
            </td>
            <td>
              <input type="file" name="image_1" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Loại</label>
            </td>
            <td>
              <select id="select" name="type_1">
                <option>Select Type</option>
                <option value="1">Featured</option>
                <option value="2">Non-Featured</option>
              </select>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <input type="submit" name="submit" Value="Save" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
  });
</script>
<!-- Load TinyMCE -->
<?php include_once 'footer_admin.php'; ?>