<?php

$name = 'Global Finance';
$email = $_POST['loginEmail'];
$pwd = $_POST['loginPassword'];

// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include './database_connect.php';

$email = $_POST['loginEmail'];
$pwd = $_POST['loginPassword'];

$sql = "SELECT * FROM staff WHERE email = $1 AND pwd = $2";
$result = pg_query_params($conn, $sql, array($email, $pwd));
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

$s_fname = $row['fname'];
$s_sname = $row['sname'];
$s_email = $row['email'];
$s_id = $row['staffid'];

// NOT USED YET!!!
// session_start();
// $_SESSION['staffID'] = $row['staffid'];

//create code: 
$code = '';
$length = 6;
for ($i = 0; $i < $length; $i++) {
    $code .= mt_rand(0, 9);
}

//email stuff if all from above is successful:
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);
//error reporting for debugging:
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp-relay.sendinblue.com";
$mail->SMTPSecure = PHPmailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = $_ENV['MAIL_API_USERNAME'];
$mail->Password = $_ENV['MAIL_API_KEY'];

$mail->setFrom("global.finance.mail@gmail.com", $name);
$mail->addAddress($email, $s_fname); //$email for admin is global.finance.mail.a1@gmail.com

$mail->Subject = "Verification Code";
$mail->Body = "Hello $s_fname $s_sname, <br> Your code is: <br> <h2><b>$code</b></h2>. <br>You have 5 minutes to use it before it times out.";


//get current time
$currentTime = time();

//set code in database
$sql2 = "UPDATE staff SET code = $1, codetime = $2 WHERE staffid = $3;";
$result2 = pg_query_params($conn, $sql2, array($code, $currentTime, $s_id));
if (!$result2) {
    echo "Failed to update code in db, please try again.";
    pg_close($conn);
    exit;
} else {
    $mail->send();
    //echo "email sent with code $code";
    //header('verify.php?id=' . $s_id);
    header('Location: staff/verifyForm.php?state=success');
    //set session variable to hold a boolean to tell the rest of the code if the user is actually in the verify process. This hold the staff id, for future use.
    session_start();
    $_SESSION['verify_active'] = $s_id;
}

// If the login is successful, redirect to account.php NOT IN USE WITH EMAIL LOGIC
// header("Location: ../account.php");

pg_close($conn);
//exit;

?>