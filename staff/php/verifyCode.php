<?php
// check session global variable is set
session_start();
if (!isset($_SESSION['verify_active'])) {
    header('Location: ../login.php?state=denied');
    session_destroy();
    exit;
}

// Connect to the database

// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include '../../database_connect.php';

//get staff id from url
$s_id = $_SESSION['verify_active'];
//get user inputted code from post
$user_code = $_POST['code'];


$sql = "SELECT code, codetime FROM staff WHERE staffid = $1;";
$result = pg_query_params($conn, $sql, array($s_id));
if (!$result) {
    header('Location: staff/login.php?state=loginerror');
    session_destroy();
    pg_close($conn);
    exit;
}

$row = pg_fetch_assoc($result);
if (!$row) {
    header('Location: staff/login.php?state=incorrect');
    session_destroy();
    pg_close($conn);
    exit;
}

//get REAL code from database
$s_code = $row['code'];

//get code time from database
$s_codetime = $row['codetime'];
//get current time
$currentTime = time();
//get difference between the two times
$timeDiff = $currentTime - $s_codetime;

if ($user_code != $s_code) {
    //code is incorrect
    header('Location: ../verifyForm.php?state=incorrectcode');
} else {
    if ($timeDiff > 300) {
        //timed out
        session_destroy();
        header('Location: ../login.php?state=timeout');
        $sql2 = "UPDATE staff SET code = $1, codetime = $2 WHERE staffid = $3;";
        $result2 = pg_query_params($conn, $sql2, array(NULL, NULL, $_SESSION['verify_active']));
    } else {
        //code is correct
        $sql3 = "UPDATE staff SET code = $1, codetime = $2 WHERE staffid = $3;";
        $result3 = pg_query_params($conn, $sql3, array(NULL, NULL, $_SESSION['verify_active']));
        if (!$result3) {
            echo "Failed to update db please try again";
            pg_close($conn);
            exit;
        }

        $_SESSION['staffID'] = $_SESSION['verify_active'];
        unset($_SESSION['verify_active']);

        header('Location: ../index.php');
    }
}
pg_close($conn);

?>