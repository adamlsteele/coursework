<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../require/connection.php");
    session_start();

    echo($accountType = $_POST['accountType']);
    echo($username = $_POST['name']);
    echo($email = $_POST['email']);
    echo($password = $_POST['password']);
    echo($confirmPassword = $_POST['confirmPassword']);

    if($password != $confirmPassword || (strlen($password) == 0)) {
        header("Location: /signup?error=Two passwords entered do not match");
        die;
    }

    if($accountType == "student") {
        $result = $connection->query('SELECT * FROM Student WHERE Email = "'.$email.'"');
        echo $noRows = $result->num_rows;

        if($noRows > 0) {
            header("Location: /signup?error=Student account already exists");
            die;
        }

        if($connection->query("INSERT INTO Student(Username, Email, Password) VALUES ('".$username."', '".$email."', '".password_hash($password, PASSWORD_DEFAULT)."')") == true) {
            header("Location: /student/index");
            $_SESSION['auth'] = true;
            $_SESSION['type'] = "student";
            $_SESSION['id'] = $connection->insert_id;
        }

    }else if($accountType == "teacher") {
        $result = $connection->query('SELECT * FROM Teacher WHERE Email = "'.$email.'"');
        echo $noRows = $result->num_rows;

        if($noRows > 0) {
            header("Location: /signup?error=Teacher account already exists");
            die;
        }

        if($connection->query("INSERT INTO Teacher(Username, Email, Password) VALUES ('".$username."', '".$email."', '".password_hash($password, PASSWORD_DEFAULT)."')") == true) {
            header("Location: /teacher/");
            $_SESSION['auth'] = true;
            $_SESSION['type'] = "teacher";
            $_SESSION['id'] = $connection->insert_id;
        }
    }
?>