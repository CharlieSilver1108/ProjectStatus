<!-- This is the page which displays student accounts and allows creation and deletion -->

<!DOCTYPE html>
    <?php
        function redirecter($url){
            ob_start();
            header('Location: '. $url);
            ob_end_flush();
            die();
        }

        session_start();                        #Only allows access if user is signed in as admin
        $access = $_SESSION['access'];

        if($access != "A"){
            redirecter("401.html");             #Redirects to authorisation error if not an admin
        }
        session_abort();
    ?>

    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; include($IPATH."headernav.php");?>

    <html lang="en">
        <title>Student Accounts</title>        

        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
        <link href="css/switch.css?version=55" rel="stylesheet" />
        <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>      


        <script> 
            function createOpen(){
                updateClose();
                deleteClose();
                $('#newText').hide();
                $('#createButton').animate({width: '0%'});
                $("#createStudentForm").slideDown("slow");

            };
            
            function createClose(){
                $("#createStudentForm").slideUp("fast");
                $("#createButton").animate({width: '100%'});
                $('#newText').show();
            };

            function toggleCardID(){
                $("#inputCardID").slideToggle("fast");
            };


            function updateOpen(){
                createClose();
                deleteClose();
                $('#updateText').hide();
                $('#updateButton').animate({width: '0%'});
                $("#updateStudentForm").slideDown("slow");
            };
            
            function updateClose(){
                $("#updateStudentForm").slideUp("fast");
                $("#updateButton").animate({width: '100%'});
                $('#updateText').show();
            };


            function deleteOpen(){
                createClose();
                updateClose();
                $('#deleteText').hide();
                $('#deleteButton').animate({width: '0%'});
                $("#deleteStudentForm").slideDown("slow");
            };
            
            function deleteClose(){
                $("#deleteStudentForm").slideUp("fast");
                $("#deleteButton").animate({width: '100%'});
                $('#deleteText').show();
            };

        </script>

        <style>
            body {
                overflow-y: auto !important;
                padding: 1rem;
            }
            .input {
            position: relative;
            display: block;
            background: #ddd;
            
            &::after {
                content: "▼";
                position: absolute; 
                right: 1.5rem;
                top: 1.6rem;
                transition: 300ms transform 200ms;
            }
            &:active::after {
                transform: rotate(-180deg);
            }
            &__field {
                display: block;
                opacity: 1;
                width: 100%;
                box-sizing: boder-box;
                border: 0;
                background: transparent;
                appearance: none;
                padding: 2rem 1.5rem 1rem;
                border-bottom: 2px solid purple;
                border-radius: 0;
                transition-delay: 0ms;
                will-change: color;
                transition: 200ms color linear;
                
                &:invalid {
                color: transparent;
                transition: 200ms color linear 100ms;
                }
                
                &:valid + .input__label,
                &:focus:valid + .input__label {
                transform: scale(0.75) translate(0.5em, -10%);
                transition: 200ms transform ease-out;
                color: purple;
                }
            }
            &__label {
                position: absolute;
                left: 0;
                top: 0;
                right: 0;
                padding: 1.5rem 1.5rem 0;
                pointer-events: none;
                transform-origin: 0 0;
                transition: 200ms transform ease-out 200ms;
                will-change: transform;
            }
            }
            .form-control:focus, .dataTable-input:focus {
                color: #212529;
                background-color: #fff;
                border-color: #522a5b;
                outline: 0;
                box-shadow: 0 0 0 0.2rem rgba(82, 42, 91, 0.65);
            }
            
            .form-check-input:checked {
                background-color: #522a5b !important;
                border-color: #522a5b !important;
            }

            .form-check-input:focus {
                border-color: #522a5b;
                outline: 0;
                box-shadow: 0 0 0 0.15rem rgba(82, 42, 91, 0.65);
            }
            
            .body{
                overflow-y: visible !important;
            }

            table.dataTable thead .sorting_asc {
                background-image: url("/assets/img/UpArrow.png")
            }

            table.dataTable thead .sorting_desc {
                background-image: url("/assets/img/DownArrow.png")
            }

            .button-group{
                display: inline-flex;
            }

            .button{
                padding: 10px;
                outline: none;
                border: none;
                cursor: pointer;
                border-right: 1px solid #cccccc;
                background: #522a5b;
                color: #ffffff;
                width: 100%;
            }

            .button:last-child{
                border-right: none;
            }
        </style>

        <body>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Student Accounts</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">The Highcliffe Sixth Form Student Account Home</li>
                        </ol>
                    </div>

                    <div class="row-fluid">
                        <div class="container-fluid px-4 mt-3 button-group">
                            <button input="submit" id="createButton" onclick="createOpen()" class="button"><span id="newText">New Student Account</span></button>
                            <button input="submit" id="deleteButton" onclick="deleteOpen()" class="button"><span id="deleteText">Delete Student Account</span></button>
                        </div>
                    </div>

        
                    <div class="container" id="createStudentForm" style="display: none;">
                        <div class="row">
                            <div class="col-lg-12" style="float:centre;" style="border-radius: 2em !important;">
                                
                                <form method="post" action="createStudentOOP.php">

                                    <div class="card shadow-lg border-0 rounded-sm mt-3">
                                        <div class="card-header highcliffe">
                                            <a input="" class="btn btn-dark" style="float:left;" onclick="createClose()">Back</a>
                                            <h3 class="text-center font-weight-light my-4" style="color:#ffffff !important;">Create Student Account</h3>
                                        </div>

                                        <div class="card-body">
                                            <div class="login">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="fname" id="inputfname" type="text" placeholder="First Name" autocomplete="off" required/>
                                                            <label for="inputfname">First Name</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <select class="form-control" id="tgroup" name="tgroup" placeholder="Choose Tutor Group" autocomplete="off" required>
                                                                <option hidden></option>
                                                                <option value="6.1">6.1</option>
                                                                <option value="6.2">6.2</option>
                                                                <option value="6.3">6.3</option>
                                                                <option value="6.4">6.4</option>
                                                                <option value="6.5">6.5</option>
                                                                <option value="6.6">6.6</option>
                                                                <option value="6.7">6.7</option>
                                                                <option value="6.8">6.8</option>
                                                                <option value="6.9">6.9</option>
                                                                <option value="6.10">6.10</option>
                                                                <option value="6.11">6.11</option>
                                                                <option value="6.12">6.12</option>
                                                            </select>
                                                            <label for="tgroup">Tutor Group</span>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="canNum" id="inputCandidateNum" type="number" pattern="[1-9]{1}[0-9]{3}" placeholder="Candidate Number" autocomplete="off" required/>
                                                            <label for="inputCandidateNum">Candidate Number <i class="muted" style="font-size: 10px;">(4 Numbers)</i></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="sname" id="inputsname" type="text" placeholder="Surname" autocomplete="off" required/>
                                                            <label for="inputsname">Surname</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <select class="form-control" id="ygroup" name="ygroup" placeholder="Choose Year Group..." autocomplete="off" required>
                                                                <option hidden></option>
                                                                <option value="12">Year 12</option>
                                                                <option value="13">Year 13</option>
                                                            </select>
                                                            <label for="ygroup">Year Group</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="aNum" id="inputAdminNum" type="number" placeholder="Admin Number" autocomplete="off" required/>
                                                            <label for="inputAdminNum">Admin Number <i class="muted" style="font-size: 10px;">(6 Numbers)</i></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" id="inputRandomCardID" onclick="toggleCardID()" type="checkbox" value="" checked/>
                                                    <label class="form-check-label" for="inputRandomCardID">Random CardID</label>
                                                </div>

                                                <div class="form-floating mb-3" id="inputCardID" style="display:none">
                                                    <input class="form-control" id="inputCardID" name="cardID" type="text" placeholder="CardID" autocomplete="off" />
                                                    <label for="inputCardID">CardID <i style="font-size: 10px;">(11 Characters)</i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="mb-2"style="float: right !important;">
                                                <button type="submit" id="createsubmitButton" class="btn btn-highcliffe" value="Submit">Create Account</button>
                                            </div>
                                        </div>
        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>




                    


                    <div class="container" id="deleteStudentForm" style="display: none;">
                        <div class="row">
                            <div class="col-lg-12" style="float:centre;" style="border-radius: 2em !important;">
                                
                                <form method="post" action="deleteStudentOOP.php" onsubmit="return confirm('Are you sure you want to delete this student account?');"> <!--add this file later-->

                                    <div class="card shadow-lg border-0 rounded-sm mt-3">
                                        <div class="card-header highcliffe">
                                            <a input="" class="btn btn-dark" style="float:left;" onclick="deleteClose()">Back</a>
                                            <h3 class="text-center font-weight-light my-4" style="color:#ffffff !important;">Delete Student Account</h3>
                                        </div>

                                        <div class="card-body">
                                            <div class="login">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="fname" id="inputfname" type="text" placeholder="First Name" autocomplete="off" required/>
                                                            <label for="inputfname">First Name</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="canNum" id="inputCandidateNum" type="number" pattern="[1-9]{1}[0-9]{3}" placeholder="Candidate Number" autocomplete="off" required/>
                                                            <label for="inputCandidateNum">Candidate Number <i class="muted" style="font-size: 10px;">(4 Numbers)</i></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="sname" id="inputsname" type="text" placeholder="Surname" autocomplete="off" required/>
                                                            <label for="inputsname">Surname</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="aNum" id="inputAdminNum" type="number" placeholder="Admin Number" autocomplete="off" required/>
                                                            <label for="inputAdminNum">Admin Number <i class="muted" style="font-size: 10px;">(6 Numbers)</i></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="mb-2"style="float: right !important;">
                                                <button type="submit" id="deletesubmitButton" class="btn btn-highcliffe" value="Submit">Delete Account</button>
                                            </div>
                                        </div>
        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 px-4">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header" style="font-size: 20px">
                                    <span style="color: #522a5b"><i class="fas fa-address-card me-1"></i></span>
                                    All Student Accounts

                                    <button class="btn btn-sm btn-highcliffe"  onClick="window.location.reload();" style="float:right; margin-top:5px; margin-right:5px;">Refresh</button>
                                </div>
                                
                                <div class="card-body">
                                    <table id="myTable" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Candidate Number</th>
                                                <th>Surname</th>
                                                <th>Firstname</th>
                                                <th>Admin Number</th>
                                                <th>Tutor Group</th>
                                                <th>Year Group</th>
                                                <th>Card ID</th>                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                            include($IPATH."connectDB.php");
                                            
                                            $sql = "SELECT * FROM `students`;";
                                                
                                            $result = mysqli_query($conn,$sql);
                                            if (!$result) {
                                                printf("Error: %s\n", mysqli_error($conn));
                                                exit();
                                            }else{
                                                while($row = mysqli_fetch_array($result)){
                                                echo "<tr>";
                                                echo "<td>" . $row['CandidateNumber'] . "</td>";
                                                echo "<td>" . $row['Surname'] . "</td>";
                                                echo "<td>" . $row['Firstname'] . "</td>";
                                                echo "<td>" . $row['misID'] . "</td>";
                                                echo "<td>" . $row['TutorGroup'] . "</td>";
                                                echo "<td>" . $row['YearGroup'] . "</td>";
                                                echo "<td>" . $row['CardID'] . "</td>";
                                                echo "</tr>";
                                                }
                                            }

                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </main>

                <script>
                    $(document).ready(function () {         //USE OF DATATABLES, a Java plugin for sortable tables
                        $('#myTable').DataTable({
                            "paging": false,
                            "order": [[4 , 'asc'], [5, 'asc'], [1, 'asc']]
                        });
                    });
                </script>

                <?php include($IPATH."footer.php"); ?>
            </div>
        </body>
    </html>

