<?php

// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include '../database_connect.php';

$email = $_POST['loginEmail'];
$pwd = $_POST['loginPassword'];

$sql = "SELECT * FROM customer WHERE email = $1 AND pwd = $2";
$result = pg_query_params($conn, $sql, array($email, $pwd));
if (!$result) {
    echo "Failed to query database";
    pg_close($conn);
    $state = "loginerror";
    header("Location: ../user.php?state=" . urlencode($state));
    exit;
}

$row = pg_fetch_assoc($result);
if (!$row) {
    echo "Incorrect email or password";
    pg_close($conn);
    $state = "loginerror";
    header("Location: ../user.php?state=" . urlencode($state));
    exit;
}

// Start a new session and store the customer ID
session_start();
$_SESSION['customerID'] = $row['customerid'];

pg_close($conn);

// If the login is successful, redirect to account.php
header("Location: ../account.php");
exit;
?>