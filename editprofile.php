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
<?php
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $UpdateCustommers = $cs->update_customers($_POST, $id);
}
?>

<div class="container">
    <h3 style="text-align: center;">Cập Nhật Thông Tin Khách Hàng</h3>
    <div style="display: flex; " class="text-h1"></div>
    <form action="" method="post">
        <table class="table">
            <?php
            if (isset($UpdateCustommers)) {
                echo '<td colspan="3">' . $UpdateCustommers . '</td>';
            }
            ?>
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
                    </thead>
                    <tbody>
                        <tr>

                            <td style="width:25%;">Tên</td>
                            <td style="width:25%;"><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                        </tr>
                        <tr>

                            <td style="width:25%;">Email</td>
                            <td style="width:25%;"><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>

                        </tr>
                        <tr>

                            <td style="width:25%;">Số Điện Thoại</td>
                            <td style="width:25%;"><input type="text" name="sodienthoai" value="<?php echo $result['sodienthoai'] ?>"></td>
                        </tr>
                        <tr>

                            <td style="width:25%;">Địa chỉ</td>
                            <td style="width:25%;"><input type="text" name="diachi" value="<?php echo $result['diachi'] ?>"></td>

                        </tr>

                        <tr style="text-align: center;" rowspan='4'>
                            <td colspan="4" class="text-center"><input type="submit" name="save" value="Save" class="grey"></td>
                        </tr>

                    </tbody>
            <?php


                }
            }
            ?>
        </table>

</div>



<?php
include_once 'footer.php';

?>