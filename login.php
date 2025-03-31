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
            $validate = new validate();
            if(isset($_POST['login'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                if($validate->validateLogin($email, $password, $conn) == false){
                    echo "<p id='resultMsg' class='errorLogin'>Invalid email or password</p>";
                }
                $conn = null;
            }
        ?>
        <section id="loginSection">
            <form id="login_info" action="login.php#resultMsg" method="POST"> <!-- Form info -->
                <h2>Login</h2>
                <div>
                    <input id="email" type="email" name="email" placeholder="Please enter Email" required/>
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Please enter Password" required/>
                </div>
                <div>
                    <button type="reset">Clear</button>
                    <button type="submit" value="Login" name='login'>Login</button>
                </div>
            </form>
        </section>
        <?php
            include("./includes/global-footer.php");
        ?>