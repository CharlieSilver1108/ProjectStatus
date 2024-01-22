<?php
    $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; include($IPATH."connectDB.php");

    $dbCandidateNumber = $_GET["CandidateNumber"];
    $status = $_GET["Status"];

    if ($status == "True"){
        $dbStatus = 1;
    } elseif ($status == "False"){
        $dbStatus = 0;
    } else {
        die("Status Error");
    }

    $sql = "SELECT * FROM `statusids` WHERE CandidateNumber=$dbCandidateNumber;";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    if ($row){
        $dbStatusID = $row['StatusID'];

        $sql = "REPLACE status (StatusID, Status)
        VALUES ('$dbStatusID', '$dbStatus')";
       
        if ($conn->query($sql)==True){
            echo "New currentstatus record created successfully" . "<br>";
        } else{
            echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
        }

        $sql = "INSERT INTO `signinhistory` (`CandidateNumber`, `Status`, `Type`)
                VALUES ($dbCandidateNumber, $dbStatus, 'ONLINE');";
        
        if ($conn->query($sql)==True){
            echo "New signinhistory record created successfully";
        } else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else{
        echo "Error: This student account does not exist";
    }
    



?>