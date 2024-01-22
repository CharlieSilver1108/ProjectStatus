<!-- This is the page visited when the createstudentform is submitted -->

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
                                      class student {       #OBJECT ORIENTED PROGRAMMING in PHP
                                        private $firstname;
                                        private $surname;
                                        private $candidateNumber;
                                        private $tutorGroup;
                                        private $yearGroup;
                                        private $adminNum;
                                        private $cardID;
                                        private $statusID;
                                        private $firstnameErr;
                                        private $surnameErr;
                                        private $candidateNumberErr;
                                        private $tutorGroupErr;
                                        private $yearGroupErr;
                                        private $adminNumErr;
                                        private $cardIDErr;
                                        private $statusIDErr;

                                        function set_firstname($firstname){
                                          $this->firstname = $firstname;
                                        }

                                        function set_surname($surname){
                                          $this->surname = $surname;
                                        }

                                        function set_candidateNumber($candidateNumber){
                                          $this->candidateNumber = $candidateNumber;
                                        }

                                        function set_tutorgroup($tutorgroup){
                                          $this->tutorgroup = $tutorgroup;
                                        }

                                        function set_yeargroup($yeargroup){
                                          $this->yeargroup = $yeargroup;
                                        }

                                        function set_adminNum($adminNum){
                                          $this->adminNum = $adminNum;
                                        }
                                        
                                        function set_cardID($cardID){
                                          $this->cardID = $cardID;
                                        }


                                        function get_firstname(){
                                          return $this->firstname;
                                        }

                                        function get_surname(){
                                          return $this->surname;
                                        }

                                        function get_candidateNumber(){
                                          return $this->candidateNumber;
                                        }

                                        function get_tutorgroup(){
                                          return $this->tutorgroup;
                                        }

                                        function get_yeargroup(){
                                          return $this->yeargroup;
                                        }

                                        function get_adminNum(){
                                          return $this->adminNum;
                                        }
                                        
                                        function get_cardID(){
                                          return $this->cardID;
                                        }


                                        function get_firstnameErr(){
                                          return $this->firstnameErr;
                                        }

                                        function get_surnameErr(){
                                          return $this->surnameErr;
                                        }

                                        function get_candidateNumberErr(){
                                          return $this->candidateNumberErr;
                                        }

                                        function get_tutorgroupErr(){
                                          return $this->tutorGroupErr;
                                        }

                                        function get_yeargroupErr(){
                                          return $this->yearGroupErr;
                                        }

                                        function get_adminNumErr(){
                                          return $this->adminNumErr;
                                        }
                                        
                                        function get_cardIDErr(){
                                          return $this->cardIDErr;
                                        }
                                        
                                        function test_input($data) {      #Ensures no code can be submitted
                                          $data = trim($data);
                                          $data = stripslashes($data);
                                          $data = htmlspecialchars($data);
                                          return $data;
                                        }
                                        
                                        function generateRandomString($length) {    #This generates a random string used for cardID
                                          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                          $charactersLength = strlen($characters);
                                          $randomString = '';
                                          for ($i = 0; $i < $length; $i++) {
                                              $randomString .= $characters[rand(0, $charactersLength - 1)];
                                          }
                                          return $randomString;
                                        }

                                        function generateRandomNumber($length) {     #This generates a random number used for statusID
                                          $characters = '0123456789';
                                          $charactersLength = strlen($characters);
                                          $randomNumber = '';
                                          for ($i = 0; $i < $length; $i++) {
                                              $randomNumber .= $characters[rand(0, $charactersLength - 1)];
                                          }
                                          return $randomNumber;
                                        }

                                        function validateStudent(){
                                          $sendtoDB = True;

                                          if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                            if (empty($_POST["fname"])) {
                                              $this->firstnameErr = "First Name Required <br>";
                                              $sendtoDB = False;
                                            } elseif (ctype_alpha($_POST["fname"])) {
                                              $this->firstname = test_input($_POST["fname"]);
                                            } else {
                                              $this->firstnameErr = "Only letters allowed in first name <br>";
                                              $sendtoDB = False;
                                            }
    
                                            if (empty($_POST["sname"])) {
                                              $this->surnameErr = "Surname Required <br>";
                                              $sendtoDB = False;
                                            } elseif (ctype_alpha($_POST["sname"])) {
                                              $this->surname = test_input($_POST["sname"]);
                                            } else {
                                              $this->surnameErr = "Only letters allowed in surname <br>";
                                              $sendtoDB = False;
                                            }
                                              
                                            if (empty($_POST["canNum"])) {
                                              $this->candidateNumberErr = "Candidate Number Required <br>";
                                              $sendtoDB = False;
                                            } elseif (strlen($_POST["canNum"]) == 4) {
                                              $this->candidateNumber = test_input($_POST["canNum"]);
                                            } else {
                                              $this->candidateNumberErr = "Candidate number must be 4 numbers <br>";
                                              $sendtoDB = False;
                                            }
    
                                            if (empty($_POST["tgroup"])) {
                                              $this->tutorGroupErr = "Tutor Group Required <br>";
                                              $sendtoDB = False;
                                            } else {
                                              $this->tutorGroup = test_input($_POST["tgroup"]);
                                            }
    
                                            if (empty($_POST["ygroup"])) {
                                              $this->yearGroupErr = "Year Group Required <br>";
                                              $sendtoDB = False;
                                            } else {
                                              $this->yearGroup = test_input($_POST["ygroup"]);
                                            }
    
                                            if (empty($_POST["aNum"])) {
                                              $this->adminNumErr = "Admin Number Required <br>";
                                              $sendtoDB = False;
                                            } elseif (strlen($_POST["aNum"]) == 6) {
                                              $this->adminNum = test_input($_POST["aNum"]);
                                            } else {
                                              $this->adminNumErr = "Admin number must be 6 numbers <br>";
                                              $sendtoDB = False;
                                            }
    
                                            if (empty($_POST["cardID"])) {
                                              $this->cardID = $this->generateRandomString(11);
                                            } elseif (strlen($_POST["cardID"]) == 11) {
                                              $this->cardID = $_POST["cardID"];
                                            } else {
                                              $this->cardIDErr = "CardID must be 11 characters <br>";
                                              $sendtoDB = False;
                                            }
                                          }
                                          return $sendtoDB;
                                        }
  
                                        function addtoDB(){
                                          $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; 
                                          include($IPATH."connectDB.php");

                                          $this->statusID = $this->generateRandomNumber(8);

                                          $conn->autocommit(false);   #USE OF SQL TRANSACTIONS

                                          $sql = "INSERT INTO `students` (`CandidateNumber`, `misID`, `Surname`, `Firstname`, `TutorGroup`, `CardID`, `YearGroup`) 
                                                  VALUES ('$this->candidateNumber', '$this->adminNum', '$this->surname', '$this->firstname', '$this->tutorGroup', '$this->cardID', '$this->yearGroup')";

                                          $conn->query($sql);

                                          $sql2 = "INSERT INTO `statusids` (`CandidateNumber`, `StatusID`)
                                                    VALUES ('$this->candidateNumber', '$this->statusID')";
                                          
                                          $conn->query($sql2);

                                          $sql3 = "INSERT INTO `status` (`StatusID`, `Status`)
                                              VALUES ('$this->statusID', 0)";
                                            
                                          $conn->query($sql3);


                                          if ($conn->commit() == TRUE) {
                                            echo "New record created successfully";
                                              $conn->close();
                                              #redirect("studentAccounts.php");
                                          } else {
                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                          }
                                        }
                                      }


                                      function redirect($url) {
                                        ob_start();
                                        header('Location: '.$url);
                                        ob_end_flush();
                                        die();
                                      }

                                      function test_input($data) {
                                        $data = trim($data);
                                        $data = stripslashes($data);
                                        $data = htmlspecialchars($data);
                                        return $data;
                                      }

                                    
                                      $student = new student();
                                      $sendtoDB = $student->validateStudent();
                                      if ($sendtoDB == True) {
                                        $student->addtoDB();
                                      } else {
                                        echo "Cannot create new student account due to these errors: <br>";
                                        echo $student->get_firstnameErr();
                                        echo $student->get_surnameErr();
                                        echo $student->get_candidateNumberErr();
                                        echo $student->get_tutorGroupErr();
                                        echo $student->get_yearGroupErr();
                                        echo $student->get_adminNumErr();
                                        echo $student->get_cardIDErr();
                                      } ?>
                                    <a href="dashboard.php">
                                        <i style="color:#52a5b;" class="fas fa-arrow-left me-1"></i>
                                        Return to Dashboard
                                    </a>
                                    <a href="studentAccounts.php">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Student Accounts
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