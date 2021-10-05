<?php
session_start();
require_once("queries.php");
if (isset($_SESSION['user'])){
    $userId = $_SESSION['user'];
    if (isset($_POST['save'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $noteId = $_POST['id'];
        $editRes = editData("note","content ='$content',noteTitle='$title'","id=$noteId");
    }
}
else {
    header("location:login.php");
    exit;
}
?>