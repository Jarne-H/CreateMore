<?php
    // destroy session
    session_start();
    session_destroy();
    
    //doorsturen naar login
    header("Location: login.php");
?>
