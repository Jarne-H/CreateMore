<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    if(!empty($_GET)){
        $currentprofilepage = $_GET["profile"];
    }
    else{
        $currentprofilepage = "unknown";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "CreateMore: " . $currentprofilepage;?></title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    <p>testerjes</p>
</body>
</html>