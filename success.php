<?php
include_once 'header.php';
//   include_once 'inc/slider.php';
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delCart = $ct->del_all_data_cart();
    echo '<script>document.location.href = "./success.php"</script>';
}
?>
<style type="text/css">
    h2.success_order {
        text-align: center;
        color: red;
    }
</style>
<form action="" method="POST">
    <div class="container  mt-3 mp-3">
        <div class="row">
            <h2 class="success_order">Success Order</h2>
            <?php
            $customer_id = Session::get('customer_id');
            // echo $customer_id;
            $get_amount = $ct->getAmountPrice($customer_id);
            if ($get_amount) {
                $amount = 0;
                while ($result = $get_amount->fetch()) {
                    $price = $result['price'] * $result['quantity'];
                    $amount += $price;
                }
            ?>
                <p class="success_note">Tổng giá bạn đã mua từ Website : <?php echo $fm->format_currency($amount) . ' ' . 'VND'; ?></p>
            <?php

            }
            ?>
            <p class="success_note">Chúng tôi sẽ liên hệ trong thời gian sớm nhất. Vui lòng xem chi tiết đơn hàng của bạn tại đây.
                <a href="chitietdonhang.php">Click tại đây.</a>
            </p>
        </div>
    </div>
</form>
<?php
include_once 'footer.php';
?>