<?php
include_once 'header.php';
// include_once 'inc/slider.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check) {
  // header('Location:order.php');
  echo '<script>document.location.href = "./order.php"</script>';
}
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $login_Customers = $cs->login_customers($_POST);
}
?>




<div class="row">
  <div class="col-lg-10 col-xl-9 mx-auto">
    <div class="card card-signin flex-row my-5">
      <div class="card-img-left d-none d-md-flex">
        <!-- Background image for card set in CSS! -->
      </div>
      <div class="card-body">
        <h5 class="card-title text-center">Đăng nhập</h5>
        <?php
        if (isset($login_Customers)) {
          echo $login_Customers;
        }
        ?>
        <form class="form-signin" action="" method="POST">
          <div class="form-label-group">
            <input type="text" id="inputUserame" class="form-control" placeholder="Mời Nhập email" name="email" autofocus>
            <label for="inputUserame">Email</label>
          </div>


          <hr>

          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Mời Nhập Password" name="password_1">
            <label for="inputPassword">Password</label>
          </div>

          <button class="btn btn-lg btn-primary btn-block text-uppercase" style=" margin:auto;
                    display:block;" type="submit" name="login" value="Sign in">Đăng nhập</button>
          <a class="d-block text-center mt-2 small" href="dangki.php">Đăng ký</a>
          <hr class="my-4">
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php
include_once 'footer.php';

?>