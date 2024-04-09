<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../model/category.php');
?>


<?php



class category extends Database
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {

        if (empty($catName)) {
            $alert = "<span class='error'>Category must be not empty</span>";
            return $alert;
        } else {
            $categoryModel = new categoryModel();
            $count = $categoryModel->insert_category($catName);
            if ($count) {
                $alert = "<span class='success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function show_category()
    {
        $categoryModel = new categoryModel();
        $stmt = $categoryModel->show_category();
        return $stmt;

    }
    public function getcatbyId($id)
    {
        $categoryModel = new categoryModel();
        $stmt = $categoryModel->getcatbyId($id);
        return $stmt;
    }


    public function update_category($catName, $id)
    {

        if (empty($catName)) {
            $alert = "<span class='error'>Category must be not empty</span>";
            return $alert;
        } else {
            $categoryModel = new categoryModel();
            $count = $categoryModel->update_category($catName, $id);
            if ($count) {
                $alert = "<span class='success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Not Successfully</span>";
                return $alert;
            }
        }
    }


    public function del_category($id)
    {
        $categoryModel = new categoryModel();
        $count = $categoryModel->del_category($id);
        if ($count) {
            $alert = "<span class='success'>Deleted Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Deleted Not Successfully</span>";
            return $alert;
        }
    }

    //show san pham ra màn hình
    public function show_category_fontend()
    {

        $categoryModel = new categoryModel();
        $stmt = $categoryModel->show_category_fontend();
        return $stmt;
    }

    // lay san pham theo danh muc 
    public function get_product_by_cat($id)
    {
        $categoryModel = new categoryModel();
        $stmt = $categoryModel->get_product_by_cat($id);
        return $stmt;
    }
    // lấy ten danh muc cua cac san pham thuoc danh muc do

    public function get_name_by_cat($id)
    {
        $categoryModel = new categoryModel();
        $stmt = $categoryModel->get_name_by_cat($id);
        return $stmt;
    }
}

?>

