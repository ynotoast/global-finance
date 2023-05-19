<?php
session_start();
//check session global variable is set
if (!isset($_SESSION['customerID'])) {
    header('Location: user.php?state=denied');
    session_destroy();
    exit;
}

// connect to db

// runs script that gets env variables from .env
// require_once 'bootstrap.php';
include './database_connect.php';

// get carid for db query
$customerid = $_SESSION['customerID'];
$carid = $_GET['id'];

// execute the SQL query with pg_query_params
$sql = "SELECT c.fname, c.sname, c.email, ca.cname, ca.price
    FROM customer c
    JOIN car ca ON c.customerid = $1 AND ca.carid = $2;";
$result = pg_query_params($conn, $sql, array($customerid, $carid));
if (!$result) {
    echo "Failed to query database";
    exit;
}

// check if a row was returned
$row = pg_fetch_assoc($result);
if (!$row) {
    echo "Car not found, please try again or contact us.";
    exit;
}

// retrieve values from query result
$carname = $row['cname'];
$carprice = $row['price'];
//$caravailable = $row['available'];
$userfname = $row['fname'];
$usersname = $row['sname'];
$useremail = $row['email'];

// close the database connection
pg_close($conn);
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Finance Application</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/vendor.css">
    <style type="text/css" media="screen">
    .s-settings {
        background-color: white;
        padding-top: calc(4.5 * var(--vspace-0_5));
        padding-bottom: calc(4.5 * var(--vspace-0_5));
        position: relative;
        color: #131516;
    }

    .s-settings .intro h1 {
        margin-top: 0;
        color: #131516;
    }

    .s-settings-dark {
        background-color: #131516;
        padding-top: calc(4.5 * var(--space));
        padding-bottom: calc(4.5 * var(--vspace-0_25));
        position: relative;
    }

    .s-settings-dark .intro h1 {
        margin-top: 0;
        color: white;

    }

    .lead-dark {
        font-weight: 300;
        font-size: var(--text-md);
        line-height: calc(1.125 * var(--space));
        color: white;
    }
    </style>


    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script defer src="js/fontawesome/all.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>

