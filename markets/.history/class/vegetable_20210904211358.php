<?php
class Vegetable {
    public $vegetableId;
    public $cateid;
    public $name;
    public $unit;
    public $amount;
    public $images;
    public $price;


//METHOD
function getAll($conn)//lấy tất cả sản phẩm
{
     $sql = "SELECT * FROM vegetable";
     $old = mysqli_query($conn,$sql);
     $val=[];
    while($row = mysqli_fetch_array($old)) {
        array_push($val,$row);
    }
    return $val;
}
function getListByCateID($conn,$cateid)//lấy sản phẩm thuộc 1 mã danh mục
{
    $sql = "SELECT * FROM `vegetable` WHERE CategoryID =' $cateid'";
    $old = mysqli_query($conn,$sql);
    $val=[];
   while($row = mysqli_fetch_array($old)) {
        array_push($val,$row);
   }
   return $val;
}
function getListByCateIDs($conn,$cateids)//lấy sản phẩm theo nhiều mã danh mục
{
    $sql = "SELECT * FROM `vegetable` WHERE CategoryID in ($cateids)";
    $old = mysqli_query($conn,$sql);
    $val=[];
   while($row = mysqli_fetch_array($old)) {
        array_push($val,$row);
   }
   return $val;
}
function getByID($conn,$vegetableID)//lấy 
{
    $sql = "SELECT * FROM `vegetable` WHERE VegetableID = '$vegetableID'";
    $old = mysqli_query($conn,$sql);
    $row = $old->fetch_assoc();
    return $row;
}
}

?>