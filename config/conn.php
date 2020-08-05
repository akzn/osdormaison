<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
define('BASE', 'http://localhost/osdormaison/');

require "mysql_mysqli.inc.php";

$servername = "localhost";
$username = "root";
$password = "";
$db = "osdormaison";

// Create connection
$conn = mysql_connect($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else mysql_select_db($db);
?>