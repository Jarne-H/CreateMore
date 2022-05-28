<?php

require_once('../bootstrap.php');

session_start();
$follower = $_SESSION["username"];
$toFollow = $_GET["username"];

$user = new User();
$user->setUsername($follower);

if($follower != $toFollow){
    if($user->doesFollow($toFollow)){
        // Gebruikter volgt al, ontvolg
        $user->unfollow($toFollow);
    }else{
        // Gebruikter volgt nog niet, volg
        $user->follow($toFollow);
    }
}


