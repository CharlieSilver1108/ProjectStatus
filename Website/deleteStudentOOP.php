<!-- This is the page visited when the delete student form is submitted -->

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

                                      class student {                     #PHP OBJECT ORIENTED PROGRAMMING
                                        private $firstname;
                                        private $surname;
                                        private $candidateNumber;
                                        private $adminNum;
                                        private $firstnameErr;
                                        private $surnameErr;
                                        private $candidateNumberErr;
                                        private $adminNumErr;
                                        private $accountErr;

                                        function set_firstname($firstname){
                                          $this->firstname = $firstname;
                                        }

                                        function set_surname($surname){
                                          $this->surname = $surname;
                                        }

                                        function set_candidateNumber($candidateNumber){
                                          $this->candidateNumber = $candidateNumber;
                                        }

                                        function set_adminNum($adminNum){
                                          $this->adminNum = $adminNum;
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

                                        function get_adminNum(){
                                          return $this->adminNum;
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

                                        function get_adminNumErr(){
                                          return $this->adminNumErr;
                                        }

                                        function get_accountErr(){
                                          return $this->accountErr;
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
    
                                            if (empty($_POST["aNum"])) {
                                              $this->adminNumErr = "Admin Number Required <br>";
                                              $sendtoDB = False;
                                            } elseif (strlen($_POST["aNum"]) == 6) {
                                              $this->adminNum = test_input($_POST["aNum"]);
                                            } else {
                                              $this->adminNumErr = "Admin number must be 6 numbers <br>";
                                              $sendtoDB = False;
                                            }
                                          }
                                          return $sendtoDB;
                                        }
                                        
                                        function studentExists(){
                                          $exists = False;

                                          include "connectDB.php";

                                          $result = $conn->prepare("SELECT * FROM `students` WHERE `firstname`=? AND `surname`=? AND `candidateNumber`=? AND `misID`=?");
                                          $result->bind_param('ssii', $firstname, $surname, $candidateNumber, $adminNumber);      #PARAMETER BINDING

                                          $firstname = $this->get_firstname();
                                          $surname = $this->get_surname();
                                          $candidateNumber = $this->get_candidateNumber();
                                          $adminNumber = $this->get_adminNum();

                                          $result->execute();
                                          $result->store_result();

                                          $row = $result->num_rows();
                                          
                                          if (!$result) {
                                              printf("Error: %s\n", mysqli_error($conn));
                                              exit();
                                          }else{
                                              if($row > 0){
                                                $exists = True;
                                                return $exists;
                                              }else{
                                                $this->accountErr = "Student Account Does Not Exist <br>";
                                              }
                                          }
                                        }

                                        function deletefromDB(){
                                          include "connectDB.php";

                                          $sql2 = "SELECT * FROM `statusids` WHERE `CandidateNumber`=$this->candidateNumber;";

                                          $result = mysqli_query($conn,$sql2);
                                          while($row = mysqli_fetch_array($result)){
                                            $this->statusID = $row['StatusID'];
                                          }


                                          $sql = "DELETE FROM `students` WHERE `CandidateNumber`=$this->candidateNumber AND `misID`=$this->adminNum AND `Surname`='$this->surname' AND `Firstname`='$this->firstname';";
                                          
                                          $sql .= "DELETE FROM `status` WHERE `StatusID`=$this->statusID;";

                                          $sql .= "DELETE FROM `statusids` WHERE `CandidateNumber`=$this->candidateNumber;";

                                          if ($conn->multi_query($sql) == TRUE) {               #MULTIQUERY used for multiple delete statements
                                            echo "Deleted successfully";
                                            $conn->close();
                                            redirect("studentAccounts.php");
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


                                      $student = new student();
                                      $valid = $student->validateStudent();

                                      if ($valid == True){
                                        $delete = $student->studentExists();
                                        if($delete == True){
                                          $student->deletefromDB();
                                        }
                                      }
                                      echo "Cannot delete student account due to these errors: <br>";
                                      echo $student-> get_firstnameErr();
                                      echo $student-> get_surnameErr();
                                      echo $student-> get_candidateNumberErr();
                                      echo $student-> get_adminNumErr();
                                      echo $student-> get_accountErr();
                                    ?>
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