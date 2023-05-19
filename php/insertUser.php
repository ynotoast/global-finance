<?php

// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include '../database_connect.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pwd = $_POST['confPassword'];

$sql = "INSERT INTO customer (fname, sname, email, phone, pwd) VALUES ($1, $2, $3, $4, $5)";
$result = pg_query_params($conn, $sql, array($firstName, $lastName, $email, $phone, $pwd));
if (!$result) {
    echo "Failed to insert data into table";
    pg_close($conn);
    $state = "accounterror";
    header("Location: ../user.php?state=" . urlencode($state));
    exit;
}

pg_close($conn);

// If the insertion is successful, redirect to user.php with a success message
$state = "success";
header("Location: ../user.php?state=" . urlencode($state));

exit;
?>