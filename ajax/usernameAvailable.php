<?php
include_once(__DIR__ . "../classes/user.php");
if(!empty($_POST)){
    User::checkUsernameAvailable($_POST["username"]);
}
?>