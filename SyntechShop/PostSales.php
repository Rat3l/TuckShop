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
					$Day = $_POST['postDay'];
					$sqli = "select * from sales where YEAR(date) = '$Year' AND MONTH(date) = '$Month' AND DAY(date) = '$Day'";

					$Itemresult = $con->query($sqli);



					if ($Itemresult->num_rows > 0) {
					  echo "<table id='SalesTable'><th>Sales ID</th><th>User</th><th>Bought</th><th>Quantity</th><th>Price</th><th>Date</th></tr>";
					  // output data of each row

					  while($row = $Itemresult->fetch_assoc()) {			 	
					     echo "<tr><td>".$row["sale_id"]."</td><td>".$row["user_name"]."</td><td>".$row["item_bought"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["date"]."</td></tr>";
					  }
					} else {
					  echo "0 results";
					}
		    }else
		    {

		    		$sqli = "select * from sales where YEAR(date) = '$Year' AND MONTH(date) = '$Month'";

					$Itemresult = $con->query($sqli);


					if ($Itemresult->num_rows > 0) {
					  echo "<table id='SalesTable'><th>Sales ID</th><th>User</th><th>Bought</th><th>Quantity</th><th>Price</th><th>Date</th></tr>";
					  // output data of each row

					  while($row = $Itemresult->fetch_assoc()) {			 	
					     echo "<tr><td>".$row["sale_id"]."</td><td>".$row["user_name"]."</td><td>".$row["item_bought"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["date"]."</td></tr>";
					  }
					} else {
					  echo "0 results";
					}


		    }
		}else
		{
		
			$sqli = "select * from sales";

					$Itemresult = $con->query($sqli);


					if ($Itemresult->num_rows > 0) {
					  echo "<table id='SalesTable'><th>Sales ID</th><th>User</th><th>Bought</th><th>Quantity</th><th>Price</th><th>Date</th></tr>";
					  // output data of each row

					  while($row = $Itemresult->fetch_assoc()) {			 	
					     echo "<tr><td>".$row["sale_id"]."</td><td>".$row["user_name"]."</td><td>".$row["item_bought"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["date"]."</td></tr>";
					  }
					} else {
					  echo "0 results";
					}
		}
   }else
   {

		

   	$User = $_POST['postUser'];
   	$sqli = "select * from sales where user_name = '$User'";

					$Itemresult = $con->query($sqli);


					if ($Itemresult->num_rows > 0) {
					  echo "<table id='SalesTable'><th>Sales ID</th><th>User</th><th>Bought</th><th>Quantity</th><th>Price</th><th>Date</th></tr>";
					  // output data of each row

					  while($row = $Itemresult->fetch_assoc()) {			 	
					     echo "<tr><td>".$row["sale_id"]."</td><td>".$row["user_name"]."</td><td>".$row["item_bought"]."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["date"]."</td></tr>";
					  }
					} else {
					  echo "0 results";
					}
   }
	

	




	die;





