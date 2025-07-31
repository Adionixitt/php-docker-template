<?php

$host = "mysql";
$port = "3306";

$db_name = "indieweb";
$db_login = "root";
$db_password = "12345678";

if(!$connection = mysqli_connect($host, $db_login, $db_password, $db_name, $port)){
    die("Failed to connect to the database.");
}