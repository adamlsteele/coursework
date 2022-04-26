<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require("../require/connection.php");

    $query = "UPDATE Student
        SET ClassID = NULL
        WHERE StudentID = '".$_SESSION['id']."'";
    $sql = $connection->query($query);

    header("Location:/");

    
?>