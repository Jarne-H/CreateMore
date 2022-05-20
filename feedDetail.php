<?php 
 
    //$title = $_GET['title'];
    //include_once(__DIR__ . "./includes/nav.inc.php");
    include_once("bootstrap.php");
    include_once(__DIR__ . "./includes/nav.inc.php");

    $limit = 12;
    $feed = [];
    $post = new feed();
    $feed = $post->LoggedIn($limit);

    $key = $_GET['post'];

//var_dump($_GET);
echo $key;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css"> 

    <title>Document</title>
</head>
<body>
<div id="detailPage">
    <h2><?php echo $feed[$key]['username']?></h2>
    <img src="<?php echo $feed[$key]['filename']?>" alt="">
    <h3><?php  echo $feed[$key]['userId']?></h3>
    <h2><?php echo htmlspecialchars($feed[$key]['title'])?></h2>
    <p><?php echo htmlspecialchars ($feed[$key]['description']) ?></p>
    <p><?php echo htmlspecialchars ($feed[$key]['tags'])?></p>
</div>


</body>
</html>