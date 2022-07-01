<?php
    //Reference to the connection details
    require("../require/connection.php");
    
    //Grab session variables
    session_start();

    //Show any errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Grab the variables from the POST request that has been sent
    if(isset($_POST['password'])) {$password = $_POST['password'];}
    if(isset($_POST['confirmPassword'])) {$confirmPassword = $_POST['confirmPassword'];}
    if(isset($_POST['username'])) {$username = $_POST['username'];}
    echo($username. $password. $confirmPassword);

    if((isset($password) && isset($confirmPassword)) && $password != "") {
        if($password === $confirmPassword) {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = 'UPDATE Student
                SET Password ="'.$hashPassword.'", Username = "'.$username.'" 
                WHERE StudentID = '. $_SESSION['id'];
            $connection->query($query);
            header("Location: /student/profile?success=Profile password updated");
        } else {
            header("Location: /student/profile?error=The two passwords you entered do not match");
        }
    } else {
        $query = 'UPDATE Student
                SET Username = "'.$username.'" 
                WHERE StudentID = '. $_SESSION['id'];
        $connection->query($query);
        header("Location: /student/profile?success=Profile username updated");
    }
?>