<?php
include_once 'header.php';
// include_once 'inc/slider.php';
?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<script>window.location = '404.php'</script>";
} else {
    $id = $_GET['proid'];
}

$customer_id = Session::get('customer_id');
$customer_name = Session::get('customer_name');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $quantity = $_POST['quantity'];
    $insertCart = $ct->add_to_cart($quantity, $id, $customer_id);
}
?>

<div class="container mt-3 mp-3">
    <div class="row">
        <?php
        $get_product_details = $product->get_details($id);
        if ($get_product_details) {
            while ($result_details = $get_product_details->fetch()) {
        ?>
                <div class="col-7">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="public/uploads/<?php echo $result_details['image_1'] ?>" class="d-block w-100" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="public/uploads/<?php echo $result_details['image_1'] ?>" class="d-block w-100" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="public/uploads/<?php echo $result_details['image_1'] ?>" class="d-block w-100" alt="">
                            </div>
                        </div>
                    </div>
                    <p><?php echo $result_details['productdesc'] ?></p>
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-2">
                            <img class="d-block w-100" style="width: 80px !important ; border-radius: 50%;" src="images/ca-beta.jpg" alt="">
                        </div>
                        <div class="col-2 mt-3">
                            <b>Như </b>
                        </div>
                    </div>
                    <b style="font-size: 25px;"><?php echo $result_details['productName'] ?></b> <br>
                    <b style="font-size: 25px; color: brown;">Price:<?php echo $result_details['price'] . ' ' . 'VND' ?></b><br>
                    <b style="font-size: 25px; color: brown;">Category: <?php echo $result_details['catName'] ?></b><br>

                    <div class="alert alert-warning" role="alert">
                        <img style="width: 20%;" src="images/logo/buy_protection.png" alt="">
                        Thanh toán đảm bảo khi mua MUA NGAY
                        <p style="font-size: 12px ; padding-left: 40px;" class="ms-5"> Hoàn tiền 100% khi không nhận
                            được hàng</p>
                    </div>
                    <form action="" method="post">
                        <div>Số lượng: <input type="number" value="1" name="quantity" min="1" style="margin-left: 50px; margin-bottom: 10px;"></div>
                        <button style="width:100% ;" class="btn btn-primary" type="submit" name="submit">Mua ngay</button>
                    </form>

                </div>
    </div>
<?php
            }
        }
?>

<div class="binhluan">
    <div class="row">
        <div class="col-md-8">
            <?php
            if (isset($binhluan_insert)) {
                echo $binhluan_insert;
            }
            ?>
            <h5>Bình luận sản phẩm</h5>
            <form action="" method="POST">
                <p><input type="hidden" value="<?php echo $id ?>" name="product_id_binhluan"></p>
                <p><input type="text" placeholder="Vui lòng điền Tên" class="form-control" name="tennguoibinhluan"></p>
                <p><textarea rows="5" style="resize: none;" placeholder="Bình luận ...." class="form-control" name="binhluan"></textarea></p>
                <p><input type="submit" name="binhluan_submit" class="btn btn-success" value="Gửi bình luận"></p>
            </form>
        </div>

    </div>
</div>


<?php
include_once 'footer.php';

?>