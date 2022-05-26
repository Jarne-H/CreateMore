<?php
session_start();
include_once(__DIR__ . "./bootstrap.php");
include_once(__DIR__ . "./classes/DB.php");




if (!empty($_POST)) {
    $email = $_POST['email'];
    $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    $passwordlength = strlen($_POST['password']);
    $recievedcode = $_POST['recievedcode'];
    User::forgotPassword($email, $recievedCode, $newpassword, $passwordlength);
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

                <div class="inputfields">
                    <label for="recievedcode">Reset code</label>
                    <input name="recievedcode" placeholder="Reset code" type="text" required />
                </div>

                <?php if (isset($errorWrongCode)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorWrongCode ?></p>
                    </div>
                <?php endif; ?>

                <div class="inputfields">
                    <label for="password">New password</label>
                    <input name="password" placeholder="New password" type="password" required />
                </div>

                <?php if (isset($errorPass)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorPass ?></p>
                    </div>
                <?php endif; ?>


                <div>
                    <input class="btn" type="submit" value="Reset password">
                </div>

                <p id="hebaccount">Heb je nog geen account? <a href="./signUp.php">Meld aan</a></p>

        </div>
        </form>

</body>

</html>