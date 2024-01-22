<!-- This is the page visited when the delete staff form is submitted -->

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
                                      $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/";

                                      
                                      class staff {                   #PHP OBJECT ORIENTED PROGRAMMING
                                        private $username;
                                        private $hash;
                                        private $usernameErr;
                                        private $accountErr;

                                        function set_username($username){
                                          $this->username = $username;
                                        }

                                        function get_username(){
                                          return $this->username;
                                        }

                                        function get_adminNum(){
                                          return $this->adminNum;
                                        }
                                        
                                        function get_usernameErr(){
                                          return $this->usernameErr;
                                        }

                                        function get_accountErr(){
                                          return $this->accountErr;
                                        }
                                        
                                        function validateStaff(){
                                          $sendtoDB = True;

                                          if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                            if (empty($_POST["username"])) {
                                              $this->usernameErr = "Username Required <br>";
                                              $sendtoDB = False;
                                            } else {
                                              $this->username = test_input($_POST["username"]);
                                            }
                                          }
                                          return $sendtoDB;
                                        }
                                        
                                        function staffExists(){
                                          $exists = False;

                                          include "connectDB.php";

                                          $sql = "SELECT * FROM `admins` WHERE `username`='$this->username';";
                                        
                                          $result = $conn->query($sql);
                                          
                                          if (!$result) {
                                            printf("Error: %s\n", mysqli_error($conn));
                                            exit();
                                          }else{
                                            while($row = mysqli_fetch_array($result)){
                                              if($row['username'] == $this->username){
                                                $exists = True;
                                                return $exists;
                                              }
                                            }
                                            $this->accountErr = "Staff Account Does Not Exist <br>";
                                          }
                                        }
                                        

                                        function deletefromDB(){
                                          include "connectDB.php";

                                          $sql = "DELETE FROM `admins` WHERE `username`='$this->username';";
                                          
                                          if ($conn->query($sql) == TRUE) {
                                            echo "Deleted successfully";
                                            $conn->close();
                                            redirect("staffAccounts.php");
                                          } else {
                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                          }
                                        }
                                      }

                                      
                                      function test_input($data){
                                        $data = trim($data);
                                        $data = stripslashes($data);
                                        $data = htmlspecialchars($data);
                                        return $data;
                                      }

                                      function redirect($url) {
                                        ob_start();
                                        header('Location: '.$url);
                                        ob_end_flush();
                                        die();
                                      }


                                      $staff = new staff();
                                      $valid = $staff->validatestaff();

                                      if ($valid == True){
                                        $delete = $staff->staffExists();
                                        if($delete == True){
                                          $staff->deletefromDB();
                                        }
                                      }
                                      echo "Cannot delete staff account due to these errors: <br>";
                                      echo $staff-> get_usernameErr();
                                      echo $staff-> get_accountErr();
                                    ?>
                                  <a href="dashboard.php">
                                      <i style="color:#52a5b;" class="fas fa-arrow-left me-1"></i>
                                      Return to Dashboard
                                  </a>
                                  <a href="staffAccounts.php">
                                      <i class="fas fa-arrow-left me-1"></i>
                                      Return to staff Accounts
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