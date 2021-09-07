<?php
class Customer {
    public $cusid;
    public $pass;
    public $fullname;
    public $address;
    public $city;


    //Method
    function getByID($cusid,$conn){ 
        $sql ="SELECT * FROM `customers` WHERE CustomerID ='$cusid'";//lấy thông tin khách hàng 
        $old = mysqli_query($conn,$sql);
        $row = $old->fetch_assoc();
        
    }

    function add($cus,$conn){
        $sql = "INSERT INTO `customers` (`CustomerID`, `Password`, `Fullname`, `Address`, `City`)
          VALUES ('$cus->cusid','$cus->pass','$cus->fullname','$cus->address','$cus->city')";
          $old = mysqli_query($conn,$sql);
    }

}
?>