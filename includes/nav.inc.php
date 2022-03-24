<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <h1>CreateMore</h1>
        <a href=""><h3>Alle projecten</h3></a>
        <a href=""><h3>Mijn projecten</h3></a>

        <input type="text" placeholder="Zoeken..">
        
        <p>Welkom, <?php echo $_POST['username']; ?></p>
        <a href="profile.php"><img class="pic" src="" alt="profielfoto"></a>
    </nav>
</body>
</html>