<?php

function getDatabaseConnection($dbname){
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $dbname = "heroku_87e7042268995be";
    $username = "bbabc890c66b77";
    $password = "ed6002a9";
    
    //Creates a database connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Setting Errorhandling to Exception
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    return $dbConn;    
}

?>