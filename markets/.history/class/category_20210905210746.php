<?php
class Category
{
  public $caid;
  public $description;
  public $name;
  public $conn;

  public function __construct($conn) {
      $this->conn = $conn;
  }
  
  function getAll()//lấy thông tin tất cả danh mục
  {
    $sql = "SELECT * FROM category";
    $old = mysqli_query($this->conn, $sql);
    $val = [];
    while ($row = mysqli_fetch_array($old)) {
      array_push($val, $row);
    }
    return $val;
  }

  function add($cate)//
  {
    $sql = "INSERT INTO `category` (  `Name`, `Description`)
              VALUES ('$cate->name','$cate->description')";
    $old = mysqli_query($this->conn, $sql);
  }
}
