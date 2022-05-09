<?php
error_reporting(0);
?>
<?php

include_once(__DIR__ . "./includes/nav.inc.php");
include_once("bootstrap.php");

if (isset($_POST['upload'])) {
    try {
        // var_dump($title);
        // var_dump($description);
        // var_dump($tags);
        echo "oké!";
        Post::uploadPost($_POST['title'], $_POST['description'], $_POST['tags']);
        // header("Location:index.php");
    } catch (Exception $e) {
        echo "niet oké!";
        $error = $e->getMessage();
    }


}

// $msg = "";

// // If upload button is clicked ...
// if (isset($_POST['upload'])) {

//     $title = $_POST['title'];
// 	$description = $_POST['description'];
// 	$tags = $_POST['tags'];


// 	$filename = $_FILES["uploadfile"]["name"];
// 	$tempname = $_FILES["uploadfile"]["tmp_name"];	
// 		$folder = "image/".$filename;
		
//         //connectie met db
//         $conn = DB::getInstance();
        
//         //query
//         $statement = $conn->prepare("INSERT INTO `post` (filename, title, description, tags) VALUES ('$filename', '$title', '$description', '$tags')");
//         $statement->bindValue(":filename", $filename);
//         $statement->bindValue(":title", $title);
//         $statement->bindValue(":description", $description);
//         $statement->bindValue(":tags", $tags);

// 		// Execute query
// 		// mysqli_query($conn, $sql);
//         $statement->execute();

		
// 		// Now let's move the uploaded image into the folder: image
// 		if (move_uploaded_file($tempname, $folder)) {
// 			$msg = "Image uploaded successfully";
// 		}else{
// 			$msg = "Failed to upload image";
// 	}
// }

// // $conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
// $conn = DB::getInstance();
// $statement = $conn->prepare("SELECT * FROM post");
// $statement->execute();

// // $result = mysqli_query($conn, "SELECT * FROM image");
// while($data = mysqli_fetch_array($result))
// {
// //toont foto's

// }
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Project plaatsen</title>
  <link rel="stylesheet" href="./CSS/style.css">    
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
			
			<div class="square">
				<input name="uploadfile" type="file" id="upload-image" required/>
			</div>


			<div class="fields">
				<div class="inputfields">
					<label for="title">Naam project</label>
					<input name="title" type="text" required/>
				</div>


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
