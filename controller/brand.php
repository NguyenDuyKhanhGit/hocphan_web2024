<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../model/brand.php');
?>


<?php



class brand extends Database
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_brand($brandName)
    {
        if (empty($brandName)) {
            $alert = "<span class='error'>Brand must be not empty</span>";
            return $alert;
        } else {
            $brandModel = new brandModel();
            $count = $brandModel->insert_brand($brandName);

            if ($count) {
                $alert = "<span class='success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function show_brand()
    {
        $brandModel = new brandModel();
        $stmt = $brandModel->show_brand();
        return $stmt;
    }
    public function getbrandbyId($id)
    {
        $brandModel = new brandModel();
        $stmt = $brandModel->getbrandbyId($id);
        return $stmt;
    }

    public function update_brand($brandName, $id)
    {

        if (empty($brandName)) {
            $alert = "<span class='error'>Brand must be not empty</span>";
            return $alert;
        } else {
            $brandModel = new brandModel();
            $count = $brandModel->update_brand($brandName, $id);
            if ($count) {
                $alert = "<span class='success'>Update Brand Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Brand Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function del_brand($id)
    {
        $brandModel = new brandModel();
        $count = $brandModel->del_brand($id);
        if ($count) {
            $alert = "<span class='success'> Deleted Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Deleted Not Successfully</span>";
            return $alert;
        }
    }
}

?>