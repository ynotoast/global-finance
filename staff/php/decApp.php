<?php
session_start();
// check session global variable is set
if (!isset($_SESSION['staffID'])) {
    header('Location: ../login.php?state=denied');
    session_destroy();
    exit;
}
if (!isset($_GET['appid'])) {
    echo 'NO APP ID';
    session_destroy();
    exit;
}


// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include '../../database_connect.php';

$staff_ID = $_SESSION['staffID'];
$decisionDate = date('Y-m-d');
$a_id = $_GET['appid'];

$sql = "UPDATE application SET staff_approval_id = $1, astatus = 'declined', decisiondate = $2 WHERE applicationid = $3;";
$result = pg_query_params($conn, $sql, array($staff_ID, $decisionDate, $a_id));
if (!$result) {
    echo "Failed to decline application";
    pg_close($conn);
    exit;
}

pg_close($conn);

// $state = "success";
header("Location: ../index.php?state=");

exit;

?>