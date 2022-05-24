<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require "libraries\phpmail\PHPMailer\PHPMailerAutoload.php";
include_once(__DIR__ . "./bootstrap.php");
include_once(__DIR__ . "./classes/DB.php");


//connectie met databank

if (!empty($_POST)) {
    try {
        $email = $_POST['email'];


        header("./index.php");
        //connectie met databank
        $conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
        //query maken
        $statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $resetCode = $user['verificationcode'];
        User::requestResetCode($email);
    } catch (Throwable $e) {
        echo $e->getMessage();
        return false;
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
    <title>Password Reset</title>
</head>

<body>
    <div id="header">
        <div class="logo"></div>
    </div>
    <div id="main">
        <h1>createMore</h1>
        <h3>Password Reset</h3>
        <div class="loginfb"></div>
        <div class="linel"></div>
        <div class="liner"></div>

        <div id="form">
            <form method="post" action="">

                <div class="inputfields">
                    <label for="email">Email</label>
                    <input name="email" placeholder="Email" type="text" required />
                </div>

                <?php if (isset($errorEmail)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorEmail ?></p>
                    </div>
                <?php endif; ?>


                <div>
                    <input class="btn" type="submit" value="Request code">
                </div>

                <p id="hebaccount">Heb je nog geen account? <a href="./signUp.php">Meld aan</a></p>

        </div>
        </form>

</body>

</html>