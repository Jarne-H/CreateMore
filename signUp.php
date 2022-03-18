<?php
//Pagina verwijst door naar login

//Kijken of velden leeg zijn
//Als ze leeg zijn --> error true
//Connectie maken met database
// email moet op @thomasmore.be eindigen
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href=""> 
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
				<input name="email" placeholder="E-mail adres" type="email" required autofocus />
                <input name="password" placeholder="Wachtwoord" type="password" required />
                <input name="password_conf" placeholder="Wachtwoord bevestigen" type="password" required />
				<h5>
					
				</h5>
				<!--input class="btn-toggle btn-toggle-round" id="btn-toggle-1" name="remember" type="checkbox" /><label for="btn-toggle-1"></label><input name="register" type="submit" value="Register" /-->
			</form>
		</div>
		
	</div>

	
		<div class="user-messages-area">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<ul>
					<?php //if(isset($error)):?>
					
					<?php //endif; ?>
				</ul>
			</div>
		</div>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>