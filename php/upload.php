<?php
session_start();
// check session global variable is set
if (!isset($_SESSION['customerID'])) {
    header('Location: ../user.php?state=denied');
    session_destroy();
    exit;
}


// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include '../database_connect.php';

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../uploads/' . $fileNameNew;

                // Insert a new row in the application table and get the ID of the new row
                $customerID = $_SESSION['customerID'];
                $carID = $_GET['id'];
                $status = 'pending';
                $creationDate = date('Y-m-d');
                $value = intval($_GET['price']);

                $result = pg_query_params($conn, 'INSERT INTO application (carid, astatus, creationDate, avalue, customerid) VALUES ($1, $2, $3, $4, $5) RETURNING applicationid', array($carID, $status, $creationDate, $value, $customerID));

                if (!$result) {
                    echo "Error creating new application: " . pg_last_error($conn);
                    exit;
                }

                // Get the ID of the new application row
                $applicationID = pg_fetch_result($result, 0, 0);

                // Insert a new row in the document table
                $type = 'image';
                $location = $fileNameNew;

                $result = pg_query_params($conn, 'INSERT INTO document (customerid, applicationid, dtype, dlocation) VALUES ($1, $2, $3, $4)', array($customerID, $applicationID, $type, $location));

                if (!$result) {
                    echo "Error creating new document: " . pg_last_error($conn);
                    exit;
                }

                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: ../account.php?=state=success");
                exit;

            } else {
                echo "File too large (must be less then 1MB)";
            }
        } else {
            echo "There was an error!";
        }
    } else {
        echo "You cannot upload this type of file!";
    }
}
?>