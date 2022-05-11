<?php
require_once('./bootstrap.php');

$myUserName = "123456";

$profiel = new Profiel();
$msg = "";

// Alleen wanneer update knop word geklikt
if(!empty($_POST)){
    $profiel->updateInfo($myUserName, $_POST);

    $wwHuidig = $_POST["huidig-ww"];
    $wwNieuw = $_POST["nieuw-ww"];

    // Alleen als er iets is ingegeven in huidig of nieuw ww
    if(!empty($wwHuidig) && !empty($wwNieuw)){
        $passwordsMatch = $profiel->checkPassword($myUserName, $wwHuidig);

        if($passwordsMatch){
            // als huidig passwoord juist is
            $profiel->updatePassword($myUserName, $wwNieuw);
            $msg = "Passwoord aangepast!";
        }else{
            // als huidig password niet juist is
            $msg = "Huidig passwoord is niet juist!";
        }
    }
}

$result = $profiel->getInfo($myUserName);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>createMore profiel</title>
    <link rel="stylesheet" href="CSS/profiel.css">
</head>
<body>
    <?php echo $msg; ?>
    <form method="POST">
        <img src="profiel.jpg" alt=""><br><br>
        <input type="file" id="foto" name="foto"/><br><br>

        <label for="gnaam">Gebruikersnaam</label>
        <br>
        <input type="text" id="gnaam" name="gnaam" value="<?php echo $result['username']; ?>" disabled><br><br>
        
        <label for="hMail">Hoofde-mailadres</label>
        <br>
        <input type="text" id="hMail" name="hmail" value="<?php echo $result['email']; ?>" disabled><br><br>
      
        <label for="tweedeEmail">Tweede e-mailadres</label>
        <br>
        <input type="email" id="tweedeEmail" name="tweedeEmail" value="<?php echo $result['tweedeEmail']; ?>"><br><br>
        
        <label for="bio">Bio</label>
        <br>
        <input type="text" id="bio" name="bio" value="<?php echo $result['bio']; ?>"><br><br>

        <label for="opleiding">Opleiding</label>
        <br>
        <input type="text" id="opleiding" name="opleiding" value="<?php echo $result['opleiding']; ?>"><br><br>

        <label for="facebook">Facebook</label>
        <br>
        <input type="text" id="facebook" name="facebook" value="<?php echo $result['facebook']; ?>"><br><br>
        
        <label for="instagram">Instagram</label>
        <br>
        <input type="text" id="instagram" name="instagram" value="<?php echo $result['instagram']; ?>"><br><br>

        <label for="huidig-ww">Huidig Wachtwoord</label>
        <br>
        <input type="password" id="huidig-ww" name="huidig-ww"><br><br>

        <label for="nieuw-ww">Nieuw Wachtwoord</label>
        <br>
        <input type="password" id="nieuw-ww" name="nieuw-ww"><br><br>
        
        <input type="submit" value="Opslaan">
      </form>
</body>
</html>