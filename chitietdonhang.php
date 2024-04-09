<?php
include_once 'header.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    echo '<script>document.location.href = "./dangnhap.php"</script>';
}
$ct = new cart();
if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];
    $time = $_GET['time'];
    $shifted_confirm = $ct->shifted_confirm($id, $time);
}
?>
<div class="container">
    <h1 style="text-align: center;">Đơn Hàng Đã Đặt</h1>
    <div style="display: flex; " class="text-h1"></div>
    <table class="table">

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Gía</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $customer_id = Session::get('customer_id');
            $get_cart_ordered = $ct->get_cart_ordered($customer_id);
            if ($get_cart_ordered) {
                $i = 0;
                $qty = 0;
                while ($result = $get_cart_ordered->fetch()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img width=150px; src="public/uploads/<?php echo $result['image_1'] ?>"></td>
                        <td><?php echo $fm->format_currency($result['price']) . ' ' . 'VND'; ?></td>

                        <td>
                            <?php echo $result['quantity'] ?>
                        </td>
                        <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                        <td>
                            <?php
                            if ($result['status'] == '0') {
                                echo 'Đang xử lý(Pending)';
                            } elseif ($result['status'] == '1') {
                            ?>
                                <span>Đã thay đổi(shifted)</span>
                            <?php
                            } elseif ($result['status'] == '2') {
                                echo 'Đã nhận(Received)';
                            }
                            ?>
                        </td>
                        <?php
                        if ($result['status'] == '0') {
                        ?>
                            <td><?php echo 'N/A'; ?></td>
                        <?php
                        } elseif ($result['status'] == '1') {
                        ?>
                            <td>
                                <a href="?confirmid=<?php echo $result['order_id'] ?>&time=<?php echo $result['date_order'] ?>">
                                    <button class="btn btn-outline-success " style=" padding: 5px; margin: 5px;">
                                        Xác nhận đã nhận hàng(Confirmed)
                                    </button>
                                </a>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td><?php echo 'Đã nhận(Received)' ?></td>
                        <?php

                        }
                        ?>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

</div>



<?php
include_once 'footer.php';

?>