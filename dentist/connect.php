<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='regestration';



$con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);
if (!$con) {
    die(mysqli_error($con));
}
else{
    // echo "success";
}