<?php
session_start();
define('ABSPATH', true);
require_once('_config.php');

if(!(isset($_SESSION['is_login']) && $_SESSION['is_login'] == 'success')){
    header('location: login.php');
}

$sql = "SELECT * FROM appointment_request";



$result = $mysqli -> query($sql);

$appoints = [];

if($result)
{
    while($row = $result -> fetch_assoc())
    {
        array_push($appoints, $row);
    }
}
else
{
    echo "Something went wrong!<BR>";
    echo "Error Description: ", $mysqli -> error;
}
$result -> free_result();
$mysqli -> close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Appointment Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* CSS for the dashboard */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    
    .dashboard {
      width: 90%;
      margin: 0 auto;
      margin-top:50px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      border-radius: 10px;
    }
    
    h1 {
      color: #333;
      text-align: center;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #f2f2f2;
      color: #333;
      font-weight: normal;
    }
    
    .approve-btn {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
    }
    
    .approve-btn:hover {
      background-color: #0056b3;
    }

    button.approve-btn.approve-done {
        background-color: lightgreen;
        color: black;
        cursor: default;
    }

    /* Media Query for screens less than 992px */
    @media (max-width: 991px) {
      table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }
      
      th, td {
        display: block;
      }
      
      th {
        text-align: left;
      }
      
      td:before {
        content: attr(data-label);
        font-weight: bold;
        display: block;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <h1>Appointment Dashboard</h1>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Date</th>
        <th>Address</th>
        <th>Email</th>
        <th>Old Customer</th>
        <th>Doctor</th>
        <th>Appointment Type</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php foreach ($appoints as $appointment): ?>
  <tr>
    <td><?php echo $appointment['id']; ?></td>
    <td><?php echo $appointment['name']; ?></td>
    <td><?php echo $appointment['gender']; ?></td>
    <td><?php echo $appointment['phone']; ?></td>
    <td><?php echo $appointment['dob']; ?></td>
    <td><?php echo $appointment['address']; ?></td>
    <td><?php echo $appointment['email']; ?></td>
    <td><?php echo $appointment['previous_attendance']; ?></td>
    <td><?php echo $appointment['doctor_select']; ?></td> <!-- Display the selected doctor's name -->
    <td><?php echo $appointment['appointment_type']; ?></td>
    <td><?php echo $appointment['status']; ?></td>
    <td>
      <?php
        if ($appointment['status'] != "Approved") {
          $id = $appointment['id'];
          $formStart = <<<DATA
          <form action="process-approve.php" method="POST">
            <input type="hidden" name="appointment_id" value="$id">
            <input type="hidden" name="action" value="approve">
          DATA;
          echo $formStart;
        }
      ?>
      <button class="approve-btn <?php
        if ($appointment['status'] == "Approved") echo "approve-done";
      ?>">Approve<?php
        if ($appointment['status'] == "Approved") echo "d";
      ?></button>
      <?php
        if ($appointment['status'] != "Approved") echo "</form>";
      ?>
    </td>
  </tr>
<?php endforeach; ?>

</table>
  </div>
</body>
</html>
