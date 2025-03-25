        <?php
            $title = "Login | Rent N' Run";
            $description = "login to Rent N' Run";
            include("./includes/global-header.php");
            require_once ('./includes/database.php');
            require_once('./includes/validate.php');
            if($loggedIn == 1){
                header('location:index.php');
                exit();
            }
        ?>
        <form id="login_info" action="login.php" method="POST"> <!-- Form info -->
            <h2>Login</h2>

            <label for="email">Email:</label>
            <input id="email" type="email" name="email" placeholder="Please enter Email" required/>

            <label for="password">Account Password:</label>
            <input type="password" name="password" id="password" placeholder="Please enter Password" required/>

            <button type="reset">Clear</button>
            <button type="submit" value="Submit" name='submit'>Submit</button>

        </form>
        <?php
            $validate = new validate();
            if(isset($_POST['submit'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $validate->validateLogin($email, $password, $conn);
                $conn = null;
            }
            include("./includes/global-footer.php");
        ?>