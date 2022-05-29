<?php
require_once('bootstrap.php');
include_once(__DIR__ . "/includes/nav.inc.php");
session_start();

$myUserName = $_SESSION["username"];

$profiel = new Profile();
$profiel->setUsername($myUserName);
$msg = "";

// Alleen wanneer update knop word geklikt
if(!empty($_POST)){
    $profiel->setValues($_POST);
    $profiel->updateInfo();

    $wwHuidig = $_POST["huidig-ww"];
    $wwNieuw = $_POST["nieuw-ww"];

    // Alleen als er iets is ingegeven in huidig of nieuw ww
    if(!empty($wwHuidig) && !empty($wwNieuw)){
        $profiel->setCurrentPassword($wwHuidig);
        $passwordsMatch = $profiel->checkPassword();

        if($passwordsMatch){
            // als huidig passwoord juist is
            $profiel->setNewPassword($wwNieuw);
            $profiel->updatePassword();
            $msg = "Passwoord aangepast!<br>";
        }else{
            // als huidig password niet juist is
            $msg = "Huidig passwoord is niet juist!<br>";
        }
    }

    if(!empty($_FILES["foto"]["name"])){
        $target_dir = "uploads/";
        $file = $_FILES['foto']['name']; // ../../../file.png

        // Het pad veilig maken
        $path = pathinfo($file);
        $filename = $path['filename']; // file
        $ext = $path['extension']; // png

        $temp_name = $_FILES['foto']['tmp_name'];
        $nieuw_pad = $target_dir . $filename . "." . $ext;

        // nakijken of het een afbeelding is 
        if(!in_array($ext, ["png", "jpg"])){
            $msg .= "De foto moet png of jpg als extensie hebben";
        }else if (file_exists($nieuw_pad)) {
            $msg .= "Sorry, het bestand bestaat al";
        }else{
            //foto in uploads plaatsen
            move_uploaded_file($temp_name, $nieuw_pad);
            // save de locatie van de foto in de database
            $profiel->setFoto($nieuw_pad);
            $profiel->updateFoto();

            $msg .= "Uw profiel foto is aangepast!";
        }
    }
}

$result = $profiel->getInfo();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>createMore profiel</title>
    <link rel="stylesheet" href="CSS/profiel.css">
    <link rel="stylesheet" href="CSS/style.css">    
</head>
<body>
    <?php echo $msg; ?>
    <form method="POST" enctype="multipart/form-data">
        <img class="profielFoto" src="<?php echo htmlspecialchars($result["profilepic"]); ?>" alt=""><br><br>
        <input type="file" id="foto" name="foto"/><br><br>

        <label for="gnaam">Gebruikersnaam</label>
        <br>
        
        <input type="text" id="gnaam" name="gnaam" value="<?php echo htmlspecialchars($result['username']); ?>" disabled><br><br>
        
        <label for="hMail">Hoofde-mailadres</label>
        <br>
        <input type="text" id="hMail" name="hmail" value="<?php echo htmlspecialchars($result['email']); ?>" disabled><br><br>
      
        <label for="tweedeEmail">Tweede e-mailadres</label>
        <br>
        <input type="email" id="tweedeEmail" name="tweedeEmail" value="<?php echo htmlspecialchars($result['tweedeEmail']); ?>"><br><br>
        
        <label for="bio">Bio</label>
        <br>
        <input type="text" id="bio" name="bio" value="<?php echo htmlspecialchars($result['bio']); ?>"><br><br>

        <label for="opleiding">Opleiding</label>
        <br>
        <input type="text" id="opleiding" name="opleiding" value="<?php echo htmlspecialchars($result['opleiding']); ?>"><br><br>

        <label for="facebook">Facebook</label>
        <br>
        <input type="text" id="facebook" name="facebook" value="<?php echo htmlspecialchars($result['facebook']); ?>"><br><br>
        
        <label for="instagram">Instagram</label>
        <br>
        <input type="text" id="instagram" name="instagram" value="<?php echo htmlspecialchars($result['instagram']); ?>"><br><br>

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