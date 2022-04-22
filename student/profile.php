<?php
    require("../require/connection.php");
    session_start();

    if(!isset($_SESSION['auth'])) {
        header("Location: /");
    }else{
        if($_SESSION['auth'] != true && $_SESSION['type'] != "student") {
            header("Location: /");
        }
    }
    
    $result = $connection->query("SELECT * FROM Student WHERE StudentID = ".$_SESSION['id']);
    $details = $result->fetch_assoc();
?>