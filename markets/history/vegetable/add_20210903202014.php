<?php 
require_once('../connection.php');
include('../class/category.php');
include('../class/vegetable.php');

if(isset($_POST['name'])) {
    $vegetable = new Vegetable();
    $vegetable->name = $_POST['name'];
    $vegetable->unit = $_POST['unit'];
    $vegetable->amount = $_POST['amount'];
    $vegetable->images = "images/" . $_FILES['images']['name'];
    $vegetable->price = $_POST['price']
}

?>