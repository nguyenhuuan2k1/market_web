<?php
    Class Order{
        public $orderid;
        public $cusID;
        public $date;
        public $total;
        public $note;

        function getAllOrder($cusID,$conn){//lấy thông tin của tất cả hóa đơn
            
            $sql = "SELECT * FROM `order` WHERE CustomerID = '$cusID'";
            $old = mysqli_query($conn,$sql);
            $val=[];
            while($row = mysqli_fetch_array($old)) {
               array_push($val,$row);
            }
            return $val;
        }
        function getOrderDetail($orderid,$conn){//lấy dữ liệu 
            
            $sql = "SELECT * FROM `orderdetail` 
            where orderdetail.OrderID = '$orderid'";
            $old = mysqli_query($conn,$sql);
            $val=[];
            while($row = mysqli_fetch_array($old)) {
                array_push($val,$row);
            }
            return $val;
       }

       function addOrder($order,$detail,$conn)
       {
           try {
            $sqlGetOrder = "SELECT * FROM `order` ORDER BY OrderID DESC LIMIT 1";
            $old = mysqli_query($conn,$sqlGetOrder);
            $row = $old->fetch_assoc();
            $lastID = $row['OrderID'] + 1;
            $sqlInsertOrder = "INSERT INTO `order`(`OrderID`, `CustomerID`, `Date`, `Total`, `Note`) 
                               VALUES ('$lastID','$order->cusID','$order->date','$order->total','$order->note')";
            
            mysqli_query($conn,$sqlInsertOrder);

            foreach($detail as $item){
                $sqlInsertDetail = "INSERT INTO `orderdetail`(`OrderID`, `VegetableID`, `Quantity`, `Price`) 
                                    VALUES ('$lastID','$item->vegeID','$item->quantity','$item->price')";
                mysqli_query($conn,$sqlInsertDetail);
            }
            return true;
       } catch (Error){
           return false;
       }

    }
}
    Class Orderdetail {
        public $orderid;
        public $vegeID;
        public $quantity;
        public $price;
    }
?>