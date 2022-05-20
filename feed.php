<?php 
//Als mensen op deel project klikken, dan komt het project in de databank te staan en dan worden deze in de feed weergegeven.
//De posts worden geprint als een lijst in chronologische volgorde
//Niet ingelogde gebruikers kunnen deze nog wel zien, maar geen naam of comments
//Ingelogde gebruikers kunnen alle nodige details zien
//Toon per pagina maximum
//Je kan bladeren
//Maak connectie met databank

include_once(__DIR__ . "./includes/nav.inc.php");
include_once("bootstrap.php");
    



$limit = 12;
if (isset($_GET['p'])) {

$pagina = $_GET['p'];
$limit = $limit * $pagina;
//var_dump($limit);

}
//var_dump($feed);
    if (isset($_SESSION['username'])) {
        $feed = [];
    
        $post = new feed();
        $feed = $post->LoggedIn($limit);
    
    while(count($feed)> 12) {

        //rest van afbeeldingen wordt ingeladen op de pagina.
        $feed = array_slice($feed, 12);


    }
    echo "Logged in";
        //Als je op de pijltjes drukt dan ga je naar volgende of vorige pagina, als er meer dan 12 submission zijn dan gaan ze rechtsreeks naar de volgende pagina.
        

}
else {
    $feed = [];

        $post = new feed();
$feed = $post->notLoggedIn($limit);
while(count($feed)> 12) {

    //rest van afbeeldingen wordt ingeladen op de pagina.
    $feed = array_slice($feed, 12);


}

echo "not logged in";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./CSS/style.css"> 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="body">
    <!--<input type="button" value="Deel project">-->

    <div class="feed">

    <!-- In de div feed komen er images, titels, descriptions enz-->
    
    <?php foreach($feed as $key => $f): ;?>
    <div id="feed-post">
    <?php if (isset($_SESSION['email'])) :?>
        
        <h3><?php echo htmlspecialchars($f['username'])?></h3>
        <?php endif; ?>
        <a href="feedDetail.php?post=<?php echo $key ?>">
        <img id="feed-image" src=<?php echo  htmlspecialchars($f['filename'])?> alt="Foto">
        </a>
        <?php if (isset($_SESSION['username'])):?>
            <div class="likes">
        <p><span><?php echo 0?></span><img id="like" src="actie.png" alt="like"></p>
        <p><span><?php echo 0?></span><img id="comment"src="comment.png" alt="comment"></p>
        </div>
        <?php endif;?>
        </div>

    <?php endforeach;?>
        </div>
                <a href="feed.php?p=<?php if ($pagina <2){ echo 1 ;} else {echo $pagina - 1;} ?>" id="leftButton"><img class="arrow" src="lArrow.png" alt="left Arrow"></a>
                <a href="feed.php?p=<?php if (count($feed)<12){echo $pagina;} else { echo $pagina+1;}  ?>" id="rightButton"><img class="arrow"src="rArrow.png" alt="right Arrow"></a>

    
  <div id="downloadButton"> 
         <a  href="post.php"><button id="download" ><img src="./download.png" alt=""></button></a>
         </div>    
</body>
</html>