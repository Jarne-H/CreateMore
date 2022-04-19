<?php

session_start();

function canLogin($username, $password)
{

    try {
        //connectie met databank
        $conn = new PDO('mysql:host=localhost;dbname=createmore', "root", "root");
        //query maken
        $statement = $conn->prepare("select * from user where username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        // var_dump($user);

        $hash = $user['password'];
        if (password_verify($password, $hash)) {
            var_dump($password);
            return true;
        } else {
            return false;
        }
    } catch (Throwable $e) {
        echo $e->getMessage();
        return false;
    }
}

if (!empty($_POST)) {
    //er is gesubmit
    $username = $_POST['username'];
    $password = $_POST['password'];
    // echo $username . $password;

    //check of de user mag inloggen
    if (canLogin($username, $password)) {
        // session_start();
        $_SESSION['username'] = $username;

        //doorsturen naar index.php
        header("location:index.php");
    } else {
        // echo "komt niet overeen";

        $errorUserPass = "Gebruikersnaam en wachtwoord komen niet overeen.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Log in</title>
</head>

<body>
    <div id="header">
        <div class="logo"></div>
    </div>
    <div id="main">
        <h1>create More</h1>
        <h3>Log in</h3>
        <div class="loginfb"></div>
        <div class="linel"></div>
        <div class="liner"></div>

        <div id="form">
            <form method="post" action="">

                <div class="inputfields">
                    <label for="username">Gebruikersnaam</label>
                    <input name="username" placeholder="Gebruikersnaam" type="text" required />
                </div>


                <div class="inputfields">
                    <label for="password">Wachtwoord</label>
                    <input name="password" placeholder="Wachtwoord" type="password" required />
                </div>

                <?php if (isset($errorUserPass)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorUserPass ?> <a href="./forgotPassword.php">Wachtwoord vergeten</a></p>
                    </div>
                <?php endif; ?>


                <div>
                    <input class="btn" type="submit" value="Log in">
                </div>

                <p id="hebaccount">Heb je nog geen account? <a href="./signUp.php">Meld aan</a></p>

        </div>
        </form>

</body>

</html>