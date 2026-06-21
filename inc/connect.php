<?php 
    $servername = "localhost";
    $username = "user";
    $password = "user";
    $dbname = "recycling-donation";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check connection
    if ($conn->connect_error)
    {
        die("Connection Failed: " . $conn->connect_error);
    }
    // echo "Connection Successfully";
?>