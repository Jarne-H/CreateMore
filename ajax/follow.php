<?php

require_once('../bootstrap.php');

session_start();
$follower = $_SESSION["username"];
$toFollow = $_GET["username"];

// TODO: Voeg to aan database dat $follower $toFollow wilt volgen