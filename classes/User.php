<?php 
class User {

private $email;
private $password;
private $username;




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
$this->email = $email;

return $this;
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
$this->password = $password;

return $this;
}

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


public function save()  {
    //conn
    $conn = new PDO('mysql:host=localhost;dbname=createmore',"root","root");
    $username = $this->getUsername();
    $email = $this->getEmail();
    $password = $this->getPassword();

    
    //insert query
    $statement = $conn->prepare("insert into `users` ( email, username, password) VALUES ( :email, :username, :password);");
    $statement->bindValue(":username",$username);
    $statement->bindValue(":password",$password);

    $statement->bindValue(":email",$email);

    $result = $statement->execute();


    //return result
    return $result;
}
}