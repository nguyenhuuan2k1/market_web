<?php
    session_start();
    
    include('../class/vegetable.php');
    include('../connection.php');
    if (!isset($_SESSION['listVegeId'])) 
{
    $_SESSION['listVegeId']=[];
}
    $vege = new Vegetable();
    

    $html='';
    $listVegetable = null;

    if (isset($_GET['cateId'])) {
        $listCateID = $_GET['cateId'];
        $listVegetable = $vege->getListByCateIDs($conn,implode(",",$listCateID));
    } else {
        $listVegetable = $vege->getAll($conn);
    }

    foreach ($listVegetable as $item)//xuất thông tin sản phẩm
    {
        $amountCart = findAmountById($item['VegetableID']);
        $html .= '
        <div class="col-md-4 mt-4">
            <div class="card" amount="'.$item['Amount'].'" amountCart="'.$amountCart.'" vegeId="'.$item['VegetableID'].'">
                <img class="card-img-top" src="../'.$item['Image'] .'" alt="Card image cap"> 
                <div class="card-body">
                    <h5 class="card-title">'.$item['VegetableName'].' <span class="priceText">'.$item['Price'].'</span></h5>

                    <button class="btn btn-primary buyCard">Buy</button>
                </div>
            </div>
        </div>';
    }

    function findAmountById($id)
    {
        $arr = $_SESSION['listVegeId'];
        foreach($arr as $item)
        {
            if ($item->id == $id)
            {
                return $item->amount;
            }
        }
        return 0;
    }

    include('../class/category.php');
    $cate = new Category();
    $listCategoryName = $cate->getAll($conn);
    $htmlCheckbox = '';
    foreach($listCategoryName as $item)
    {
        $htmlCheckbox .='<li> <input type="checkbox" name="cateId[]" id="" value="'.$item['CategoryID'].'">'.$item['Name'].'</li>';
    }
    
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetable</title>
    <link rel="stylesheet" href="../css/booststrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
        include('../menu.php');
    ?>
    <div class="container" >
        <div class="row justify-content-between">
            <div class="sidebar col-md-2 mt-4">
                <form action="">
                    <h2>Category name</h2>
                    <ul style="list-style: none;padding-left:0px">
                        <?php echo $htmlCheckbox; ?>
                    </ul>
                    <button type="submit" class="btn btn-info my-1 my-sm-0">Filter</button>
                </form>
            </div>

            <div class="col-md-10 mt-4">
                <div class="row">
                    <?php echo $html;//xuất thông tin sản phẩm có trong database ra màn hình ?>
                </div>
            </div>
        </div>
    </div>
    <script>

        const textList = Array.from(document.querySelectorAll('.priceText'));
            textList.forEach((e) => {
              e.innerHTML = formatNumber(e.innerHTML);
            })
        function formatNumber(num) { // định dạng giá tiền
            return Number(num).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }

        const listCart = Array.from(document.querySelectorAll('.card'));
        listCart.forEach((e) => {
            const btn = e.querySelector('.buyCard');
            btn.onclick = () => {
                const amountCart = e.getAttribute('amountCart')
                const amount = e.getAttribute('amount')
                const vegeId = e.getAttribute('vegeId')
                if (amount == amountCart){
                    alert('Out of amount!')
                }else{
                    window.location.href = `../cart/index.php?vegeId=${vegeId}`;
                }
            }
        })
    </script>
</body>
</html>

