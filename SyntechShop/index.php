<?php

    session_start();

    include("connection.php");
    include("functions.php");
    if(isset($_SESSION['user_id']))
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['isPassCorrect']);
        
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //The signup submit button was pressed
        $username = $_POST['user_name'];


        //Check if username has correct format
        if(!is_numeric($username) && !empty($username))
        {
            //Read from the database
            $query = "select * from users where user_name = '$username' limit 1";

            $result = mysqli_query($con,$query);



            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: shop.php");
                    die;                 
                }
            }


            echo "User not found in database";

        }else
        {
            echo "Please select a user!";
        }

    }


    $sqli = "create TABLE IF NOT EXISTS `users` (
      `id` bigint(20) NOT NULL AUTO_INCREMENT,
      `user_id` bigint(20) NOT NULL,
      `user_name` varchar(50) NOT NULL,
      `isAdmin` tinyint(1) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      KEY `user_name` (`user_name`),
      KEY `isAdmin` (`isAdmin`)
    ) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4";
    mysqli_query($con,$sqli);

    $sqli = "create TABLE IF NOT EXISTS `sales` (
      `id` bigint(20) NOT NULL AUTO_INCREMENT,
      `sale_id` bigint(20) NOT NULL,
      `user_name` varchar(50) NOT NULL,
      `item_bought` varchar(50) NOT NULL,
      `quantity` bigint(20) NOT NULL,
      `price` decimal(15,2) NOT NULL,
      `date` datetime DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `sale_id` (`sale_id`),
      KEY `user_name` (`user_name`),
      KEY `item_bought` (`item_bought`),
      KEY `quantity` (`quantity`),
      KEY `price` (`price`)
    ) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb4";
    mysqli_query($con,$sqli);

    $sqli = "create TABLE IF NOT EXISTS `items` (
      `id` bigint(20) NOT NULL AUTO_INCREMENT,
      `item` varchar(50) NOT NULL,
      `category` varchar(50) NOT NULL,
      `old_quantity` bigint(20) NOT NULL,
      `quantity` int(11) NOT NULL,
      `price` decimal(15,2) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `item` (`item`),
      KEY `category` (`category`),
      KEY `quantity` (`quantity`),
      KEY `price` (`price`),
      KEY `Old Quantity` (`old_quantity`)
    ) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4";
    mysqli_query($con,$sqli);

    $sqli = "insert INTO users (user_id,user_name,isAdmin)
             SELECT '1','ADMIN','1'
             WHERE NOT EXISTS (SELECT * FROM users)";
    mysqli_query($con,$sqli);


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Select</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    </head>
    <body id="indexBody">

        

        <form id="indexForm" autocomplete="off" method="post">
        
        <input id="user_name" name="user_name" class="chosen-value" type="text" value="" placeholder="Select Name" READONLY>
        <ul class="value-list">
                <?php  
                    $resultSet = $con->query("SELECT user_name FROM users ORDER BY user_name");

                    if ($resultSet->num_rows > 0) {
                        while ($rows = $resultSet->fetch_assoc()) 
                        {
                            $user_name = $rows['user_name'];

                            echo "
                                <li>$user_name</li>
                            ";
                        }
                    }
                  ?>

        </ul>
        <button type="submit" id="confirmButton">CONFIRM</button>  
        </form>
        
        
    </body>
</html>

<script type="text/javascript" src="js/index.js"></script>