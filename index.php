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
    <title>PHP2</title>
</head>
<body>
    <h1>Logowanie</h1>

    <form action="zaloguj.php" method="post">
        <p>login</p>
        <input type="text" name="login" />
            <br><br>
        <p>haslo</p>
        <input type="password" name="password" />
            <br><br>
        <input type="submit" action="Zaloguj" />

    </form>

    <br>

<?php
    if(isset($_SESSION['blad'])){ 
        echo $_SESSION['blad'];
    }  
?>
    
</body>
</html>