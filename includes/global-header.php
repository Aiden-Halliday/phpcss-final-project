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
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Honk&family=Jersey+15&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <!-- css -->
        <link rel="stylesheet" href="./css/reset.css">
        <link rel="stylesheet" href="./css/style.css">
        <!-- Javascript -->
         <script src="js/script.js" defer></script>
    </head>
    <body>
        <header>
            <a href="index.php" class="logoLink">
                <h1>Rent N' Run</h1>
            </a>
            <nav>
                <menu>
                    <li><a href="index.php"> Home </a></li>
                    <li><a href="register.php"> Register </a></li>
                    <li><a href="login.php"> Login </a></li>
                    <li><a href="viewData.php"> Users </a></li>
                </menu>
            </nav>
            <?php
                session_start();
                $loggedIn = isset($_SESSION['accountid']) ? 1 : 0;

                // Check if the user_id session variable exists
                if (isset($_SESSION['accountid'])) {

                    $account_id = $_SESSION['accountid'];

                    require_once './includes/database.php';

                    $sql = "SELECT fname, lname, profileimage FROM useraccounts WHERE accountid = '$account_id'";
                    $result = $conn->query($sql);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        echo "<div class='headerAccount'>";
                            echo "<img src='" . $row['profileimage'] . "' alt='profile picture'>";
                            echo "<a href='userLibrary.php' class='usernameText'>" . ($row['fname']) . " " . ($row['lname']) . "</a>";
                        echo "</div>";
                        $loggedIn = true;
                    } else {
                        echo "<h1>No user found</h1>";
                    }
                }
                else {
                    ?>
                    <div class="headerLogin">
                        <form id="header_login" action="login.php" method="POST"> <!-- Form info -->
                            <h1>Login</h1>

                            <input id="headerEmail" type="email" name="email" placeholder="Please enter Email" required/>

                            <input type="password" name="password" id="headerPassword" placeholder="Please enter Password" required/>

                            <button type="submit" value="Login" name='login'>Login</button>

                        </form>
                    </div>
                    <?php
                }
            ?>
        </header>