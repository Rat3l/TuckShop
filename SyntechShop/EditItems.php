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

		$itemID = $_POST['item_ID'];
		$SelectedCategory = strtolower($_POST['selected_edit'] );
		$QuantitySelector = strtolower($_POST['quantity_select'] );

		if($SelectedCategory=='item' || $SelectedCategory=='category')
		{

			

			if($SelectedCategory == 'category' && $_POST['item_category'] != 'Category')
			{
				$value = strtoupper($_POST['item_category']);
				$query = "UPDATE items SET category='$value' WHERE id='$itemID'";		
			}else
			{
				$value = $_POST['string_val'];
				$query = "UPDATE items SET item='$value' WHERE id='$itemID'";	
			}

			

		
		}else if($SelectedCategory=='quantity' || $SelectedCategory=='price') 
		{
			$value = $_POST['int_val'];
			
			if($SelectedCategory == 'quantity')
			{
				if ($QuantitySelector == 'add') 
				{
					$value = strtoupper($value);
					$SQLquery = "select * from items where id='$itemID'";
					$result = mysqli_query($con,$SQLquery);

					while ($row = $result->fetch_assoc()) 
					{
				    	$oldQuantity = $row['quantity'];
					}

					$newQuantity = $oldQuantity + $value;
					$query = "UPDATE items SET quantity='$newQuantity',old_quantity='$newQuantity' WHERE id='$itemID'";	
				}else if ($QuantitySelector == 'subtract') 
				{
					$value = strtoupper($value);
					$SQLquery = "select * from items where id='$itemID'";
					$result = mysqli_query($con,$SQLquery);

					while ($row = $result->fetch_assoc()) 
					{
				    	$oldQuantity = $row['quantity'];
					}

					$newQuantity = $oldQuantity - $value;
					$query = "UPDATE items SET quantity='$newQuantity',old_quantity='$newQuantity' WHERE id='$itemID'";	
				}else if ($QuantitySelector == 'edit') 
				{
					$value = strtoupper($value);
					$query = "UPDATE items SET quantity='$value',old_quantity='$value' WHERE id='$itemID'";	
				}
	
			}else
			{
				$query = "UPDATE items SET price='$value' WHERE id='$itemID'";	
			}
		}
		
		
			mysqli_query($con,$query);

			header("Location: EditItems.php");
			die;

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	<title>Edit Item</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="EditItemsBody">

	<div>
		
		<form method="post" style="display: inline;">
		    <div id="EditItemForm">

			    <div><h1 style="margin: 1%;">Edit Item</h1></div><br><br>
				<input type="number" name="item_ID" min="1" placeholder="Item ID" style="width: 40%;" required><br><br>

				<p>Edit the following:</p>
				<input onclick="handleRadioClick()" type="radio" id="item" name="selected_edit" value="item">
				<label  for="item">Item</label><br>
				<input onclick="handleRadioClick()" type="radio" id="category" name="selected_edit" value="category">
				<label for="category">Category</label><br>
				<input onclick="handleRadioClick()" type="radio" id="quantity" name="selected_edit" value="quantity">
				<label for="quantity">Quantity</label><br>
				<input onclick="handleRadioClick()" type="radio" id="price" name="selected_edit" value="price">
				<label for="price">Price</label><br><br>

				<p id="StringVal"></p>
				<div id="QuantitySelector">
					<input onclick="handleRadioClick()" type="radio" id="add" name="quantity_select" value="add">
					<label for="add">Add</label><br>
					<input onclick="handleRadioClick()" type="radio" id="edit" name="quantity_select" value="edit">
					<label  for="edit">Edit</label><br>
					<input onclick="handleRadioClick()" type="radio" id="subtract" name="quantity_select" value="subtract">
					<label for="subtract">Subtract</label><br>
				</div>
				<input id="string" type="text" name="string_val" placeholder="Coke" style="width: 40%;">
				<input id="int" type="number" name="int_val" placeholder="12" style="width: 40%;">
				<select style="display: none;" name="item_category" id="#EditItemcategorySelect">
			        <option value="Category" selected>Category</option><br>
			        <option value="DRINKS">Drinks</option>
			        <option value="CHIPS">Chips</option>
			        <option value="CHOCOLATES">Chocolates</option>
			        <option value="SWEETS">Sweets</option>
			        <option value="FOOD">Food</option>
			        <option value="OTHER">Other</option>
			    </select>
				
				<br><br>

			    <input type="submit" value="Edit Item" style="margin-top: 5px;">
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
<script type="text/javascript" src="js/EditItems.js"></script>
</html>
