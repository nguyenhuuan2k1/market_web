<?php
    require_once('../connection.php');
    include('../class/customer.php');
    session_start();
    $invalidPass = '';
    if (isset($_SESSION['fullname'])) {//kiểm tra đăng nhập
        header('location:../index.php');
    }
    if (isset($_POST['yourId'])) 
    {
        $id = $_POST['yourId'];
        $pass = $_POST['password'];
        $cus = new Customer($conn);
        $row = $cus->getByID($id);
        if ($row !== null ) {
           if ($row['Password']==$pass) {
            $_SESSION['fullname'] = $row['Fullname'];
            $_SESSION['id'] = $row['CustomerID'];
            $_SESSION['address'] = $row['Address'];
            $_SESSION['city'] = $row['City'];
            header('location:../vegetable/index.php');
            //nếu đăng nhập thành công thì chuyển sang trang vegetable/index.php và lưu SESSION
           }else{
            $invalidPass = 'Mật khẩu hoặc id sai';
           }
        }else{
            $invalidPass = 'Không tìm thấy tài khoản';
        }

        
    }
?>