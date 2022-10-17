<?php 

	session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);


	// $HasLoggedIn = $_SESSION['isPassCorrect'];

	// if(!isset($HasLoggedIn) || !$user_data['isAdmin'] || !$HasLoggedIn) {
 //    	header("Location: index.php");
	// 	die;
 //    }



    $ShowAll = $_POST['postShowAll'];
    

	if ($ShowAll === "false") {
		if(isset($_POST['postCategory'])) {
				$Category = $_POST['postCategory'];
				$sqli = "select * from items where category='$Category'";

				$Itemresult = $con->query($sqli);

				if ($Itemresult->num_rows > 0) {
					 echo "<table id='InventoryTable'><th>ID</th><th>Item</th><th>Category</th><th>Old Quantity</th><th>Current Quantity</th><th>Price</th></tr>";
					  // output data of each row

					while($row = $Itemresult->fetch_assoc()) {			 	
					    echo "<tr><td>".$row["id"]."</td><td>".$row["item"]."</td><td>".$row["category"]."</td><td>".$row["old_quantity"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td></tr>";
					}
				} else {
					echo "0 results";
				}
		}else if(isset($_POST['postItem']))
		   {

		    	$item = $_POST['postItem'];
				$sqli = "select * from items where item='$item'";

				$Itemresult = $con->query($sqli);

				if ($Itemresult->num_rows > 0) {
					 echo "<table id='InventoryTable'><th>ID</th><th>Item</th><th>Category</th><th>Old Quantity</th><th>Current Quantity</th><th>Price</th></tr>";
					  // output data of each row

					while($row = $Itemresult->fetch_assoc()) {			 	
					    echo "<tr><td>".$row["id"]."</td><td>".$row["item"]."</td><td>".$row["category"]."</td><td>".$row["old_quantity"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td></tr>";
					}
				} else {
					echo "0 results";
				}
			}
   }else
		{
				$sqli = "select * from items ORDER BY category";

				$Itemresult = $con->query($sqli);

				if ($Itemresult->num_rows > 0) {
					 echo "<table id='InventoryTable'><th>ID</th><th>Item</th><th>Category</th><th>Old Quantity</th><th>Current Quantity</th><th>Price</th></tr>";
					  // output data of each row

					while($row = $Itemresult->fetch_assoc()) {			 	
					    echo "<tr><td>".$row["id"]."</td><td>".$row["item"]."</td><td>".$row["category"]."</td><td>".$row["old_quantity"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td></tr>";
					}
				} else {
					echo "0 results";
				}
		}

	




	die;





