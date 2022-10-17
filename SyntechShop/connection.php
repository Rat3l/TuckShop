<?php

	//Replace localhost with your own host
	$dbHost = "localhost";
	$dbUser = "root";
	$dbPass = "";
	$dbName = "syntech_tuckshop_db";



	try {
		if(!$con = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName))
		{
			die("Failed to connect to the database");
		}
	}catch (Exception $e){
	    $error = $e->getMessage();
	    echo $error;
	}


