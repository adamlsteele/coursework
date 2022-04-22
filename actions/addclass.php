<?php
    //Reference to the connection details
    require("../require/connection.php");
    
    //Grab session variables
    session_start();

    //Show any errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Grab the code from the post request that the user entered
    $code = $_POST["code"];

    //Check to see if a class with the code exists
    $result = $connection->query('SELECT * FROM Class WHERE `Class Code` = "'.$code.'"');
    echo $noRows = $result->num_rows;

    if($noRows != 0) {
        //Updat the student record so they can be associated with a class
        $classDetails = $result->fetch_assoc();
        $query = $connection->query(
            'UPDATE Student
            SET ClassID = '.$classDetails["ClassID"].'
            WHERE StudentID = '.$_SESSION['id'].';'
        );
        header("Location: /");
    }else{
        //Redirect if a class with the code doesn't exist
        header("Location: /student/index?error=The code you entered does not match to a class.");
    }



?>