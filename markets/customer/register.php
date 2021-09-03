<?php
    include('./saveRegister.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/booststrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="register">
        <form class=" p-4" action="register.php" method="POST">
            <h3>Register</h3>
            <div class="form-group">
                <label for="exampleDropdownFormEmail2">Fullname</label>
                <input type="text" name="name" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter Your Name">
            </div>
            <div class="form-group">
                <label for="exampleDropdownFormPassword2">Password</label>
                <input type="text" name="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Enter your password">
            </div>
            <div class="form-group">
                <label for="exampleDropdownFormEmail2">Address</label>
                <input type="text" name="address" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter your address">
            </div>
            <div class="form-group">
                <label for="exampleDropdownFormEmail2">City</label>
                <input type="text" name="city" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter your city">
            </div>
  
            <button type="submit" class="btn login-btn btn-primary">Register</button>
        </form>
</div>
    
</body>
</html>