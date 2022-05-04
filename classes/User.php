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


// var_dump($password);
// exit();
$options  = ['cost' => 12];
$password = password_hash($password, PASSWORD_DEFAULT, $options);
$this->password = $password;

return $this;
}

//Login
public static function login($username, $password){

    //connectie met db
    // $conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
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



//Account aanmaken
public function SignUp() {

//Connectie met de databank

// $conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
$conn = DB::getInstance();

//Als email thomas more in heeft dan wordt er gekeken, dan wordt getEmail aangeroepen

$email = $this->getEmail();
$password = $this->getPassword();
$username =$this->getUsername();


if (stripos($email, '@student.thomasmore.be')!== false|| stripos($email, '@thomasmore.be')!== false) {
    $query = $conn->prepare("select * from user where email = :email");
    $query->bindValue(":email", $email);
    $query->execute();
    $result = $query->rowCount();

    if ($result > 0) {
        throw new Exception("Dit e-mail adres bestaat al");
    }
    else {
        var_dump($username);
        var_dump($password);

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
if (strlen($password)<=6) {
    throw new Exception("Wachtwoord moet minstens 6 characters lang zijn");


}
/*if (empty($username)) {
    throw new Exception("Gebruikersnaam kan niet leeg zijn");
}*/

}

// public function canLogin($username, $password){ 

//     $username =$this->getUsername();
//     $password = $this->getPassword();



//     try {
//         $conn = new PDO('mysql:host=localhost:8889;dbname=createmore2', "root", "root");
//         $statement = $conn->prepare("select * from users where username = :username");
//         $statement->bindValue(":username", $username); 	// sql injectie = prepare en bind
//         $statement->execute();
//         $user = $statement->fetch(PDO::FETCH_ASSOC);
//         // var_dump($user)
//         $hash = $user['password'];
//         if(password_verify($password, $hash)) {
//             return true;
//         }
//         else {
//             return false;
//         }
        
//     }
//     catch(Throwable $e) {
//         echo $e->getMessage();
//         return false;
//     }

    
// }


// public static function login($username, $password){

//     // $conn = Db::getConnection();
//     $conn = new PDO('mysql:host=localhost:8889;dbname=createmore2', "root", "root");
//     $statement = $conn->prepare("select * from users where username = :username");
//     $statement->bindValue(":username", $username);
//     $statement->execute();
//     // get user connected to email
//     $user = $statement->fetch(PDO::FETCH_ASSOC);
//     // var_dump($user);
//     if(!$user){
//         throw new Exception('This user does not exist');
//     }

//         $hash = $user['password'];
//         if(password_verify($password, $hash)) {
//             echo "het klopt";
//             return true;
//         }
//         else {
//             echo "komt niet overeen";
//             return false;
//         }

//     //verify password
//     // $hash = $user["password"];
//     // if(password_verify($password, $hash)){
//     //     // login
//     //     session_start();
//     //     // $_SESSION["userid"] = $user['username'];
//     //     $_SESSION["username"] = $username;
//     //     $_SESSION["password"] = $password;
//     //     // $_SESSION["userId"] = $user['userId'];
//     //     // $_SESSION["userRole"] = $user['userRole'];
//     //     header("Location: index.php");
//     // }else{
//     //     throw new Exception('Incorrect password');
//     // }

// }




}