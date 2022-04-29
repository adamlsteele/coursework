<?php
    //Show any errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Grab session wide variables
    session_start();
    require("../require/connection.php");

    //Syntax to update the student record so that their class is set to NULL
    $query = "UPDATE Student
        SET ClassID = NULL
        WHERE StudentID = '".$_SESSION['id']."'";
    //Execute query
    $sql = $connection->query($query);

    //Redirect user to the root page
    header("Location:/");

    
?>