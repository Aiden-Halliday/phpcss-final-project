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
            <section id="registerSection">
                <form id="register_info" action="register.php#resultMsg" method="POST" enctype='multipart/form-data'> <!-- Form info -->
                    <h2>Register an account</h2>
                    <div>
                        <input id ="fName" type="text" name="fName" required placeholder="Your first name">

                        <input id="lName" type="text" name="lName" required placeholder="Your last name">
                    </div>

                    <div>
                        <label for="dob">Date of Birth:</label><br/>
                        <input type="date" name="dob" id="dob" required/>
                    </div>

                    <div>
                        <input id="email" type="email" name="email" required placeholder="Your email"/>
                    </div>

                    <div>
                        <label for="userPassword">Account Password:</label><br/>
                        <input type="password" name="userPassword" id="userPassword" required placeholder="Password"/>
                    </div>
                    <div>
                        <label for="userConfirm">Confirm Password:</label><br/>
                        <input type="password" name="userConfirm" id="userConfirm" required placeholder="Confirm Password"/>
                    </div>

                    <div>
                        <label for="imgUpload">Upload a profile picture</label><br/>
                        <input type="file" name="file" id="imgUpload" />
                    </div>
                    <div>
                        <button type="reset">Clear</button>
                        <button type="submit" value='Submit' name='submit'>Submit</button>
                    </div>
                </form>
            </section>
            <?php
                $validate = new validate();
                if(isset($_POST['submit'])){
                    $fName = trim($_POST['fName']);
                    $lName = trim($_POST['lName']);
                    $dob = $_POST['dob'];
                    $email = $_POST['email'];
                    $password = $_POST['userPassword'];
                    $confirm = $_POST['userConfirm'];

                    //file name
                    $filename = $_FILES['file']['name'];
                    if ($filename == null){
                        $filename = "placeholder.png";
                    }
                    //location
                    $target_file = './uploads/'.$filename;
                    //file extensions
                    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                    $file_extension = strtolower($file_extension);
                    // valid image extensions
                    $valid_extension = array("png", "jpeg", "jpg");

                    $insertData = $conn->prepare("INSERT INTO useraccounts(fName, lName, dob, email, userpassword, profileimage) VALUES('$fName', '$lName', '$dob', '$email', '$password', '$target_file')");
                    
                    $msg = $validate->checkEmpty($_POST, array('fName', 'lName', 'dob', 'email', 'userPassword')); //checks that all data is not empty
                    $checkName = $validate->validName($_POST, array('fName', 'lName')); //checks that the first and last name have only letters and one hyphen
                    $checkEmail = $validate->validEmail($_POST['email'], $conn);  //checks that email is in proper format and doesnt already exist
                    $checkPassword = $validate->validPassword($_POST['userPassword'], $_POST['userConfirm']);
                    //check password
                    if($msg != null) //feedback for empty form inputs 
                    {
                        echo "<p id='resultMsg' class='errorMsg'>$msg</p>";
                    }
                    else if(!$checkName) //feedback for invalid name
                    {
                        echo "<p id='resultMsg' class='errorMsg'>Please provide a valid name (only letter characters and hyphens)</p>";
                    }
                    else if(!$checkEmail) //invalid email
                    {
                        echo "<p id='resultMsg' class='errorMsg'>Please provide a valid email that is not already used</p>";
                        
                    }
                    else if(!$checkPassword){
                        echo "<p id='resultMsg' class='errorMsg'>Password must be at least 7 characters, 1 uppercase, 1 lowercase and 1 number</p>";
                    }
                    else{
                        $password = hash('sha512', $password);
                        if(in_array($file_extension, $valid_extension)){
                            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file) || $target_file == './uploads/placeholder.png'){
                                $insertData->execute();
                                $conn = null;
                                echo "<section id='resultMsg' class='successResponse'>";
		                            echo "<div>";
			                            echo "<p>All setup, click the button below to head to the sign in page!</p>";
			                            echo "<a href='login.php'>Sign In</a>";
		                            echo "</div>";
	                            echo"</section>";
                            }
                        }
                    }
                }
                include("./includes/global-footer.php");
            ?>