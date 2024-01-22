<!-- This is the page visited to view the sign in history -->

<!DOCTYPE html>
<html lang="en">
    <title>Student Status History</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css/switch.css?version=55" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/";
    include($IPATH."headernav.php");     
    ?>


    <body>        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Student Status History</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Welcome to the hub of the Highcliffe Sixth Form Status History</li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header" style="font-size: 20px">
                                    <span style="color: #522a5b"><i class="fas fa-history me-1"></i></span>
                                    Status History

                                    <a style="float:right; margin-top: 5px;" class="btn btn-sm btn-dark" href="deletehistory.php?all=1" onclick="return confirm('Are you sure you want to delete all status history?'); //Java popup for confirming form submit">Delete All History</a>
                                    <a style="float:right; margin-top: 5px; margin-right: 5px;" class="btn btn-sm btn-dark" href="deletehistory.php?all=2" onclick="return confirm('Are you sure you want to delete status history from longer than a month ago?');">Delete Previous Month</a>
                                    <button class="btn btn-sm btn-highcliffe" onclick="window.location.reload(); //Java reload page to update table" style="float:right; margin-top:5px; margin-right:5px;">Refresh</button>
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
                                                <th>Date Changed</th>
                                                <th>Time Changed</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php

                                            include "connectDB.php";
                                            
                                            $sql = "SELECT signinhistory.DateChange, signinhistory.TimeChange, students.CandidateNumber, students.Firstname, students.Surname, students.TutorGroup, students.YearGroup, signinhistory.Status FROM `signinhistory`
                                            LEFT JOIN `students` ON signinhistory.CandidateNumber = students.CandidateNumber
                                            ORDER BY signinhistory.DateChange DESC;";
                                                
                                            $result = mysqli_query($conn,$sql);
                                            if (!$result) {
                                                printf("Error: %s\n", mysqli_error($conn));
                                                exit();
                                            }else{
                                                while($row = mysqli_fetch_array($result)){
                                                if($row['Status'] == 1){$pStatus = "IN";}elseif($row['Status'] == 0){$pStatus = "OUT";}else{$pStatus = "Error";};
                                                echo "<tr>";
                                                echo "<td>" . $row['CandidateNumber'] . "</td>";
                                                echo "<td>" . $row['Surname'] . "</td>";
                                                echo "<td>" . $row['Firstname'] . "</td>";
                                                echo "<td>" . $row['TutorGroup'] . "</td>";
                                                echo "<td>" . $row['YearGroup'] . "</td>";
                                                echo "<td>" . $row['DateChange'] . "</td>";
                                                echo "<td>" . $row['TimeChange'] . "</td>";
                                                echo "<td>" . $pStatus . "</td>";
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
                        "paging": false,
                        "order": [[ 5 , 'desc' ], [6, 'desc']]
                    });
                });
            </script>

            <?php include($IPATH."footer.php"); ?>
        </div>
    </body>
</html>