<?php

session_start();

if(isset($_SESSION['loged']) && ($_SESSION['loged'] == true)){

    header('Location: main.php');
    exit();

}

$all_good = true;
$login = $_POST['login'];

// login

if ((strlen($login)<3) || (strlen($login)>15)){

    $all_good = false;
    $_SESSION['e_login']="Login musi posiadać od 3 do 15 zanków!";

}

if (ctype_alnum($login)==false){

    $all_good=false;
    $_SESSION['e_login']="Login może zawierać znaki alfanumeryczne!";

}

//email

$email = $_POST['email'];
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB != $email)){
    $all_good=false;
    $_SESSION['e_email']="Podaj poprawny adres e-mail (bez znaków nie alfanumerycznych)!";
}

if ($all_good==true){

    echo "gid gud";

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP2</title>
    <style>

    .error{
        color: red;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    </style> 
</head>
<body>

    <form method="post">
        <p>Login</p>
        <input type="text" name="login" />

        <?php 
        
        if (isset($_SESSION['e_login'])){
            echo '<div class="error">'.$_SESSION['e_login'].'</div>';
            unset($_SESSION['e_login']);
        }
        ?>
            <br>
        <p>E-mail</p>
        <input type="text" name="email" />

        <?php 
        
        if (isset($_SESSION['e_email'])){
            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
            unset($_SESSION['e_email']);
        }
        ?>

            <br>
        <p>Hasło</p>
        <input type="password" name="password1" />
            <br>
        <p>Powtórz hasło</p>
        <input type="password" name="password2" />
        <input type="submit" value="Zarejestrój" />

    </form>
    
</body>
</html>