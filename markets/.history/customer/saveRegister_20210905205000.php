<?php
    require_once('../connection.php');
    include('../class/customer.php');
    session_start();
    if (isset($_SESSION['fullname'])) //kiểm tra đăng nhập
    {
        header('location:../index.php');
    }
    if (isset($_POST['name'])) {
    
        $cus = new Customer($conn);//gọi một đối tượng Customer

        $cus->fullname = $_POST['name'];
        $cus->pass = $_POST['password'];
        $cus->address = $_POST['address'];
        $cus->city = $_POST['city'];
    
        $cus->add($cus);//thực hiện thêm người dung mới
    
        header('location:./login.php');
    }