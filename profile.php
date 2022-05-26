<?php
require_once('./bootstrap.php');
include_once(__DIR__ . "./includes/nav.inc.php");
session_start();

$username = $_GET["username"];

$profiel = new Profile();
$profiel->setUsername($username);
$result = $profiel->getInfo();

if(empty($result["username"])){
    header("Location: index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>createMore profiel</title>
    <link rel="stylesheet" href="CSS/profiel.css">
    <link rel="stylesheet" href="./CSS/style.css">    
</head>
<body>
    <img class="profielFoto" src="<?php echo htmlspecialchars($result["profilepic"]); ?>" alt=""><br><br>

    <b>Gebruikersnaam</b>
    <p><?php echo htmlspecialchars($result['username']); ?></p><br><br>
    
    <b>Hoofde-mailadres</b>
    <p><?php echo htmlspecialchars($result['email']); ?></p><br><br>
    
    <b>Tweede e-mailadres</b>
    <p><?php echo htmlspecialchars($result['tweedeEmail']); ?></p><br><br>
    
    <b>Bio</b>
    <p><?php echo htmlspecialchars($result['bio']); ?></p><br><br>

    <b>Opleiding</b>
    <p><?php echo htmlspecialchars($result['opleiding']); ?></p><br><br>

    <b>Facebook</b>
    <br>
    <a href="<?php echo htmlspecialchars($result['facebook']); ?>"><?php echo htmlspecialchars($result['facebook']); ?></a><br><br>
    
    <b>Instagram</b>
    <br>
    <a href="<?php echo htmlspecialchars($result['instagram']); ?>"><?php echo htmlspecialchars($result['facebook']); ?></a><br><br>
</body>
</html>