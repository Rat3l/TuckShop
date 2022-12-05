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







?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	<title>Inventory</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="InventoryBody">


	<div onclick="Logout()" class="back">
        <a href="ControlPanel.php" style="text-decoration: none; color: #1e4e45; margin-left: 25%;">BACK</a>
    </div><br><br>

    <input onclick="handleRadioClick()" type="radio" id="AllInventory" name="InventorySelector" value="AllInventory" required>
	<label  for="AllInventory">All Items</label><br>
	<input onclick="handleRadioClick()" type="radio" id="SearchItem" name="InventorySelector" value="SearchItem">
	<label for="SearchItem">Search Item</label><br>
	<input onclick="handleRadioClick()" type="radio" id="SearchCategory" name="InventorySelector" value="SearchCategory">
	<label for="SearchCategory">Search Category</label><br>

	<div id="itemSelector">
		<label for="day">Search Item:</label>

		<select name="item_inventory" id="itemSelect">
			<?php  
                $resultSet = $con->query("SELECT * FROM items ORDER BY category");

                if ($resultSet->num_rows > 0) 
                {
	                while ($rows = $resultSet->fetch_assoc()) 
	                {
	                    $item = $rows['item'];

	                    echo "
	                        <option value='$item'>$item</option>
	                    ";
	                }
	            }
                  ?>
		</select>
	</div>

	<div id="categorySelector">
		<label for="day">Search Category:</label>
	
		<select name="category_inventory" id="categorySelect">
			<?php  
                $resultSet = $con->query("SELECT * FROM items ORDER BY category");

                if ($resultSet->num_rows > 0) 
                {
	                while ($rows = $resultSet->fetch_assoc()) 
	                {
	                    $item = $rows['category'];

	                    echo "
	                        <option value='$item'>$item</option>
	                    ";
	                }
	            }
                  ?>
		</select>
	</div>
    
	<input type="button" value="Submit" onclick="Submit()" id="submitButton">

	<input type="button" value="Copy" id="copyBtn" onclick="copyTable(document.getElementById('InventoryTable'))" style="display:none;">
	<div id="result"></div>


</body>
<script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous">
      

  </script>
<script type="text/javascript" src="js/Inventory.js"></script>
</html>
