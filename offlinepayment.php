<?php
include_once 'header.php';
//   include_once 'inc/slider.php';
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    // $delCart = $ct->del_all_data_cart(); // bo dong nay
    echo '<script>document.location.href = "./success.php"</script>';
}
?>
<style type="text/css">
    .box_left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
        margin: 15px;
    }

    .box_right {
        width: 45%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
        margin: 15px;
    }

    a.a_order {

        background: #FF8C00;
        padding: 7px 20px;
        color: #fff;
        font-size: 21px;
        border: none;
        margin: 20px;
        margin-top: 20px;
    }
</style>
<form action="" method="POST">
    <div class="container  mt-3 mp-3">
        <div class="row">
            <h3 style="text-align: center;">Thanh Toán Đơn Hàng</h3>
            <div style="display: flex; " class="text-h1"></div>
            <div class="box_left">
                <div class="container">

                    <h3 style="text-align: center;">Đơn hàng của bạn</h3>
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
                                <th scope="col">ID</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Gía</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_product_cart = $ct->get_product_cart();
                            $subtotal = 0;
                            $i = 0;
                            if ($get_product_cart) {

                                while ($result = $get_product_cart->fetch()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $result['productName'] ?></td>
                                        <td><?php echo $fm->format_currency($result['price']) . ' ' . 'VND' ?></td>
                                        <td>
                                            <input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>">
                                        </td>
                                        <td>
                                            <?php
                                            $total = $result['price'] * $result['quantity'];
                                            echo $fm->format_currency($total) . ' ' . 'VND';
                                            ?>
                                        </td>

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


                </div>
            </div>
            <div class="box_right">
                <div class="container">
                    <table class="table">
                        <h3 style="text-align: center;">Thông Tin Khách Hàng</h3>
                        <div style="display: flex; " class="text-h1"></div>
                        <?php
                        $id = Session::get('customer_id');
                        $get_customers = $cs->show_customers($id);
                        if ($get_customers) {
                            while ($result = $get_customers->fetch()) {

                        ?>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:50%; ">Name</td>
                                        <td style="width:50%; "><?php echo $result['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%; ">Email</td>
                                        <td style="width:50%; "><?php echo $result['email'] ?></td>
                                    </tr>



                                </tbody>
                        <?php

                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div style="padding:20px; text-align: center"><a href="?orderid=order" class="a_order">Order Now</a></div>
        </div>
    </div>
</form>

<?php
include_once 'footer.php';
?>