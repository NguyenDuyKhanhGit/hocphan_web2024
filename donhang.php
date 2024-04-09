<?php
include_once 'header.php';
// include_once 'inc/slider.php';
?>

<?php
if (isset($_GET['cartid'])) {
  $cartid = $_GET['cartid'];
  $delcart = $ct->del_product_cart($cartid);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $cartId = $_POST['cartId'];
  $quantity = $_POST['quantity'];
  // print_r($cartId);die;
  $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
  if ($quantity <= 0) {
    $delcart = $ct->del_product_cart($cartId);
  }
}
?>

<div class="container">

  <h1 style="text-align: center;">Gio Hang</h1>
  <div style="display: flex; " class="text-h1"></div>



  <table class="table">
    <?php
    if (isset($update_quantity_cart)) {
      echo $update_quantity_cart;
    }
    ?>
    <?php
    if (isset($delcart)) {
      echo $delcart;
    }
    ?>

    <thead>
      <tr>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Gía</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Tổng tiền</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $get_product_cart = $ct->get_product_cart();
      $subtotal = 0;
      if ($get_product_cart) {

        while ($result = $get_product_cart->fetch()) {

      ?>
          <tr>
            <td><?php echo $result['productName'] ?></td>
            <td><img width=150px; src="public/uploads/<?php echo $result['image_1'] ?>"></td>
            <td><?php echo $fm->format_currency($result['price']) . ' ' . 'VND' ?></td>
            <td>
              <form action="" method="post">
                <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>">
                <input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>">
                <input style="width=10px;" type="submit" name="submit" value="Update">
              </form>
            </td>
            <td>
              <?php
              $total = $result['price'] * $result['quantity'];
              echo $fm->format_currency($total) . ' ' . 'VND';
              ?>
            </td>
            <td> <a href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td>
          </tr>
          <?php $subtotal += $total; ?>
      <?php
        }
      }
      ?>
      <tr>
        <td style="color:green; text-align: right; font-size:18px;" colspan="5" ;>
          Tổng: <?php echo $fm->format_currency($subtotal) . ' ' . 'VND'; ?>

        </td>
      </tr>

    </tbody>
  </table>
  <div>
    <div>
      <a href="payment.php">
        <p style="text-align: center; font-size: 30px;">CheckOut</p>
      </a>
    </div>
  </div>

</div>



<?php
include_once 'footer.php';

?>