<?php
require_once('../connection.php');
include('../class/vegetable.php');
session_start();

$html='';
$total=0;
$scriptAlert = '';
if (isset($_GET['billStatus'])) {
    $billStatus = $_GET['billStatus'];
    if ($billStatus==1) {
        $scriptAlert='alert("Pay successsfully!")</script>';
    }
    else {
        $scriptAlert='<script> alert("Pay unsuccesssfully!")</script>';
    }
}
if (!isset($_SESSION['fullname'])) 
{
    $html = 'You need to login!!';
}else {
    $vegetable = new Vegetable();
    if (isset($_GET['vegeId'])) 
    {

        $object = new stdClass();
        $object->amount = 1;
        $object->id =$_GET['vegeId'];

        if (check($object,$_SESSION['listVegeId'])) 
        {
            
        }else {
            array_push($_SESSION['listVegeId'],$object);
        }
    }

    $_SESSION['listVegeId'] = checkAmount($vegetable,$conn);


$html='';


foreach ($_SESSION['listVegeId'] as $key=> $item) 
{
    $vegetableItem = $vegetable->getByID($conn,$item->id);
    
    $name = $vegetableItem['VegetableName'];
    $image = $vegetableItem['Image'];
    $amount = $item->amount;
    $price = $vegetableItem['Price'];
    $total+=($amount*$price);
    $html.='<tr>
                <th scope="row">'.$key.'</th>
                <td>'.$name.'</td>
                <td><image src="../'.$image.'" alt="" style="width:180px;height:200px;"></td>
                <td>'.$amount.'</td>
                <td>'.$price.'</td>
            </tr>';
    }
}

$_SESSION['listVegeId'] = checkAmount($vegetable,$conn);

function check($object,$arr)
{
    for ($i=0; $i < count($arr); $i++) {
        if ($arr[$i]->id==$object->id) {
            $arr[$i]->amount++;
            $_SESSION['listVegeId'] = $arr;
            return true;
        }
    }
}

function checkAmount($vegetable,$conn)
{
    $arr = $_SESSION['listVegeId'];
    $length = count($arr);

    for ($i=0; $i < $length; $i++) { 
        $currentAmount = $vegetable->getByID($conn,$arr[$i]->id);
        if ($arr[$i]->amount > $currentAmount['Amount']) {
            $arr[$i]->amount-=1;
            
            if ($arr[$i]->amount == 0) {
                unset($arr[$i]);
            }
            return $arr;
        }
    }
    return $arr;
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
                    <th></th>
                    <th>Total: <?php echo $total; ?></th>
                </tr>
            </tbody>
        </table>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
            Order
        </button>

        <!-- Modal -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="./saveorder.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Note title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total</label>
                            <input type="text" class="form-control disInput" name="total" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="<?php echo $total; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Note</label>
                            <input type="text" class="form-control" name="note" id="exampleInputPassword1" placeholder="Your note">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Order</button>
                </div>
            </form>
        </div>
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