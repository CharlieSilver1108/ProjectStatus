<!-- This is the page visited to update a student's status -->

<!DOCTYPE html>
<html lang="en">
    <title>Update Student Status</title>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]. "/PROJECT/Website/assets/IPATH/"; include($IPATH."headernav.php"); ?>

    <style>
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
    </style>


    <body>           
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Update Student Status</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Update A Highcliffe Sixth Form Student's Status</li>
                    </ol>
                    
                    <div class="container" id="deleteStudentForm">
                        <div class="row">
                            <div class="col-lg-12" style="float:centre;" style="border-radius: 2em !important;">
                                
                                <form method="post" action="websigninout.php">

                                    <div class="card shadow-lg border-0 rounded-sm mt-3">
                                        <div class="card-header highcliffe">
                                            <h3 class="text-center font-weight-light my-4" style="color:#ffffff !important;">Update A Student Status</h3>
                                        </div>

                                        <div class="card-body">
                                            <div class="login">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="canNum" id="inputCandidateNum" type="number" pattern="[1-9]{1}[0-9]{3}" placeholder="Candidate Number" autocomplete="off" required/>
                                                            <label for="inputCandidateNum">Candidate Number <i class="muted" style="font-size: 10px;">(4 Numbers)</i></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3">
                                                            <select class="form-control" id="status" name="status" placeholder="Choose Status" autocomplete="off" required>
                                                                <option hidden></option>
                                                                <option value="1">IN</option>
                                                                <option value="0">OUT</option>
                                                            </select>
                                                            <label for="status">Status</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="mb-2"style="float: right !important;">
                                                <button type="submit" id="submitButton" class="btn btn-highcliffe" value="Submit">Update</button>
                                            </div>
                                        </div>
        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </main>

            <?php include($IPATH."footer.php"); ?>

        </div>
    </body>
</html>
