<?php

	session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);


	$HasLoggedIn = $_SESSION['isPassCorrect'];
    

    if(!isset($HasLoggedIn) || !$user_data['isAdmin'] || !$HasLoggedIn) {
    	header("Location: index.php");
		die;
    }







	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//The signup submit button was pressed
		$ID = $_POST['user_ID'];
		$username = $_POST['user_name'];
		$isAdmin = $_POST['isAdmin'];

		
   
	   	$sqli2 = "select user_name from users where id='$ID'";
			$resultt = mysqli_query($con,$sqli2);
			if ($resultt->num_rows > 0) 
			{
				while($row = $resultt->fetch_assoc()) 
				{			 	
					$name = $row["user_name"];

				}
			} else 
			{
				echo "0 results";
			}



		if ($isAdmin === 'Yes') 
		{
			$isAdmin = 1;
		}else
		{
			$isAdmin = 0;
		}

		//Check if username has correct format
		if(!is_numeric($username) && !empty($username))
		{

	
			$query = "UPDATE users SET user_name='$username' , isAdmin='$isAdmin' WHERE id='$ID'";
			

			mysqli_query($con,$query);

			$query2 = "UPDATE sales SET user_name='$username' WHERE user_name='$name'";	
			mysqli_query($con,$query2);

			header("Location: EditUsers.php");
			die;

		}else
		{
			echo "Please enter a valid username!";
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit User</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="EditUsersBody">

	<div>
		
		<form method="post" style="display: inline;">
			<div id="EditUserForm">
				<div><h1 style="margin: 1%;">Edit User</h1></div><br><br>
				<input type="number" name="user_ID" min="1" placeholder="User ID" style="width: 40%;" required><br><br>
				<p>New Username:</p>
				<input type="text" name="user_name" placeholder="Username" style="width: 40%;" required><br><br>
				
				<p>Is Admin?</p>
				<select name="isAdmin" id="isAdmin">
			        <option value="No" selected>No</option><br>
			        <option value="Yes">Yes</option>
			    </select><br><br>

			    <input type="submit" value="Edit User" style="margin-top: 	5px;">



		    </div>

		</form>




	</div>

	<div onclick="Logout()" class="back">
        <a href="ControlPanel.php" style="text-decoration: none; color: #1e4e45; margin-left: 25%;">BACK</a>
    </div><br><br>

     <?php

	    $sql = "select * from users";

		$Itemresult = $con->query($sql);

		if ($Itemresult->num_rows > 0) {
		  echo "<table><tr><th>ID</th><th>Username</th><th>IsAdmin (Yes=1)</th></tr>";
		  // output data of each row
		  while($row = $Itemresult->fetch_assoc()) {
		    echo "<tr><td>".$row["id"]."</td><td>".$row["user_name"]."</td><td>".$row["isAdmin"]."</td></tr>";
		  }
		  echo "</table>";
		} else {
		  echo "0 results";
		}

	 ?>

</body>
<script type="text/javascript" src="js/logout.js"></script>
</html>