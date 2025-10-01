// JavaScript Document
// To Trim d String
function trimString(str)
	{
		while (str.charAt(0) ==' ')
		str = str.substring(1);
		while (str.charAt(str.length - 1) == ' ')
		str = str.substring(0, str.length - 1);
		return str;
	}

// email checking function
function echeck(str) 
{
	if (str.length > 0 )
	{
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1)
		{
			return false
		}
		else if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
		{
			return false
		}
		else if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
		{
			return false
		}
		else if (str.indexOf(at,(lat+1))!=-1)
		{
			return false
		}
		else if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
		{
			return false
		}
		else if (str.indexOf(dot,(lat+2))==-1)
		{
			return false
		}
		else if (str.indexOf(" ")!=-1)
		{
			return false
		}
		else if (str.lastIndexOf(".")>lstr-3)
		{
			return false
		}
		else
		{
			return true					
		}
	}
	else
	{
	return true
	}
}

// valid date format dd/mm/YYYY
function val_date(st)
{
	var len=st.length;
	var dd=st.substr(0,2);
	var mm=st.substr(3,2);
	var yy=st.substr(6,4);
	var s1=st.substr(2,1);
	var s2=st.substr(5,1);
	if(isNaN(dd)==true || isNaN(mm)==true || isNaN(yy)==true || s1!='/' || s2!='/')
	var val=false;
	else
	{
		if(yy<1900 || yy>2050 || mm<1 || mm>12)
		var val=false;
		else
		{
			var f=new Date(yy,mm,0).toLocaleFormat('%d');
			if(dd<1 || dd>f)
			var val=false;
			else
			val=true;
		}
	}
	return val;
}


// Date validation
var d = new Date();

var curr_date = d.getDate();

var curr_month = d.getMonth()+1;

var curr_year = d.getFullYear();

var curYear = curr_year.toString().slice(2);

function gettoday()

{

	var today=new Date();

	var tyear=today.getFullYear(); 

	var tmonth=today.getMonth()+1;

	var tday=today.getDate();

	var todate=tyear+"/"+tmonth+"/"+tday;

	return todate;

}

// validation for only current & previous dates
function validate_date(valdate)
{

	var day1, day2;

	var month1, month2;

	var year1, year2;

	

	value1 = valdate;

	var value2=gettoday();
//	var value2=now.format("yyyy/mm/dd");

	

	day1 = value1.substring (0, value1.indexOf ("/"));

	month1 = value1.substring (value1.indexOf ("/")+1, value1.lastIndexOf ("/"));

	year1 = value1.substring (value1.lastIndexOf ("/")+1, value1.length);

	

	day2 = value2.substring (0, value2.indexOf ("/"));

	month2 = value2.substring (value2.indexOf ("/")+1, value2.lastIndexOf ("/"));

	year2 = value2.substring (value2.lastIndexOf ("/")+1, value2.length); 

	

	date1 = year1+"/"+month1+"/"+day1;

	date2 = value2;

	firstDate = Date.parse(date1)

	secondDate= Date.parse(date2)

	

	msPerDay = 24 * 60 * 60 * 1000

	dbd = Math.round((secondDate.valueOf()-firstDate.valueOf())/ msPerDay);


	if(dbd >=0)

	return true;

	else

	return false;



}

// validation for only current & past dates

function validate_date_past(valdate)
{

	var day1, day2;

	var month1, month2;

	var year1, year2;

	

	value1 = valdate;

	var value2=gettoday();
//	var value2=now.format("yyyy/mm/dd");

	

	day1 = value1.substring (0, value1.indexOf ("/"));

	month1 = value1.substring (value1.indexOf ("/")+1, value1.lastIndexOf ("/"));

	year1 = value1.substring (value1.lastIndexOf ("/")+1, value1.length);

	

	day2 = value2.substring (0, value2.indexOf ("/"));

	month2 = value2.substring (value2.indexOf ("/")+1, value2.lastIndexOf ("/"));

	year2 = value2.substring (value2.lastIndexOf ("/")+1, value2.length); 

	

	date1 = year1+"/"+month1+"/"+day1;

	date2 = value2;

	firstDate = Date.parse(date1)

	secondDate= Date.parse(date2)

	

	msPerDay = 24 * 60 * 60 * 1000

	dbd = Math.round((secondDate.valueOf()-firstDate.valueOf())/ msPerDay);


	if(dbd <=0)

	return true;

	else

	return false;



}

// rounding number to required decimals
function numround(st,n)
{
	var n1=Math.pow(10,n);
	var num=Math.round(st*n1)/(n1);
	return num;
}

// make field value to upper case
function caps(id){

    document.getElementById(id).value = document.getElementById(id).value.toUpperCase();

}

// select value of combo list on form loading
function sel_combo(st,adv)
{
	var fld=document.getElementById(st);
	for(k=0;k<fld.options.length;k++)
	{
		if(fld.options[k].value==adv)
		{
			fld.options[k].selected=true;
		}

	}
}

// tp check the value weather in the range of 2 numbers
function num_range(st,st1,st2)
{
//	alert(st+"--"+st1+"--"+st2);
	var val=true;
	if(st1!="" && (parseFloat(st)<parseFloat(st1)))
	val=false;
	if(st2!="" && (parseFloat(st)>parseFloat(st2)))
	val=false;

	return val;
}

// to make drop down list read only on focus
function drop_readonly(st)
{
	return false;
}

// to check the string length with in the range
function valid_char(st,st1,st2)
{
	var val=true;
	var len=st.length;
	if(st1!="" && (parseInt(len)<parseInt(st1)))
	val=false;
	if(st2!="" && (parseInt(len)>parseInt(st2)))
	val=false;

	return val;
}

/// http Object funtion for ajax
function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

/// to check the existance of _ and . in a string
function valid_us(st,st1)
{
	if(st.indexOf('_')>0 || st.indexOf('.')>0)
	{
		alert("'_ and .' are not allowed for "+st1);
		return false;
	}
	else
	return true
}

function pageindex(st,st1)
{
	
	if(st!="" && st1!="")
	{
		var x=document.form1.action=st1+"?page_index="+st;
		document.form1.submit();
	}
	else
	{
	return false;
	}

}

/// add new option to dropdown list
function AddItem(Text,Value,dropdown)
{
       // Create an Option object

 
       var opt = document.createElement("option");
       
       // Add an Option object to Drop Down/List Box
       document.getElementById(dropdown).options.add(opt);
       // Assign text and value to Option object
       opt.text = Text;
       opt.value = Value;
                 
}
