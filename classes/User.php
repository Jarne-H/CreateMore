<?php 
class User {
private $username;
private $email;
private $password;
//private $options;
//Private eigenschappen kunnen niet buiten de klasse aangesproken worden.
//constructor is niet handnig om meerdere taken uit te laten voeren
//Setters: publieke functies, anders kan je ze niet buiten de klasse aanroepen 
//Om waarde te zetten
//getters: geeft waarde van huidig object. Je kan enkel publieke functies/eigenschappen aanspreken.
//Nu kan je makkelijk controles uitvoeren

//Post: 
//get: Je krijgt je informatie in de url. input velden hebben een name nodig!
//Namespaces zijn bedoeld zodat je meerdere classes users hebt zonder dat ze doorelkaar gebruikt gaan kunnen worden, ze groeperen namelijk de classes met zelfde namespace
//Met bcrypt encrypteer je een wachtwoord, zodat mensen het niet kunnen ontcijferen met een of andere tool. //Wij gebruiken password default. Dat is het wachtwoord dat ingegeven is, een standaard algoritme en een kost die extra random characters er bij zet
 







/**
 * Get the value of username
 */ 


/**
 * Set the value of username
 *
 * @return  self
 */ 
public function setUsername($username)
{
$this->username = $username;

return $this;
}
public function getUsername()
{
return $this->username;
}

/**
 * Get the value of email
 */ 
public function getEmail()
{
return $this->email;
}

/**
 * Set the value of email
 *
 * @return  self
 */ 
public function setEmail($email)
{

//if (stripos($this->email, '@student.thomasmore.be') !== false || stripos($this->email, '@thomasmore.be')!== false) {
    //Als het email adres bestaat ui thomasmore.be dan kan er verder gedaan worden

    //echo "Hallo ik ben er";
    $this->email = $email;
    return $this;


//}
//else {
   /// echo "Email adres is niet juist";
//}

}

/**
 * Get the value of password
 */ 
public function getPassword()
{
return $this->password;
}

/**
 * Set the value of password
 *
 * @return  self
 */ 
public function setPassword($password)
{

$options  = ['cost' => 14,];
$password = password_hash($password, PASSWORD_DEFAULT, $options);
$this->password = $password;

return $this;
}
public static function login($username, $password){

    //connectie met db
    $conn = DB::getInstance();
    //query
    $statement = $conn->prepare("select * from user where username = :username");
    $statement->bindValue(":username", $username);
    $statement->execute();
    //user connecteren met username
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if(!$user){
        throw new Exception('Deze gebruiker bestaat niet.');
    }
    var_dump($user);

    //wachtwoord verifiëren
    //Haald het password en de hash uit de database en kijkt of dit matcht, als het matcht dan gaat het verder en log je in
    
    $hash = $user["password"];
    if(password_verify($password, $hash)){
        // login
        echo "oke";
        session_start();

        $_SESSION["username"] = $username;
        
        //doorsturen naar index.php (empty state)
        header("Location: index.php");
    }
    else{
        echo "niet oke";
        throw new Exception('Gebruikersnaam en wachtwoord komen niet overeen.');
    }

}



public function SignUp() {

//Connectie met de databank

    $conn = DB::getInstance();


//Als email thomas more in heeft dan wordt er gekeken, dan wordt getEmail aangeroepen

    $email = $this->getEmail();
    $password = $this->getPassword();
    $username =$this->getUsername();


        if (stripos($email, '@student.thomasmore.be')!== false|| stripos($email, '@thomasmore.be')!== false) {
            $query = $conn->prepare("select * from user where email = :email");
            $query2 = $conn->prepare("select * from user where username = :username");
            $query->bindValue(":email", $email);
            $query2->bindValue(":username",$username);
            $query->execute();
            $query2->execute();
            $result2 = $query2->rowCount();
            $result = $query->rowCount();

                if ($result > 0) {
                    throw new Exception("Dit e-mail adres bestaat al");
                }
                if ($result2 > 0) {
                    throw new Exception("Deze gebruikersnaam bestaat al");
                // echo "hi";
                }
        else {
                    
                    $statement = $conn->prepare("insert into `user` ( email, username, password) VALUES ( :email, :username, :password);");
                    $statement->bindValue(":username",$username);
                    $statement->bindValue(":password",$password);
                    $statement->bindValue(":email",$email);

                    $result = $statement->execute();

                    return $result;

                }



            }

            if (stripos($email, '@student.thomasmore.be') == false && stripos($email,'@thomasmore.be') == false){
                throw new Exception("E-mail adres moet op @student.thomasmore.be of @thomasmore.be eindigen");


            }
/*if (strlen($password)<6) {
    throw new Exception("Wachtwoord moet minstens 6 characters lang zijn");

}
/*if (empty($username)) {
    throw new Exception("Gebruikersnaam kan niet leeg zijn");
}*/












}
public function profile() {

    $conn = DB::getInstance();

    $email = $this->getEmail();
    $password = $this->getPassword();
    $username =$this->getUsername();

    $query = $conn->prepare("select * from user where email = :email and password = :password and username = :username");
    $query->bindValue(":email", $email);
    $query->bindValue(":username", $username);
    $query->bindValue(":password", $password);

 $query->execute();

 $result = $query->fetchAll();

    return $result;






}





}