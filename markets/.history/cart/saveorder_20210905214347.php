<?php
    session_start();
    include('../connection.php');
    include('../class/vegetable.php');
    include('../class/order.php');
    $vegetable = new Vegetable($conn);

    if (!isset($_SESSION['fullname'])) //kiểm tra đăng nhập
    {
        header('location:./index.php?errLogin');
    }
    //lấy các SESSION 
    $cusId= $_SESSION['id'];
    $total = $_POST['total'];
    $note= $_POST['note'];
    //tạo hóa odn7
    $order = new Order($conn);
    $order->cusID = $cusId;
    $order->total = $total;
    $order->note = $note;
    $order->date = date('Y-m-d H:i:s');
    //gán giá trị cho $order

    $listDetails =[];
    foreach ($_SESSION['listVegeId'] as $key => $item) 
    {
        $vegetableItem = $vegetable->getByID( $item->id);
        $price = $vegetableItem['Price'];
        $amount = $item->amount;
        $id = $item->id;

        $orderDetail = new Orderdetail();
        $orderDetail->vegeID = $id;
        $orderDetail->quantity = $amount;
        $orderDetail->price = $price;

        array_push($listDetails,$orderDetail);
       
    }
    if ($order->addOrder($order,$listDetails)) {//thêm order và orderdetail vào database
        $_SESSION['listVegeId']=[];//làm mới lại giỏ hàng
        
        header('location:./index.php?billStatus=1');
    }else{
        header('location:./index.php?billStatus=0');
    }
?>
    