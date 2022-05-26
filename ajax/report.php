<?php
require_once('../bootstrap.php');
session_start();

$reporter = $_SESSION["username"];
$toReport = $_GET["username"];

// Voeg to aan database dat $toReport is gerapporteert door $reporter

if($reporter != $toReport){
    $user = new User();
    $user->setUsername($reporter);
    $user->report($toReport);
}
