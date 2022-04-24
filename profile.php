<?php 
include_once(__DIR__ . "/classes/User.php");

//Maak connectie met de databank
//$conn =  new PDO('mysql:host=localhost;dbname=createmore', "root", "root");

//Haal data uit de databank (gebruikersnaam, wachtwoord, email)


    

$users = [];
$user = new User();
$user->getUsername();
$users = $user->profile("test");




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css"> 

    <title>Profile</title>
</head>
<body>
    <div class="container">
        <h1>Profiel</h1>
    <form action="" method="post">
    <div class="inputbox">


<input type="file" accept="image/*" id="profilepic" placeholder="Profielfoto" name = "profilepic">
<label for="picture">Profielfoto</label>
</div>
    <div class="inputbox">

    <label for="username">Gebruikersnaam</label>
    <?php foreach ($users as $u): ;?>
    <input type="text" id="username" placeholder="Gebruikersnaam" name = "username" value="<?php echo $u['username'] ?>" required>
    <?php endforeach;   ?>
    </div>

    <div class="inputbox">

<label for="email">E-mail adres</label>
<input type="email" id="email" placeholder="E-mail" name = "email" required>

</div>

<div class="inputbox">

<label for="secondEmail">Tweede e-mail adres</label>
<input type="secondEmail" id="secondEmail" placeholder="Tweede e-mail adres" name = "secondEmail">

</div>
<div class="inputbox">

<label for="bio">Over mij</label>
<input type="text" id="bio" placeholder="Je hebt nog geen beschrijving" name = "bio">

</div>
<div class="inputbox">

<label for="password">Wachtwoord</label>
<input type="password" id="password" placeholder="Wachtwoord" name = "password" required>

</div>

<input type="submit" value="Opslaan" id="save">
<a href="logout.php">Uitloggen</a>


    </form>

    



    </div>
</body>
</html>