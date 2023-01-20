<?php

session_start();

if(isset($_SESSION['loged']) && ($_SESSION['loged'] == true)){

    header('Location: main.php');
    exit();

}


require_once "connect.php";

$connect = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connect->connect_errno!=0){

    echo "Error: ".$connect->connect_errno ." Opis: ".$connect->connect_error;

}
else{

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

    //password

    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ((strlen($password1)<3) || (strlen($password1)>20)){
        $all_good=false;
        $_SESSION['e_password1']="Haslo musi posiadać od 3 do 20 zanków!";
    }

    if ((strlen($password2)<3) || (strlen($password2)>20)){
        $all_good=false;
        $_SESSION['e_password2']="Haslo musi posiadać od 3 do 20 zanków!";
    }

    if ($password1 !== $password2){
        $all_good=false;
        $_SESSION['e_password2']="Halsa muszą być takie same!";
    }


    if ($all_good==true){

        echo "gid gud";

        $sql = "INSERT INTO `uzytkownicy`(`login`, `password`, `e-mail`) VALUES ('$login','$password2','$email')";

        mysqli_query($connect, $sql);

        header('Location: index.php');


    }


    
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

        <?php

        if (isset($_SESSION['e_password1'])){
            echo '<div class="error">'.$_SESSION['e_password1'].'</div>';
            unset($_SESSION['e_password1']);
        }

        ?>
            <br>
        <p>Powtórz hasło</p>
        <input type="password" name="password2" />

        <?php

        if (isset($_SESSION['e_password2'])){
            echo '<div class="error">'.$_SESSION['e_password2'].'</div>';
            unset($_SESSION['e_password2']);
        }

        ?>

        <br><br>

        <input type="submit" value="Zarejestrój" />

    </form>
    
</body>
</html>