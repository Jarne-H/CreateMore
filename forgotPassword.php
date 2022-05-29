<?php
session_start();

include_once("bootstrap.php");




if (!empty($_POST)) {
    $email = $_POST['email'];
    $options = ['cost' => 12,];
    $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    // var_dump($passwordhash);
    $passwordlength = strlen($_POST['password']);
    $recievedcode = $_POST['recievedcode'];
    User::forgotPassword($email, $recievedCode, $newpassword, $passwordlength);
    // var_dump($newpassword);
    header("Location: index.php");

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

                <div class="inputfields">
                    <label for="recievedcode">Gekregen code</label>
                    <input name="recievedcode" placeholder="Gekregen code" type="text" required />
                </div>

                <?php if (isset($errorWrongCode)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorWrongCode ?></p>
                    </div>
                <?php endif; ?>

                <div class="inputfields">
                    <label for="password">Nieuw wachtwoord</label>
                    <input name="password" placeholder="Nieuw wachtwoord" type="password" required />
                </div>

                <?php if (isset($errorPass)) : ?>
                    <div class="errorMessage">
                        <p><?php echo $errorPass ?></p>
                    </div>
                <?php endif; ?>


                <div>
                    <input id="btn" type="submit" value="Stel wachtwoord in">
                </div>

                <p id="hebaccount">Heb je nog geen account? <a href="signup.php">Meld aan</a></p>

        </div>
        </form>

</body>

</html>