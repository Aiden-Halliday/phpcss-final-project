<?php
    $title = "View Users | Rent N' Run";
    $description = "restricted page of Rent N' Run";
	include './includes/global-header.php';

	if($loggedIn == 0){
		header('location:index.php');
		exit();
	}
	else{
		//connect to the database
		require_once ('./includes/database.php');
		$sql = "SELECT * FROM useraccounts";
		// run the query and store the results
		$result = $conn->query($sql);
		//create our table
		echo "<section>";
		echo "<table>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Date of Birth</th>
				</tr>";
			foreach($result as $row){
				echo "<tr>
						<td>" . $row['fname'] . "</td>
						<td>" . $row['lname'] . "</td>
						<td>" . $row['email'] . "</td>
						<td>" . $row['dob'] . "</td>
				</tr>";
			}
			//close our table
			echo "</table>";
			echo"<a href='logout.php'>Logout</a>";
		echo "</section>";
		$conn = null;
	}
	include './includes/global-footer.php';
?>