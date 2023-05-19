<?php
if (isset($_GET['state'])) {
  $state = $_GET['state'];
  if ($state == "logout") {
    $html_message = '<p style="color:green; font-size: 20px;"> Successfully logged out. </p>';
  } elseif ($state == "loginerror") {
    $html_message = '<p style="color:red; font-size: 20px;"> Database error, please try again. </p>';
  } elseif ($state == "denied") {
    $html_message = '<p style="color:red; font-size: 20px;"> You must be logged in to access this page. </p>';
  } elseif ($state == "incorrect") {
    $html_message = '<p style="color:red; font-size: 20px;"> Incorrect email or password </p>';
  } elseif ($state == "timeout") {
    $html_message = '<p style="color:red; font-size: 20px;"> Code timed out, please try again. </p>';
  }
} else {
  $html_message = '';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #222;
            font-family: Arial, sans-serif;
        }

        form {
            border: 2px solid #ddd;
            background-color: #333;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(255, 255, 255, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        p {
            color: white;
        }
        a {
            color: lightblue;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
            background-color: #444;
            font-size: 16px;
            color: #fff;
        }

        input[type="submit"] {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0062cc;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .logo img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <form action="../sendEmail.php" method="POST">
        <div class="logo">
            <a href="../index.php"><img src="../images/logo.png" alt="Logo"></a>
        </div>
        <h1>Staff Login</h1>
        <p>In the wrong place? <a href="../index.php">Click here</a> to go to the main site.</p> 

        <label for="email">Email:</label>
        <input type="text" id="email" name="loginEmail" placeholder="email">
        <label for="password">Password:</label>
        <input type="password" id="password" name="loginPassword" placeholder="password">
        <input type="submit" value="Login">
        <h5><?php echo $html_message;?></h5>
    </form>
</body>

</html>