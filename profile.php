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
                        <td style="width:25%; ">Tên</td>
                        <td style="width:25%; "><?php echo $result['name'] ?></td>
                    </tr>
                    <tr>
                        <td style="width:25%; ">Email</td>
                        <td style="width:25%; "><?php echo $result['email'] ?></td>
                    </tr>
                    <tr>
                        <td style="width:25%; ">Số điện thoại</td>
                        <td style="width:25%; "><?php echo $result['sodienthoai'] ?></td>
                    </tr>
                    <tr>
                        <td style="width:25%; ">Địa chỉ</td>
                        <td style="width:25%; "><?php echo $result['diachi'] ?></td>
                    </tr>

                    <tr>
                        <td colspan="4" class="text-center"><a href="editprofile.php">Cập nhật thông tin</a></td>
                    </tr>

                </tbody>
        <?php

            }
        }
        ?>
    </table>

</div>



<?php
include_once 'inc/footer.php';

?>