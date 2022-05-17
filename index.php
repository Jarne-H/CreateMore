<?php 

include_once(__DIR__ . "./includes/nav.inc.php");
//session_start();
if (isset($_SESSION['username'])){
  echo "welcome" . $_SESSION['username'];
}
else {
  header("location: logIn.php");
}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="./CSS/style.css">    
</head>
<body>

    <h1 class="titel">Er zijn nog geen projecten gedeeld</h1>
    <p class="subtitel">Start met je eerste project te delen aan andere.</p>
  

  <div class="buttonCenter">
      <a href="post.php"><button>deel project</button></a>
  </div>



</body>
</html>

