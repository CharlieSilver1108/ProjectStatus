<!-- This is the homepage -->

<!DOCTYPE html>
<html lang="en">    
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; include($IPATH."headernav.php"); ?>
    <title>Dashboard - <?php echo $username; ?></title> <!-- $username is set in the IPATH header when the user signs in -->
    
    <body>           
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">The Highcliffe Sixth Form status dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card highcliffe text-white mb-4">
                                <div class="card-body">Student Statuses</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="students.php?show=1">Visit this page</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card highcliffe text-white mb-4">
                                <div class="card-body">Status History</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="statushistory.php">Visit this page</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card highcliffe text-white mb-4">
                                <div class="card-body">Update Student Status</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="updatestatus.php">Visit this page</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Fire</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Visit this page</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header" style="font-size:20px">
                                    <i class="fas fa-sign-in-alt fa-lg me-1" style="color: #522a5b !important;"></i>
                                    Students Signed IN
                                    <button class="btn btn-sm btn-secondary" onClick="window.location.reload();" style="float:right; margin-top:5px; margin-right:5px;">Refresh</button> <!-- window.location.reload is a javascript functino to reload the page -->
                                </div>
                                <div class="card-body">
                                    <table style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Number Of Students:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include ($IPATH."connectDB.php");
                                            
                                                $sql = "SELECT status, COUNT(*) as count FROM status 
                                                        WHERE status = 1
                                                        GROUP BY status;";                  #Counts the number of students signed in
                                                
                                                $result = mysqli_query($conn,$sql);
                                                
                                                if (!$result) {
                                                    printf("Error: %s\n", mysqli_error($conn));
                                                    exit();
                                                }else{
                                                    while($row = mysqli_fetch_array($result)){
                                                    echo "<tr>";
                                                    echo "<td>" . $row['count'] . "</td>";
                                                    echo "<tr>";
                                                    }
                                                }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header" style="font-size:20px">
                                    <i class="fas fa-sign-out-alt fa-lg me-1" style="color: #522a5b !important;"></i>
                                    Students Signed OUT
                                    <button class="btn btn-sm btn-secondary"  onClick="window.location.reload();" style="float:right; margin-top:5px; margin-right:5px;">Refresh</button>
                                </div>
                                <div class="card-body">
                                    <table style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Number Of Students:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include ($IPATH."connectDB.php");
                                            
                                                $sql = "SELECT status, COUNT(*) as count FROM status 
                                                        WHERE status = 0
                                                        GROUP BY status;";                  #Counts the number of students signed in
                                                
                                                $result = mysqli_query($conn,$sql);
                                                
                                                if (!$result) {
                                                    printf("Error: %s\n", mysqli_error($conn));
                                                    exit();
                                                }else{
                                                    while($row = mysqli_fetch_array($result)){
                                                    echo "<tr>";
                                                    echo "<td>" . $row['count'] . "</td>";
                                                    echo "<tr>";
                                                    }
                                                }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php include($IPATH."footer.php"); ?>

        </div>
    </body>
</html>
