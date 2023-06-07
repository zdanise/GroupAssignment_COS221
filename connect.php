<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "gws_group27vs4";
    session_start();
    try 
    {
        $con = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    }
    catch(Exception $th){  
        die("Could not connect!");
   }
    
?> 