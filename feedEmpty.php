<?php 

include_once(__DIR__ . "/includes/nav.inc.php");

//session_start();
if (isset($_SESSION['username'])){
  echo "welcome" . $_SESSION['username'];
  header("location: feed.php");
}
else {
  header("location: login.php");
}


?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="/CSS/style.css">    
</head>
<body>

    <h1 class="titel">Er zijn nog geen projecten gedeeld</h1>
    <p class="subtitel">Start met je eerste project te delen aan andere.</p>
  

  <div class="buttonCenter">
      <a href="post.php"><input type="submit" value="Deel project" id="btn"></a>
  </div>



</body>
</html>

