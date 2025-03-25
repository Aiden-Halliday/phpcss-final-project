<?php
    $title = "Logout | Rent N' Run";
    $description = "Logout of Rent N' Run";
    include './includes/global-header.php';

    
    session_start();

    session_unset();

    session_destroy();

    header('location:index.php');
    include './includes/global-footer.php';
?>