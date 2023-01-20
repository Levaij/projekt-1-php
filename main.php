<?php

session_start();

if(!isset($_SESSION['loged'])){

    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php



echo "Zalogowano jako ".$_SESSION['login']."! <br>";
echo "Podany e-mail to ".$_SESSION['e-mail']."!";



?>

<br>

<a href="wyloguj.php">Wyloguj</a>
    
</body>
</html>