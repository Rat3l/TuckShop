<?php

    
    session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    unset($_SESSION['HasLoggedIn']);

    

    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if (isset($_GET['Apassw'])) 
        {    
            $APassw = $_GET['Apassw'];
            if($user_data['isAdmin'] && $APassw === "Syntuck@Admin") 
            {
                $_SESSION['isPassCorrect'] = true;
                header("Location: ControlPanel.php");
                die;    
            }
        }

        
    }

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Syntec Tuck Shop</title>
    <link rel="shortcut icon" href="images/favicon.ico">
   <link rel="stylesheet" type="text/css" href="css/ShopStylesheet.css">
   <style type="text/css">
        [type="number"]::-webkit-inner-spin-button,
        [type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        height: auto;
        }
        .stepper {
        border: 1px solid #08567A;
        display: inline-block;
        overflow: visible;
        height: 2.1em;
        background: #08567A;
        padding: 1px;
        display: none;
        }
        .stepper input {
        width: 3em;
        height: 100%;
        text-align: center;
        border: 0;
        background: transparent;
        color: #000;
        }
        .stepper button {
        width: 1.4em;
        font-weight: 300;
        height: 100%;
        line-height: 0.1em;
        font-size: 1.4em;
        padding: 0.2em !important;
        background: #eee;
        color: #333;
        border: none;
        }

        #CartListItem
        {
            list-style-type: "× ";
            list-style: none;            
        }

        li::before {content: "× "; color: red; font-weight: bold;font-size: 1.5rem}

   </style>
