<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
// Trong file AdminModel.php hoặc tạo một file mới
class productModel extends Database {
    private $db;
    private $fm;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_product($productName, $category, $brand, $productdesc, $type_1, $price, $unique_image)
    {
      
        $sql = "INSERT INTO pet.tbl_product( productName, catId,brandId, productdesc, type_1, price, image_1) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productName, $category, $brand, $productdesc, $type_1, $price, $unique_image]);
        $count = $stmt->rowCount();
        return $count; 
    }

    public function show_product()
    {
      $sql = "SELECT pet.tbl_product.*, pet.tbl_category.catName, pet.tbl_brand.brandName
          FROM pet.tbl_product INNER JOIN pet.tbl_category ON pet.tbl_product.catId = pet.tbl_category.catId
          INNER JOIN pet.tbl_brand ON pet.tbl_product.brandId = pet.tbl_brand.brandId
          order by pet.tbl_product.productId desc";
      $stmt = $this->connect()->query($sql);
      return $stmt;
    }

    public function update_product_one($productName, $brand, $category, $type_1, $price, $unique_image, $productdesc, $id)
  {
        $sql = "UPDATE pet.tbl_product SET 
             productName = ?,
             brandId = ?,
             catId = ?,
             type_1 = ?,
             price = ?,
             image_1 = ?,
             productdesc = ?
             WHERE productId = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productName, $brand, $category, $type_1, $price, $unique_image, $productdesc, $id]);
        return $stmt;
  }
  public function update_product_two($productName, $brand, $category, $type_1, $price, $unique_image, $productdesc, $id)
  {
        $sql = "UPDATE pet.tbl_product SET 
        productName = ?,
        brandId = ?,
        catId = ?,
        type_1 = ?,
        price = ?,
        productdesc = ?
        WHERE productId = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productName, $brand, $category, $type_1, $price, $productdesc, $id]);
        return $stmt;
  }

  public function del_product($id)
  {
    $sql = "DELETE FROM pet.tbl_product WHERE productId = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt;
  }

  public function getproductbyId($id)
  {
    $sql = "SELECT * FROM pet.tbl_product WHERE productId = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    // $count = $stmt->rowCount();
    return $stmt;
  }
  public function getproduct_feathered()
  {
    $sql = "SELECT * FROM pet.tbl_product where type_1 = '1'";
    $stmt = $this->connect()->query($sql);
    return $stmt;
  }
  public function getproduct_new()
  {
    $sql = "SELECT * FROM pet.tbl_product order by productId desc LIMIT 4";
    $stmt = $this->connect()->query($sql);

    return $stmt;
  }
  public function getproduct_binhthuong()
  {
    $sql = "SELECT * FROM pet.tbl_product ";
    $stmt = $this->connect()->query($sql);
    return $stmt;
  }
  public function get_details($id)
  {
    $sql = "SELECT pet.tbl_product.*, pet.tbl_category.catName, pet.tbl_brand.brandName
            FROM pet.tbl_product INNER JOIN pet.tbl_category ON pet.tbl_product.catId = pet.tbl_category.catId
            INNER JOIN pet.tbl_brand ON pet.tbl_product.brandId = pet.tbl_brand.brandId 
            WHERE pet.tbl_product.productId = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt;
  }
  public function getproduct_timkiem($search_1)
  {

    $sql = "SELECT * from pet.tbl_product where productName like ? or ? or ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(["%" . $search_1 . "%", "%" . $search_1, $search_1 . "%"]);
    // $count = $stmt->rowCount();
    return $stmt;
  }

}
?>
