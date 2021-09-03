<?php
require_once('../connection.php');
include('../class/category.php');
session_start();

if (isset($_POST['name'])) {
    $cate = new Category();
    $cate->ame  = $_POST['name'];
    $cate->description  = $_POST['description'];
    $cate->add($cate,$conn);
    header('location:./index.php');
}
?>