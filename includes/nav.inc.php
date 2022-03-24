<?php
    session_start();
    $username = $_SESSION['username'];


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <h1 class="logo">CreateMore</h1>
        <a href=""><h3 class="navLink">Alle projecten</h3></a>
        <a href=""><h3 class="navLink">Mijn projecten</h3></a>

        <input class="search" type="text" placeholder="Zoeken..">
        
        <p class="welkom">Welkom, <?php echo $username; ?></p>
        <div class="imageCropper">
            <a href="profile.php"><img src="/CreateMore/assets/profile1.png" alt="profielfoto"></a>
        </div>
        <a href="logOut.php"><p class="logOut">Uitloggen</p></a>
        
    </nav>
</body>
</html>