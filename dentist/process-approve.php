<?php
define('ABSPATH', true);
require_once('_config.php');

if (isset($_POST['appointment_id']) && isset($_POST['action']) && $_POST['action'] == 'approve') {
    $sql = "UPDATE appointment_request set status = ? where id = ?";
    $stmt = $mysqli->prepare($sql);
    $status = 'Approved';
    $stmt->bind_param('ss', $status, $_POST['appointment_id']);
    $result = $stmt->execute();

}

header("Location: dashboard.php");
exit();