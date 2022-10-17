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
		$ID = $_POST['item_ID'];

		$sql = "delete FROM items WHERE id='$ID'";
		mysqli_query($con,$sql);

		header("Location: RemoveItem.php");
		die;

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Remove Item</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="EditUsersBody">

	<div>
		
		<form method="post" style="display: inline;">
			<div id="EditUserForm">
				<div><h1 style="margin: 1%;">Remove Item</h1></div><br><br>
				<input type="number" name="item_ID" min="1" placeholder="Item ID" style="width: 40%;" required><br><br>
				

			    <input type="submit" value="Remove Item" style="margin-top: 	5px;">



		    </div>

		</form>




	</div>

	<div onclick="Logout()" class="back">
        <a href="ControlPanel.php" style="text-decoration: none; color: #1e4e45; margin-left: 25%;">BACK</a>
    </div><br><br>

 <?php

    $sql = "select * from items";

	$Itemresult = $con->query($sql);

	if ($Itemresult->num_rows > 0) {
	  echo "<table><tr><th>ID</th><th>Item</th><th>Category</th><th>Old Quantity</th><th>Current Quantity</th><th>Price</th></tr>";
	  // output data of each row
	  while($row = $Itemresult->fetch_assoc()) {
	    echo "<tr><td>".$row["id"]."</td><td>".$row["item"]."</td><td>".$row["category"]."</td><td>".$row["old_quantity"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td></tr>";
	  }
	  echo "</table>";
	} else {
	  echo "0 results";
	}

 ?>

</body>
<script type="text/javascript" src="js/logout.js"></script>
</html>