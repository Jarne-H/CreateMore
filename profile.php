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

// Als gebruiker al volgt, toon "Unfollow"
// Als gebruiker nog niet volgt, toon "Follow"
$follower = $_SESSION["username"];


$thisUser = new User();
$thisUser->setUsername($follower);

if($thisUser->doesFollow($username)){
    // Gebruikter volgt al
    $followText = "Unfollow";
}else{
    $followText = "Follow";
}


$profileUser = new User();
$profileUser->setUsername($username);
$followCount = $profileUser->getFollowCount();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>createMore profiel</title>
    <link rel="stylesheet" href="CSS/profiel.css">
    <link rel="stylesheet" href="CSS/style.css">  
</head>
<body>
    <img class="profielFoto" src="<?php echo htmlspecialchars($result["profilepic"]); ?>" alt=""><br><br>

    <input id="username" type="hidden" value="<?php echo htmlspecialchars($result["username"]); ?>"/>

    <?php if($username != $_SESSION["username"]){ ?>
        <button title="Report user as inapproriate" onclick="report()">🚩</button>
        <button onclick="follow()" id="follow"><?php echo $followText; ?></button>
    <?php } ?>

    <br><br>
    <b>Volgers</b>
    <p id="followCount"><?php echo htmlspecialchars($followCount); ?></p><br><br>

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
    <script src="js/profile.js"></script>
</body>
</html>