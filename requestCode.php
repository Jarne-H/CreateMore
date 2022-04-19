<?php
session_start();
require "./libraries\phpmail\PHPMailer\PHPMailerAutoload.php";

function requestResetCode($email)
{
    try {
        //connectie met databank
        $conn = new PDO('mysql:host=localhost:33066;dbname=createmore', "root", "root");
        //query maken
        $statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);


        $resetCode = $user['verificationcode'];


        $from = 'info@duckstyle.be';
        $name = 'Horemans Jarne';
        $subj = 'CreateMore resetcode';
        $msg = 'Your resetcode:';
        $msg .= $resetCode;

        $sendMail = smtpmailer($email, $from, $name, $subj, $msg);
        echo $sendMail;
    } catch (Throwable $e) {
        echo $e->getMessage();
        return false;
    }
}

if (!empty($_POST)) {
    $email = $_POST['email'];

    requestResetCode($email);

    header("./index.php");
}

function smtpmailer($to, $from, $from_name, $subject, $body)
{
    require_once '../PHPMailerAutoload.php';

    $results_messages = array();

    $mail = new PHPMailer(true);
    $mail->CharSet = 'utf-8';
    ini_set('default_charset', 'UTF-8');

    class phpmailerAppException extends phpmailerException
    {
    }

    try {
        if (!PHPMailer::validateAddress($to)) {
            throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
        }
        $mail->isSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host       = "webreus.email";
        $mail->Port       = "25025";
        $mail->SMTPSecure = "ssl";
        $mail->SMTPAuth   = false;
        $mail->addReplyTo($from, $from_name);
        $mail->setFrom($from, $from_name);
        $mail->addAddress($to, "Gebruiker");
        $mail->Subject  = $subject;
        $body = <<<'EOT'
    yesss
    EOT;
        $mail->WordWrap = 78;
        $mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
        $mail->addAttachment('images/phpmailer_mini.png', 'phpmailer_mini.png');  // optional name
        $mail->addAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name

        try {
            $mail->send();
            $results_messages[] = "Message has been sent using SMTP";
        } catch (phpmailerException $e) {
            throw new phpmailerAppException('Unable to send to: ' . $to . ': ' . $e->getMessage());
        }
    } catch (phpmailerAppException $e) {
        $results_messages[] = $e->errorMessage();
    }

    if (count($results_messages) > 0) {
        echo "<h2>Run results</h2>\n";
        echo "<ul>\n";
        foreach ($results_messages as $result) {
            echo "<li>$result</li>\n";
        }
        echo "</ul>\n";
    }
    //oude code\/\/\/\/\/\/\/\/\/\/\/\/\/
    //    $mail = new PHPMailer();
    //    $mail->IsSMTP();
    //    $mail->SMTPAuth = true;
    //
    //    $mail->SMTPSecure = 'ssl';
    //    $mail->Host = 'webreus.email';
    //    $mail->Port = 2525;
    //    $mail->Username = 'info@duckstyle.be';
    //    $mail->Password = 'd3!nqd!djz8';
    //
    //    //   $path = 'reseller.pdf';
    //    //   $mail->AddAttachment($path);
    //
    //    $mail->IsHTML(true);
    //    $mail->From = "horemans.jarne@duckstyle.be";
    //    $mail->FromName = $from_name;
    //    $mail->Sender = $from;
    //    $mail->AddReplyTo($from, $from_name);
    //    $mail->Subject = $subject;
    //    $mail->Body = $body;
    //    $mail->AddAddress($to);
    //    if (!$mail->Send()) {
    //        $errorMail = "Please try Later, Error Occured while Processing..." . $mail->ErrorInfo;
    //        return $errorMail;
    //    } else {
    //        $errorMail = "Thanks You !! Your email is sent.";
    //        return $errorMail;
    //    }
    //oude code/\/\/\/\/\/\/\/\/\/\/\/\/\
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