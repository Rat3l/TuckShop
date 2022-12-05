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

		$sql = "delete FROM users WHERE id='$ID'";
		mysqli_query($con,$sql);

		header("Location: RemoveUser.php");
		die;

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	<title>Remove User</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="EditUsersBody">

	<div>
		
		<form method="post" style="display: inline;">
			<div id="EditUserForm">
				<div><h1 style="margin: 1%;">Remove User</h1></div><br><br>
				<input type="number" name="user_ID" min="1" placeholder="User ID" style="width: 40%;" required><br><br>
				

			    <input type="submit" value="Remove User" style="margin-top: 	5px;">



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
