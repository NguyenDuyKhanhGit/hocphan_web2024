<?php
include_once 'header.php';
include_once 'slider.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    echo '<script>document.location.href = "./dangnhap.php"</script>';
}
?>
<style>
    h3.payment {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
    }

    .wrapper_method {
        text-align: center;
        width: 550px;
        margin: 10px auto;
        border: 1px solid #666;
        padding: 20px;
        background: cornsilk;
    }

    .wrapper_method a {
        padding: 10px;
        background: red;
        color: #fff;
    }

    .wrapper_method h3 {
        margin-bottom: 20px;
    }
</style>


<div class="container">
    <h3 style="text-align: center;">Thanh Toán Đơn Hàng</h3>
    <div style="display: flex; " class="text-h1"></div>
    <div class="wrapper_method">
        <h3 class="payment">Chọn phương thức thanh toán</h3>
        <a href="offlinepayment.php">Thanh Toán Offline</a>
        <!-- <a href="onlinepayment.php">Thanh Toán Online </a> -->
        <br><br><br>
        <a style="background:grey" href="donhang.php">
            << Previous </a>
    </div>

</div>



<?php
include_once 'footer.php';

?>