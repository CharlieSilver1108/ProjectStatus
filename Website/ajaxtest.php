<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/styles.css?version=55" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>


<body>        
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Student Statuses</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Welcome to the hub of the Highcliffe Sixth Form statuses</li>
                </ol>

                <div class="row">
                    <div class="card mb-4">
                        
                        <div class="card-header" style="font-size: 20px">
                            <span style="color: #522a5b"><i class="fas fa-database me-1"></i></span>
                            Students Signed <?php echo $status?>

                            <form action="students.php?show=0" method="POST" style="float:right; margin-top:2px;">
                                <input type="submit" class="btn btn-sm btn-primary" style="background-color: #343A40 !important; border-color: #343A40 !important; max-height:60%;" name="update" value="Out">
                            </form>
                            <form action="students.php?show=1" method="POST" style="float:right; margin-top:2px; margin-right:5px;">
                                <input type="submit" class="btn btn-sm btn-primary" style="background-color: #343A40 !important; border-color: #343A40 !important; max-height:60%;" name="update" value="In">
                            </form>
                            <button class="btn btn-sm btn-highcliffe"  onClick="window.location.reload();" style="float:right; margin-top:5px; margin-right:5px;">Refresh</button>
                        </div>
                        
                        <div class="card-body">
                            <table id="datatablesSimple" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Candidate Number</th>
                                        <th>Surname</th>
                                        <th>Firstname</th>
                                        <th>Tutor Group</th>
                                        <th>Time Changed</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>Candidate Number</th>
                                        <th>Surname</th>
                                        <th>Firstname</th>
                                        <th>Tutor Group</th>
                                        <th>Time Changed</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>  
                                <tbody>  
                                    <?php
                                        $show = $_GET['show'];
                                        if ($show == 1){
                                            $status = "IN";
                                        } elseif ($show == 0){
                                            $status = "OUT";
                                        } else{
                                            echo "error";
                                            die();
                                        }

                                        $servername ="localhost";
                                        $username = "username";
                                        $password = "password";
                                        $dbname = "database";

                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        if($conn->connect_error){
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "SELECT status.DateChange, students.CandidateNumber, students.Firstname, students.Surname, students.TutorGroup FROM `status`
                                        LEFT JOIN `statusids` ON status.StatusID = statusids.StatusID
                                        LEFT JOIN `students` ON statusids.CandidateNumber = students.CandidateNumber
                                        WHERE status.status = $show;";
                                            
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
                                            echo "<td>" . $row['TutorGroup'] . "</td>";
                                            echo "<td>" . $row['DateChange'] . "</td>";
                                            echo "<td>" . $status . "</td>";
                                            echo "</tr>";
                                            }
                                        }

                                        $conn->close();
                                    ?>
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>


