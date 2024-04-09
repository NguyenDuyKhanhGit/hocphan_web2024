<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../model/product.php');
?>


<?php



class product extends Database
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  public function insert_product($data, $files)
  {
    $productName = $data['productName'];
    $category = $data['category'];
    $brand =  $data['brand'];
    $productdesc = $data['productdesc'];
    $price = $data['price'];
    $type_1 = $data['type_1'];

    // Kiem tre hinh anh va lay hinh anhcho vao folder upload
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name_1 = $_FILES['image_1']['name'];
    $file_size = $_FILES['image_1']['size'];
    $file_temp = $_FILES['image_1']['tmp_name'];

    $div = explode('.', $file_name_1);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "public/uploads/" . $unique_image;

    if (empty($productName) || empty($category) ||  empty($brand) || empty($productdesc) || empty($price) || empty($type_1) || empty($file_name_1)) {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      move_uploaded_file($file_temp, $uploaded_image);
      $productModel = new productModel();
      $count = $productModel->insert_product($productName, $category, $brand, $productdesc, $type_1, $price, $unique_image);
      if ($count) {
        $alert = "<span class='success'>Insert Product Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Product Not Successfully</span>";
        return $alert;
      }
    }
  }
  public function show_product()
  {

    $productModel = new productModel();
    $stmt = $productModel->show_product();
    return $stmt;
  }


  public function update_product($data, $files, $id)
  {

    $productName = $data['productName'];
    $category = $data['category'];
    $brand =  $data['brand'];
    $productdesc = $data['productdesc'];
    $price = $data['price'];
    $type_1 = $data['type_1'];

    // Kiem tre hinh anh va lay hinh anhcho vao folder upload
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name_1 = $_FILES['image_1']['name'];
    $file_size = $_FILES['image_1']['size'];
    $file_temp = $_FILES['image_1']['tmp_name'];

    $div = explode('.', $file_name_1);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if (empty($productName) || empty($category) ||  empty($brand) || empty($productdesc) || empty($price) || empty($type_1)) {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      if ($file_name_1) {
        // neu nguoi dung chon anh
        if ($file_size > 1009600) {
          $alert = "<span class='success'>Image Size should be less hen 2MB!</span>";
          return $alert;
        } else if (in_array($file_ext, $permited) === false) {

          $alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
          return $alert;
        }
        move_uploaded_file($file_temp, $uploaded_image);

        $productModel = new productModel();
        $stmt = $productModel->update_product_one($productName, $brand, $category, $type_1, $price, $unique_image, $productdesc, $id);
      } else {
        //neu nguoi dung khong chon anh

        $productModel = new productModel();
        $stmt = $productModel->update_product_two($productName, $brand, $category, $type_1, $price, $unique_image, $productdesc, $id);
      }
      $count = $stmt->rowCount();
      if ($count) {
        $alert = "<span class='success'>Product Upload Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Product Upload Not Successfully</span>";
        return $alert;
      }
    }
  }

  public function del_product($id)
  {
 
    $productModel = new productModel();
    $count = $productModel->del_product($id);
    if ($count) {
      $alert = "<span class='success'>Deleted Successfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'> Deleted Not Successfully</span>";
      return $alert;
    }
  }

  public function getproductbyId($id)
  {

    $productModel = new productModel();
    $stmt = $productModel->getproductbyId($id);
    return $stmt;
  }

  // //END Back end
  // SAN PHAM NỔI BẬT
  public function getproduct_feathered()
  {

    $productModel = new productModel();
    $stmt = $productModel->getproduct_feathered();
    return $stmt;
  }
  /// SAN PHAM MỚI
  public function getproduct_new()
  {

    $productModel = new productModel();
    $stmt = $productModel->getproduct_new();
    return $stmt;
  }
  //   // show san pham trang sanpham.php
  public function getproduct_binhthuong()
  {

    $productModel = new productModel();
    $stmt = $productModel->getproduct_binhthuong();
    return $stmt;
  }

  public function get_details($id)
  {
    $productModel = new productModel();
    $stmt = $productModel->get_details($id);
    return $stmt;
  }

  public function getproduct_timkiem($search_1)
  {

    $productModel = new productModel();
    $stmt = $productModel->getproduct_timkiem($search_1);
    $count = $stmt->rowCount();
    if (empty($count)) {
      echo "Không có sản phẩm nào như vậy!";
    } else {
      return $stmt;
    }
  }
}


?>