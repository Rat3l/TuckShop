    const SearchItemElement = document.getElementById('itemSelector');
 	const SearchCategoryElement = document.getElementById('categorySelector');
 	const SubmitButton = document.getElementById('submitButton');
 	const SearchItemValue = document.getElementById('itemSelect');
 	const SearchCategoryValue = document.getElementById('categorySelect');

    function Logout() 
    {
        window.location.href = "ControlPanel.php";
    }

    function handleRadioClick() 
    {
    	if (document.getElementById('AllInventory').checked)
    	{
    		SearchItemElement.style.display = 'none';
    		SearchCategoryElement.style.display = 'none';
    		SubmitButton.style.display = 'block';

    	}else if (document.getElementById('SearchItem').checked)
    	{
    		SearchItemElement.style.display = 'block';
    		SearchCategoryElement.style.display = 'none';
    		SubmitButton.style.display = 'block';

    	}else if (document.getElementById('SearchCategory').checked)
    	{
    		SearchItemElement.style.display = 'none';
    		SearchCategoryElement.style.display = 'block';
    		SubmitButton.style.display = 'block';
    	}
    }

    function Submit()
 	{
        var copyButton = document.getElementById("copyBtn");
        copyButton.style.display = "block";
    	if (document.getElementById('AllInventory').checked)
    	{
    		var bool = true;
			postAll(bool);
    	}else if (document.getElementById('SearchItem').checked)
    	{
    		var bool = false;
    		var item = SearchItemValue.value;

	    	postItem(item,bool);
	    	
    	}else if (document.getElementById('SearchCategory').checked)
    	{
    		var bool = false;
    		var category = SearchCategoryValue.value;

	    	postCategory(category,bool);

    	}
 	}

 	function postAll(bool)
    {
    	console.log("ello");
        $.post('PostInventory.php', {postShowAll:bool},
            function(data)
            {
                $('#result').html(data);    
            }
        );
    }

    function postCategory(category,bool)
    {

        $.post('PostInventory.php', {postCategory:category,postShowAll:bool},
            function(data)
            {
                $('#result').html(data);     
            }
        );
    }

 	function postItem(item,bool)
    {

        $.post('PostInventory.php', {postItem:item,postShowAll:bool},
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
