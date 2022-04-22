<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


function resetPassword($email, $recievedCode)
{

    try {
        //connectie met databank
        $conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
        //query maken
        $statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);


        $resetCode = $user['verificationcode'];

        if ($recievedCode == $resetCode) {
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
    $options = ['cost' => 14,];
    $email = $_POST['email'];
    $recievedcode = $_POST['recievedcode'];
    $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    $passwordlength = strlen($_POST['password']);

    if (resetPassword($email, $recievedcode)) {
        if ($passwordlength >= 6) {
            $conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
            $query = $conn->prepare("UPDATE user SET password = :password WHERE email = :email");
            $query->bindValue(":email", $email);
            $query->bindValue(":password", $newpassword);
            $query->execute();

            $statement = $conn->prepare("UPDATE user SET verificationcode = NULL WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            header("Location: ./index.php");
        } else {
            $errorPass = "Wachtwoord moet minstens 6 characters lang zijn.";
        }
    } else {
        $errorWrongCode = "De resetcode was onjuist of vervallen.";
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