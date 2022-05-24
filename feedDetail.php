<?php 
 
    //$title = $_GET['title'];
    //include_once(__DIR__ . "./includes/nav.inc.php");
    include_once("bootstrap.php");
    include_once(__DIR__ . "./includes/nav.inc.php");
    //session_start();
    $limit = 12;
    $key = $_GET['post'];

    //$feed = [];
    $post = new feed();

    $feed = $post::getPostById($key);
    //$like = new like();
   // $l = $like::
    //var_dump($feed);
    
    $allComments = comment::getTheComment($key);
    $likes = like::getAmount($key);
    //var_dump($likes);
    $comment = comment::amountOfComments($key);

//var_dump($_GET);
//echo $key;
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
    <h2><?php echo $feed['username']?></h2>
    <img src="<?php echo $feed['filename']?>" alt="">
    <h3><?php  echo $feed['userId']?></h3>
    <h2><?php echo htmlspecialchars($feed['title'])?></h2>
    <p><?php echo htmlspecialchars ($feed['description']) ?></p>
    <p><?php echo htmlspecialchars ($feed['tags'])?></p>
</div>


<form action="" method="post">
<input id="textComment" name="comment" placeholder="Comment text" type="text" required contenteditable="99"/>
<input id="submitComment" type="submit" value="plaats comment" data-postId="<?php echo $key ?>" data-username = "<?php echo $_SESSION['username'] ?>">
<a href="#" name = "like"class="like" data-postId = "<?php echo $key?>" data-username = "<?php echo $_SESSION['username'] ?>"><img id="heart" src="unknown.png" alt=""></a>

</form>
<p>Amount of likes: <span class="amount"><?php echo $likes?></span></p>
<p>Amount of comments: <span class="amountOfComments"><?php echo $comment ?></span></p>


<ul class="commentList">
    <?php foreach($allComments as $c):  ?>
    <li>  <?php echo  $c['username'] ." ". $c['comment'] ?></li>
    <?php endforeach;?>
 </ul>
   


<script src="app.js"></script>
</body>
</html>