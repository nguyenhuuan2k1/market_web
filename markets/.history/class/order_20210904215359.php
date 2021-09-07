<?php
    Class Order{
        public $orderid;
        public $cusID;
        public $date;
        public $total;
        public $note;

        function getAllOrder($cusID,$conn){//lấy thông tin của tất cả hóa đơn theo mã người dùng
            
            $sql = "SELECT * FROM `order` WHERE CustomerID = '$cusID'";
            $old = mysqli_query($conn,$sql);
            $val=[];
            while($row = mysqli_fetch_array($old)) {
               array_push($val,$row);
            }
            return $val;
        }
        function getOrderDetail($orderid,$conn){//lấy thông tin chi tiết hóa đơn dựa theo mã hóa đơn
            
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
            $sqlGetOrder = "SELECT * FROM `order` ORDER BY OrderID DESC LIMIT 1"; //lấy mã cuối cùng của bảng order 
            $old = mysqli_query($conn,$sqlGetOrder);
            $row = $old->fetch_assoc();
            $lastID = $row['OrderID'] + 1;
            $sqlInsertOrder = "INSERT INTO `order`(`OrderID`, `CustomerID`, `Date`, `Total`, `Note`) 
                               VALUES ('$lastID','$order->cusID','$order->date','$order->total','$order->note')";
            //thêm mã và thông tin hóa đơn mới 
            mysqli_query($conn,$sqlInsertOrder);

            foreach($detail as $item){
                $sqlInsertDetail = "INSERT INTO `orderdetail`(`OrderID`, `VegetableID`, `Quantity`, `Price`) 
                                    VALUES ('$lastID','$item->vegeID','$item->quantity','$item->price')";
                                    //thêm chi tiết
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