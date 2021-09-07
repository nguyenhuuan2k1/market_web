<?php
  $headerRight = '';
  $history = '';
    if(isset($_SESSION['fullname'])) { //kiểm tra đăng nhập
      $fullname = $_SESSION['fullname'];
      $headerRight = '<a href="/markets/customer/logout.php" type="" class="linkLogout">Logout</a>
                      <button class="btn btn-info my-2 my-sm-0" >' . $fullname . '</button>';
      $history ='<li class="nav-item">
                    <a class="nav-link" href="/markets/cart/history.php">History</a>
                </li>';

    } else{
      $headerRight = '<a class="btn btn-info my-2 my-sm-0" href="/markets/customer/login.php">Login/Register</a>';
    }
?>

<div class="header bg-dark">
  <nav class="navbar container navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/markets/index.php">Market online</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/markets/vegetable/index.php">Vegetable</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/markets/cart/index.php">Cart</a>
        </li>
        <?php echo $history;//xuất hiện History nếu đã đăng nhập ?> 
      
      </ul>
      <div class="form-inline my-2 my-lg-0">
        <?php echo $headerRight;//xuất tên người dùng và nút Logout nếu đã đăng nhập, ngược lại là nút Login/Register ?>
        
      </div>
    </div>
  </nav>
</div>



