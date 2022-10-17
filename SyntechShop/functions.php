<?php

	function check_login($con)
	{
		if(isset($_SESSION['user_id']))
		{
			$id = $_SESSION['user_id'];
			$query = "select * from users where user_id = '$id' limit 1";

			$result = mysqli_query($con,$query);

			if($result && mysqli_num_rows($result) > 0)
			{
				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
			}
		}

		//If the above not true, then redirect to login page

		header("Location: index.php");
		die;

	}

	function setLogin($APassw)
	{
		if(isset($APassw))
		{
			$_SESSION['HasLoggedIn'] = true;
		}else
		{
			$_SESSION['HasLoggedIn'] = false;
		}
		
	}

	function random_num($max_length)
	{

		$text = "";

		//Length must be atleast 5
		if($max_length < 5)
		{
			$max_length = 5;
		}

		//Makes a new random length between 4 and max length
		$len = rand(4,$max_length);

		//Fill text with random numbers
		for ($i=0; $i < $len; $i++) 
		{ 
			$text .= rand(0,9);	
		}

		return $text;

	}


