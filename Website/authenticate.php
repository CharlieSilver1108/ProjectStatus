<!-- This is the page visited when a user submits the login form -->

<!DOCTYPE html>
<html lang="en">

    <?php 
    function test_input($data) {     #This ensures that no code can be inserted by the user
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
    ?>

    <!-- This is the 401 error page format -->

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>401 Error - Admin</title>
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
                                    <h1 class="display-1">401</h1>
                                    <p class="lead">Unauthorized</p>
                                    <p>Access to this resource is denied due to these errors:</p>
                                    <?php 
                                    if((isset($_POST['username'])) && !empty($_POST['username'])){
                                        if((isset($_POST['password'])) && !empty($_POST['password'])){
                                            
                                            $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; 
                                            include($IPATH."connectDB.php");
                                            
                                            $username = test_input($_POST['username']);
                                            $result = $conn->query("SELECT * FROM `admins` WHERE username='$username';");
                                            $password = test_input($_POST['password']);
                                            $hash = password_hash($password, PASSWORD_DEFAULT); #Using a hashing algorithm provides extra security so that no actual passwords are being sent or stored on the database

                                            if (!$result){
                                                printf("Error: %s\n", mysqli_error($conn));
                                                exit();
                                            }else{
                                                while($row = mysqli_fetch_array($result)){
                                                    if(($row['username'] == $username) && (password_verify($password, $row['hashedpassword']))){    #If the input password when hashed matches the hashed password assingned to the input username then allow entry to the website
                                                        session_start();
                                                        $_SESSION['username'] = $username;
                                                        $_SESSION['access'] = $row['access'];
                                                        redirect("dashboard.php");
                                                    }
                                                }
                                            }
                                        }else{
                                            echo "No password";
                                        }
                                    }else{
                                        echo "No username";
                                    }
                                    echo "Username or Password was incorrect";
                                    ?>

                                    <br>
                                    <a href="login.php">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Login
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
