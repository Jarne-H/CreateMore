<?php

//include_once(__DIR__ . "/classes/User.php");
include_once("bootstrap.php");


//Pagina verwijst door naar login

//Kijken of velden leeg zijn
//Als ze leeg zijn --> error true
//Connectie maken met database
// email moet op @thomasmore.be eindigen

if (!empty($_POST)) {
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordconf = $_POST['password_conf'];

	
		/*$user = new User();
		$user->setEmail($_POST['email']);
		$user->setUsername($_POST['username']);
		$user->setPassword($_POST['password']);*/
	
		
	
	

	/*$user->getEmail() = $_POST['email'];*/
	/*$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordconf = $_POST['password_conf'];
	*/

	
		
//Als het wachtwoord hetzelfde is als passwordconf en als ze minstens 6 characters zijn dan wordt je ingelogd
		if (  $password === $passwordconf && strlen($password)>=6) {

				try {
				$user = new User();
				$user->setUsername($username);
				$user->setEmail($email);
				$user->setPassword($password);
				$user->SignUp();
				session_start();
				$_SESSION['username'] = $user->getUsername();
				header("Location: logIn.php");
				}

				catch (Throwable $error) {
					//$error = $error->getMessage();
					var_dump($error);

					switch ($error = $error->getMessage()) {
						case "Dit e-mail adres bestaat al":
							$errorEmail = $error;
						break;

						case "E-mail adres moet op @student.thomasmore.be of @thomasmore.be eindigen":
						$errorEmail = $error;

						break;

						case "Deze gebruikersnaam bestaat al":
							$errorUser = $error;
							
						/*case "Gebruikersnaam kan niet leeg zijn":
						$errorUser = $error;
						break;*/
						/*case "Wachtwoord moet minstens 6 characters lang zijn":
							

							$errorPass = $error;
						/*case "Wachtwoord moet minstens 6 characters lang zijn":
							$errorPass = $error;*/
							
					}
					
				}
				/*catch (Throwable $errorUser) {

					$errorUser = $errorUser->getMessage();
				}*/

}
if ($password !== $passwordconf){
		
	$errorPass2 = "Wachtwoorden komen niet overeen";

}
if (strlen($password)<6) {
	$errorPass = "Wachtwoord moet minstens 6 characters lang zijn!";
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
		
				<div class="inputfields">
                    <label for="email">E-mail</label>
                    <input name="email" placeholder="E-mail adres" type="email" required autofocus/>
                </div>
				<?php if(isset($errorEmail)):?>
				<div class="errorMessage">
					<p><?php echo $errorEmail?></p>
				</div>
				<?php endif;?>

				<div class="inputfields">
                    <label for="username">Gebruikersnaam</label>
                    <input name="username" placeholder="Gebruikersnaam" type="text" required/>
                </div>
				<?php if(isset($errorUser)):?>
				<div class="errorMessage">
					<p><?php echo $errorUser?></p>
				</div>
				<?php endif;?>

			

                <div class="inputfields">
                    <label for="password">Wachtwoord</label>
                    <input name="password" placeholder="Wachtwoord" type="password" required/>
                </div>
				<?php if(isset($errorPass)):?>
				<div class="errorMessage">
				<p><?php echo $errorPass?></p>
					
				</div>
				<?php endif;?>
                <div class="inputfields">
                    <label for="password_conf">Wachtwoord bevestigen</label>
                    <input name="password_conf" placeholder="Wachtwoord bevestigen" type="password" required />
                </div>
				<?php if(isset($errorPass2)):?>
				<div class="errorMessage">
				<p><?php echo $errorPass2?></p>
				</div>
				<?php endif;?>
		
				<div>
				<input type="submit" value="Meld je aan" id="btn">
				</div>

		</div>
		</form>

		<p id="hebaccount">Heb je al een account? <a href="./logIn.php">Login in</a></p>

	
</body>
</html>