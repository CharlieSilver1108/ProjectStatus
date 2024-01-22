<!-- This is the page which displays all current students stati -->

<!DOCTYPE html>
<html lang="en">
    <title>Student Statuses</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css/switch.css?version=55" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/";
    include($IPATH."headernav.php"); 

    $show = $_GET['show'];
    if ($show == 1){
        $status = "IN";
    } elseif ($show == 0){
        $status = "OUT";
    } else{
        echo "error";
        die();
    }
    
    ?>


    <body>        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Student Statuses</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Welcome to the hub of the Highcliffe Sixth Form statuses</li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-12">
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
                                    <table id="myTable" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Candidate Number</th>
                                                <th>Surname</th>
                                                <th>Firstname</th>
                                                <th>Tutor Group</th>
                                                <th>Year Group</th>
                                                <th>Time Changed</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php

                                            $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; 
                                            include($IPATH."connectDB.php");
                                            
                                            $sql = "SELECT status.DateChange, students.CandidateNumber, students.Firstname, students.Surname, students.TutorGroup, students.YearGroup FROM `status`
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
                                                echo "<td>" . $row['YearGroup'] . "</td>";
                                                echo "<td>" . $row['DateChange'] . "</td>";
                                                echo "<td>" . $status . "</td>";
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
                </div>
            </main>

            <script>
                $(document).ready(function () {
                    $('#myTable').DataTable({
                        "paging": false
                    });
                });
            </script>

            <?php include($IPATH."footer.php"); ?>
        </div>
    </body>
</html>