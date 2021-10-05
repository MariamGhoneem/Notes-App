<?php
session_start();
require_once("queries.php");
if (isset($_SESSION['user'])){
    $userId = $_SESSION['user'];
    $res = getData("users","*","id=$userId");
    while ($userData = mysqli_fetch_assoc($res)) {
        $userName = $userData['username'];
        $pass = $userData['password'];
        $email = $userData['email'];
    }
}
else {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notes</title>
    <link rel="stylesheet" href="style.css"></link>
    <script src="js/notes.js"></script>
</head>
<body>
    <div class="toolbar">
    <input type="button" class="toolbar-button" value="Go back!" onclick="history.back()">
    </div>
    <div class="title">
        <h6>Edit Your Data</h6>
    </div>
    <div style="text-align: center;">
        <form method="POST" action="updatedata.php">
            <label>User Name: </label> <input type="text" placeholder="<?= $userName;?>" name="name"><br/><br/>
            <label>Password: </label> <input type="text" placeholder="<?= $pass;?>" name="pass"><br/><br/>
            <label>E-mail: </label> <input type="text" placeholder="<?= $email;?>" name="mail"><br/><br/><br/>
            <input type="submit" name="save" value="Update">
        </form>
    </div>
</body>