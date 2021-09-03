<?php 
    session_start();
    include('../class/vegetable.php');
    include('../class/order.php');
    include('../connection.php');
    if (!isset($_SESSION['fullname'])) {
        header('location:../customer/login.php');
    }
    $totalAmount=0;
    $totalPrice=0;
    $html='';
    if (isset($_GET['id'])) {
        $orderID = $_GET['id'];
        $listOrderDetail = [];
        $order = new Order();
        $listOrderDetail = $order->getOrderDetail($orderID,$conn);
        foreach ($listOrderDetail as $key => $item) {
            $vegetable = new Vegetable();
            $vegetableItem = $vegetable->getByID($conn,$item['VegetableID']);
            
            $html .='<tr>
            <th scope="row">'. $key+1 .'</th>
            <td>'.$vegetableItem['VegetableName'].'</td>
            <td><image src="../'.$vegetableItem['Image'].'" alt="" style="width:180px;height:200px;"></td>
            <td>'.$item['Quantity'].'</td>
            <td>'.$vegetableItem['Price'].'</td>
        </tr>';
        $totalAmount+=$item['Quantity'];
        $totalPrice+=$item['Quantity'] * $vegetableItem['Price'];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/booststrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
        include('../menu.php');
    ?>
    <h1>Order Detail</h1>
    <div class="container mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $html; ?>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><?php echo $totalAmount; ?></th>
                    <th>Total: <?php echo $totalPrice; ?></th>
                </tr>
            </tbody>
        </table>
        
    </div>
    



    <script> <?php echo $scriptAlert; ?> </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

</body>

</html>