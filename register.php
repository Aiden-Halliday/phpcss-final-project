            <?php
                $title = "Register an Account | Rent N' Run";
                $description = "register for Rent N' Run";
                include("./includes/global-header.php");
                require_once ('./includes/database.php');
                require_once('./includes/validate.php');
                if($loggedIn == 1){
                    header('location:index.php');
                    exit();
                }
            ?>
            <form id="register_info" action="register.php" method="POST" enctype='multipart/form-data'> <!-- Form info -->
                <h2>Register an account</h2>
                <label for="fName">First Name:</label>
                <input id ="fName" type="text" name="fName" required placeholder="Your first name">

                <label for="lName">Last Name:</label>
                <input id="lName" type="text" name="lName" required placeholder="Your last name">

                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" id="dob" required/>

                <label for="email">Email:</label>
                <input id="email" type="email" name="email" required/>

                <label for="userPassword">Account Password:</label>
                <input type="password" name="userPassword" id="userPassword" required/>

                <label for="userConfirm">Account Password:</label>
                <input type="password" name="userConfirm" id="userConfirm" required/>

                <label for="imgUpload">Upload a profile picture:</label>
                <input type="file" name="file" id="imgUpload" />

                <button type="reset">Clear</button>
                <button type="submit" value='Submit' name='submit'>Submit</button>
            </form>
            <?php
                $validate = new validate();
                if(isset($_POST['submit'])){
                    $fName = $_POST['fName'];
                    $lName = $_POST['lName'];
                    $dob = $_POST['dob'];
                    $email = $_POST['email'];
                    $password = $_POST['userPassword'];
                    $confirm = $_POST['userConfirm'];

                    $insertData = $conn->prepare("INSERT INTO useraccounts(fName, lName, dob, email, userpassword) VALUES('$fName', '$lName', '$dob', '$email', '$password')");
                    
                    $msg = $validate->checkEmpty($_POST, array('fName', 'lName', 'dob', 'email', 'userPassword')); //checks that all data is not empty
                    $checkName = $validate->validName($_POST, array('fName', 'lName')); //checks that the first and last name have only letters
                    $checkEmail = $validate->validEmail($_POST['email']);  //checks that email is in proper format
                    $checkPassword = $validate->validPassword($_POST['userPassword'], $_POST['userConfirm']);
                    //check password
                    if($msg != null) //feedback for empty form inputs (shouldn't appear due to html required but failsafe is here just incase)
                    {
                        echo "<p>$msg</p>";
                    }
                    else if(!$checkName) //feedback for invalid name
                    {
                        echo "<p>Please provide a valid name (only letter characters and hyphens)</p>";
                        echo "<div>";
                        echo "<a href='javascript:self.history.back();'>Go Back </a>";
                        echo "</div>";
                    }
                    else if(!$checkEmail) //invalid email
                    {
                        echo "<p>Please provide a valid email</p>";
                        echo "<div>";
                        echo "<a href='javascript:self.history.back();'>Go Back </a>";
                        echo "</div>";
                        
                    }
                    else if(!$checkPassword){
                        echo "<p>Please provide a valid password</p>";
                        echo "<div>";
                        echo "<a href='javascript:self.history.back();'>Go Back </a>";
                        echo "</div>";
                    }
                    else{
                        $password = hash('sha512', $password);
                        $insertData->execute();
                        echo "<section class='successResponse'>";
		                    echo "<div>";
			                    echo "<p>All setup, click the button below to head to the sign in page!</p>";
			                    echo "<a href='login.php'>Sign In</a>";
		                    echo "</div>";
	                    echo"</section>";
                        $conn = null;
                    }
                }
                include("./includes/global-footer.php");
            ?>