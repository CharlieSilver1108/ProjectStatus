<!-- This is the page visited for the user to log in -->

<!DOCTYPE html>
<html lang="en">
    <?php 
        session_abort();            #Restarts session
        clearstatcache();
    ?>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Highcliffe Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>

   <style>
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
    </style>


    <script>
        function showPassword() {                       //Javascript function used to toggle between password view and text view
            var x = document.getElementById("inputPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>



    <body class="highcliffe">
        <div id="layoutAuthentication">
            <div><img src="assets/img/highcliffelogo.png" class="img-fluid max-width:100% height: auto" style="margin-top:10px; margin-left:10px;"></div>
            <div id="layoutAuthentication_content">
                <main>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <form method="post" action="authenticate.php">
                                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                        <div class="card-body">
                                            <div class="login">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputUsername" name="username" type="username" placeholder="Username" autocomplete="off" required/>
                                                    <label for="inputUsername">Username</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" required/>
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                    <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                                    <div style="float:right;">
                                                        <label class="form-check-label" for="inputShowPassowrd">Show Password</label>
                                                        <input class="form-check-input" id="inputShowPassowrd" type="checkbox" onclick="showPassword()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center py-3">
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <button type="submit" id="submitButton" class="btn btn-highcliffe" value="Submit">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
