<?php

include_once(__DIR__ . "./includes/nav.inc.php");

session_start();
$username = $_SESSION["username"];
var_dump($username);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
    <a href="logIn.php">Login</a>
    <a href="signUp.php">signUp</a>
    <a href="deleteProfile.php">deleteProfile</a>
    <a href="forgotPassword.php">forgotPassword</a>
    <a href="requestCode.php">requestCode</a>
    <a href="profilePage.php">profilePage</a>
    
    <h1 class="titel">Er zijn nog geen projecten gedeeld</h1>
    <p class="subtitel">Start met je eerste project te delen aan andere.</p>
    
    <div class="buttonCenter">
        <input type="submit" value="Deel project" id="btn">
    </div>

</body>

</html>
