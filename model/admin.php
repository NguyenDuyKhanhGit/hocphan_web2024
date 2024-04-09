<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
// Trong file AdminModel.php hoặc tạo một file mới
class adminModel extends Database {
    private $db;
    // private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        // $this->fm = new Format();
    }

    public function loginAdmin($adminUser, $adminPass) {
        $sql = "SELECT * FROM pet.tbl_admin WHERE adminUser = ? AND adminPass = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$adminUser, md5($adminPass)]);
        $count = $stmt->rowCount();
        
        return $count;
    }

    public function getLoginAdmin($adminUser, $adminPass) {
        $sql = "SELECT * FROM pet.tbl_admin WHERE adminUser = ? AND adminPass = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$adminUser, md5($adminPass)]);
        
        return $stmt;
    }

    public function registerAdmin($adminEmail) {
        $check_email = "SELECT * FROM pet.tbl_admin where adminEmail = ? LIMIT 1";
        $stmt = $this->connect()->prepare($check_email);
        $stmt->execute([$adminEmail]);
        $count = $stmt->rowCount();
        return $count;
    }

    public function registerAdmin_success($adminUser, $adminPass, $adminName, $adminEmail, $adminAddress, $adminPhone) {
        $sql = "INSERT INTO pet.tbl_admin( `adminUser`, `adminPass`, `adminName`, `adminEmail`, `adminAddress`, `adminPhone`) VALUES (?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$adminUser, md5($adminPass), $adminName, $adminEmail, $adminAddress, $adminPhone]);
        return $stmt;
    }
}
?>
