<?php

session_start();

if(isset($_SESSION['loged']) && ($_SESSION['loged'] == true)){

    header('Location: main.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP2</title>
</head>
<body>
    <h1 class="t1">Logowanie</h1>

    <form action="zaloguj.php" method="post">
        <p>login</p>
        <input type="text" name="login" />
            <br><br>
        <p>haslo</p>
        <input type="password" name="password" />
            <br><br>
        <input class="butt" type="submit" action="Zaloguj" />

    </form>

    <br>
<div class="span">
    <?php
        if(isset($_SESSION['blad'])){ 
            echo $_SESSION['blad'];
        }  
    ?>
</div>

<br><br>

<div class="t1">
    <a class="butt" href="rejestracja.php">Rejestracja!</a>    
</div>

</body>
</html>