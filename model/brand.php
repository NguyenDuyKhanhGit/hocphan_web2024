<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
// Trong file AdminModel.php hoặc tạo một file mới
class brandModel extends Database {
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_brand($brandName) {
        $sql = "INSERT INTO pet.tbl_brand(brandName) VALUES(?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$brandName]);
            $count = $stmt->rowCount();
        return $count;
    }

    public function show_brand() {
        $sql = "SELECT * FROM pet.tbl_brand order by brandId desc";
        $stmt = $this->connect()->query($sql);
        return $stmt;
    }

    
    public function getbrandbyId($id)
    {
        $sql = "SELECT * FROM pet.tbl_brand WHERE brandId = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }

    public function update_brand($brandName, $id)
    {
            $sql = "UPDATE pet.tbl_brand SET brandName = ? WHERE brandId= ? ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$brandName, $id]);
            $count = $stmt->rowCount();
            return $count;
    }

    public function del_brand($id)
    {
        $sql = "DELETE FROM pet.tbl_brand WHERE brandId = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $count = $stmt->rowCount();
        return $count;
    }



}
?>
