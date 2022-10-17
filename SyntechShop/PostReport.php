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
    
    if(!isset($_POST['postUser'])) {
		if ($ShowAll === "false") {
			$Year = $_POST['postYear'];
			$Month = $_POST['postMonth'];
			if(isset($_POST['postDay'])) {

					$sql = "select * from items";

					$Itemresult = $con->query($sql);
					$Day = $_POST['postDay'];



					if (!isset($Total)) {
						$Total = 0;
					}

					if (!isset($NumberOfSales)) {
						$NumberOfSales = 0;
					}

					if ($Itemresult->num_rows > 0) {
					  echo "<table id='ReportTable'><th>Item Name</th><th>Amount Sold</th><th>Money Made</th></tr>";
					  // output data of each row

					  while($row = $Itemresult->fetch_assoc()) {
					 	$itembought = $row["item"];
					 	$sqli = "select sum(quantity) as quantity_val from sales where item_bought='$itembought' AND YEAR(date) = '$Year' AND MONTH(date) = '$Month' AND DAY(date) = '$Day'";
					 	$resultt = mysqli_query($con,$sqli);
					 	$singeRow = mysqli_fetch_assoc($resultt); 
						$Quantitysum = $singeRow['quantity_val'];

						if (is_null($Quantitysum)) {
							$Quantitysum = 0;
						}

						$sqliQuery = "select sum(price) as price_val from sales where item_bought='$itembought' AND YEAR(date) = '$Year' AND MONTH(date) = '$Month' AND DAY(date) = '$Day'";
					 	$result = mysqli_query($con,$sqliQuery);
					 	$singeRow = mysqli_fetch_assoc($result); 
						$Pricesum = $singeRow['price_val'];

						if (is_null($Pricesum)) {
							$Pricesum = 0;
						}
						
					  	$Total +=  $Pricesum;
					  	$NumberOfSales += $Quantitysum;

					     echo "<tr><td>".$row["item"]."</td><td>".$Quantitysum."</td><td>R".$Pricesum."</td></tr>";
					  }
					  echo "<tr></tr><tr></tr><tr class='Total'><td></td><td>Total:<td>R".$Total."</td></table>";

					  echo "<div class='numsales'>Total Items Sold: <p class='center'>".$NumberOfSales."</p></div>";
					  echo "<div class='numsales'>Revenue: <p class='center'>R".$Total."<p></div>";
					} else {
					  echo "0 results";
					}
		    }else
		    {

		    		$sql = "select * from items";

					$Itemresult = $con->query($sql);



					if (!isset($Total)) {
						$Total = 0;
					}

					if (!isset($NumberOfSales)) {
						$NumberOfSales = 0;
					}

					if ($Itemresult->num_rows > 0) {
					  echo "<table id='ReportTable'><th>Item Name</th><th>Amount Sold</th><th>Money Made</th></tr>";
					  // output data of each row

					  while($row = $Itemresult->fetch_assoc()) {
					 	$itembought = $row["item"];
					 	$sqli = "select sum(quantity) as quantity_val from sales where item_bought='$itembought' AND YEAR(date) = '$Year' AND MONTH(date) = '$Month'";
					 	$resultt = mysqli_query($con,$sqli);
					 	$singeRow = mysqli_fetch_assoc($resultt); 
						$Quantitysum = $singeRow['quantity_val'];

						if (is_null($Quantitysum)) {
							$Quantitysum = 0;
						}

						$sqliQuery = "select sum(price) as price_val from sales where item_bought='$itembought' AND YEAR(date) = '$Year' AND MONTH(date) = '$Month'";
					 	$result = mysqli_query($con,$sqliQuery);
					 	$singeRow = mysqli_fetch_assoc($result); 
						$Pricesum = $singeRow['price_val'];

						if (is_null($Pricesum)) {
							$Pricesum = 0;
						}
						
					  	$Total +=  $Pricesum;
					  	$NumberOfSales += $Quantitysum;

					     echo "<tr><td>".$row["item"]."</td><td>".$Quantitysum."</td><td>R".$Pricesum."</td></tr>";
					  }
					  echo "<tr></tr><tr></tr><tr class='Total'><td></td><td>Total:<td>R".$Total."</td></table>";

					  echo "<div class='numsales'>Total Items Sold: <p class='center'>".$NumberOfSales."</p></div>";
					  echo "<div class='numsales'>Revenue: <p class='center'>R".$Total."<p></div>";
					} else {
					  echo "0 results";
					}


		    }
		}else
		{
		
			$sql = "select * from items";

			$Itemresult = $con->query($sql);



			if (!isset($Total)) {
				$Total = 0;
			}

			if (!isset($NumberOfSales)) {
				$NumberOfSales = 0;
			}

			if ($Itemresult->num_rows > 0) {
			  echo "<table id='ReportTable'><th>Item Name</th><th>Amount Sold</th><th>Money Made</th></tr>";
			  // output data of each row

			  while($row = $Itemresult->fetch_assoc()) {
			 	$itembought = $row["item"];
			 	$sqli = "select sum(quantity) as quantity_val from sales where item_bought='$itembought'";
			 	$resultt = mysqli_query($con,$sqli);
			 	$singeRow = mysqli_fetch_assoc($resultt); 
				$Quantitysum = $singeRow['quantity_val'];

				if (is_null($Quantitysum)) {
					$Quantitysum = 0;
				}

				$sqliQuery = "select sum(price) as price_val from sales where item_bought='$itembought'";
			 	$result = mysqli_query($con,$sqliQuery);
			 	$singeRow = mysqli_fetch_assoc($result); 
				$Pricesum = $singeRow['price_val'];

				if (is_null($Pricesum)) {
					$Pricesum = 0;
				}
				
			  	$Total +=  $Pricesum;
			  	$NumberOfSales += $Quantitysum;

			     echo "<tr><td>".$row["item"]."</td><td>".$Quantitysum."</td><td>R".$Pricesum."</td></tr>";
			  }
			  echo "<tr></tr><tr></tr><tr></tr><tr class='Total'><td></td><td>Total:<td>R".$Total."</td></table>";

			  echo "<div class='numsales'>Total Items Sold: <p class='center'>".$NumberOfSales."</p></div>";
			  echo "<div class='numsales'>Revenue: <p class='center'>R".$Total."<p></div>";
			} else {
			  echo "0 results";
			}
		}
	}else
   {

		

   		$User = $_POST['postUser'];

   		$sql = "select * from items";

		$Itemresult = $con->query($sql);



		if (!isset($Total)) 
		{
			$Total = 0;
		}

		if (!isset($NumberOfSales)) 
		{
			$NumberOfSales = 0;
		}

		if ($Itemresult->num_rows > 0) {
			echo "<table id='ReportTable'><th>Item Name</th><th>Amount Sold</th><th>Money Made</th></tr>";
			  // output data of each row

			while($row = $Itemresult->fetch_assoc()) 
			{
			 	$itembought = $row["item"];
			 	$sqli = "select sum(quantity) as quantity_val from sales where item_bought='$itembought' AND user_name='$User'";
			 	$resultt = mysqli_query($con,$sqli);
			 	$singeRow = mysqli_fetch_assoc($resultt); 
				$Quantitysum = $singeRow['quantity_val'];

				if (is_null($Quantitysum)) {
					$Quantitysum = 0;
				}

				$sqliQuery = "select sum(price) as price_val from sales where item_bought='$itembought' AND user_name='$User'";
			 	$result = mysqli_query($con,$sqliQuery);
			 	$singeRow = mysqli_fetch_assoc($result); 
				$Pricesum = $singeRow['price_val'];

				if (is_null($Pricesum)) {
					$Pricesum = 0;
				}
				
			  	$Total +=  $Pricesum;
			  	$NumberOfSales += $Quantitysum;

			     echo "<tr><td>".$row["item"]."</td><td>".$Quantitysum."</td><td>R".$Pricesum."</td></tr>";
			  }
			  echo "<tr></tr><tr></tr><tr></tr><tr class='Total'><td></td><td>Total:<td>R".$Total."</td></table>";

			  echo "<div class='numsales'>Total Items Bought: <p class='center'>".$NumberOfSales."</p></div>";
			  echo "<div class='numsales'>Revenue from $User: <p class='center'>R".$Total."<p></div>";
			} else {
			  echo "0 results";
			}

   }
	

	




	die;





