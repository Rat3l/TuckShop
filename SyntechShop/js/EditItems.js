    function Logout() 
    {
        window.location.href = "ControlPanel.php";
    }

    const inputString = document.getElementById('string');
    const inputSelect = document.getElementById('#EditItemcategorySelect');
    const inputInt = document.getElementById('int');
    const ShowInputType = document.getElementById('StringVal');
	const QuantitySelector = document.getElementById('QuantitySelector');

    function handleRadioClick() 
    {
	  if (document.getElementById('item').checked) {
	  	ShowInputType.innerText = "New item name:"
	    inputString.style.display = 'block';
	    inputSelect.style.display = 'none';
	    inputString.placeholder = "Coke";
	    inputInt.style.display = 'none';
	    QuantitySelector.style.display = 'none'
	}else if (document.getElementById('category').checked)
	   		{
	   			ShowInputType.innerText = "Select new category"
	   			inputSelect.style.display = 'block';
	    		inputString.style.display = 'none';
	    		inputInt.style.display = 'none';
	    		QuantitySelector.style.display = 'none'
	  		}else if (document.getElementById('quantity').checked) 
	  				{
	  					
	  					ShowInputType.innerText = "What do you want to do?"
	  					QuantitySelector.style.display = 'block'
	  					inputInt.style.display = 'none';
	    				
	    				if (document.getElementById('edit').checked) {
	    					inputInt.style.display = 'block';
	    				}else if (document.getElementById('add').checked) {
	    					inputInt.style.display = 'block';
	    				}else if (document.getElementById('subtract').checked) {
	    					inputInt.style.display = 'block';
	    				}

	    				inputSelect.style.display = 'none';
	    				inputString.style.display = 'none';

	  				}else if (document.getElementById('price').checked) 
	  						{
	  							ShowInputType.innerText = "New Price:"
	    						inputInt.style.display = 'block';
	    						inputSelect.style.display = 'none';
	    						inputString.style.display = 'none';
	    						QuantitySelector.style.display = 'none'
	  						} else 
	  						{
	    						inputInt.style.display = 'none';
	    						inputSelect.style.display = 'none';
	    						QuantitySelector.style.display = 'none'
	    						inputString.style.display = 'none';
	  						}
	}
	