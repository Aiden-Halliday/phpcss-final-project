<?php
    $title = "View Users | Rent N' Run";
    $description = "restricted page of Rent N' Run";
	include './includes/global-header.php';

	if($loggedIn == 0){
		header('location:index.php');
		exit();
	}
	else{
		require_once ('./includes/database.php');
		if (isset($_POST['delete'])) {
			$idToDelete = ($_POST['delete']); 

			$stmt = $conn->prepare("DELETE FROM useraccounts WHERE accountid = '$idToDelete'");
			if ($stmt->execute()) {
				$message = "Row deleted successfully!";
				if ($idToDelete == $account_id){
					header('location:logout.php');
					exit();
				}
			} else {
				$message = "Error: " . $conn->error;
			}
		}
		
		if (isset($_POST['submit'])) {
			require_once('./includes/validate.php');
			$validate = new validate();
			$idToUpdate = ($_POST['userId']); 
			$newFName = trim($_POST['fName']);
            $newLName = trim($_POST['lName']);
			$newEmail = $_POST['email'];

			$filename = $_FILES['file']['name'];
            if ($filename == null){
                $filename = "placeholder.png";
            }

			$target_file = './uploads/'.$filename;
			//file extensions
			$file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			// valid image extensions
			$valid_extension = array("png", "jpeg", "jpg");
			$updateData = $conn->prepare("UPDATE useraccounts SET fname = '$newFName', lname = '$newLName', email = '$newEmail', profileimage = '$target_file' WHERE accountid = '$idToUpdate';)");
			$msg = $validate->checkEmpty($_POST, array('fName', 'lName', 'email')); //checks that all data is not empty
			$checkName = $validate->validName($_POST, array('fName', 'lName')); //checks that the first and last name have only letters
			$checkEmail = $validate->validEmail($_POST['email'], $conn);  //checks that email is in proper format and doesnt already exist
			//check password
			if($msg != null) //feedback for empty form inputs 
			{
				echo "<p>$msg</p>";
			}
			else if(!$checkName) //feedback for invalid name
			{
				echo "<p>Please provide a valid name (only letter characters and hyphens)</p>";
			}
			else if(!$checkEmail) //invalid email
			{
				echo "<p>Please provide a valid email</p>";
				
			}
			else{
				if(in_array($file_extension, $valid_extension)){
					if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
						$updateData->execute();
						$message = "User Updated successfully!";
					}
					else if($target_file == './uploads/placeholder.png') {
						$updateData->execute();
						$message = "User Updated successfully!";
					}
				}
			}
		}

		if (isset($message)) {
			echo "<p>$message</p>";
		}

		$sql = "SELECT * FROM useraccounts";
		// run the query and store the results
		$result = $conn->prepare($sql);
		$result->execute();

		echo "<section>";
		echo "<table>
				<tr>
					<th>Id</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Date of Birth</th>
					<th>Profile Picture</th>
				</tr>";
			foreach($result as $row){
				echo "<tr>
							<td>" . $row['accountid'] . "</td>
							<td>" . $row['fname'] . "</td>
							<td>" . $row['lname'] . "</td>
							<td>" . $row['email'] . "</td>
							<td>" . $row['dob'] . "</td>
							<td>
								<img src='" . $row['profileimage'] . "' alt='profile picture'>
							</td>
							<td>
								<form method='POST' action='viewData.php'>
									<button type='submit' name='delete' value='{$row['accountid']}'>Delete</button>
								</form>
							</td>
							<td>
								<form method='POST' action='viewData.php'>
									<button type='submit' name='update' value='{$row['accountid']}'>Update</button>
								</form>
							</td>
					</tr>";
			}
			echo "</table>";
			if (isset($_POST['update'])) {
				$idToUpdate = ($_POST['update']); 
				$updateQuery = "SELECT * FROM useraccounts WHERE accountid = '$idToUpdate'";
            	$updateResult = $conn->prepare($updateQuery);
            	$updateResult->execute();

            	$count = $updateResult -> rowCount();

				if ($count == 1) {
					$row = $updateResult->fetch(PDO::FETCH_ASSOC);
					$originalFName = $row['fname'];
					$originalLName = $row['lname'];
					$originalEmail = $row['email'];

					// Output the form with prefilled values
					echo "<form method='POST' action='viewData.php' id='updateForm' enctype='multipart/form-data'>
							<input type='hidden' id='userId' name='userId' value='$idToUpdate'>
							<label for='fName'>First Name:</label>
							<input id='fName' type='text' name='fName' value='$originalFName' required>
							<label for='lName'>Last Name:</label>
							<input id='lName' type='text' name='lName' value='$originalLName' required>
							<label for='email'>Email:</label>
							<input type='email' id='email' name='email' value='$originalEmail' required>
							<label for='file'>Upload a Profile Picture:</label>
							<input type='file' name='file' id='imgUpload'>
							<button type='submit' name='submit'>Update</button>
						</form>";
				} 
				else {
            		echo "User not found.";
        		}
			}
			
			echo"<a href='logout.php'>Logout</a>";
		echo "</section>";
	}
	
	include './includes/global-footer.php';
?>