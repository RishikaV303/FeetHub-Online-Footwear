<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feethub_db";
$connect = mysqli_connect($servername, $username, $password, $dbname);
if(mysqli_connect_error()){
    die('Error Occured'.mysqli_connect_errno());
}
?>