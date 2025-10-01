var keyVal;

function setValue(val)
{
	keyVal = val.substring(4,12);
}

$(document).ready(function(){
  $(document).keypress(function(e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
	if(keycode == '13'){
		
		var x= document.getElementById("username1Error");
		var y= document.getElementById("password1Error");
		
		if(x == null && y == null){
			//document.getElementById("serverSideError").innerHTML = "Please click \"" +  $(":submit").val() + "\" to proceed.";
		}
		else
		if(x != null && y != null)
		{
			document.getElementById("serverSideError").innerHTML = "Please click \"Login\" to proceed.";
		}
		else
		if(x != null)
		{
			x.innerHTML = "Please click \"Next\" to proceed.";
		}
		else
		if(y != null)
		{
			y.innerHTML = "Please click \"Login\" to proceed.";
		}
		
		return false;
    }
  });
}); 

function putUsenameStar()
{
	with (document.forms[0]) {
		if(username1.value.length >= 6){
    		//username1.value = username1.value.replace(/./g, '*'); 
    		
    		username1.focus();
    	}
    }
}

function putPasswordStar()
{
	with (document.forms[0]) {
    	if(password1.value.length >= 8){
	    	password1.value = password1.value.replace(/./g,'*');
	    	username.value = stringToHex(des (keyVal, username.value, 1, 0, "", 1));
	    	
	    	password1.focus();
    	}
    }
}

function putUsenamePasswordStar()
{
	with (document.forms[0]) {
    	if(username1.value.length >= 6 && password1.value.length >= 8){
    		//username1.value = username1.value.replace(/./g, '*'); 
	    	password1.value = password1.value.replace(/./g,'*');
	    	
	    	password1.focus();
    	}
    }
}

function checkField(orifield, dummyfield)
{
    /*var lastIndex = dummyfield.value.lastIndexOf("*");
    
    if(lastIndex != -1)
    {
        dummyfield.value = "";
        orifield.value = "";
    }
    else
    {*/
        orifield.value = stringToHex(des (keyVal, dummyfield.value, 1, 0, "", 1));
    //}
}
