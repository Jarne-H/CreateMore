<?php

//include DB
include_once(__DIR__ . "/Db.php");


class User
{
     private $userId;
    private $avatar;
    private $editEmail;
    private $privatecheck;
    
     /**
     * Get the value of avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }


    /**
     * Set the value of avatar
     *
     * @return  self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
    
      /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
    
        /**
     * Get the value of privatecheck
     */
    public function getPrivatecheck()
    {
        return $this->privatecheck;
    }

    /**
     * Set the value of privatecheck
     *
     * @return  self
     */
    public function setPrivatecheck($privatecheck)
    {
        $this->privatecheck = $privatecheck;

        return $this;
    }

        /**
     * Get the value of editEmail
     */
    public function getEditEmail()
    {
        return $this->editEmail;
    }

    /**
     * Set the value of editEmail
     *
     * @return  self
     */
    public function setEditEmail($editEmail)
    {
        $this->editEmail = $editEmail;

        return $this;
    }
    
     //haal de gegevens op van alle users
    public function getAllUsers()
    {
        $conn = Db::getConnection();

        $result = $conn->query("SELECT * FROM Users");
        return $result->fetchAll();
    }
    
    



    static function register($username, $email, $firstName, $lastName, $password, $passwordVerify, $date)
    {

        //if form filled in correctly
        if (!empty($username) && !empty($email) && !empty($firstName) && !empty($lastName) && !empty($password) && !empty($passwordVerify)) {

            //check if username already exist in DB
            $conn = Db::getConnection();
            $stm = $conn->prepare("SELECT * FROM Users WHERE username = :username");
            $stm->bindValue(':username', $username);
            $stm->execute();
            $result = $stm->fetchAll();

            //check of 
            if (count($result) === 0) {
                
                /*
                //password should be complex
                $includesNumber = preg_match("#[0-9]+#", $password);
                $includesLetter = preg_match("#[a-zA-Z]+#", $password);
                
                if (!$includesNumber || !$includesLetter || strlen($password) < 8) {
                    throw new Exception("Password should be at least 8 characters in length and should include at least one upper case letter and one number.");
                } else {*/

                    //check if passowrd verify is the same as password
                    if ($passwordVerify === $password) {



                        //password cost & hash
                        $option = [
                            'cost' => 12,
                        ];
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $option);


                        //insert new user in DB
                        $conn = Db::getConnection();
                        $stm = $conn->prepare("INSERT INTO Users (firstname, lastname, username, email, password,created) VALUES (:firstName, :lastName, :username, :email, :password, :date)");
                        $stm->bindValue(':username', $username);
                        $stm->bindValue(':email', $email);
                        $stm->bindValue(':firstName', $firstName);
                        $stm->bindValue(':lastName', $lastName);
                        $stm->bindValue(':password', $password);
                        $stm->bindValue(':date', $date);
                        $stm->execute();

                        header('Location: login.php');
                    } else {
                        throw new Exception("error: passwords not the same");
                    }
                /*}*/
            } else {
                throw new Exception("error: username already exists");
            }
        } else {
            throw new Exception("error: form not filled in correctly");
        }
    }

  

    public static function getUserByUsername($username, $password)
    {
        $conn = Db::getConnection();
        $stm = $conn->prepare("SELECT * FROM Users WHERE username = :username");
        $stm->bindValue(':username', $username);
        $stm->execute();
        $user = $stm->fetch();
        //var_dump($user);
        if (!$user) {
            $stmMail = $conn->prepare("SELECT * FROM Users WHERE email = :email");
            $stmMail->bindValue(':email', $username);
            $stmMail->execute();
            $user = $stmMail->fetch();
            //var_dump($user);

        }
        if (!$user) {
            throw new Exception("the email or username is wrong");
            return false;
        }
        $hash = $user["password"];
        if (password_verify($password, $hash)) {
            $userId = $user['id'];
            $_SESSION["username"] = $username;
            $_SESSION["userId"] = $userId;
            header("Location: index.php");

            //var_dump($user);
            return true;
        } else {
            throw new Exception("the password is wrong");
            return false;
        }
    }
    
        //haal alle gegevens op van gebruikers waarvan de gegeven id gelijk is aan die van in de databank
    public  function getUserById()
    {

        $userId = $this->getUserId();

        $conn = Db::getConnection();
        $result = $conn->prepare("select * from Users where id = :id");
        $result->bindValue(':id',  $userId);
        $result->execute();
        return $result->fetch();
    }
    
        //haal de aanmaakdatum op waar de id gelijk is aan de meegeven id
    public  function getdateStats()
    {

        $userId = $this->getUserId();

        $conn = Db::getConnection();
        $result = $conn->prepare("select created from Users where id = :id");
        $result->bindValue(':id', $userId);
        $result->execute();
        $stats = $result->fetch();
        return  $stats;
    }
    
      //slaag de avatar image naam op in de db voor d
    public function uploadAvatar()
    {

        $userId = $this->getUserId();

        $conn = Db::getConnection();
        $statement = $conn->prepare("update Users set profileImage=:avatar where id = :id ");
        $statement->bindValue(':avatar', $this->avatar);
        $statement->bindValue(':id', $userId);
        $statement->execute();
    }

    //verwijder de avater image naam uit de db
    public function deleteAvatar()
    {

        $userId = $this->getUserId();

        $conn = Db::getConnection();
        $statement = $conn->prepare('UPDATE Users SET profileImage=:defaultAvatar WHERE id = :id');
        $statement->bindValue(':id',   $userId);
        $statement->bindValue(':defaultAvatar', 'defaultAvatar');

        $statement->execute();
    }
    
        public function updateEmail()
    {   $id = $this->getUserId();
        $editEmail = $this->getEditEmail();
        $conn = Db::getConnection();
        $statement = $conn->prepare("update Users set email=:email where id = :id ");
        $statement->bindValue(':email', $editEmail);
        $statement->bindValue(':id', $id);
        $statement->execute();
        header("Location: ./profileSettings.php");
    }
    
    public function updateFirstname($id, $editFirstname)
    {
        if (!empty($editFirstname)) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("update Users set firstname=:firstname where id = :id ");
            $statement->bindValue(':firstname', $editFirstname);
            $statement->bindValue(':id', $id);
            $statement->execute();
            header("Location: ./profileSettings.php");
        }
    }

    public function updateLastname($id, $editLastname)
    {
        if (!empty($editLastname)) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("update Users set lastname=:lastname where id = :id ");
            $statement->bindValue(':lastname', $editLastname);
            $statement->bindValue(':id', $id);
            $statement->execute();
            header("Location: ./profileSettings.php");
        }
    }

    public function updatePassword($id, $editPassword)
    {
        if (!empty($editPassword)) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE Users SET password = :password WHERE id = :id");
            $statement->bindValue(":password", $editPassword);
            $statement->bindValue(":id", $id);
            $statement->execute();
        }
    }

    public function updateBio($id, $editBio)
    {
        if (!empty($editBio)) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("update Users set bio=:bio where id = :id ");
            $statement->bindValue(':bio', $editBio);
            $statement->bindValue(':id', $id);
            $statement->execute();
            header("Location: ./profileSettings.php");
        }
    }

    //This will hash your password using bcrypt
    public function bcrypt($pw)
    {
        $option = [
            'cost' => 12,
        ];
        $hashedPassword = password_hash($pw, PASSWORD_DEFAULT, $option);
        return $hashedPassword;
    }
    
    
    public function validatePasswordRequirements($pw)
    {
        $includesNumber = preg_match("#[0-9]+#", $pw);
        $includesLetter = preg_match("#[a-zA-Z]+#", $pw);
        if (!$includesNumber || !$includesLetter || strlen($pw) < 8) {
            throw new Exception("Password should be at least 8 characters in length and should include at least one upper case letter and one number.");
        } else {
            return true;
        }
    }
    

    //this will be check of your account is private
    public function privateAccount(){
        $id = $this->getUserId();
        $privatecheck = $this->getPrivatecheck();
        $conn = Db::getConnection();
        if($privatecheck == 0){
            $statement = $conn->prepare("UPDATE Users SET privateAccount=0 WHERE id = :id");
            $statement->bindValue(':id', $id);
            $statement->execute();

        }elseif ($privatecheck == 1){
            $statement = $conn->prepare("UPDATE Users SET privateAccount=1 WHERE id = :id");
            $statement->bindValue(':id', $id);
            $statement->execute();
           
        }
    }
    
    public function loadUsersByQuery($query){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM Users WHERE username LIKE :query");
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();
        $foundUsers = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $foundUsers;
    }

}