<?php
function addData($table, $col, $val)
{
    $mySQLLink = mysqli_connect("localhost", "root", "", "notes");
    $qInsert = "INSERT INTO $table ($col) VALUES ($val)";
    $boolAdd = mysqli_query($mySQLLink, $qInsert);
    mysqli_close($mySQLLink);
    if ($boolAdd) {
        return true;
    } else {
        return false;
    }
}


function getData($table, $col, $cond)
{
    $mySQLLink = mysqli_connect("localhost", "root", "", "notes");
    $qSelect = "SELECT $col FROM $table WHERE $cond";
    $qRes = mysqli_query($mySQLLink, $qSelect);
    mysqli_close($mySQLLink);
    if (mysqli_num_rows($qRes) > 0) {
        return $qRes;
    } else {
        return false;
    }
}

function editData($table, $colAndVal, $cond)
{
    $mySQLLink = mysqli_connect("localhost", "root", "", "notes");
    $qUpdate = "UPDATE $table SET $colAndVal WHERE $cond";
    $boolUpdate = mysqli_query($mySQLLink, $qUpdate);
    mysqli_error($mySQLLink);
    if (mysqli_affected_rows($mySQLLink) > 0) {
        return true;
    } else {
        return false;
    }
    mysqli_close($mySQLLink);
}

function removeData($table, $cond)
{
    $mySQLLink = mysqli_connect("localhost", "root", "", "notes");
    $qDelete = "DELETE FROM $table WHERE $cond";
    $boolDelete = mysqli_query($mySQLLink, $qDelete);
    mysqli_close($mySQLLink);
    if ($boolDelete) {
        return true;
    } else {
        return false;
    }
}


?>