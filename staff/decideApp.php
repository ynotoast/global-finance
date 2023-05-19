<?php
session_start();
// check session global variable is set
if (!isset($_SESSION['staffID'])) {
    header('Location: login.php?state=denied');
    session_destroy();
    exit;
}
if (!isset($_GET['appid'])) {
    echo 'NO APP ID';
    session_destroy();
    exit;
}
// connect to db

// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include '../database_connect.php';

// get staff id from session superglobal variable and application id from URL 
$staff_ID = $_SESSION['staffID'];
$application_ID = $_GET['appid'];


//sql for staff first and last name
$sql1 = "SELECT fname, sname FROM staff WHERE staffid = $1";

$result1 = pg_query_params($conn, $sql1, array($staff_ID));
if (!$result1) {
    echo "Failed to query database";
    exit;
}

$row1 = pg_fetch_assoc($result1);
if (!$row1) {
    header('login.php?state=denied');
    exit;
}

$staff_fname = $row1['fname'];
$staff_sname = $row1['sname'];


//sql to select application info 
$sql2 = "SELECT applicationid, carid, creationdate, avalue, astatus, customerid FROM application WHERE applicationid = $1;";

$result2 = pg_query_params($conn, $sql2, array($application_ID));
if (!$result2) {
    echo "Failed to query database";
    exit;
}

$row2 = pg_fetch_assoc($result2);
if (!$row2) {
    header('login.php?state=denied');
    session_destroy();
    exit;
}

//get application id
$a_id = $row2['applicationid'];
$a_creationdate = $row2['creationdate'];
$a_value = $row2['avalue'];
$a_status = $row2['astatus'];
// get customer id
$a_customerid = $row2['customerid'];
//get car id
$a_carid = $row2['carid'];

//sql for customer first and last name
$sql3 = "SELECT fname, sname FROM customer WHERE customerid = $1";

$result3 = pg_query_params($conn, $sql3, array($a_customerid));
if (!$result3) {
    echo "Failed to query database";
    exit;
}

$row3 = pg_fetch_assoc($result3);
if (!$row3) {
    echo 'no custid found';
    session_destroy();
    exit;
}

$c_fname = $row3['fname'];
$c_sname = $row3['sname'];

//sql for car name
$sql4 = "SELECT cname FROM car WHERE carid = $1;";

$result4 = pg_query_params($conn, $sql4, array($a_carid));
if (!$result4) {
    echo "Failed to query database";
    exit;
}

$row4 = pg_fetch_assoc($result4);
if (!$row4) {
    echo 'no carid found';
    session_destroy();
    exit;
}

$car_name = $row4['cname'];

//sql for document location
$sql5 = "SELECT dlocation FROM document WHERE applicationid = $1;";

$result5 = pg_query_params($conn, $sql5, array($a_id));
if (!$result5) {
    echo "Failed to query database";
    exit;
}

$row5 = pg_fetch_assoc($result5);
if (!$row5) {
    echo 'no application id found';
    session_destroy();
    exit;
}

$d_location = $row5['dlocation'];

pg_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="css/vendor.css">
    <style>
    /* Style for the content */
    .content {
        padding: 20px;
    }

    .info {
        display: block;
        padding: 0px;
        color: darkorange;
        text-decoration: none;
    }

    body {
        background-color: white
    }

    .content h1,
    h2 {
        color: black;
    }

    #buttonApp {
        background-color: var(--color-success);
    }

    #buttonApp:hover {
        background-color: greenyellow;
        color: black;
    }

    #buttonDec {
        background-color: var(--color-error);
    }

    #buttonDec:hover {
        background-color: red;
    }
    </style>
</head>

<body>
    <div class="content" class="settings">
        <p class="info">You are logged in as:
            <?php echo $staff_fname . ' ';
            echo $staff_sname; ?>
        </p>

        <!-- Customer Finance Applications page content -->
        <div id="cust-fin-apps" ;>
            <h2>Review Application:</h2>

            <div class="table-responsive">

                <table>
                    <thead>
                        <tr>
                            <th>Application ID</th>
                            <th>Car Name</th>
                            <th>Status</th>
                            <th>Creation Date</th>
                            <th>Value</th>
                            <th>Customer Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $a_id; ?>
                            </td>
                            <td>
                                <?php echo $car_name ?>
                            </td>
                            <td>
                                <?php echo $a_status ?>
                            </td>
                            <td>
                                <?php echo $a_creationdate ?>
                            </td>
                            <td>
                                <?php echo $a_value ?>
                            </td>
                            <td>
                                <?php echo $c_fname . ' ';
                                echo $c_sname ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="column">
                    <h5>ID PHOTO:</h5>
                    <img src="../uploads/<?php echo $d_location ?>" srcset="../uploads/<?php echo $d_location ?> 1000w, 
                    ../uploads/<?php echo $d_location ?>g 500w" sizes="(max-width: 1000px) 100vw, 1000px" alt="">
                    <br>
                </div>
                <div class="column">
                    <button id="buttonApp" onclick="confirmApp()">APPROVE</button>
                    <button id="buttonDec" onclick="confirmDec()">DECLINE</button>
                </div>
            </div>
        </div>


    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script>
    function confirmApp() {
        var confirmed = confirm("Are you sure you want to APPROVE this application?");
        if (confirmed) {
            window.location.href = "php/appApp.php?appid=<?php echo $a_id ?>";
        }
    }

    function confirmDec() {
        var confirmed2 = confirm("Are you sure you want to DECLINE this application?");
        if (confirmed2) {
            window.location.href = "php/decApp.php?appid=<?php echo $a_id ?>";
        }
    }
    </script>

</body>

</html>