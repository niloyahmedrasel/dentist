<nav>
  <ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="index.html">About</a></li>
    <li><a href="index.html">Services</a></li>
    <li><a href="index.html">Team</a></li>
    <li><a href="index.html">Gallary</a></li>
  </ul>
</nav>

<?php
define('ABSPATH', true);
require_once('_config.php');

session_start();
if(!isset($_SESSION['username'])){
  die("NOT LOGGED IN");
}

// user is logged in
$username = $_SESSION['username'];
$email = "NOT FOUND";

$appointment_list = [];

$sql = "SELECT * FROM appointment_request where username=? order by id desc";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Loop through the rows and save each row as an element in the $appointment_list array
  while ($row = $result->fetch_assoc()) {
      $appointment_list[] = $row;
  }
}

// Close the statement and free up resources
$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
  <title>User Profile Page</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f3f3f3;
      background-image: linear-gradient(45deg, #ffffff, #f3f3f3);
    }
    .navbar {
      background-color: #3498db;
      text-align: center;
      padding: 10px 0;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .navbar h1 {
      color: #fff;
      margin: 0;
    }
    .user-card {
      width: 400px;
      margin: 20px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      background-image: linear-gradient(135deg, #ffffff, #e0e0e0);
    }
    .user-card h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #3498db;
    }
    .user-info {
      text-align: left;
    }
    .user-info p {
      margin: 10px 0;
    }
    .empty-appointment {
      text-align: center;
      color: #888;
    }
    nav{
      display: flex;
      justify-content: center;

    }
    nav ul li{
      display: inline-block;
      list-style-type: none;
    }
    nav ul li a{
      padding: 10px;
      text-decoration: none;
      color:blue;
    }
    nav ul li a:hover{
      transition: .5s;
      color: #fc5185;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h1>User Profile</h1>
  </div>
  <div class="user-card">
    <h2>User Information</h2>
    <div class="user-info">
      <!-- Add user information here -->
      <p>Username: <?php echo $_SESSION['username'];?></p>
      <?php if(empty($appointment_list)): ?>
        <h3>You don't have any appointment</h3>
      <?php else: ?>
        <p>Patient Name: <?php echo $appointment_list[0]['name']; ?></p>
        <p>Email: <?php echo $appointment_list[0]['email']; ?></p>
        <p>Gender: <?php echo $appointment_list[0]['gender']; ?></p>
        <p>Phone: <?php echo $appointment_list[0]['phone']; ?></p>
        <p>Appointment Date: <?php echo $appointment_list[0]['dob']; ?></p>
        <p>Address: <?php echo $appointment_list[0]['address']; ?></p>
        <p>Previously Attended: <?php echo $appointment_list[0]['previous_attendance']; ?></p>
        <p>Service Type: <?php echo $appointment_list[0]['appointment_type']; ?></p>
        <p>Status: <?php echo $appointment_list[0]['status']; ?></p>
        <p>Requested Doctor: <?php echo $appointment_list[0]['doctor_select']; ?></p>
      <?php endif; ?>
      
    </div>
  </div>
</body>
</html>
