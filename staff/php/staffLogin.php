<?php
// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include '../../database_connect.php';

$email = $_POST['loginEmail'];
$pwd = $_POST['loginPassword'];

$sql = "SELECT * FROM staff WHERE email = $1 AND pwd = $2";
$result = pg_query_params($conn, $sql, array($email, $pwd));
if (!$result) {
    header('Location: ../staff/login.php?state=loginerror');
    session_destroy();
    pg_close($conn);
    exit;
}

$row = pg_fetch_assoc($result);
if (!$row) {
    header('Location: ../login.php?state=incorrect');
    session_destroy();
    pg_close($conn);
    exit;
}

// Start a new session and store the customer ID
session_start();
$_SESSION['staffID'] = $row['staffid'];

pg_close($conn);

// If the login is successful, redirect to account.php
header("Location: ../index.php");
exit;
?>