</head>
<body id="ShopBody">    

            <span class="stepper">
            <button>–</button>
            <input type="number" id="sup" value="1" min="1" max="5" step="1" readonly>
            <button>+</button>
          </span>

    <div onclick="Logout()" class="Logout">
        <a href="logout.php" style="text-decoration: none; color: black; margin-left: 25%;">BACK</a>
    </div>

    
    <div class="modal" id="Drinks-modal">
        <span class="close" id="closeDrinks-modal">&times;</span>
        <div class="modal-content">
            
             <?php

                $sql = "select * from items where category='DRINKS' and quantity>0";

                $Itemresult = $con->query($sql);

                if ($Itemresult->num_rows > 0) {
                  echo "<table><tr><th>Selected</th><th>Quantity</th><th>Item</th><th>Price</th></tr>";
                  // output data of each row
                  while($row = $Itemresult->fetch_assoc()) {
                    $sqli = "select sum(quantity) as quantity_val from items where item='".$row["item"]."'";
                    $resultt = mysqli_query($con,$sqli);
                    $singeRow = mysqli_fetch_assoc($resultt); 
                    $Quantitysum = $singeRow['quantity_val'];

                    if ($Quantitysum > 5) {
                        $Quantitysum = 5;
                    }

                    $id = "SelectedDrink";
                    $id .= $row["item"];
                    $cleanid = str_replace(' ', '', $id);
                    $noSpaceItem = str_replace(' ', '', $row["item"]);

                    echo "<tr class='listItem' id='".$noSpaceItem."' item='".$row["item"]."'><td>"."<input type='radio' class='Selected' CleanId='".$cleanid."' id='SelectedDrink' name='SelectedDrink' value='".$row["item"]." R".$row["price"]."'>"."</td><td><span class='stepper' id='".$cleanid."'><button>-</button><input type='number' id='value".$cleanid."' value='1' min='1' max='".$Quantitysum."' step='1' readonly><button>+</button></span></td><td>".$row["item"]."</td><td>".$row["price"]."</td></tr>";
                  }
                  echo "<tr><td><input style='display: none;' type='radio' id='SelectedDrink' name='SelectedDrink' value=''></td></tr>";

                  echo "</table>";
                } else {
                  echo "No stock found";
                }            
                echo "<button class='AddToCart' onclick='AddToCart(SelectedDrink);closeDrink()'>ADD</button>"
             ?>
             
           
        </div>
    </div>
    <div class="modal" id="Chips-modal">
        <span class="close" id="closeChips-modal">&times;</span>
        <div class="modal-content">
            
             <?php

                $sql = "select * from items where category='CHIPS' and quantity>0";

                $Itemresult = $con->query($sql);

                if ($Itemresult->num_rows > 0) {
                  echo "<table><tr><th>Selected</th><th>Quantity</th><th>Item</th><th>Price</th></tr>";
                  // output data of each row
                  while($row = $Itemresult->fetch_assoc()) {
                    $sqli = "select sum(quantity) as quantity_val from items where item='".$row["item"]."'";
                    $resultt = mysqli_query($con,$sqli);
                    $singeRow = mysqli_fetch_assoc($resultt); 
                    $Quantitysum = $singeRow['quantity_val'];

                    if ($Quantitysum > 5) {
                        $Quantitysum = 5;
                    }
                    $id = "SelectedChips";
                    $id .= $row["item"];
                    $cleanid = str_replace(' ', '', $id);
                    $noSpaceItem = str_replace(' ', '', $row["item"]);
                    echo "<tr class='listItem' id='".$noSpaceItem."' item='".$row["item"]."'><td>"."<input type='radio' CleanId='".$cleanid."' id='SelectedChips' name='SelectedChips' value='".$row["item"]." R".$row["price"]."'>"."</td><td><span class='stepper' id='".$cleanid."'><button>-</button><input type='number' id='value".$cleanid."' value='1' min='1' max='".$Quantitysum."' step='1' readonly><button>+</button></span></td><td>".$row["item"]."</td><td>".$row["price"]."</td></tr>";
                  }
                  echo "<tr><td><input style='display: none;' type='radio' id='SelectedChips' name='SelectedChips' value=''></td></tr>";
                  echo "</table>";
                } else {
                  echo "No stock found";
                }               
                echo "<button class='AddToCart' onclick='AddToCart(SelectedChips);closeChips()'>ADD</button>"
             ?>
            
        </div>
    </div>

    <div class="modal" id="Choco-modal">
        <span class="close" id="closeChoco-modal">&times;</span>
        <div class="modal-content">
            
             <?php

                $sql = "select * from items where category='CHOCOLATES' and quantity>0";

                $Itemresult = $con->query($sql);

                if ($Itemresult->num_rows > 0) {
                  echo "<table><tr><th>Selected</th><th>Quantity</th><th>Item</th><th>Price</th></tr>";
                  // output data of each row
                  while($row = $Itemresult->fetch_assoc()) {
                    $sqli = "select sum(quantity) as quantity_val from items where item='".$row["item"]."'";
                    $resultt = mysqli_query($con,$sqli);
                    $singeRow = mysqli_fetch_assoc($resultt); 
                    $Quantitysum = $singeRow['quantity_val'];

                    if ($Quantitysum > 5) {
                        $Quantitysum = 5;
                    }
                    $id = "SelectedChips";
                    $id .= $row["item"];
                    $cleanid = str_replace(' ', '', $id);
                    $noSpaceItem = str_replace(' ', '', $row["item"]);
                    echo "<tr class='listItem' id='".$noSpaceItem."' item='".$row["item"]."'><td>"."<input type='radio' CleanId='".$cleanid."' id='SelectedChoco' name='SelectedChoco' value='".$row["item"]." R".$row["price"]."'>"."</td><td><span class='stepper' id='".$cleanid."'><button>-</button><input type='number' id='value".$cleanid."' value='1' min='1' max='".$Quantitysum."' step='1' readonly><button>+</button></span></td><td>".$row["item"]."</td><td>".$row["price"]."</td></tr>";
                  }
                  echo "<tr><td><input style='display: none;' type='radio' id='SelectedChoco' name='SelectedChoco' value=''></td></tr>";
                  echo "</table>";
                } else {
                  echo "No stock found";
                }               

                echo "<button class='AddToCart' onclick='AddToCart(SelectedChoco);closeChoco()'>ADD</button>"
             ?>
        </div>
    </div>

    <div class="modal" id="Sweets-modal">
        <span class="close" id="closeSweets-modal">&times;</span>
        <div class="modal-content">
            
             <?php

                $sql = "select * from items where category='SWEETS' and quantity>0";

                $Itemresult = $con->query($sql);

                if ($Itemresult->num_rows > 0) {
                  echo "<table><tr><th>Selected</th><th>Quantity</th><th>Item</th><th>Price</th></tr>";
                  // output data of each row
                  while($row = $Itemresult->fetch_assoc()) {
                    $sqli = "select sum(quantity) as quantity_val from items where item='".$row["item"]."'";
                    $resultt = mysqli_query($con,$sqli);
                    $singeRow = mysqli_fetch_assoc($resultt); 
                    $Quantitysum = $singeRow['quantity_val'];

                    if ($Quantitysum > 5) {
                        $Quantitysum = 5;
                    }
                    $id = "SelectedChips";
                    $id .= $row["item"];
                    $cleanid = str_replace(' ', '', $id);
                    $noSpaceItem = str_replace(' ', '', $row["item"]);
                    echo "<tr class='listItem' id='".$noSpaceItem."' item='".$row["item"]."'><td>"."<input type='radio' CleanId='".$cleanid."' id='SelectedSweets' name='SelectedSweets' value='".$row["item"]." R".$row["price"]."'>"."</td><td><span class='stepper' id='".$cleanid."'><button>-</button><input type='number' id='value".$cleanid."' value='1' min='1' max='".$Quantitysum."' step='1' readonly><button>+</button></span></td><td>".$row["item"]."</td><td>".$row["price"]."</td></tr>";
                  }
                  echo "<tr><td><input style='display: none;' type='radio' id='SelectedSweets' name='SelectedSweets' value=''></td></tr>";
                  echo "</table>";
                } else {
                  echo "No stock found";
                }               

                echo "<button class='AddToCart' onclick='AddToCart(SelectedSweets);closeSweets()'>ADD</button>"
             ?>
        </div>
    </div>

    <div class="modal" id="Foods-modal">
        <span class="close" id="closeFoods-modal">&times;</span>
        <div class="modal-content">
            
             <?php

                $sql = "select * from items where category='FOOD' and quantity>0";

                $Itemresult = $con->query($sql);

                if ($Itemresult->num_rows > 0) {
                  echo "<table><tr><th>Selected</th><th>Quantity</th><th>Item</th><th>Price</th></tr>";
                  // output data of each row
                  while($row = $Itemresult->fetch_assoc()) {
                    $sqli = "select sum(quantity) as quantity_val from items where item='".$row["item"]."'";
                    $resultt = mysqli_query($con,$sqli);
                    $singeRow = mysqli_fetch_assoc($resultt); 
                    $Quantitysum = $singeRow['quantity_val'];

                    if ($Quantitysum > 5) {
                        $Quantitysum = 5;
                    }
                    $id = "SelectedChips";
                    $id .= $row["item"];
                    $cleanid = str_replace(' ', '', $id);
                    $noSpaceItem = str_replace(' ', '', $row["item"]);
                    echo "<tr class='listItem' id='".$noSpaceItem."' item='".$row["item"]."'><td>"."<input type='radio' CleanId='".$cleanid."' id='SelectedFoods' name='SelectedFoods' value='".$row["item"]." R".$row["price"]."'>"."</td><td><span class='stepper' id='".$cleanid."'><button>-</button><input type='number' id='value".$cleanid."' value='1' min='1' max='".$Quantitysum."' step='1' readonly><button>+</button></span></td><td>".$row["item"]."</td><td>".$row["price"]."</td></tr>";
                  }
                  echo "<tr><td><input style='display: none;' type='radio' id='SelectedFoods' name='SelectedFoods' value=''></td></tr>";
                  echo "</table>";
                } else {
                  echo "No stock found";
                }               

                echo "<button class='AddToCart' onclick='AddToCart(SelectedFoods);closeFoods()'>ADD</button>"
             ?>
        </div>
    </div>

    <div class="modal" id="Others-modal">
        <span class="close" id="closeOthers-modal">&times;</span>
        <div class="modal-content">
            
             <?php

                $sql = "select * from items where category='OTHER' and quantity>0";

                $Itemresult = $con->query($sql);

                if ($Itemresult->num_rows > 0) {
                  echo "<table><tr><th>Selected</th><th>Quantity</th><th>Item</th><th>Price</th></tr>";
                  // output data of each row
                  while($row = $Itemresult->fetch_assoc()) {
                    $sqli = "select sum(quantity) as quantity_val from items where item='".$row["item"]."'";
                    $resultt = mysqli_query($con,$sqli);
                    $singeRow = mysqli_fetch_assoc($resultt); 
                    $Quantitysum = $singeRow['quantity_val'];

                    if ($Quantitysum > 5) {
                        $Quantitysum = 5;
                    }
                    $id = "SelectedChips";
                    $id .= $row["item"];
                    $cleanid = str_replace(' ', '', $id);
                    $noSpaceItem = str_replace(' ', '', $row["item"]);
                    echo "<tr class='listItem' id='".$noSpaceItem."' item='".$row["item"]."'><td>"."<input type='radio' CleanId='".$cleanid."' id='SelectedOthers' name='SelectedOthers' value='".$row["item"]." R".$row["price"]."'>"."</td><td><span class='stepper' id='".$cleanid."'><button>-</button><input type='number' id='value".$cleanid."' value='1' min='1' max='".$Quantitysum."' step='1' readonly><button>+</button></span></td><td>".$row["item"]."</td><td>".$row["price"]."</td></tr>";
                  }
                  echo "<tr><td><input style='display: none;' type='radio' id='SelectedOthers' name='SelectedOthers' value=''></td></tr>";
                  echo "</table>";
                } else {
                  echo "No stock found";
                }               

                echo "<button class='AddToCart' onclick='AddToCart(SelectedOthers);closeOthers()'>ADD</button>"
             ?>
        </div>
    </div>

    <form>
        <div id="LogoContainer">
            <img src="images/Logo2.png" alt="Syntec Logo" id="Logo">
          
        </div>
        <div id="ListContainer" >

            <nav class="NavGrid">
                <a id="DrinksButton">DRINKS</a>
                <a id="ChipsButton">CHIPS</a>
                <a id="ChocoButton">CHOCOLATES</a>
                <a id="SweetsButton">SWEETS</a>
                <a id="FoodsButton">FOOD</a>
                <a id="OthersButton">OTHER</a>           
            </nav>

        </div>
 
        <div id="container2">

            <div id="cartContainer">

                <p style="margin-left: 48%; font-weight: bolder;">Cart</p>
                <p style="text-align: center; color: #1788C6; font-weight:bold; font-size: 2rem" id="CartListUsername"><?php echo $user_data['user_name']; ?></p>
                <div id="cart">
                <p id="CartTotal"></p>
                </div>
                <input type="button" value="CONFIRM" onclick="Confirm()" id="confirmButton">
                <div id="result"></div>
            </div>
            
        </div>

    </form>
    <form method="GET">
    <?php 

         if($user_data['isAdmin']) 
        {   
            echo "
            <br><br>
            <div class='container3'>
            <form name='form' action='' method='get'>
            <input class='TextBox' type='password' name='Apassw' placeholder='Password' required>
            <br><br>
            <button id='LButton'>CONFIRM</button>  
            </form>
            </div><br><br>";
        }

     ?> 
    </form>
   




</body>
<script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous">
      

  </script>
<script type="text/javascript" src="js/Shop.js"></script>
</html>