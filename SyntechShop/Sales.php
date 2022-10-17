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
	<title>Sales</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="SalesBody">


	<div onclick="Logout()" class="back">
        <a href="ControlPanel.php" style="text-decoration: none; color: #1e4e45; margin-left: 25%;">BACK</a>
    </div><br><br>

    <input onclick="handleRadioClick()" type="radio" id="AllSales" name="ReportSelector" value="AllReports" required>
	<label  for="AllSales">All Time</label><br>
	<input onclick="handleRadioClick()" type="radio" id="SpecificMonth" name="ReportSelector" value="SpecificMonth">
	<label for="SpecificMonth">Specific Month</label><br>
	<input onclick="handleRadioClick()" type="radio" id="SpecificDay" name="ReportSelector" value="SpecificDay">
	<label for="SpecificDay">Specific Day</label><br>
	<input onclick="handleRadioClick()" type="radio" id="SearchUser" name="ReportSelector" value="SearchUser">
	<label for="SearchUser">Search User</label><br>

	<div id="monthSelector">
    <label for="start">Select Month:</label>

	<input type="month" id="Date" name="start" min="2022-01" value="2022-01">
	</div>

	<div id="daySelector">
    <label for="day">Select Day:</label>

	<input type="Date" id="DateDay" name="day" min="2022-01-01" value="2022-01-01">
	</div>



	<div id="userSelector">
		<label for="day">Search User:</label>

		<select name="item_category" id="UserSelect">
			<?php  
                $resultSet = $con->query("SELECT user_name FROM users ORDER BY user_name");

                if ($resultSet->num_rows > 0) 
                {
	                while ($rows = $resultSet->fetch_assoc()) 
	                {
	                    $user_name = $rows['user_name'];

	                    echo "
	                        <option value='$user_name'>$user_name</option>
	                    ";
	                }
	            }
                  ?>
		</select>
	</div>
    
	<input type="button" value="Submit" onclick="Submit()" id="submitButton">
 
	
	<input type="button" value="Copy" id="copyBtn" onclick="copyTable(document.getElementById('SalesTable'))" style="display:none;">
	<div id="result"></div>
	

</body>
<script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous">
      

  </script>
<script type="text/javascript" src="js/Sales.js">



</script>



</html>