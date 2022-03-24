<?php
    // destroy a cookie?
    // setcookie("loggedin", "", time()-60*60);
    session_start();
    session_destroy();
    
    header("Location: login.php");
?>