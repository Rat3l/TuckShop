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

		$itemName = $_POST['item_name'];
		$itemCategory = $_POST['item_category'];
		$itemOldQuantity = $_POST['item_quantity'];
		$itemQuantity = $itemOldQuantity;
		$itemPrice = $_POST['item_price'];
		
		
		if($itemCategory != 'Category')
		{
			//Check if username has correct format
			if(!is_null($itemName))
			{
				//save the new user to database
				$query = "insert into items (item,category,old_quantity,quantity,price) values ('$itemName','$itemCategory','$itemOldQuantity','$itemQuantity','$itemPrice')";

				mysqli_query($con,$query);
				header("Location: AddItems.php");
				die;


			}else
			{
				echo "Please enter a valid username!";
			}
		}
		else
		{
			echo "Invalid Category";
		}
		

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Item</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="AddItemBody">

	<div>
		
		<form method="post" style="display: inline;">
		    <div id="AddItemForm">
			    <div><h1 style="margin: 1%;">Add Item</h1></div><br><br>
				<input type="text" name="item_name" placeholder="Item" style="width: 40%;" required><br><br>
				<select name="item_category" id="categorySelect">
			        <option value="Category" selected>Category</option><br>
			        <option value="DRINKS">Drinks</option>
			        <option value="CHIPS">Chips</option>
			        <option value="CHOCOLATES">Chocolates</option>
			        <option value="SWEETS">Sweets</option>
			        <option value="FOOD">Food</option>
			        <option value="OTHER">Other</option>
			    </select><br><br>
			    <input type="number" name="item_quantity" min="0" placeholder="Qty" style="width: 40%;" required><br><br>
			    <input type="number" name="item_price" min="0" placeholder="Price" style="width: 40%;" required><br><br>

			    <input type="submit" value="Add Item" style="margin-top: 5px;">
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
		  echo "<table><tr><th>ID</th><th>item</th><th>category</th><th>Old Quantity</th><th>Current Quantity</th><th>price</th></tr>";
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