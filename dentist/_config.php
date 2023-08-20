<?php
if (!defined('ABSPATH')) {
  exit("DIRECT ACCESS NOT ALLOWED");
}
// mysql connection
define('DB_HOST', 'localhost');  
define('DB_USER', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'dentist');


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  exit();
}