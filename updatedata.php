<?php
session_start();
require_once("queries.php");
if (isset($_SESSION['user'])){
    require_once("queries.php");
    $userId = $_SESSION['user'];
    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        $mail = $_POST['mail'];
        editData("users","username='$name',password='$pass',email='$mail'","id=$userId");
        header("location:body.php");
    } 
}
else {
    header("location:login.php");
    exit;
}
?>