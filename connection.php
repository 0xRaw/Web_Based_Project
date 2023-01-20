<?php
$host = "localhost";
$port = "3302";
$user = "root";
$password = "";
$dbname = "ebooks";

$conn = new mysqli($host, $user, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "welcome we are connected successfully";
};

?>