<?php
$success=0;
$user=0;


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include 'connect.php';
        $username=$_POST['username'];
        $password=$_POST['password'];
      

        $sql="select * from `regestration` where username='$username' and password='$password'";
        
        $result=mysqli_query($con,$sql);
        if($result){

            $num=mysqli_num_rows($result);
            if($num>0){
               // echo"user already exist";
               echo"login successful";
               session_start();
               $_SESSION['username']=$username;
               header("Location:aboutdoctors.html");
            }
        }
        else{
            echo"login failed";
           
    
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

    <title>login page</title>
  </head>
  <body>
   

 
    <div class="container mt-5">
        <h2 class="text-center">login page </h2>
    <form action="login1.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your username" name="username">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" placeholder="enter your password" name="password">
  </div>
 
  <button type="submit" class="btn btn-primary w-100">Login</button>
</form>
    </div>
</body>
</html>