<?php 
class Profiel
{
    public function getInfo($username) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from `user` where username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateInfo($username, $waarden) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE `user` SET tweedeEmail = :tweedeEmail, bio = :bio, opleiding = :opleiding, facebook = :facebook, instagram = :instagram WHERE username = :username");
        
        $statement->bindValue(":username", $username);
        $statement->bindValue(":tweedeEmail", $waarden["tweedeEmail"]);
        $statement->bindValue(":bio", $waarden["bio"]);
        $statement->bindValue(":opleiding", $waarden["opleiding"]);
        $statement->bindValue(":facebook", $waarden["facebook"]);
        $statement->bindValue(":instagram", $waarden["instagram"]);

        $statement->execute();
    }

    public function checkPassword($username, $password){
        $conn = DB::getInstance();
        //query
        $statement = $conn->prepare("select * from user where username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        //user connecteren met username
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            throw new Exception('Deze gebruiker bestaat niet.');
        }

        $hash = $result["password"];
        if(password_verify($password, $hash)){
            // passwoord komt overeen
            return true;
        } else{
            // passwoord komt niet overeen
            return false;
        }
    }

    public function updatePassword($username, $password) {
        $options  = ['cost' => 12];

        $password = password_hash($password, PASSWORD_DEFAULT, $options);
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE `user` SET `password` = :password WHERE `username` = :username");
        $statement->bindValue(":password", $password);
        $statement->bindValue(":username", $username);

        $statement->execute();
    }
}
?>