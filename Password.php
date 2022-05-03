
<?php 
include_once("bootstrap.php");

//Wachtwoord wijzigen
//Gebruiker kan hier zijn of haar wachtwoord zien
//Wachtwoord wordt uit de databank gehaald
//Wachtwoord wordt in invoerveld weergegeven.

//Als je er op klikt dan wordt je wachtwoord gewijzigd.

//Databank connectie


$profile = [];
$person = new Profile();
$person->setUser("jeffrey");
$person->getprofile();

    echo $profile['email'];










?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijzig wachtwoord</title>
</head>
<body>
    <form action="" method="post">
        
       
    <input type="text" name ="username">
    <input type="password" name="passwordChange">
  

    
    </form>
    
</body>
</html>