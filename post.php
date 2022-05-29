<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ . "/includes/nav.inc.php");
include_once("bootstrap.php");

// include_once("bootstrapsession_start();.php");

// session_start();

// $post = new Post();


    //wanneer op "Post submit" geduwd wordt
    if(!empty($_POST)) {
		try {


			// $filename = $_FILES['uploadfile'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$tags = $_POST['tags'];

			// var_dump($title);
			// var_dump($description);
			// var_dump($tags);
			// echo "oke!";

			// $tags = $_POST['tags'];
			// $tags = explode(" ", $tags);
			$post = new Post();
			$post->setTitle($title);
			$post->setDescription($description);
			$post->setTags($tags);
			$post->addPost();
    } catch (\Throwable $th) {
		//toont errors bij een lege description of image, of bij een fout filetype
		$error = $th->getMessage();
	}
}





?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Project plaatsen</title>
  <link rel="stylesheet" href="/CSS/style.css">    
</head>
<body>
	<div id="header">
		<div class="logo"></div>
	</div>

	<div id="main">
		<!-- <h1>create More</h1> -->
        <h3>Plaats je project</h3>
		<div class="loginfb"></div>
		<div class="linel"></div>
		<div class="liner"></div>

		<!-- formulier -->
		<div id="form">
			<form action="" method="post" enctype="multipart/form-data">
			
			<!-- <div class="square"> -->
				<input name="uploadfile" type="file" id="upload-image" required/>
			<!-- </div> -->
			<!-- <img src=" <?php echo 'image/'.$filename; ?> ">  -->


			<div class="fields">
				<div class="inputfields">
					<label for="title">Naam project</label>
					<input name="title" type="text" required/>
				</div>

				<!-- <img src="<?php echo "image/Artboard 11.png"?>" alt=""> -->

				<div class="inputfields">
					<label for="description">Beschrijving</label>
					<input name="description" type="text" required/>
				</div>


				<div class="inputfields">
					<label for="tags">Tags</label>
					<input name="tags" type="text" required/>
				</div>


				<div>
					<button type="submit" name="upload" id="btn">Uploaden</button>
				</div>
			</div>
			</form>
		</div>
</div>
</body>
</html>
