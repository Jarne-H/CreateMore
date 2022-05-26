<?php 
class Profile
{
    private $username;
    private $currentPassword;
    private $newPassword;
    private $values; 
    private $foto;

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
     * Get the value of current password
     */
    public function getCurrentPassword()
    {
        return $this->currentPassword;
    }

    /**
     * Set the value of current password
     *
     * @return  self
     */
    public function setCurrentPassword($password)
    {
        $this->currentPassword = $password;

        return $this;
    }


    /**
     * Get the value of new password
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set the value of new password
     *
     * @return self
     */
    public function setNewPassword($password)
    {
        $options  = ['cost' => 12];
        $password = password_hash($password, PASSWORD_DEFAULT, $options);
        $this->newPassword = $password;

        return $this;
    }

     /**
     * Get the value of values
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set the value of values
     *
     * @return  self
     */
    public function setValues($values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * Get the value of current foto
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of current foto
     *
     * @return  self
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }



    public function getInfo() {
        $conn = DB::getInstance();
        $statement = $conn->prepare("select * from `user` where username = :username");
        $statement->bindValue(":username", $this->username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Als de gebruiker geen foto heeft, standaard foto tonen
        if(empty($result['profilepic'])){
            $result['profilepic'] = "profiel.jpg";
        }

        return $result;
    }

    public function updateInfo() {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE `user` SET tweedeEmail = :tweedeEmail, bio = :bio, opleiding = :opleiding, facebook = :facebook, instagram = :instagram WHERE username = :username");
        
        $statement->bindValue(":username", $this->username);
        $statement->bindValue(":tweedeEmail", $this->values["tweedeEmail"]);
        $statement->bindValue(":bio", $this->values["bio"]);
        $statement->bindValue(":opleiding", $this->values["opleiding"]);
        $statement->bindValue(":facebook", $this->values["facebook"]);
        $statement->bindValue(":instagram", $this->values["instagram"]);

        $statement->execute();
    }

    public function checkPassword(){
        $conn = DB::getInstance();
        //query
        $statement = $conn->prepare("select * from user where username = :username");
        $statement->bindValue(":username", $this->username);
        $statement->execute();
        //user connecteren met username
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            throw new Exception('Deze gebruiker bestaat niet.');
        }

        $hash = $result["password"];
        if(password_verify($this->currentPassword, $hash)){
            // passwoord komt overeen
            return true;
        } else{
            // passwoord komt niet overeen
            return false;
        }
    }

    public function updatePassword() {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE `user` SET `password` = :password WHERE `username` = :username");
        $statement->bindValue(":password", $this->newPassword);
        $statement->bindValue(":username", $this->username);

        $statement->execute();
    }

    public function updateFoto() {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE `user` SET `profilepic` = :pad WHERE `username` = :username");
        $statement->bindValue(":pad", $this->foto);
        $statement->bindValue(":username", $this->username);

        $statement->execute();
    }
}
?>