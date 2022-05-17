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



//var_dump($feed);
    if (isset($_SESSION['email'])) {

    $feed = [];

    $post = new feed();
    $feed = $post->LoggedIn();

    echo "Logged in";


}
else {
    $feed = [];

        $post = new feed();
$feed = $post->notLoggedIn();

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
    <?php foreach($feed as $f): ;?>
    <div id="feed-post">
    <?php if (isset($_SESSION['email'])) :?>
        <h3><?php echo $f['username']?></h3>
        <?php endif; ?>
        <img id="feed-image" src=<?php echo $f['filename']?> alt="Foto">
        <?php if (isset($_SESSION['email'])):?>
        <p><span><?php echo 0?></span><img src="actie.png" alt="like"></p>
        <p><span><?php echo 0?></span><img src="comment.png" alt="comment"></p>
        <?php endif;?>
        </div>

    <?php endforeach;?>
        </div>
       
                <a href="#" id="leftButton"><img class="arrow" src="lArrow.png" alt="left Arrow"></a>
                <a href="#" id="rightButton"><img class="arrow"src="rArrow.png" alt="right Arrow"></a>
        
    
  <div id="downloadButton"> 
         <a  href=""><button id="download" ><img src="./download.png" alt=""></button></a>
         </div>    
</body>
</html>