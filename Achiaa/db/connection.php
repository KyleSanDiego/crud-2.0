<?php 
//establish a connection to database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "chiaa";

//combine all variables to connect the database
$conn = new mysqli($host, $user, $pass, $dbname);

//check if connection is failed
if($conn->connect_error)
{
    die("we ded: ". $conn->connect_error);
}

?>