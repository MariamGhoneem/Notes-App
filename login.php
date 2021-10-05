<?php
session_start();
require_once("queries.php");
if (isset($_SESSION['user'])){
    header("location:body.php");
    exit;
}
elseif(isset($_POST['login'])){
    $userName = $_POST['username'];
    $passsword = $_POST['password'];
    $userData = getData("users","id","username='$userName' AND password = '$passsword'");
    if($userData){
        $data = mysqli_fetch_assoc($userData);
        $_SESSION['user'] = $data['id'];
        header("location:body.php");
        exit;
    } else{
        echo "Incorrect username or password";
        include_once("login.html");
        exit;
    }
} else {
    include_once("login.html");
    exit;
}
?>