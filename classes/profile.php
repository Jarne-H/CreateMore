<?php

class profile  {

public function setUser($value) {
    $this->username = $value;
}
public function getprofile() {
    

    $conn = DB::getInstance();
    $statement = $conn->prepare("select email from user");
  
    $statement->execute();
    $result = $statement->fetch();
    var_dump($result['email']);
    //return $result;


}
//Haal gegevens uit de databank

//Krijg alle gegevens waar username = jeffrey
//$statement->bindValue(":username", $username);





















}












