<?php       #this is called from IPATH each time I want to connect to my php server
    $servername ="localhost";
    $username = "username";
    $password = "password";
    $dbname = "database";

    $conn = new mysqli($servername, $username, $password, $dbname); #using SQLi
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);  #If an error occurs then it is outputed
    }
?>