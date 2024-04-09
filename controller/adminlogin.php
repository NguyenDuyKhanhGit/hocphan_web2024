<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
// include_once('/../lib/session.php');
Session::checkLogin();
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../model/admin.php');
?>


<?php
class adminlogin extends Database
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser, $adminPass)
    {
        $adminModel = new adminModel();
        $count = $adminModel ->loginAdmin($adminUser, $adminPass);
        if (empty($adminUser) || empty($adminPass)) {
            $alert = "Tài khoản và mật khẩu không thể bỏ trống!";
            return $alert;
        } else {

            if ($count) {
                $admin_User = $adminModel->getLoginAdmin($adminUser, $adminPass)->fetch();
                Session::set('adminlogin', true);
                Session::set('adminId', $admin_User['adminID']);
                Session::set('adminUser', $admin_User['adminUser']);
                Session::set('adminName', $admin_User['adminName']);
                echo '<script>document.location.href = "./index.php"</script>';
            } else {
                $alert = "Tài khoản và mật khẩu không khớp!";
                return $alert;
            }
        }
    }
    
    public function register_admin($adminUser, $adminPass, $adminName, $adminEmail, $adminAddress, $adminPhone)
{
    if (empty($adminUser) || empty($adminPass) || empty($adminName) || empty($adminEmail) || empty($adminAddress) || empty($adminPhone)) {
        $alert = "Bạn cần nhập các thông tin và không bỏ trống!";
        return $alert;
    } else {
        if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            $alert = "Email không hợp lệ!";
            return $alert;
        }

       
        $adminModel = new adminModel();
        $count = $adminModel ->registerAdmin($adminEmail);

        if ($count) {
            $alert = "<span class='error'>Email đã được đăng ký!</span>";
            return $alert;
        } else {
            $stmt = $adminModel->registerAdmin_success($adminUser, $adminPass, $adminName, $adminEmail, $adminAddress, $adminPhone);
            if ($stmt) {
                $alert = "<span class='success'>Đăng ký thành công!</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Đã xảy ra lỗi!</span>";
                return $alert;
            }
        }
    }
}

}

?>