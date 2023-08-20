<?php
$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $checkUserQuery = "SELECT * FROM `regestration` WHERE username='$username'";
    $checkUserResult = mysqli_query($con, $checkUserQuery);

    if ($checkUserResult) {
        $num = mysqli_num_rows($checkUserResult);
        if ($num > 0) {
            $user = 1;
        } else {
            // Insert the new user data
            $insertUserQuery = "INSERT INTO `regestration` (username, password) VALUES ('$username', '$password')";
            $insertUserResult = mysqli_query($con, $insertUserQuery);

            if ($insertUserResult) {
                $success = 1;
            } else {
                die(mysqli_error($con));
            }
        }
    } else {
        die(mysqli_error($con));
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>signup page</title>
  </head>
  <body>
    <?php
    if ($user) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oh no! </strong> User already exists.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    ?>

    <?php
    if ($success) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> You have successfully signed up.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    ?>

    <div class="container mt-5">
        <h2 class="text-center">Sign up page</h2>
        <form action="signup.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your username" name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign up</button>
            
        </form>
        <a href="login1.php" class="btn btn-primary w-100 mt-3">Login</a>
    </div>
</body>
</html>
