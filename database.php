<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "user_registration";
$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

if (!$conn) { 
    die("Connection not successful");
}
