    const MonthSelectorElement = document.getElementById('monthSelector');
 	const DaySelectorElement = document.getElementById('daySelector');
 	const AllSelectorElement = document.getElementById('monthSelector');
 	const SubmitButton = document.getElementById('submitButton');
 	const SearchUser = document.getElementById('userSelector');
 	const SearchUserValue = document.getElementById('UserSelect');

    function Logout() 
    {
        window.location.href = "ControlPanel.php";
    }

    function handleRadioClick() 
    {
    	if (document.getElementById('AllSales').checked)
    	{
    		MonthSelectorElement.style.display = 'none';
    		SubmitButton.style.display = 'block';
    		DaySelectorElement.style.display = 'none';
    		SearchUser.style.display = 'none';
    	}else if (document.getElementById('SpecificMonth').checked)
    	{
    		MonthSelectorElement.style.display = 'block';
    		SubmitButton.style.display = 'block';
    		DaySelectorElement.style.display = 'none';
    		SearchUser.style.display = 'none';
    	}else if (document.getElementById('SpecificDay').checked)
    	{
    		DaySelectorElement.style.display = 'block';
    		MonthSelectorElement.style.display = 'none';
    		SearchUser.style.display = 'none';
    		SubmitButton.style.display = 'block';
    	}else if(document.getElementById('SearchUser').checked)
    	{
    		DaySelectorElement.style.display = 'none';
    		MonthSelectorElement.style.display = 'none';
    		SubmitButton.style.display = 'block';
    		SearchUser.style.display = 'block';
    	}
    }

    function Submit()
 	{
        var copyButton = document.getElementById("copyBtn");
        copyButton.style.display = "block";
    	if (document.getElementById('AllSales').checked)
    	{
    		var bool = true;
			postAll(bool);
    	}else if (document.getElementById('SpecificMonth').checked)
    	{
    		var bool = false;
    		const DateSelector = document.getElementById('Date');

	    	var DateSelected = DateSelector.value;
	    	const DateArray = DateSelected.split("-");
	    	var Year = DateArray[0];
	    	var Month = DateArray[1];
	    	postMonth(Year,Month,bool);
	    	


    	}else if (document.getElementById('SpecificDay').checked)
    	{
    		var bool = false;
    		const DateSelector = document.getElementById('DateDay');

	    	var DateSelected = DateSelector.value;
	    	const DateArray = DateSelected.split("-");
	    	var Year = DateArray[0];
	    	var Month = DateArray[1];
	    	var Day = DateArray[2];

	    	postDay(Year,Month,Day,bool);
    	}else if(document.getElementById('SearchUser').checked)
    	{
    		var bool = false;
    		var User = SearchUserValue.value;
    		postUser(User, bool);
    	}
 	}

 	function postMonth(Year,Month,bool)
    {

    	var PostYear = Year;
    	var PostMonth = Month;
    	var ShowAll = bool;

        $.post('PostSales.php', {postYear:PostYear,postMonth:PostMonth,postShowAll:ShowAll},
            function(data)
            {
                $('#result').html(data);    
            }
        );
    }

    function postAll(bool)
    {

    	var doAll = bool;

        $.post('PostSales.php', {postShowAll:doAll},
            function(data)
            {
                $('#result').html(data);     
            }
        );
    }

 	function postDay(Year,Month,Day,bool)
    {

        $.post('PostSales.php', {postYear:Year,postMonth:Month,postDay:Day,postShowAll:bool},
            function(data)
            {
                $('#result').html(data);            
            }
        );
    }

    function postUser(User, bool)
    {

        $.post('PostSales.php', {postUser:User,postShowAll:bool},
            function(data)
            {
                $('#result').html(data);            
            }
        );
    }

    

	function copyTable(el) {
		console.log("Copied");
    	var body = document.body,
    		range,
    		sel;
    	if (document.createRange && window.getSelection) {
    		range = document.createRange();
    		sel = window.getSelection();
    		sel.removeAllRanges();
    		try {
    		range.selectNodeContents(el);
    		sel.addRange(range);
    		} catch (e) {
    		range.selectNode(el);
    		sel.addRange(range);
    		}
    	} else if (body.createTextRange) {
    		range = body.createTextRange();
    		range.moveToElementText(el);
    		range.select();
    	}
    	document.execCommand("Copy");
	}

