<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- metadata -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="robots" content="noindex, nofollow">
        <link rel="shortcut icon" href="./imgs/icon.png" type="image/x-icon">
        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Jersey+15&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
        <!-- css -->
        <link rel="stylesheet" href="./css/reset.css">
        <link rel="stylesheet" href="./css/style.css">
        <!-- Javascript -->
         <script src="js/script.js" defer></script>
    </head>
    <body>
        <header>
            <h1>Rent N' Run</h1>
            <nav>
                <menu>
                    <li><a href="index.php"> Home </a></li>
                    <li><a href="register.php"> Register </a></li>
                    <li><a href="login.php"> Login </a></li>
                    <li><a href="viewData.php"> See Users </a></li>
                </menu>
            </nav>
            <?php
                session_start();
                $loggedIn = isset($_SESSION['accountid']) ? 1 : 0;

                // Check if the user_id session variable exists
                if (isset($_SESSION['accountid'])) {

                    $account_id = $_SESSION['accountid'];

                    require_once './includes/database.php';

                    $sql = "SELECT fname, lname FROM useraccounts WHERE accountid = '$account_id'";
                    $result = $conn->query($sql);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        echo "<h1>" . ($row['fname']) . " " . ($row['lname']) . "</h1>";
                        $loggedIn = true;
                    } else {
                        echo "<h1>No user found</h1>";
                    }
                }
                else {
                    echo "<h1>No session found. Please log in.</h1>";
                }
            ?>
        </header>