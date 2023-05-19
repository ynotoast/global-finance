<?php
// Connect to the database
// $host = 'localhost';
// $port = '5432';
// $dbname = 'gfdb';
// $user = $_ENV['DB_USERNAME'];
// $password = $_ENV['DB_PWD'];


// $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
// if (!$conn) {
//     echo "Failed to connect to database, Please return to the previous page.";
//     exit;
// }

//require_once './bootstrap.php';
// Connect to the RAILWAY database
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PWD'];


$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    echo "Failed to connect to database, Please return to the previous page.";
    exit;
}
?>
