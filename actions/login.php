<?php
    require("../require/connection.php");
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($_GET['type'] == "student") {
        $result = $connection->query("SELECT * FROM Student WHERE Email = '".$email."'");
        $row = $result->fetch_assoc();
        echo $result->num_rows."\n rows.\n";
        if ($row != null) {
            echo "\nHash = ".$row['Password'];
            echo "\nVerify = ". password_verify($password, $row['Password']);
            if (password_verify($password, $row['Password'])) {
                echo "Verified";
                $_SESSION['auth'] = true;
                $_SESSION['type'] = "student";
                $_SESSION['id'] = $row['StudentID'];
                header("Location: /student/index");
                die;
            }
        }
    }

    if($_GET['type'] == "teacher") {
        $result = $connection->query("SELECT * FROM Teacher WHERE Email = '".$email."'");
        $row = $result->fetch_assoc();
        echo $result->num_rows."\n rows.\n";
        if ($row != null) {
            echo "\nHash = ".$row['Password'];
            echo "\nVerify = ". password_verify($password, $row['Password']);
            if (password_verify($password, $row['Password'])) {
                echo "Verified";
                $_SESSION['auth'] = true;
                $_SESSION['type'] = "teacher";
                $_SESSION['id'] = $row['TeacherID'];
                header("Location: /teacher/");
                die;
            }
        }
    }

    header("Location: /?error=Invalid details");
?>