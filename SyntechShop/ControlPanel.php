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
	<title>Sign Up</title>
    <link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="ControlPanelBody">
    <div id="container">
        <div>
            <div id="UserControlPanel">
                <input type="button" class="button" name="AddUser" value="Add User" onclick="AddUser()">

                <input type="button" class="button" name="EditUsers" value="Edit Users" onclick="EditUser()">

                <input type="button" class="button" name="RemoveUser" value="Remove Users" onclick="RemoveUser()">
            </div>

            <div id="ItemsControlPanel">
                <input type="button" class="button" name="AddItem" value="Add Items" onclick="AddItem()">

                <input type="button" class="button" name="EditItem" value="Edit Items" onclick="EditItem()">

                <input type="button" class="button" name="RemoveItem" value="Remove Item" onclick="RemoveItem()">
            </div>

            <div id="SalesControlPanel">
                <input type="button" class="button" name="Sales" value="Sales" onclick="Sales()">

                <input type="button" class="button" name="Inventory" value="Inventory" onclick="Inventory()">

                <input type="button" class="button" name="Report" value="Report" onclick="Report()">
            </div>
        </div>
        <input type="button" class="Logout" name="Logout" value="Logout" onclick="Logout()">

    </div>



</body>
<script type="text/javascript" src="js/ControlPanel.js"></script>
</html>
