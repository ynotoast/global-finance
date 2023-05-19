<?php
session_start();
// check session global variable is set
if (!isset($_SESSION['staffID'])) {
    header('Location: /staff/login.php?state=denied');
    session_destroy();
    exit;
}

// connect to db

// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include '../database_connect.php';

// get carid for db query
$staff_ID = $_SESSION['staffID'];

$sql1 = "SELECT fname, sname FROM staff WHERE staffid = $1";

$result1 = pg_query_params($conn, $sql1, array($staff_ID));
if (!$result1) {
    echo "Failed to query database";
    exit;
}

$row1 = pg_fetch_assoc($result1);
if (!$row1) {
    echo "Car not found, please try again or contact us.";
    exit;
}

$staff_fname = $row1['fname'];
$staff_sname = $row1['sname'];


// Get User Info from db
$sql2 = "SELECT car.cname, application.applicationid, application.avalue, application.staff_approval_id, application.astatus, application.creationdate, application.decisiondate, document.documentid, document.dlocation, customer.fname, customer.sname, customer.email, customer.phone
FROM application
INNER JOIN car ON application.carid = car.carid
INNER JOIN document ON application.applicationid = document.applicationid
INNER JOIN customer ON application.customerid = customer.customerid 
WHERE 1=1";
$result2 = pg_query_params($conn, $sql2, array());
if (!$result2) {
    echo "Failed to query database";
    exit;
}

// Retrieve all finance applications for the current user
$rows = pg_fetch_all($result2);

pg_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="css/vendor.css">
    <style>
    /* Style for the sidebar */
    .sidebar {
        width: 20%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #f1f1f1;
        overflow-x: hidden;
        padding-top: 20px;
        display: block;
        transition: transform 0.3s ease-in-out;
        transform: translateX(0);
    }

    .sidebar.hidden {
        transform: translateX(-100%);
    }

    /* Style for the links in the sidebar */
    .sidebar a {
        display: block;
        padding: 16px;
        color: black;
        text-decoration: none;
    }

    /* Style for the content */
    .content {
        margin-left: 20%;
        padding: 20px;
    }

    .sidebar a.bottom {
        color: red;
        position: absolute;
        bottom: 25px;
    }

    .info {
        display: block;
        padding: 16px;
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
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="#" class="active">Customer Finance Applications</a>
        <a href="#">Inventory</a>
        <a style="color:blue;" href="../index.php">Link To Global Finance Main Page</a>
        <a style="cursor:pointer;" class="bottom" onclick="confirmLogout()">Logout</a>
        <p class="info">You are logged in as:<br><br>
            <?php echo $staff_fname . ' ' . $staff_sname ?>
        </p>
    </div>

    <div class="content settings">

        <!-- cars sold page content NOT IN USE-->
        <div id="cars-sold" style="display: none;">
            <h2>Cars Sold</h2>
            <p>cars sold info to go here</p>
        </div>

        <!-- Customer Finance Applications page content -->
        <div id="cust-fin-apps" style="display: none;">
            <h2>Customer Finance Applications</h2>

            <div class="table-responsive">

                <table>
                    <thead>
                        <tr>
                            <th>Application ID</th>
                            <th>Car Name</th>
                            <th>Aproved By ID</th>
                            <th>Status</th>
                            <th>Creation Date</th>
                            <th>Decision Date</th>
                            <th>Value</th>
                            <th>Customer Name</th>
                            <th>Document Link</th>
                            <th>Decide Application</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                        <tr>
                            <td>
                                <?= $row['applicationid'] ?>
                            </td>
                            <td>
                                <?= $row['cname'] ?>
                            </td>
                            <td>
                                <?= $row['staff_approval_id'] ?>
                            </td>
                            <td>
                                <?= $row['astatus'] ?>
                            </td>
                            <td>
                                <?= $row['creationdate'] ?>
                            </td>
                            <td>
                                <?= $row['decisiondate'] ?>
                            </td>
                            <td>
                                <?= $row['avalue'] ?>
                            </td>
                            <td>
                                <?= $row['fname'] . ' ' . $row['sname'] ?>
                            </td>
                            <td>
                                <a href="../uploads/<?= $row['dlocation'] ?>" target="_blank">Doc Link</a>
                            </td>
                            <td>
                                <a href="decideApp.php?appid=<?= $row['applicationid'] ?>" target="_self">Decide
                                    Link</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>

        <!-- Inventory page content -->
        <div id="inventory" style="display: block;">
            <h2>Inventory</h2>
            <p>We currently have these cars on the front page:</p>
            <div id="output"></div>
        </div>

        <!-- Customer Documents page content NOT IN USE-->
        <div id="cust-docs" style="display: none;">
            <h2>Customer Documents</h2>
            <p>Customer Documents to go here</p>
        </div>

    </div>


    <script src="js/staff.js"></script>
    <script src="js/get-cars.js"></script>
</body>

</html>