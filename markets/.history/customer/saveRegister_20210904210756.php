<?php
    require_once('../connection.php');
    include('../class/customer.php');
    session_start();
    if (isset($_SESSION['fullname'])) {//kiểm tra đăng nhập
        header('location:../index.php');
    }
    if (isset($_POST['name'])) {
        /*$fullname = $_POST['name'];
        $pass = $_POST['password'];
        $address = $_POST['address'];
        $city = $_POST['city'];*/

        $cus = new Customer();//gọi một đối tượng Customer

        $cus->fullname = $_POST['name'];
        $cus->pass = $_POST['password'];
        $cus->address = $_POST['address'];
        $cus->city = $_POST['city'];

        $cus->add($cus,$conn);//thực hiện thêm người dùng mới
        
        header('location:./login.php');
    }

?>