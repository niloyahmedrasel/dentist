<?php
session_start();
$error = "";
if( isset($_POST['username']) && isset($_POST['password']) ){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!($username == "admin" && $password=="admin123")){
        $error = "Username or password incorrect";
    }else if($username == "admin" && $password=="admin123"){
        $_SESSION["is_login"] = "success";
        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <style>
    /* CSS for the login page */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    
    .login-container {
      width: 300px;
      margin: 0 auto;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      margin-top: 100px;
    }
    
    h1 {
      color: #333;
    }
    
    .login-form {
      margin-top: 20px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }
    
    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 90%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    
    .form-group input[type="submit"] {
      width: 90%;
      padding: 8px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    .form-group input[type="submit"]:hover {
      background-color: #0056b3;
    }
    .alert.alert-danger {
        background: #f6bcbc;
        padding: 8px;
        border: 1px solid red;
        border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <?php
        if($error!=""){
            echo '<div class="alert alert-danger">'.$error.'</div>';
        }
    ?>    
    <form class="login-form" action="login.php" method="POST">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Login">
      </div>
    </form>
  </div>
</body>
</html>
