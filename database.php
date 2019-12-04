<?php
    $hostname = "localhost";
    $username = "monty";
    $password = "AG";
    $database_name = "e_commerce0";

    // Create connection
    $connection = mysqli_connect($hostname, $username, $password, $database_name);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
