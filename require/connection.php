<?php
    //Connection variables
    $host = "localhost";
    $username = "root";
    $database = "cloud_coding";

    //Connection string
    $connection = new mysqli($host, $username, "", $database);

    //Check for any errors and print them if so
    if ($connection->connect_error) {
        die("Connection could not be established: ".$connection->connect_error);
    }
?>