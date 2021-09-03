<?php
require_once('../connection.php');
include('../class/category.php');
include('../class/vegetable.php');

if (isset($_POST['name'])) {
    $vegetable = new Vegetable();
    $vegetable->name  = $_POST['name'];
    $vegetable->unit  = $_POST['unit'];
    $vegetable->amount  = $_POST['amount'];
    $vegetable->image = "images/" . $_FILES['images']['name'];
    $vegetable->price  = $_POST['price'];
    $vegetable->cateid  = $_POST['cateid'];

    $targetDir = "../images/";
    $targetFile = $targetDir . basename($_FILES["images"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["images"]["tmp_name"]);
    if ($_FILES["images"]["size"] > 2097152) {
        header('location:./new.php?err=-1');
    }

    if ($check == false) {
        header('location:./new.php?err=-1');
    }

    if (move_uploaded_file($_FILES["images"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO `vegetable`(CategoryID, VegetableName, Unit, Amount, Image, Price)
         VALUES ('$vegetable->cateid','$vegetable->name','$vegetable->unit','$vegetable->amount','$vege->image','$vege->price')";
        $old = mysqli_query($conn, $sql);
        header('location:./new.php?err=0');
    } else {
        header('location:./new.php?err=-1');
    }
}