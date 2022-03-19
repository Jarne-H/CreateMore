<?php
//Pagina verwijst door naar login

//Kijken of velden leeg zijn
//Als ze leeg zijn --> error true
//Connectie maken met database
// email moet op @thomasmore.be eindigen

if (!empty($_POST)) {

	$email = $_POST['email'];
	$options = ['cost' => 14,];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordconf = $_POST['password_conf'];

		$conn = new PDO('mysql:host=localhost;dbname=createmore', "root", "root");
		$query  = $conn->prepare("insert into user ( email, username, password, profilepic, savedPostId, likedPostId, toolsId) VALUES ( :email, :username, :password, NULL, NULL, NULL, NULL)
		");

		if (stripos($email, '@student.thomasmore.be') !== false || stripos($email,'@thomasmore.be')) {
			$query  = $conn->prepare ("select * from user where email = '$email'");
			$query -> execute();
			$result = $query->rowCount();

			if ($result === 1){
				$error = true;
			}
			else {
		
		
		

		if (  $password === $passwordconf && strlen($password)>=6) {

			$password = password_hash($_POST['password'] . "SDF0303", PASSWORD_DEFAULT, $options);
			$query ->bindValue(":email", $email);
			$query ->bindValue(":username", $username);
			session_start();

			$query ->bindValue(":password", $password);
			$query ->execute();
			header("Location: logIn.php");

			
			
		}

		}
	}
		else {
			$error = true;
		}
	





}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="./CSS/style.css"> 
	<link rel="stylesheet" type="" href="">
</head>
<body>
	<div id="header">
		<div class="logo"></div>
	</div>
	<div id="main">
		<h1>create More</h1>
        <h3>Maak een account aan</h3>
		<div class="loginfb"></div>
		<div class="linel"></div>
		<div class="liner"></div>
		<div id="form">
			<form method="post" action>
			
				<div>
                    <label for="email">E-mail</label>
                    <input name="email" placeholder="E-mail adres" type="email" required autofocus/>
                </div>
				<?php if(isset($error)):?>
				<div class="errorMessage">
					<p><?php echo $error?></p>
				</div>
				<?php endif;?>

				
			
				<div>
                    <label for="username">Gebruikersnaam</label>
                    <input name="username" placeholder="Gebruikersnaam" type="text" required/>
                </div>
				<?php if(isset($error)):?>
				<div class="errorMessage">
					<p>Gebruikersnaam mag niet leeg zijn</p>
				</div>
				<?php endif;?>

			

                <div>
                    <label for="password">Wachtwoord</label>
                    <input name="password" placeholder="Wachtwoord" type="password" required/>
                </div>
				<?php if(isset($error)):?>
				<div class="errorMessage">
					<p>Wachtwoord moet minstens 6 karakters lang zijn.</p>
					<p>E-mail bestaat al</p>
				</div>
				<?php endif;?>


                <div>
                    <label for="password_conf">Wachtwoord bevestigen</label>
                    <input name="password_conf" placeholder="Wachtwoord bevestigen" type="password" required />
                </div>
				<?php if(isset($error)):?>
				<div class="errorMessage">
					<p>Wachtwoorden komen niet overeen.</p>
				</div>
				<?php endif;?>
			
		<div class="user-messages-area">
			<div class="alert alert-danger">
				
			<input type="submit" value="Meld je aan" class="btn">
					<ul>
					

			</div>
		</div>
		</form>

	
</body>
</html>