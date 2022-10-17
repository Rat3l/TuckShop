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



	$ID = $_POST['postID'];
	$Name = $_POST['postName'];
	$Bought = $_POST['postBought'];
	$Quantity = $_POST['postQuantity'];
	$Price = $_POST['postPrice'];
	$date = date("Y-m-d H:i:s");



	$query = "insert into sales (sale_id,user_name,item_bought,quantity,price,date) values ('$ID','$Name','$Bought','$Quantity','$Price','$date')";
	mysqli_query($con,$query);

	$SQLquery = "select * from items where item='$Bought'";
	$result = mysqli_query($con,$SQLquery);
	while ($row = $result->fetch_assoc()) {
    $oldQuantity = $row['quantity'];
    $itemname = $row['item'];
	}

	$newQuantity = $oldQuantity - $Quantity;

	$query = "UPDATE items SET quantity='$newQuantity' WHERE item='$Bought'";
	mysqli_query($con,$query);


	die;





