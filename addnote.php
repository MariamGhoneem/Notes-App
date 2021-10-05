<?php
session_start();
require_once("queries.php");
if (isset($_SESSION['user'])){
    $userId = $_SESSION['user'];
    $noteRes = addData("note","userid","$userId");
}
else {
    header("location:login.php");
    exit;
}

?>