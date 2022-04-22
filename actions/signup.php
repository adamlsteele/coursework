<?php
    //Display any errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Include connection string
    require("../require/connection.php");
    //Grab session variables
    session_start();

    //Grab all variables from the sign up form
    echo($accountType = $_POST['accountType']);
    echo($username = $_POST['name']);
    echo($email = $_POST['email']);
    echo($password = $_POST['password']);
    echo($confirmPassword = $_POST['confirmPassword']);

    //Redirect back if the two passwords enetered are not verified
    if($password != $confirmPassword || (strlen($password) == 0)) {
        header("Location: /signup?error=Two passwords entered do not match");
        die;
    }

    //If account type is student
    if($accountType == "student") {
        $result = $connection->query('SELECT * FROM Student WHERE Email = "'.$email.'"');
        echo $noRows = $result->num_rows;

        //Check that the student account doesn't already exist
        if($noRows > 0) {
            header("Location: /signup?error=Student account already exists");
            die;
        }

        //Insert a record into the student database
        if($connection->query("INSERT INTO Student(Username, Email, Password) VALUES ('".$username."', '".$email."', '".password_hash($password, PASSWORD_DEFAULT)."')") == true) {
            header("Location: /student/index");
            $_SESSION['auth'] = true;
            $_SESSION['type'] = "student";
            $_SESSION['id'] = $connection->insert_id;
        }

    //If account type is teacher
    }else if($accountType == "teacher") {
        $result = $connection->query('SELECT * FROM Teacher WHERE Email = "'.$email.'"');
        echo $noRows = $result->num_rows;

        //Check that the teacher account doesn't already exist
        if($noRows > 0) {
            header("Location: /signup?error=Teacher account already exists");
            die;
        }

        //Insert a record into the teacher database
        if($connection->query("INSERT INTO Teacher(Username, Email, Password) VALUES ('".$username."', '".$email."', '".password_hash($password, PASSWORD_DEFAULT)."')") == true) {
            header("Location: /teacher/");
            $_SESSION['auth'] = true;
            $_SESSION['type'] = "teacher";
            $_SESSION['id'] = $connection->insert_id;
        }
    }
?>