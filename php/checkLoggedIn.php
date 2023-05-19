<?php
    session_start();
    // check session global variable is set
    if (isset($_SESSION['customerID'])) {
        header('Location: ../account.php');
    }
    else {
        header('Location: ../user.php');
        session_destroy();
    }
?>