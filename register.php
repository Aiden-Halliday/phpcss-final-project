<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- metadata -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Register an account">
        <meta name="robots" content="noindex, nofollow">
        <title>Register | Rent N' Run</title>
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
            <?php
	            include("./includes/global-header.html");
            ?>
        </header>
            <form id="register_info" action="" method="POST"> <!-- Form info -->
                <h2>Register an account</h2>
                <label for="fName">First Name:</label>
                <input id ="fName" type="text" name="fName" required placeholder="Your first name">

                <label for="lName">Last Name:</label>
                <input id="lName" type="text" name="lName" required placeholder="Your last name">

                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" id="dob" required/>

                <label for="email">Email:</label>
                <input id="email" type="email" name="email" required/>

                <label for="password">Account Password:</label>
                <input type="password" name="password" id="password" required/>

                <label for="imgUpload">Upload a profile picture:</label>
                <input type="file" name="file" id="imgUpload" />

                <button type="reset">Clear</button>
                <button type="submit">Submit</button>
            </form>
        <footer>
            <?php
	            include("./includes/global-footer.html");
            ?>
        </footer>
    </body>
</html>