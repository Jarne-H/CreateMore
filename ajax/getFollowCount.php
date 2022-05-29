<?php

require_once('bootstrap.php');

session_start();
$username = $_GET["username"];

$user = new User();
$user->setUsername($username);

echo $user->getFollowCount();