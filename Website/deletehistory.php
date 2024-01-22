<!-- This is the page visited when the delete history button is clicked -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>500 Error - Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
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
                                        function redirect($url) {
                                            ob_start();
                                            header('Location: '.$url);
                                            ob_end_flush();
                                            die();
                                        }

                                        $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/"; include($IPATH."connectDB.php"); 

                                        $all = $_GET['all'];
                                        echo $all . "<br>";

                                        if ($_GET['all'] == 1){                                 #If delete all
                                            $sql = "DELETE FROM `signinhistory`";
                                            if($conn->query($sql) == True){
                                                echo "Table Data Deleted <br>";
                                                redirect("statushistory.php");
                                            } else{
                                                echo "Error, Could Not Delete Data <br>";
                                            }
                                        }elseif($_GET['all'] == 2){                             #If delete last month
                                            $prevMonth = date("Y") . "-" . (date("m")-1) . "-" . date ("d");
                                            $prevMonth = strval($prevMonth);
                                            $sql = "DELETE FROM `signinhistory` WHERE DateChange <= '$prevMonth';";
                                            if($conn->query($sql) == True){
                                                echo "Table Data Deleted <br>";
                                                redirect("statushistory.php");
                                            } else{
                                                echo "Error, Could Not Delete Data <br>";
                                            }
                                        }else{
                                            echo "General Error <br>";
                                        }

                                        ?>
                                    <a href="dashboard.php">
                                        <i style="color:#52a5b;" class="fas fa-arrow-left me-1"></i>
                                        Return to Dashboard
                                    </a>
                                    <a href="statushistory.php">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Status History
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