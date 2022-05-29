<?php
session_start();
require "libraries/phpmail/PHPMailer/PHPMailerAutoload.php";
include_once("bootstrap.php");

//connectie met databank

if (!empty($_POST)) {
    try {
        $email = $_POST['email'];
        User::requestResetCode($email);
        // header("index.php");

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
    <link rel="stylesheet" href="CSS/style.css">
    <title>Nieuw wachtwoord instellen</title>
</head>

<body>
    <div id="header">
        <div class="logo"></div>
    </div>
    <div id="main">
        <h1>createMore</h1>
        <h3>Nieuw wachtwoord instellen</h3>
        <div class="loginfb"></div>
        <div class="linel"></div>
        <div class="liner"></div>

        <div id="form">
            <form method="post" action="">

                <div class="inputfields">
                    <label for="email">E-mail</label>
                    <input name="email" placeholder="E-mail" type="text" required />
                </div>

                <?php if (isset($errorEmail)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorEmail ?></p>
                    </div>
                <?php endif; ?>


                <div>
                    <input id="btn" type="submit" value="Vraag code aan">
                </div>

                <p id="hebaccount">Heb je nog geen account? <a href="/signup.php">Meld aan</a></p>

        </div>
        </form>

</body>

</html>