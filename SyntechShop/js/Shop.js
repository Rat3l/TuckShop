    username = document.getElementById("CartListUsername").innerText;



    $('input[name="SelectedDrink"]').change(function()
    {
        var submitBtn=$('.AddToCart');
        var allSteppers=$('.stepper');
        allSteppers.hide();
        if ($('input[name="SelectedDrink"]:checked').length > 0) {

            var radios = document.getElementsByName('SelectedDrink');

            for (var radio of radios) 
            {
                if (radio.checked) 
                {
                    CleanedId = radio.getAttribute("CleanId");      
                }
            }
            var stepper = document.getElementById(CleanedId);
            stepper.style.display = "block";
            submitBtn.show();
        } else {
            submitBtn.hide();
        }
    });

$('input[name="SelectedChips"]').change(function()
    {
        var submitBtn=$('.AddToCart');
        var allSteppers=$('.stepper');
        allSteppers.hide();
        if ($('input[name="SelectedChips"]:checked').length > 0) {
            
            var radios = document.getElementsByName('SelectedChips');

            for (var radio of radios) 
            {
                if (radio.checked) 
                {
                    CleanedId = radio.getAttribute("CleanId");      
                }
            }
            var stepper = document.getElementById(CleanedId);
            stepper.style.display = "block";
            submitBtn.show();
        } else {
            submitBtn.hide();
        }
    });

    $('input[name="SelectedChoco"]').change(function()
    {
        var submitBtn=$('.AddToCart');
        var allSteppers=$('.stepper');
        allSteppers.hide();
        if ($('input[name="SelectedChoco"]:checked').length > 0) {
             
            var radios = document.getElementsByName('SelectedChoco');

            for (var radio of radios) 
            {
                if (radio.checked) 
                {
                    CleanedId = radio.getAttribute("CleanId");      
                }
            }
            var stepper = document.getElementById(CleanedId);
            stepper.style.display = "block";
            submitBtn.show();
        } else {
            submitBtn.hide();
        }
    });

    $('input[name="SelectedSweets"]').change(function()
    {
        var submitBtn=$('.AddToCart');
        var allSteppers=$('.stepper');
        allSteppers.hide();
        if ($('input[name="SelectedSweets"]:checked').length > 0) {
            
            var radios = document.getElementsByName('SelectedSweets');

            for (var radio of radios) 
            {
                if (radio.checked) 
                {
                    CleanedId = radio.getAttribute("CleanId");      
                }
            }
            var stepper = document.getElementById(CleanedId);
            stepper.style.display = "block";
            submitBtn.show();
        } else {
            submitBtn.hide();
        }
    });

    $('input[name="SelectedFoods"]').change(function()
    {
        var submitBtn=$('.AddToCart');
        var allSteppers=$('.stepper');
        allSteppers.hide();
        if ($('input[name="SelectedFoods"]:checked').length > 0) {
            
            var radios = document.getElementsByName('SelectedFoods');

            for (var radio of radios) 
            {
                if (radio.checked) 
                {
                    CleanedId = radio.getAttribute("CleanId");      
                }
            }
            var stepper = document.getElementById(CleanedId);
            stepper.style.display = "block";
            submitBtn.show();
        } else {
            submitBtn.hide();
        }
    });

    $('input[name="SelectedOthers"]').change(function()
    {
        var submitBtn=$('.AddToCart');
        var allSteppers=$('.stepper');
        allSteppers.hide();
        if ($('input[name="SelectedOthers"]:checked').length > 0) {
                        
            var radios = document.getElementsByName('SelectedOthers');

            for (var radio of radios) 
            {
                if (radio.checked) 
                {
                    CleanedId = radio.getAttribute("CleanId");      
                }
            }
            var stepper = document.getElementById(CleanedId);
            stepper.style.display = "block";
            submitBtn.show();
        } else {
            submitBtn.hide();
        }
    });

    function Confirm()
    {
        let name = username;
        let tempArr = cartArray;
        let newCartArr = [];

        for(let i=0; i<tempArr.length; i++)
        {
            let bool = true;
            let item = tempArr[i]["Item"];
            let price = tempArr[i]["Price"];
            let quantity = 1;

            if (tempArr[i]["Item"] != "null") 
            {
                for(let k=i+1; k<tempArr.length; k++)
                {
                    if (tempArr[k]["Item"] == tempArr[i]["Item"])
                    {
                        price += tempArr[k]["Price"];
                        quantity++;
                        tempArr[k]["Item"] = "null"
                    }
                }
            }else
            {
                continue;
            }
            var newList=new Array;
            newList["Item"] = item;
            newList["Price"] = price;
            newList["Quantity"] = quantity;

            newCartArr.push(newList);

        }
        console.log("Cleaned up shop cart:");
        console.log(newCartArr);
        let salesID = random_num(11);
        for(let x=0; x<newCartArr.length; x++)
        {
            let itemname = newCartArr[x]["Item"];
            let itemprice = newCartArr[x]["Price"];
            let itemquantity = newCartArr[x]["Quantity"];
            
            //console.log(salesID,name,itemname,itemquantity,itemprice);
            post(salesID,name,itemname,itemquantity,itemprice);
        }
        
    }

    function random_num(max_length)
    {

        let text = "";

        //Length must be atleast 5
        if(max_length < 5)
        {
            max_length = 5;
        }

        //Makes a new random length between 4 and max length
        let len = randomInteger(4,max_length);

        //Fill text with random numbers
        for (let i=0; i < len; i++) 
        { 
            text += randomInteger(0,9); 
        }

        return text;
    }

    function randomInteger(min, max)
    {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function post(ID,Name,Bought,Quantity,Price)
    {

        $.post('validate.php', {postID:ID,postName:Name,postBought:Bought,postQuantity:Quantity,postPrice:Price},
            function(data)
            {
                $('#result').html(data);
                console.log("Testp")
                Logout();               
            }
        );
    }
    
    function Logout() 
    {
        window.location.href = "logout.php";
    }

    //Opens up the drinks modal
    document.getElementById("DrinksButton").addEventListener("click", function () 
    {
        let modal = document.getElementById("Drinks-modal");
        modal.style.display = "block";
        const body = document.querySelector("body");
        body.style.overflow = "hidden";
    });

    //Close the add drinks modal
    document.getElementById("closeDrinks-modal").addEventListener("click", function () 
    {
        let modal = document.getElementById("Drinks-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";
        var allSteppers=$('.stepper');
        allSteppers.hide();

        var radList = document.getElementsByName('SelectedDrink');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }

        modal.style.display = "none";
    });

    function closeDrink()
    {
        let modal = document.getElementById("Drinks-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";
        var allSteppers=$('.stepper');
        allSteppers.hide();

        var radList = document.getElementsByName('SelectedDrink');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }

        modal.style.display = "none";
    }

    //Opens up the chips modal
    document.getElementById("ChipsButton").addEventListener("click", function () 
    {
        let modal = document.getElementById("Chips-modal");
        const body = document.querySelector("body");
        modal.style.display = "block";
        body.style.overflow = "hidden";
       // modal.style.overflow = "auto";


    });

    //Close the add chips modal
    document.getElementById("closeChips-modal").addEventListener("click", function () 
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Chips-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedChips');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    });

    function closeChips()
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Chips-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedChips');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    }

    //Opens up the Choco modal
    document.getElementById("ChocoButton").addEventListener("click", function () 
    {
        let modal = document.getElementById("Choco-modal");
        modal.style.display = "block";
        const body = document.querySelector("body");
        body.style.overflow = "hidden";
    });

    //Close the add Choco modal
    document.getElementById("closeChoco-modal").addEventListener("click", function () 
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Choco-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedChoco');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    });

    function closeChoco()
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Choco-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedChoco');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    }

    //Opens up the Sweets modal
    document.getElementById("SweetsButton").addEventListener("click", function () 
    {
        let modal = document.getElementById("Sweets-modal");
        modal.style.display = "block";
        const body = document.querySelector("body");
        body.style.overflow = "hidden";
    });

    //Close the add Sweets modal
    document.getElementById("closeSweets-modal").addEventListener("click", function () 
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Sweets-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedSweets');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    });

    function closeSweets()
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Sweets-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedSweets');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    }

    //Opens up the Foods modal
    document.getElementById("FoodsButton").addEventListener("click", function () 
    {
        let modal = document.getElementById("Foods-modal");
        modal.style.display = "block";
        const body = document.querySelector("body");
        body.style.overflow = "hidden";
    });

    //Close the add Foods modal
    document.getElementById("closeFoods-modal").addEventListener("click", function () 
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Foods-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedFoods');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    });

    function closeFoods()
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Foods-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedFoods');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    }

    //Opens up the Others modal
    document.getElementById("OthersButton").addEventListener("click", function () 
    {
        let modal = document.getElementById("Others-modal");
        modal.style.display = "block";
        const body = document.querySelector("body");
        body.style.overflow = "hidden";
    });

    //Close the add Others modal
    document.getElementById("closeOthers-modal").addEventListener("click", function () 
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Others-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedOthers');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    });

    function closeOthers()
    {
        var allSteppers=$('.stepper');
        allSteppers.hide();
        let modal = document.getElementById("Others-modal");
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";

        var radList = document.getElementsByName('SelectedOthers');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
        modal.style.display = "none";
    }

    
    
    var Total;
    var ItemCounter;
    var cartArray=new Array;

    function AddToCart(radioName)
    {
        
        var radioList = document.getElementsByName(radioName[0].name);
        var List=new Array;
        if (typeof Total === 'undefined')
        {
            console.log("Started Counting Total")
            Total = 0;
        }
        if (typeof ItemCounter === 'undefined')
        {
            console.log("Started Counting amount in list")
            ItemCounter = 0;
        }
        

        if (ItemCounter != 20)
        {
            ItemCounter++;


            var radios = document.getElementsByName('SelectedDrink');

            for (var radio of radios) 
            {
                if (radio.checked) 
                {
                    CleanedId = radio.getAttribute("CleanId");      
                }
            }
            var listItems = document.getElementsByClassName("listItem");
            var quantity = document.getElementById("value"+CleanedId).value;
            var stepper = document.getElementById(CleanedId);
            stepper.style.display = "none";

            for (var i = 0; i < radioList.length; i++) 
            {

                if (radioList[i].checked)
                {
                    for(let k=0; k<quantity;k++)
                    {
                        var test = radioList[i].getAttribute("test");
                        //Use the test value to get the element with id=test and then get the value of that element, then do a for(i<value) to add the element to cart so many times;

                        var StringTotal = radioName[i].value.split(" R");
                        var List=new Array;
                        Total += parseInt(StringTotal[1]);
                        //console.log(Total);
                        let SelectedItem = radioList[i].value;

                        List["Name"] = document.getElementById("CartListUsername").innerText;
                        List["Item"] = StringTotal[0];
                        List["Price"] = parseInt(StringTotal[1]);

                        console.log("Added item: "+StringTotal[0]);
                        cartArray.push(List);

                        for (var item of listItems)
                        {
                            var Attr = item.getAttribute("item");
                            if (List["Item"] == Attr) 
                            {
                                item.style.visibility = 'hidden';
                            }
                        }
                    }
                    
                    DisplayCart(cartArray);         
                               
                }
            }
        }

    }

    function DisplayCart(array)
    {
        let arr = new Array;
        let DisplayArray = new Array;
        let Total=0;
        let cart = document.getElementById("cart");


        while (cart.firstChild) 
        {
            cart.removeChild(cart.lastChild);
        }
        const Totalpara = document.createElement("p");
        Totalpara.innerText = "";
        Totalpara.setAttribute("id", "CartTotal");
        cart.appendChild(Totalpara);

        for (var item of array)
        {
            arr.push(item["Item"]);
        }

        // console.log(arr); 

        // let trackObj = {};
        // arr.forEach(cur => 
        // {
        //     if( !trackObj[cur] )
        //     trackObj[cur]
        //     else
        //     trackObj[cur]++;
        // });

        // console.log(trackObj);



        var trackObj = {};

        var maxCount = 0, maxElement;       // if you want to find the element with maximum occurence
         
        arr.forEach(cur => {
          
        (!trackObj[cur]) ? trackObj[cur] = 1 : trackObj[cur]++;

        });

        console.log(trackObj);

        var ListArr = Object.keys(trackObj);
        console.log(ListArr);

        console.log(trackObj[ListArr[0]])

        for (var l=0; l<Object.keys(trackObj).length; l++)
            {
                DisplayArray.push(ListArr[l]+": x"+trackObj[ListArr[l]]);
            }

        console.log(DisplayArray);

        for(let i=0; i<array.length; i++)
        {
            Total += array[i]["Price"]       
        }

        for(let z=0; z<DisplayArray.length; z++)
        {
            const node = document.createElement("li");
            node.setAttribute("id", "CartListItem");
            const textnode = document.createTextNode(DisplayArray[z]);

            node.addEventListener('click', function handleClick(event) 
            {
                cartArray = RemoveItemFromCart(cartArray, node.innerText);
                ItemCounter--;
                DisplayCart(cartArray);
                
            });
            node.appendChild(textnode);
            cart.appendChild(node);              
        }


        var CartTotalElement = document.getElementById("CartTotal");
        CartTotalElement.innerText = "Total: R" + Total;
       
    }

    function RemoveItemFromCart(array, itemString)
    {
        var listItems = document.getElementsByClassName("listItem");
        var Item = itemString.split(": x");
        for (var i =0 ; i<array.length; i++) 
        {
            if (array[i]['Item'] == Item[0])
             {
                var ItemRemoved = Item[0];
                console.log("Removed Item: "+ItemRemoved)

            for (var item of listItems)
                {
                    var Attr = item.getAttribute("item");
                    if(Item[1] == 1)
                    {
                        if (ItemRemoved == Attr) 
                        {
                            item.style.visibility = 'visible';
                        }
                    }
                }

                array.splice(i,1);
                break;
             }
             
        }
        
        return array;
    }

    var inc = document.getElementsByClassName("stepper");

    for (i = 0; i < inc.length; i++) 
    {
        var incI = inc[i].querySelector("input"),
            id = incI.getAttribute("id"),
            min = incI.getAttribute("min"),
            max = incI.getAttribute("max"),
            step = incI.getAttribute("step");
        document
            .getElementById(id)
            .previousElementSibling.setAttribute(
            "onclick",
            "stepperInput('" + id + "', -" + step + ", " + min + ")"
            ); 
        document
            .getElementById(id)
            .nextElementSibling.setAttribute(
            "onclick",
            "stepperInput('" + id + "', " + step + ", " + max + ")"
            ); 
    }

    function stepperInput(id, s, m) 
    {
        var el = document.getElementById(id);
        if (s > 0) {
            if (parseInt(el.value) < m) {
            el.value = parseInt(el.value) + s;
            }
        } else {
            if (parseInt(el.value) > m) {
            el.value = parseInt(el.value) + s;
            }
        }
    }

    window.addEventListener("click", function (e) {
      let DrinksModal = document.getElementById("Drinks-modal");
      let ChipsModal = document.getElementById("Chips-modal");
      let ChocoModal = document.getElementById("Choco-modal");
      let SweetsModal = document.getElementById("Sweets-modal");
      let FoodsModal = document.getElementById("Foods-modal");
      let OthersModal = document.getElementById("Others-modal");


      if (e.target == DrinksModal) {

        DrinksModal.style.display = "none";
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";
        var allSteppers=$('.stepper');
        allSteppers.hide();

        var radList = document.getElementsByName('SelectedDrink');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }
      }else if(e.target == ChipsModal)
      {

        ChipsModal.style.display = "none";
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";
        var allSteppers=$('.stepper');
        allSteppers.hide();

        var radList = document.getElementsByName('SelectedChips');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }

      }else if(e.target == FoodsModal)
      {

        FoodsModal.style.display = "none";
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";
        var allSteppers=$('.stepper');
        allSteppers.hide();

        var radList = document.getElementsByName('SelectedFoods');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }

      }else if(e.target == ChocoModal)
      {

        ChocoModal.style.display = "none";
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";
        var allSteppers=$('.stepper');
        allSteppers.hide();

        var radList = document.getElementsByName('SelectedChoco');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }

      }else if(e.target == SweetsModal)
      {

        SweetsModal.style.display = "none";
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";
        var allSteppers=$('.stepper');
        allSteppers.hide();

        var radList = document.getElementsByName('SelectedSweets');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }

      }else if(e.target == OthersModal)
      {

        OthersModal.style.display = "none";
        var submitBtn=$('.AddToCart');
        submitBtn.hide();
        const body = document.querySelector("body");
        body.style.overflow = "auto";
        var allSteppers=$('.stepper');
        allSteppers.hide();

        var radList = document.getElementsByName('SelectedOthers');
        for (var i = 0; i < radList.length; i++) 
        {
            if(radList[i].checked)
            {
                radList[i].checked = false;
            } 
        }

      }
    });
