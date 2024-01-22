<!-- This is the page visited when the user clicks the logout button -->

<?php
Session_start();                        #Destroys the current session to remove signed in variables
Session_destroy();                      
header('Location: ' . "login.php");     #redirects the user to the login screen

?>