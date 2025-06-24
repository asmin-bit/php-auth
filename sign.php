<?php

$success = '0';
$user ='0';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';

    // Avoid undefined index warnings
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
        exit();
    }

    // ❌ Fix SQL syntax: Don't use single quotes around table name
    $sql = "SELECT * FROM registration WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            //echo "User already exists";
            $user=1;
        } else {
            // ✅ Safe to insert new user
            $sql = "INSERT INTO registration (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                //echo "Signup success";
                $success=1;
            } else {
                die("Insert error: " . mysqli_error($con));
            }
        }
    } else {
        die("Select error: " . mysqli_error($con));
    }
}
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Signup!</title>
  </head>
  <body>

  <?php 
  if($user){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> User already exist
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';
  };
  ?>
    <?php 
  if($success){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> User has been created successfully
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';
  };
  ?>

   <br>
 
    <div class="jumbotron" >
        <h1 class="text-center">Signup Page</h1>
         <div class="container mt-5" >
              
        <form action="sign.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="username">  
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    </div>
   
  </body>
</html>