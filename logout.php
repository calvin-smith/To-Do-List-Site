<?php 
//Built from SQL login tutorial by E-Oreo
//http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html


    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // We remove the user's data from the session 
    unset($_SESSION['User']); 
     
    // We redirect them to the login page 
    header("Location: index.php"); 
    //die("Redirecting to: index.php");
