<?php 
class User {
private $username;
private $email;
private $password;
protected $options;







/**
 * Get the value of username
 */ 
public function getUsername()
{
return $this->username;
}

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

$options  = ['cost' => 12,];
$password = password_hash($this->password . "SDF0303", PASSWORD_DEFAULT, $options);
$this->password = $password;

return $this;
}

//Login
public static function login($username, $password){

    //connectie met db
    $conn = new PDO('mysql:host=localhost:8889;dbname=createmore2', "root", "root");
    //query
    $statement = $conn->prepare("select * from users where username = :username");
    $statement->bindValue(":username", $username);
    $statement->execute();
    //user connecteren met username
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if(!$user){
        //error
        throw new Exception('Deze gebruiker bestaat niet.');
    }

    //wachtwoord verifiëren
    $hash = $user["password"];
    if(password_verify($password, $hash)){
        // login
        session_start();
        $_SESSION["username"] = $username;
        //doorsturen naar index.php (empty state)
        header("Location: index.php");
    }
    else{
        //error
        throw new Exception('Gebruikersnaam en wachtwoord komen niet overeen.');
    }

}



//Account aanmaken
public function SignUp() {

//Connectie met de databank

$conn = new PDO('mysql:host=localhost:8889;dbname=createmore2', "root", "root");


//Als email thomas more in heeft dan wordt er gekeken, dan wordt getEmail aangeroepen

$email = $this->getEmail();
$password = $this->getPassword();
$username =$this->getUsername();


if (stripos($email, '@student.thomasmore.be')!== false|| stripos($email, '@thomasmore.be')!== false) {
    $query = $conn->prepare("select * from users where email = :email");
    $query->bindValue(":email", $email);
    $query->execute();
    $result = $query->rowCount();

    if ($result > 0) {
        throw new Exception("Dit e-mail adres bestaat al");
    }
    else {
        
        $statement = $conn->prepare("insert into `users` ( email, username, password) VALUES ( :email, :username, :password);");
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
if (strlen($password)<=6) {
    throw new Exception("Wachtwoord moet minstens 6 characters lang zijn");


}
/*if (empty($username)) {
    throw new Exception("Gebruikersnaam kan niet leeg zijn");
}*/

}






}