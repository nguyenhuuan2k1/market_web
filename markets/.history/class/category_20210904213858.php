<?php
class Category {
  public $caid;
  public $description;
  public $name;


  // Methods
  function getAll($conn)//lấy thông tin tất cả danh mục 
{
     $sql = "SELECT * FROM category";
     $old = mysqli_query($conn,$sql);
     $val=[];
    while($row = mysqli_fetch_array($old)) {
        array_push($val,$row);
    }
    return $val;
}
function add($cate,$conn){//thêm 1 danh mục moo
      $sql = "INSERT INTO `category` (`Name`, `Description`)
      VALUES ('$cate->name','$cate->description')";
      $old = mysqli_query($conn,$sql);
}


}
?>