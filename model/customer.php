<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
// Trong file AdminModel.php hoặc tạo một file mới
class customerModel extends Database {
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
      public function insert_customers_one($email)
      {
        $check_email = "SELECT * FROM pet.tbl_customer where email = ? LIMIT 1";
        $stmt = $this->connect()->prepare($check_email);
        $stmt->execute([$email]);
        $count=$stmt->rowCount();
        return $count;
      }
      public function insert_customers_two($name, $email, $password_1, $sodienthoai, $diachi)
      {
        $sql = "INSERT INTO pet.tbl_customer( `name`, `email`, `password_1`, `sodienthoai`, `diachi`) VALUES (?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $email, $password_1, $sodienthoai, $diachi]);
        return $stmt;
      }

      public function login_customers_one($email, $password_1)
    {
        $sql = "SELECT * FROM pet.tbl_customer WHERE email = ? AND password_1 = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $password_1]);
        $count = $stmt->rowCount();
        return  $count;
    }
    public function login_customers_two($email, $password_1)
    {
        $sql = "SELECT * FROM pet.tbl_customer WHERE email = ? AND password_1 = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $password_1]);
        return  $stmt;
    }
    public function show_customers($id)
    {
      $sql = "SELECT * FROM pet.tbl_customer WHERE customer_id = ?"; //do doi ten cot id thanh customer_id
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id]);
      return $stmt;
    }
    public function update_customers($name, $email, $sodienthoai, $diachi, $id)
    {
      
        $sql = "UPDATE pet.tbl_customer SET `name`= ? , `email`= ?,`sodienthoai`= ?, `diachi`= ? WHERE customer_id= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $email, $sodienthoai, $diachi, $id]);
        $count = $stmt->rowCount();
        return $count;
    }





}
?>
