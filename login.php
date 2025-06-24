<?php
session_start(); // Start session to store user login status

include 'connect.php'; // Your DB connection file

// Initialize flags
$login = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        // Fetch user data from database
        $sql = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $login = true;
            $_SESSION['username'] = $username;
            header('Location: welcome.php'); // Redirect to a protected page
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Login</h2>
    <form action="login.php" method="POST">
      <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
      <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-primary">Log In</button>
    </form>
  </div>
</body>
</html>
