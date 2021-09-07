<?php
class Customer {
  public $cusid;
  public $pass;
  public $fullname;
  public $address;
  public $city;
  public $conn;


  public function __construct($conn) {
      $this->conn = $conn;
  }


  function getByID($cusid){//lấy thông tin khách hàng dựa trên id
      $sql = "SELECT * FROM `customers` WHERE CustomerID =$cusid";
      $old = mysqli_query($this->conn,$sql);
      if ($old==false) {
        return null;
      }
      $row = $old->fetch_assoc();
      return $row;
  }
  function add($cus){//thêm mới 1 khách hàng
      $sql = "INSERT INTO `customers`( `Password`, `Fullname`, `Address`, `City`)
       VALUES ('$cus->pass','$cus->fullname','$cus->address','$cus->city')";
        $old = mysqli_query($this->conn,$sql);
  }
}
?>