<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("bootstrap.php");
session_start();
include_once(__DIR__ . "/classes/User.php");
var_dump($_SESSION);
$username = $_SESSION["username"];
User::deleteProfile($username);
header("Location: ./signUp.php");

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Profile</title>
</head>
<body>
    
<form method="post">
<?php
?>
</form>
</body>
</html>