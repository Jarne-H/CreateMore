<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require "libraries\phpmail\PHPMailer\PHPMailerAutoload.php";


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
        requestResetCode($email);
    } catch (Throwable $e) {
        echo $e->getMessage();
        return false;
    }
}

function requestResetCode($email)
{
    try {

        $characters = '012345678901234567890123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ&$@';
        $requestCode = '';

        for ($i = 0; $i < 8; $i++) {
            $nextSymbol = rand(0, strlen($characters) - 1);
            $requestCode .= $characters[$nextSymbol];
        }
        echo $requestCode;

        $from = 'info@duckstyle.be';
        $smtpServer = 'webreus.email';
        $smtpUsername = 'info@duckstyle.be';
        $smtpPassword = 'd3!nqd!djz8';
        $smtpPort = '25025';
        $name = 'CreateMore';
        $subj = 'CreateMore resetcode';
        $body = "Copy this resetcode and fill it in the form: " . $requestCode;
        $sendMail = smtpmailer($email, $from, $name, $subj, $body, $smtpServer, $smtpUsername, $smtpPassword, $smtpPort);
        echo $sendMail;

        $conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
        $statement = $conn->prepare("UPDATE user SET verificationcode = :verificationcode WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->bindValue(":verificationcode", $requestCode);
        $statement->execute();
        header("Location: forgotPassword.php");
    } catch (Throwable $e) {
        echo $e->getMessage();
        return false;
    }
}

function smtpmailer($to, $from, $from_name, $subject, $body, $smtpServer, $smtpUsername, $smtpPassword, $smtpPort)
{
    date_default_timezone_set('Europe/Brussels');

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = $smtpServer;
    $mail->Port = $smtpPort;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->setFrom($from, $from_name);
    $mail->addReplyTo($from, $from_name);
    $mail->addAddress($to, 'Beste student');
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->Body .= "\nIf you didn't request this mail, please contact us";
    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
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