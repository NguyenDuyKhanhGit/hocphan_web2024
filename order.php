<?php
include_once 'header.php';
include_once 'slider.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
  echo '<script>document.location.href = "./order.php"</script>';
}
?>


<style>
  .order_page {
    font-size: 30px;
    font-weight: bold;
    color: red;
  }
</style>

<div class="container">

  <h3 class="order_page">Order Page</h3>

</div>



<?php
include_once 'footer.php';

?>