<!-- This is the page visited to view and edit staff accounts -->

<!DOCTYPE html>
    <?php
        function redirecter($url){
            ob_start();
            header('Location: '. $url);
            ob_end_flush();
            die();
        }

        session_start();                                #If the user is not signed in as an admin, they cannot view this page and are redirected to the 401 error page
        $access = $_SESSION['access'];

        if($access != "A"){
            redirecter("401.html");
        }
        session_abort();
    ?>

    <html lang="en">
        <title>Staff Accounts</title>

        <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; include($IPATH."headernav.php");?>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
        <link href="css/switch.css?version=55" rel="stylesheet" />
        <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>      

        <script>                //Javascript functions to animate opening and closing the create and delete forms
            function createOpen(){
                deleteClose();
                $('#newText').hide();
                $('#createButton').animate({width: '0%'});
                $("#createStaffForm").slideDown("slow");
            };
            
            function createClose(){
                $("#createStaffForm").slideUp("fast");
                $("#createButton").animate({width: '100%'});
                $('#newText').show();
            };

            function deleteOpen(){
                createClose();
                $('#deleteText').hide();
                $('#deleteButton').animate({width: '0%'});
                $("#deleteStaffForm").slideDown("slow");
            };
            
            function deleteClose(){
                $("#deleteStaffForm").slideUp("fast");
                $("#deleteButton").animate({width: '100%'});
                $('#deleteText').show();
            };
        </script>

        <style>
            body {
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
                overflow-y: auto !important;
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
                        <h1 class="mt-4">Staff Accounts</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">The Highcliffe Sixth Form Staff Account Home</li>
                        </ol>
                    </div>

                    <div class="row-fluid">
                        <div class="container-fluid px-4 mt-3 button-group">
                            <button input="submit" id="createButton" onclick="createOpen()" class="button"><span id="newText">New Staff Account</span></button>
                            <button input="submit" id="deleteButton" onclick="deleteOpen()" class="button"><span id="deleteText">Delete Staff Account</span></button>
                        </div>
                    </div>

        
                    <div class="container" id="createStaffForm" style="display: none;">
                        <div class="row">
                            <div class="col-lg-12" style="float:centre;" style="border-radius: 2em !important;">
                                
                                <form method="post" action="createStaffOOP.php"> <!--add this file later-->

                                    <div class="card shadow-lg border-0 rounded-sm mt-3">
                                        <div class="card-header highcliffe">
                                            <a input="" class="btn btn-dark" style="float:left;" onclick="createClose()">Back</a>
                                            <h3 class="text-center font-weight-light my-4" style="color:#ffffff !important;">Create Staff Account</h3>
                                        </div>

                                        <div class="card-body">
                                            <div class="login">
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="username" id="inputusername" type="text" placeholder="Username" autocomplete="off" required/>
                                                            <label for="inputusername">Username</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="password" id="inputpassword" type="text" placeholder="Password" autocomplete="off" required/>
                                                            <label for="inputpassword">Password <i class="muted" style="font-size: 10px;">(Include Special Character)</i></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-floating mb-3">
                                                            <select class="form-control" id="access" name="access" placeholder="Choose Access Level" autocomplete="off" required>
                                                                <option value="S">Staff</option>
                                                                <option value="A">Admin</option>
                                                            </select>
                                                            <label for="access">Access Level</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="mb-2"style="float: right !important;">
                                                <button type="submit" id="submitButton" class="btn btn-highcliffe" value="Submit">Create Account</button>
                                            </div>
                                        </div>
        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="container" id="deleteStaffForm" style="display: none;">
                        <div class="row">
                            <div class="col-lg-12" style="float:centre;" style="border-radius: 2em !important;">
                                
                                <form method="post" action="deleteStaffOOP.php" onsubmit="return confirm('Are you sure you want to delete this staff account?');"> <!--add this file later-->

                                    <div class="card shadow-lg border-0 rounded-sm mt-3">
                                        <div class="card-header highcliffe">
                                            <a input="" class="btn btn-dark" style="float:left;" onclick="deleteClose()">Back</a>
                                            <h3 class="text-center font-weight-light my-4" style="color:#ffffff !important;">Delete Staff Account</h3>
                                        </div>

                                        <div class="card-body">
                                            <div class="login">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="username" id="inputusername" type="text" placeholder="Username" autocomplete="off" required/>
                                                            <label for="inputusername">Username</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="mb-2"style="float: right !important;">
                                                <button type="submit" id="submitButton" class="btn btn-highcliffe" value="Submit">Delete Account</button>
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
                                    <span style="color: #522a5b"><i class="far fa-address-card me-1"></i></span>
                                    All Staff Accounts

                                    <button class="btn btn-sm btn-highcliffe"  onClick="window.location.reload();" style="float:right; margin-top:5px; margin-right:5px;">Refresh</button>
                                </div>
                                
                                <div class="card-body">
                                    <table id="myTable" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Username</th> 
                                                <th>Staff Type</th>                              
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                                $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; 
                                                include($IPATH."connectDB.php");
                                                
                                                $sql = "SELECT username, access FROM `admins`;";
                                                    
                                                $result = mysqli_query($conn,$sql);
                                                if (!$result) {
                                                    printf("Error: %s\n", mysqli_error($conn));
                                                    exit();
                                                }else{
                                                    while($row = mysqli_fetch_array($result)){
                                                    echo "<tr>";
                                                    echo "<td>" . $row['username'] . "</td>";
                                                    echo "<td>" . $row['access'] . "</td>"; 
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
                    $(document).ready(function () {             //USE OF DATATABLES, a Java plugin for sortable tables
                        $('#myTable').DataTable({
                            "paging": false,
                            "order": [[1 , 'asc'], [2, 'asc']]
                        });
                    });
                </script>

                <?php include($IPATH."footer.php"); ?>
            </div>
        </body>
    </html>

