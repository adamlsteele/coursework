<?php
    $host = "localhost";
    $username = "root";
    $database = "cloud_coding";

    $connection = new mysqli($host, $username, "", $database);

    if ($connection->connect_error) {
        die("Connection could not be established: ".$connection->connect_error);
    }
?>