<?php
    $server = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname= 'renting';
    try{
        $conn = new PDO("mysql:host=$server; dbname=$dbname", "$username", "$password");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
    catch(PDOException $_ENV){
        die("<p> Unable to connect to the database</p>");
    }
?>