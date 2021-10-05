<?php
session_start();
require_once("queries.php");
if (isset($_SESSION['user'])){
    $userId = $_SESSION['user'];
    if (isset($_POST['delete'])) {
        $noteId = $_POST['noteId'];
        $noteRes = removeData("note","id=$noteId");
    }
}
else {
    header("location:login.php");
    exit;
}
?>

