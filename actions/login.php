<?php
    //Reference to the connection details
    require("../require/connection.php");
    
    //Grab session variables
    session_start();

    //Show any errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Grab the email and password that the user entered into the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    //If the type of account they selected is student
    if($_GET['type'] == "student") {
        //Check if the account exists
        $result = $connection->query("SELECT * FROM Student WHERE Email = '".$email."'");
        $row = $result->fetch_assoc();
        echo $result->num_rows."\n rows.\n";
        if ($row != null) {
            echo "\nHash = ".$row['Password'];
            echo "\nVerify = ". password_verify($password, $row['Password']);
            //Check if the password entered matches the stored
            if (password_verify($password, $row['Password'])) {
                echo "Verified";
                //Setup a session and redirect the user if details are correct
                $_SESSION['auth'] = true;
                $_SESSION['type'] = "student";
                $_SESSION['id'] = $row['StudentID'];
                header("Location: /student/index");
                die;
            }
        }
    }

    //If the type of account they selected is teacher
    if($_GET['type'] == "teacher") {
        //Check if account exists
        $result = $connection->query("SELECT * FROM Teacher WHERE Email = '".$email."'");
        $row = $result->fetch_assoc();
        echo $result->num_rows."\n rows.\n";
        if ($row != null) {
            echo "\nHash = ".$row['Password'];
            echo "\nVerify = ". password_verify($password, $row['Password']);
            //Check if the password entered matches the stored
            if (password_verify($password, $row['Password'])) {
                echo "Verified";
                //Setup a session redirecy the user if details are correct
                $_SESSION['auth'] = true;
                $_SESSION['type'] = "teacher";
                $_SESSION['id'] = $row['TeacherID'];
                header("Location: /teacher/");
                die;
            }
        }
    }

    //Redirect the user back to the login page with an error message saying invalid details
    header("Location: /?error=Invalid details");
?>