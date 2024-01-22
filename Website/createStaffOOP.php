<!-- This is the page visited when the create staff form has been submitted -->

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
                                    <?php                 #OBJECT ORIENTED PROGRAMMING in PHP
                                      class staff {
                                        private $username;
                                        private $password;
                                        private $hash;
                                        private $access;
                                        private $usernameErr;
                                        private $passwordErr;
                                        private $accessErr;

                                        function set_username($username){
                                          $this->username = $username;
                                        }

                                        function set_password($password){
                                          $this->password = $password;
                                        }

                                        function set_access($access){
                                          $this->access = $access;
                                        }

                                        function get_username(){
                                          return $this->username;
                                        }

                                        function get_password(){
                                          return $this->password;
                                        }

                                        function get_hash(){
                                          return $this->hash;
                                        }

                                        function get_access(){
                                          return $this->access;
                                        }

                                        function get_usernameErr(){
                                          return $this->usernameErr;
                                        }

                                        function get_passwordErr(){
                                          return $this->passwordErr;
                                        }

                                        function get_accessErr(){
                                          return $this->accessErr;
                                        }
                                        
                                        function test_input($data) {      #Ensures no code can be submitted to the form
                                          $data = trim($data);
                                          $data = stripslashes($data);
                                          $data = htmlspecialchars($data);
                                          return $data;
                                        }

                                        function validateStaff(){
                                          $sendtoDB = True;

                                            if (empty($_POST["username"])) {          #These following if statements check that the format of the inputs are correct
                                              $this->usernameErr = "Username Required <br>";
                                              $sendtoDB = False;
                                            }elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["username"])){ #REGULAR EXPRESSION
                                              $this->usernameErr = "No special characters allowed in username <br>";
                                              $sendtoDB = False;
                                            }else {
                                              $this->username = $this->test_input($_POST["username"]);
                                            }
    
                                            if (empty($_POST["password"])) {
                                              $this->passwordErr = "Password Required <br>";
                                              $sendtoDB = False;
                                            } elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,!|=_+¬-]/', $_POST["password"])){  #REGULAR EXPRESSION
                                              $this->passwordErr = "Password must include a special character <br>";
                                              $sendtoDB = False;
                                            }elseif (strlen($_POST["password"]) >= 8){
                                              $this->password = $this->test_input($_POST["password"]);
                                              $this->hash = password_hash($this->password, PASSWORD_DEFAULT);
                                              #Ensures the passwords are stored as a hash making them more secure
                                              //$this->hash = password_hash($this->password, PASSWORD_DEFAULT);
                                            }else {
                                              $this->passwordErr = "Password must be 8 characters or longer <br>";
                                              $sendtoDB = False;
                                            }

                                            if (empty($_POST["access"])) {
                                              $this->accessErr = "Access Level Required <br>";
                                              $sendtoDB = False;
                                            }else{
                                              $this->access = $_POST["access"];
                                            }
                                          
                                          return $sendtoDB;
                                        }
  
                                        function addtoDB(){
                                          $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; 
                                          include($IPATH."connectDB.php");

                                            $sql = "INSERT INTO `admins` (`username`, `hashedpassword`, `access`) 
                                                    VALUES ('$this->username', '$this->hash', '$this->access')";

                                            if ($conn->query($sql) == TRUE) {
                                              echo "New account created successfully";
                                              $conn->close();
                                              redirect("staffAccounts.php");
                                            } else {
                                              echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
                                            }
                                    
                                        }
                                      }

                                      function redirect($url) {
                                        ob_start();
                                        header('Location: '.$url);
                                        ob_end_flush();
                                        die();
                                      }

                                      $staff = new staff();
                                      $sendtoDB = $staff->validatestaff();
                                      if ($sendtoDB == True) {
                                        $staff->addtoDB();
                                      } else {
                                        echo "Cannot create new staff account due to these errors: <br>";
                                        echo $staff->get_usernameErr();
                                        echo $staff->get_passwordErr();
                                        echo $staff->get_accessErr();
                                      } 
                                      

                                      ?>
                                    <a href="dashboard.php">
                                        <i style="color:#52a5b;" class="fas fa-arrow-left me-1"></i>
                                        Return to Dashboard
                                    </a>
                                    <a href="staffAccounts.php">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Staff Accounts
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