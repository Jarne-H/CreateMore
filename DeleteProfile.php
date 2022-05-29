<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("bootstrap.php");
// var_dump($_SESSION);
$username = $_SESSION["username"];
User::deleteProfile($username);
// header("Location: signup.php");
?><script> location.replace("signup.php"); </script><?php

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Profile</title>
</head>
<body>
    

</body>
</html>