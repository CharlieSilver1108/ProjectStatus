<?php
    $servername ="localhost";
    $username = "username";
    $password = "password";
    $dbname = "database";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    echo"Connected successfully" . "<br>";

    $sql = "UPDATE `status`
        SET 
        `status` = 0";

    if ($conn->query($sql)==True){
        echo "New record created successfully";
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>