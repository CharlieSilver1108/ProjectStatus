<!-- This is the page visited when the updateStatus form is submitted -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>404 Error - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <?php
    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
    ?>

    <body>
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <h1 class="display-1">500</h1>
                                    <p class="lead">Internal Server Error</p>
                                    
                                    <?php
                                        $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; 
                                        include($IPATH."connectDB.php");

                                        $dbCandidateNumber = $_POST["canNum"];
                                        $status = $_POST["status"];

                                        $sql = "SELECT * FROM `statusids` WHERE CandidateNumber=$dbCandidateNumber;";
                                        $result = $conn->query($sql);
                                        $row = mysqli_fetch_array($result);
                                        if ($row){
                                            $dbStatusID = $row['StatusID'];

                                            $conn->autocommit(FALSE);   #USE OF SQL TRANSACTIONS

                                            $sql = "REPLACE status (StatusID, Status)
                                            VALUES ('$dbStatusID', '$status')";
                                            $conn->query($sql);

                                            $sql2 = "INSERT INTO `signinhistory` (`CandidateNumber`, `Status`, `Type`)
                                                    VALUES ($dbCandidateNumber, $status, 'ONLINE');";
                                            $conn->query($sql);

                                            if ($conn->commit() == TRUE) {
                                                echo "New record created successfully";
                                                  $conn->close();
                                                  redirect("updateStatus.php");
                                              } else {
                                                echo "Error: " . $sql . "<br>" . $conn->error;
                                            }

                                        } else{
                                            echo "Error: This student account does not exist <br>";
                                        }
                                        
                                    ?>

                                    <a href="dashboard.php">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Dashboard
                                    </a>
                                    <a href="updateStatus.php">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Status Update
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutError_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
