<?php 
class feed {

    //connectie met de databank
    //
    


    public function notLoggedIn($limit) {

        //var_dump($limit);
        //$limit = 12;
    
        //Als mensen niet ingelogd zijn
        //Dan kunnen ze nog steeds de afbeeldingen zien en titel, maar geen username

        $conn = DB::getInstance();
        $statement =$conn->prepare("select * from post order by id desc limit :limit");
        $statement->bindValue(":limit", $limit,PDO::PARAM_INT);
        //var_dump($limit);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;


    }
    public function loggedIn($limit) {
        //var_dump($limit);
       // $limit = 12;
        $conn = DB::getInstance();
        $statement = $conn->prepare("select * from post order by id desc limit :limit");
        $statement->bindValue(":limit", $limit,PDO::PARAM_INT);
        //var_dump($limit);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;



    }
    public static function getPostById($id) {
        $conn = DB::getInstance();
        $statement = $conn->prepare("select * from post where id = :id");
        $statement->bindValue(":id", $id);
        //var_dump($limit);

        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;


    }
}