<?php
  include('./checkLogin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/booststrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="login">
    <form class=" p-4" action="login.php" method="POST">
      <h3>Login</h3>
        <div class="form-group">
          <label for="exampleDropdownFormEmail2">Your ID</label>
          <input type="text" name="yourId" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter Your's ID">
        </div>
        <div class="form-group">
          <label for="exampleDropdownFormPassword2">Password</label>
          <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
        </div>
        <div style="color: red;"> <?php echo $invalidPass ?> </div>
  
        <button type="submit" class="btn login-btn btn-primary">Login</button>
        <a href="register.php" type="submit" class="btn login-btn btn-primary">Register</a>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>