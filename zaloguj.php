<?php

session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['password']))){
    header('Location: index.php');
    exit();
}


require_once "connect.php";

$connect = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connect->connect_errno!=0){

    echo "Error: ".$connect->connect_errno ." Opis: ".$connect->connect_error;

}
else{

    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "utf-8");
    $password = htmlentities($password, ENT_QUOTES, "utf-8");

    if ($result = @$connect->query(
        sprintf("SELECT * FROM uzytkownicy WHERE login='%s' AND password='%s'",
        mysqli_real_escape_string($connect,$login),
        mysqli_real_escape_string($connect,$password)))){

        $good_row_num = $result->num_rows;

        if($good_row_num == 1){

            $_SESSION['loged'] = true;

            $record = $result->fetch_assoc();
            $_SESSION['id'] = $record['id'];
            $_SESSION['login'] = $record['login'];
            $_SESSION['e-mail'] = $record['e-mail'];

            $result->free();

            unset($_SESSION['blad']);

            header('Location: main.php');
        }
        else{

            $_SESSION['blad'] = '<span>Nieprawidłowy login lub haslo</span>';
            header('Location: index.php');

        }
    }

    $connect->close();
}



?>