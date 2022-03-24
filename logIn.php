<?php

	// session_start();

	function canLogin($username, $password){
		try {
			// if($username === "ninja" && $password === "12345") {
			// 	return true;
			// } else {
			// 	return false;
			// }
		
			//connectie met databank
			$conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
			//query maken
			$statement = $conn->prepare("select * from user where username = :username");
			$statement->bindValue(":username", $username);
			$statement->execute();
			//$user = $statement->fetch(PDO::FETCH_ASSOC);
			$user = $statement->fetchAll();
			// if(!$user) {
			// 	return false;
			// }
			// var_dump($user);
			// exit();

			if($username === $username && $password === $password){
				return true;
			}
			else {
				return false;
			}

			// $hash = $user['password'];
			// // var_dump($hash);
			// // $hash = substr( $hash, 0, 60 );
			// if(password_verify($password, $hash)){
			// 	return true;

			// } 
			// else {
			// 	// var_dump(password_verify($password, $hash));
			// 	var_dump($password);
			// 	// echo strlen($hash);
			// 	return false;
				
			// }
		} 
		catch (Throwable $e) {
			echo $e->getMessage();
			return false;
		}



		// try {
		// 	$conn = new PDO('mysql:host=localhost:8889;dbname=createmore', "root", "root");
		// 	$statement = $conn->prepare("select * from users where username = :username");
		// 	$statement->bindValue(":username", $_username); 	// sql injectie = prepare en bind
		// 	$statement->execute();
		// 	$user = $statement->fetch(PDO::FETCH_ASSOC);
		// 	// var_dump($user)
		// 	$hash = $user['password'];
		// 	if(password_verify($_password, $hash)) {
		// 		return true;
		// 	}
		// 	else {
		// 		return false;
		// 	}
		// }

		// catch(Throwable $e) {
		// 	echo $e->getMessage();
		// 	return false;
		// }
	
		

		// echo $user["password"];
		// die();
		// var_dump($password);
		// var_dump("\n");
		// var_dump($user['password']);

		// $hash = $user['password'];
		// if(password_verify($password, $hash)){
		// 	echo "boo";
		// 	return true;
			
		// } else {
		// 	echo "aah";
		// 	return false;
			
		// }
	}

	if(!empty($_POST)){
		//er is gesubmit
		$username = $_POST['username'];
		$password = $_POST['password'];
		// echo $username . $password;

		//check of de user mag inloggen
		if(canLogin($username, $password)){
			session_start();
			$_SESSION['username'] = $username;
			//doorsturen naar index.php
			header("location:index.php");
		} else {
			// echo "komt niet overeen";
			$errorUserPass = "Gebruikersnaam en wachtwoord komen niet overeen.";
			// $error = true;
		}
	}




?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./CSS/style.css">    
	<title>Log in</title>
</head>
<body>
<div id="header">
		<div class="logo"></div>
	</div>
	<div id="main">
		<h1>create More</h1>
        <h3>Log in</h3>
		<div class="loginfb"></div>
		<div class="linel"></div>
		<div class="liner"></div>

		<div id="form">
			<form method="post" action="">

				<div class="inputfields">
                    <label for="username">Gebruikersnaam</label>
                    <input name="username" placeholder="Gebruikersnaam" type="text" required/>
                </div>


                <div class="inputfields">
                    <label for="password">Wachtwoord</label>
                    <input name="password" placeholder="Wachtwoord" type="password" required/>
                </div>

				<?php if(isset($errorUserPass)):?>
				<div class="errorMessage">
				    <p><?php echo $errorUserPass?></p>
				</div>
				<?php endif;?>

		
				<div>
				<input type="submit" value="Log in" id="btn">
				</div>

                <p id="hebaccount">Heb je nog geen account?<a href="/signUp.php">Meld aan</a></p>

		</div>
		</form>

</body>
</html>
