<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../model/cart.php');
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



class cart extends Database
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  //thêm sp vào gio hang
  public function add_to_cart($quantity, $id, $customer_id)
  {
    $quantity =  $this->fm->validation($quantity);
    $ssId = session_id();
    $cartModel = new cartModel();
    $count = $cartModel -> add_to_cart($quantity, $id, $customer_id,$ssId);

    if ($count) {
      echo '<script>document.location.href = "./donhang.php"</script>';
    } else {
      echo '<script>document.location.href = "./404.php"</script>';
    }
  }

  // lay san pham vao don hang
  public function get_product_cart()
  {
    $ssId = session_id();
    $cartModel = new cartModel();
    $stmt = $cartModel -> get_product_cart($ssId);
    return $stmt;
  }

  public function update_quantity_cart($quantity, $cartId)
  {
    $cartModel = new cartModel();
    $stmt = $cartModel -> update_quantity_cart($quantity, $cartId);
    if ($stmt) {
      $msg = "<span class='success'>Product Quantity Update Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Product Quantity Update Not Successfully</span>";
      return $msg;
    }
  }

  public function del_product_cart($cartid)
  {

    $cartModel = new cartModel();
    $count = $cartModel -> del_product_cart($cartid);
    if ($count) {
      $msg = "<span class='success'>Product Deleted Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Product Deleted Not Successfully</span>";
      return $msg;
    }
  }

  public function del_all_data_cart()
  {
    $ssId = session_id();
    $cartModel = new cartModel();
    $count = $cartModel -> del_product_cart($ssId);
    return $count;
  }

  public function insertOrder()
  {
    $ssId = session_id();
    $cartModel = new cartModel();
    $stmt = $cartModel -> insertOrder_one($ssId);
    if ($stmt) {
      while ($result = $stmt->fetch()) { // lấy dư lieu đe truyen
        $cartId = $result['cartId'];
        $insert_order = $cartModel -> insertOrder_two($cartId);
        $upCart_status = $cartModel -> insertOrder_three($cartId);
      }
      return $insert_order;
    }
  }

  public function getAmountPrice($customer_id)
  {
    $ssId = session_id();
    $cartModel = new cartModel();
    $stmt = $cartModel -> getAmountPrice($customer_id);
    return $stmt;
  }

  public function get_cart_ordered($customer_id)
  {
    $cartModel = new cartModel();
    $stmt = $cartModel -> get_cart_ordered($customer_id);
    return $stmt;
  }
  //   public function get_cart_ordered($customer_id){


  public function get_inbox_cart()
  {
    $cartModel = new cartModel();
    $stmt = $cartModel -> get_inbox_cart();
    return $stmt;
  }

  public function shifted_admin($order_id, $time, $adminid)
  {
    $cartModel = new cartModel();
    $count = $cartModel -> shifted_admin($order_id, $time, $adminid);
    if ($count) {
      $msg = "<span class='success'>Update Order Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Update Order Not Successfully</span>";
      return $msg;
    }
  }


  public function shifted_confirm($order_id, $time)
  {
    $cartModel = new cartModel();
    $count = $cartModel -> shifted_confirm($order_id, $time);
    if ($count) {
      $msg = "<span class='success'>Update Order Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Update Order Not Successfully</span>";
      return $msg;
    }
  }
}
?>