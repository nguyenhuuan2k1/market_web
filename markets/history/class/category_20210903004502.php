<?php
class Category {
  public $caid;
  public $description;
  public $name;


  // Methods
  function getAll($conn)
{
     $sql = "SELECT * FROM category";
     $old = mysqli_query($conn,$sql);
     $val=[];
    while($row = mysqli_fetch_array($old)) {
        array_push($val,$row);
    }
    return $val;
}
function add($cate,$conn){
      $sql = "INSERT INTO `category` (`Name`, `Description`)
      VALUES ('')";
      $old = mysqli_query($conn,$sql);
}


}
?>