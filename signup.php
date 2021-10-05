<?php
session_start();
require_once("queries.php");
if(isset($_SESSION['user'])){
    header("location:body.php");
    exit;
} elseif(isset($_POST['signup'])){
    $userName = $_POST['username'];
    $passsword = $_POST['password'];
    $email = $_POST['email'];
    $userData = addData("users","username,password,email","'$userName','$passsword','$email'");
    if($userData){
        $dataRes = getData("users","id","username='$userName' AND password ='$passsword'");
        $data = mysqli_fetch_assoc($dataRes);
        $_SESSION['user'] = $data['id'];
        header("location:body.php");
        exit;
    } else {
        echo "Error!";
    }
} else {
    include_once("signup.html");
}
?>