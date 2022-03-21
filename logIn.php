<?php

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="css" href="/CSS/style.css">
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

		
				<div>
				<input type="submit" value="Log in" id="btn">
				</div>

                <p id="hebaccount">Heb je nog geen account?<a href="/signUp.php">Meld aan</a></p>

		</div>
		</form>

</body>
</html>
