<?php 

class comment {

    private $userId;     //Er moet een userId uit de database gehaald worden die hetzelfde is als de id van tabel user
    private $text; //De tekst die wordt ingevoerd in het invoerveld
    private $postId; //Het Id van de post dat gelijk staat aan id uit tabel post

    public function getUserName() {
        return $this->userId;


    }
    public function setUserName($valueUser) {
     
        $this->userId = $valueUser;
        return $this;
    }
    public function getText() {
        return $this->text;

    }
    public function setText($valueText) {

        if (!empty($_POST['comment'])) {
        $this->text = $valueText;
        }
        return $this;

    }
    public function getPostId() {
        return $this->postId;
    }
    public function setPostId($valuePost) {
        $this->postId = $valuePost;
        return $this;
    }

    public function saveComment() {

        $userId = $this->getUserName();
        $text = $this->getText();
        $postId = $this->getPostId();


        //Connectie met databank maken
        $conn = DB::getInstance();
        //voeg het geen dat je post in de database
        $statement = $conn ->prepare("insert into comments (username, comment, postId) values (:username, :comment, :postId)");
        $statement->bindValue(":comment", $text);
        $statement->bindValue(":username", $userId);
        $statement->bindValue(":postId", $postId);

       $result =  $statement->execute();

        return $result;
        

    }
    public static function getTheComment($postId) {
        $conn = DB::getInstance();
        $statement = $conn->prepare("select * from comments where postId = :postId");
        $statement->bindValue(":postId", $postId);
         $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
    public static function amountOfComments($postId) {
        $conn = DB::getInstance();
        $statement = $conn->prepare("select * from comments where postId = :postId");
        $statement->bindValue(":postId", $postId);
         $statement->execute();

        $result = $statement->rowCount();
         return $result;

    }

}



