<?php
class like {
private $postId;
private $username;

public function getPostId() {
    return $this->postId;

}
public function setPostId($postId) {
    $this->postId = $postId;


}
public function getUsername() {
    return $this->username;

}
public function setUsername($username) {
    $this->username = $username;

    return $this;
} 
public function saveLike() {
    $username= $this->getUsername();
    //$text = $this->getText();
    $postId = $this->getPostId();


    $conn = Db::getInstance();
    $statement = $conn->prepare("insert into likes (postId,username,dateCreated) values (:postId, :username,Now())");
    $statement->bindValue(":postId", $postId);
    $statement->bindValue(":username", $username);
    $result =  $statement->execute();
    return $result;


}
public static function getAmount($postId) {
        $conn = DB::getInstance();
        $statement = $conn->prepare("select * from likes where postId = :postId");
        $statement->bindValue(":postId", $postId);
         $statement->execute();

        $result = $statement->rowCount();
         return $result;

     

    }
    public function unLike()
 {  
    $username= $this->getUsername();
    //$text = $this->getText();
    $postId = $this->getPostId();

        $conn = DB::getInstance();
        $statement = $conn->prepare("delete from likes where postId =:postId AND username = :username");
        $statement->bindValue(":postId", $postId);
        $statement->bindValue(":username",$username);
        $result = $statement->execute();

         return $result;



 }


}