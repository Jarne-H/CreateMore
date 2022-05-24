<?php 
    include_once(__DIR__ . "/../bootstrap.php");
if (!empty($_POST)) {
//nEW COMMENT MAKEN
    $c = new Comment();
    //$_SESSION['username'] = $c->getUserName();
    $c-> setPostId($_POST['postId']);
    $c->setText($_POST['text']);
    $c->setUserName($_POST['username']);
    
    //Best vanuit session
    //var_dump($_SESSION['username']);

    
//save
    $c->saveComment();
//response?
$response = [
    'status' => 'success',
    'body' => htmlspecialchars($c->getText()),
    'user' => htmlspecialchars($c->getUserName()),
    'message' => 'comment saved'


];
header('Content-type: application/json');
echo json_encode($response);
//Hier wordt je message encode naar json

//Stel juiste headers in, zeg dat je json terug geeft, javascript kan geen php runnen, enkel json

}


