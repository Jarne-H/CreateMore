<?php 
class feed {

    //connectie met de databank

    public function notLoggedIn() {

        //Als mensen niet ingelogd zijn
        //Dan kunnen ze nog steeds de afbeeldingen zien en titel, maar geen username

        $conn = DB::getInstance();
        $statement =$conn->prepare("select *  from post");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;


    }
    public function loggedIn() {
        $conn = DB::getInstance();
        $statement = $conn->prepare("select filename, title, description, tags,toolId, views, postDate, likes, commentId, userId from post");
        $statement->execute();
        $result = $statement->fetch();
        return $result;




    }






























}