<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "mystore";

$con = new mysqli($hostname, $username, $password, $dbname);
if($con->connect_errno)
{
    // print_r($con->connect_error);
    echo "Failed to connect!";
}
else
{
    // echo '---------------Successful Connection------------------' . '<br>';
}

?>