<?php
    //Grab session variables, destroy session variables and then redirect to index
    session_start();
    session_destroy();
    header("Location: /");
?>