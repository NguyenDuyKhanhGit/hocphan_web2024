<?php
include_once 'header.php';
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $insertCustomers = $cs->insert_customers($_POST);
}
?>
<div class="container">
  <div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto">
      <div class="card card-signin flex-row my-5">
        <div class="card-img-left d-none d-md-flex">
          <!-- Background image for card set in CSS! -->
        </div>
        <div class="card-body">
          <h5 class="card-title text-center">Đăng ký</h5>
          <form class="form-signin" action="" method="POST">
            <?php
            if (isset($insertCustomers)) {
              echo $insertCustomers;
            }
            ?>
            <div class="form-label-group">
              <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="name">
              <label for="inputUsername">Username</label>
            </div>
            <div class="form-label-group">

              <input type="text" id="inputEmail" class="form-control" placeholder="Email" name="email">
              <label for="inputEmail">Email</label>
            </div>

            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password_1">
              <label for="inputPassword">Password</label>
            </div>
            <div class="form-label-group">
              <input type="text" id="inputSoDienThoai" class="form-control" placeholder="Sodienthoai" name="sodienthoai">
              <label for="inputSoDienThoai">Số Điện Thoại</label>
            </div>
            <div class="form-label-group">
              <input type="text" id="inputDiaChi" class="form-control" placeholder="Diachi" name="diachi">
              <label for="inputDiaChi">Địa chỉ</label>
            </div>

            <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block text-uppercase" style=" margin:auto;
              display:block;">Đăng ký</button>
            <a class="d-block text-center mt-2 small" href="dangnhap.php">Đăng nhập</a>
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