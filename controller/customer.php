<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../model/customer.php');

?>

<style>
  .success {
    font-size: 18px;
    color: green !important;
  }

  .error {
    font-size: 18px;
    color: red !important;
  }
</style>


<?php



class customer extends Database
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  // dang ki
  public function insert_customers($data)
  {
    $name = $data['name'];
    $email = $data['email'];
    $password_1 = md5($data['password_1']);
    $diachi = $data['diachi'];
    $sodienthoai = $data['sodienthoai'];
    if (empty($name) || empty($email) || empty($password_1) || empty($diachi) || empty($sodienthoai)) {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $customerModel = new customerModel();
      $count = $customerModel->insert_customers_one($email);
      if ($count) {
        $alert = "<span class='error'>Email Already Existed</span>";
        return $alert;
      } else {
        $stmt = $customerModel->insert_customers_two($name, $email, $password_1, $sodienthoai, $diachi);
        if ($stmt) {
          $alert = "<span class='success'>Customer Creates Successfully</span>";
          return $alert;
        } else {
          $alert = "<span class='error'>Customer Creates Not Successfully</span>";
          return $alert;
        }
      }
    }
  }

  public function login_customers($data)
  {
    $email = $data['email'];
    $password_1 = md5($data['password_1']);



    if (empty($email) || empty($password_1)) {
      $alert = "Tài khoản và mật khẩu không được bỏ trống!";
      return $alert;
    } else {
      $customerModel = new customerModel();
      $count = $customerModel->login_customers_one($email, $password_1);
      if ($count) {
        // $User = $stmt->fetch();
        $User = $customerModel->login_customers_two($email, $password_1)->fetch();
        Session::set('customer_login', true);
        Session::set('customer_id', $User['customer_id']);
        Session::set('customer_name', $User['name']);
        // header('Location:index.php');
        echo '<script>document.location.href = "./trangchu.php"</script>';
      } else {
        $alert = "Tài khoản và mật khẩu không đúng!";
        return $alert;
      }
    }
  }

  //  //cap nhat thong tin khach hang
  public function show_customers($id)
  {
    $customerModel = new customerModel();
    $stmt = $customerModel->show_customers($id);
    return $stmt;
  }
  public function update_customers($data, $id)
  {
    $name = $data['name'];
    $email = $data['email'];
    $sodienthoai =  $data['sodienthoai'];
    $diachi = $data['diachi'];
    if (empty($name) || empty($email) || empty($diachi) || empty($sodienthoai)) {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $customerModel = new customerModel();
      $count = $customerModel->update_customers($name, $email, $sodienthoai, $diachi, $id);
      if ($count) {
        $alert = "<span class='success'>Customer Creates Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Customer Creates Not Successfully</span>";
        return $alert;
      }
    }
    // return $stmt;
  }


}
?>