<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader"></div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header">
        <div class="row">

            <div class="s-header__logo">
                <a href="index.php">
                    <img src="images/logo.png" alt="Homepage">
                </a>
            </div>

            <nav class="s-header__nav">
                <ul>
                    <li class="current"><a class="smoothscroll" href="#settings">Finance Application</a></li>
                    <li><a class="smoothscroll" href="#summary">Summary</a></li>
                    <li><a class="smoothscroll" href="#upload">Upload Documents</a></li>
                    <li><a id="myAccount" href="account.php">Go To My Account</a></li>
                </ul>
            </nav>

            <a class="s-header__menu-toggle" href="#0" title="Menu">
                <span class="s-header__menu-icon"></span>
            </a>

        </div> <!-- end row -->
    </header> <!-- end s-header -->

    <!-- home
    ================================================== -->
    <section id="home" class="s-home" data-parallax="scroll" data-image-src="images/hero-bg.jpg"
        data-natural-width="3000" data-natural-height="2000">
    </section> <!-- end s-home -->


    <section id="settings" class="s-settings-dark">

        <div class="row">

            <div class="column large-12 intro">

                <h1>New Finance Application for the
                    <?php echo $carname ?>
                </h1>

            </div>

        </div> <!-- end row -->
    </section>

    <section id="summary" class="s-settings">

        <div class="row">

            <div class="column large-12 intro">

                <h2 style="color: #131516;">Summary</h2>

                <div class="table-responsive">

                    <table>
                        <thead>
                            <tr>
                                <th>Car Name</th>
                                <th>Price</th>
                                <th>Your Name</th>
                                <th>Your Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $carname ?>
                                </td>
                                <td>
                                    <?php echo $carprice; ?>
                                </td>
                                <td>
                                    <?php echo $userfname; ?>
                                    <?php echo $usersname; ?>
                                </td>
                                <td>
                                    <?php echo $useremail; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <hr class="fancy">
            </div>

        </div> <!-- end row -->
    </section>

    <section id="upload" class="s-settings">

        <div class="row">

            <div class="column large-12 intro">

                <h1 style="color: #131516;">Upload Documents & Confirm</h1>

                <p class="lead">You must upload a picture of a valid UK drivers licence or passport to submit a finance
                    request. This will be manually reviewed by our team. Please make sure the photo is in good light and
                    is clearly visible. If your application is declined you will have an opportunity to try again.</p>
                <p>Here is an example of a good picture of ID:</p>
                <figure>
                    <img src="images/exampleIDs/EXAMPLE.jpeg" srcset="images/exampleIDs/EXAMPLE.jpeg 1000w, 
                    images/exampleIDs/EXAMPLE.jpeg 500w" sizes="(max-width: 1500px) 150vw, 1500px" alt="">
                </figure>
                <h4>Please upload your ID document here:</h4>
                <form
                    action="php/uploadNoDoc.php?id=<?php echo $carid ?>&price=<?php echo str_replace(array("£", ",", ".00"), "", $carprice) ?>"
                    method="post" enctype="multipart/form-data">
                    <input type="file" name="file"><br>
                    <button class="btn--primary" type="submit" name="submit"> CONFIRM & CREATE FINANCE APPLICATION
                        REQUEST </button>
                </form>
                <hr class="fancy">
            </div>
    </section>

    <!-- contact
    ================================================== -->
    <section id="contact" class="s-contact target-section s-dark">

        <div class="row section-head">
            <div class="column large-3 medium-12">
                <h2>Contact Us</h2>
                <p class="desc">Get in touch with us.</p>
            </div>
        </div> <!-- end section-head -->

        <div class="row s-contact__content">

            <div class="column large-7 medium-12">
                <h3 class="display-1">
                    Our customer support team are ready 24/7 to help you with anything you are
                    having trouble with!
                </h3>
            </div>

            <div class="column large-4 medium-12 s-contact__info-blocks">
                <div class="row">
                    <div class="column large-12 medium-6 tab-12">
                        <div class="s-contact__info-block">

                            <span class="s-contact__info-block-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                    <path
                                        d="M12 14c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z" />
                                    <path
                                        d="M11.42 21.814a.998.998 0 001.16 0C12.884 21.599 20.029 16.44 20 10c0-4.411-3.589-8-8-8S4 5.589 4 9.995c-.029 6.445 7.116 11.604 7.42 11.819zM12 4c3.309 0 6 2.691 6 6.005.021 4.438-4.388 8.423-6 9.73-1.611-1.308-6.021-5.294-6-9.735 0-3.309 2.691-6 6-6z" />
                                </svg>
                            </span>

                            <h5>Find us here</h5>
                            <p>
                                Global Finance HQ <br>
                                Coventry <br>
                                CV4 7AL, UK
                            </p>
                        </div> <!-- end s-contact__info-block -->
                    </div>

                    <div class="column large-12 medium-6 tab-12">
                        <div class="s-contact__info-block">
                            <span class="s-contact__info-block-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                    <path
                                        d="M17.707 12.293a.999.999 0 00-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 000-1.414l-4-4a.999.999 0 00-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 000-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 00-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 00.912-.271L17 14.414 19.586 17l-2.006 2.005z" />
                                </svg>
                            </span>

                            <h5>Say hello</h5>
                            <p>
                                hello@globalfinance.com <br>
                                +44 7027 854172
                            </p>
                        </div> <!-- end s-contact__info-block -->
                    </div>
                </div> <!-- end row -->
            </div> <!-- end s-contact__info-blocks -->

        </div> <!-- end s-contact__content -->

    </section> <!-- end s-contact -->


    <!-- footer
    ================================================== -->
    <footer class="s-footer">
        <div class="row">

            <div class="column large-7 medium-6 w-1000-stack ss-copyright">
                <span>Design by <a href="https://www.styleshout.com/">StyleShout</a></span>
            </div>
        </div>

        <div class="ss-go-top">
            <a class="smoothscroll" title="Back to Top" href="#top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M6 4h12v2H6zm5 10v6h2v-6h5l-6-6-6 6z" />
                </svg>
            </a>
        </div> <!-- end ss-go-top -->
    </footer>


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <script>
    function confirmLogout() {
        var confirmed = confirm("Are you sure you want to logout?");
        if (confirmed) {
            window.location.href = "php/logout.php";
        }
    }
    </script>

</body>

</html>