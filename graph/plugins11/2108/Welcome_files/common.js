// Updated 14/02/08

// For custom requiredIf rules in struts
function validateConditionalRequired (field)
{
		var isValid = true;
        var focusField = null;
        var i = 0;
        var isCheck = -1;

		if (field.type == 'text' ||
		 	field.type == 'textarea' ||
			field.type == 'file' ||
			field.type == 'select-one' ||
			field.type == 'password')
		{
                  var value = '';

			if (field.type == 'select-one')
			{
				var si = field.selectedIndex;
				if (si > 0)
				{
					value = field.options[si].value;
				}
			} else {
				value = field.value;
			}

                  if (trim(value).length == 0)
                  {
				isValid = false;
                  }
		}
		else if (field.length > 0 && (field[0].type == 'radio' ||
               field[0].type == 'checkbox'))
		{
			name = field[0].name;

			for (loop = 0; loop < field.length; loop++)
			{
				if (field[loop].checked)
				{
					isCheck=loop;
					break;
				}
			}

			if (isCheck < 0)
			{
				isValid = false;
			}
           }
           else if (field.type == 'radio' || field.type == 'checkbox')
           {
			name = field.name;

			if (field.checked)
			{
				isCheck=1;
			}

			if (isCheck < 0)
			{
				isValid = false;
			}
           }

           if (!isValid)
           {
           	field.focus();
           }

        return isValid;
}

// Trim whitespace from left and right sides of s.
function trim(s)
{
    return s.replace( /^\s*/, "" ).replace( /\s*$/, "" );
}

function errorMessageHandler (isValid, fieldName, msg)
{
	if (!isValid)
	{
		if (document.getElementById(fieldName + 'Error') != null)
		{
			if (msg.length > 0)
			{
				document.getElementById(fieldName + 'Error').innerHTML = msg + '<br>';
			}
			else
			{
				document.getElementById(fieldName + 'Error').innerHTML = '';
			}

		}

		if (document.getElementById(fieldName + 'ErrorSymbol') != null)
		{
			document.getElementById(fieldName + 'ErrorSymbol').innerHTML = '*';
		}

		if (document.getElementById(fieldName + 'Label') != null)
		{
			document.getElementById(fieldName + 'Label').className = 'error';
		}

		hideOverlay();
	}
	else
	{
		if (document.getElementById(fieldName + 'Error') != null)
		{
			document.getElementById(fieldName + 'Error').innerHTML = '';
		}

		if (document.getElementById(fieldName + 'ErrorSymbol') != null)
		{
			document.getElementById(fieldName + 'ErrorSymbol').innerHTML = '';
		}

		if (document.getElementById(fieldName + 'Label') != null)
		{
			document.getElementById(fieldName + 'Label').className = '';
		}
	}
}


function clearErrorMessage ()
{
	var all = document.all ? document.all : document.getElementsByTagName('*');
	var elements = new Array();
	var index = 0;

	for (var i = 0; i < all.length; i++)
	{
		var idValue = all[i].id;
		var re1 = /Error$/;
		var re2 = /ErrorSymbol$/;
		var re3 = /Label$/;
		var re4 = /resultStatusMessage$/;

		if(re1.test(idValue) || re2.test(idValue) || re4.test(idValue))
		{
			all[i].innerHTML = '';
		}
		else if (re3.test(idValue))
		{
			all[i].className = '';
		}
	}
}


// Fixed clearing error messages.
function clearAll(theform)
{
	for (i = 0; i < theform.elements.length; i++)
	{
		var fieldName = theform.elements[i].name;

		if (theform.elements[i].type=="text" ||
			theform.elements[i].type=="textarea" ||
			theform.elements[i].type=="password")
		{
			theform.elements[i].value = '';
		}
		else if (theform.elements[i].type == "checkbox" || theform.elements[i].type=="radio")
		{
			theform.elements[i].checked = false;
		}
		else if (theform.elements[i].type=="select-one")
		{
			theform.elements[i].value = theform.elements[i].options[0].value;
		}

		if (document.getElementById(fieldName + 'Error') != null)
		{
			document.getElementById(fieldName + 'Error').innerHTML = '';
		}

		if (document.getElementById(fieldName + 'ErrorSymbol') != null)
		{
			document.getElementById(fieldName + 'ErrorSymbol').innerHTML = '';;
		}

		if (document.getElementById(fieldName + 'Label') != null)
		{
			document.getElementById(fieldName + 'Label').className = '';
		}
	}

	if (document.getElementById('serverSideError') != null)
	{
		document.getElementById('serverSideError').innerHTML = '';
	}
}


function visitReceiptPage (link)
{
	window.open (link,'receipt','location=0,scrollbars=1,status=1,width=550,height=458,top=50,left=30');
}


function printPage()
{
//	if(window.print)
//	{
		window.print();
//	}
//	else
//	{
//		alert("Your browser doesn't support printing. Please use File->print option.");
//	}
}


function visitBillPaymentPopUp ()
{
	var corperationName 	= document.forms[0].corporationName.value;
	var billAccountNumber 	= document.forms[0].fromAccountDisplay.value;
	var approvalCode 		= document.forms[0].approvalCode.value;
	var bankReferenceNumber = document.forms[0].billReferenceNo.value;
	var transactionDate 	= document.forms[0].transactionDateTime.value;
	var status 				= document.forms[0].statusMessage.value;
	var transactionAmount 	= document.forms[0].amountDisplay.value;
	var referenceNumber 	= document.forms[0].referenceNo.value;
	var payeeCode 			= document.forms[0].payeeCodeDisplay.value;
	var merchantURL 		= document.forms[0].merchantURL.value;
	var payeeType			= document.forms[0].paymentType.value;

	if (payeeType == "Kiosk")
	{
		referenceNumber = request.getParameter("billReferenceNo");
	}

	var parameters = "../jsp/m1200_onlinebillpayment/mbbBillPaymentPopUp.jsp?merchantURL="+escape(merchantURL)+"&transactionDate="+escape(transactionDate)+"&status="+status+"&transactionAmount="+transactionAmount+"&referenceNumber="+referenceNumber+"&payeeCode="+payeeCode+"&approvalCode="+approvalCode+"&bankReferenceNumber="+bankReferenceNumber+"&billAccountNumber="+billAccountNumber+"&corperationName="+escape(corperationName);
	window.open(parameters, 'popup', 'width=500,height=350,status=0,scrollbars=1,resizable=1');
}

function getPageSize()
{
	var xScroll, yScroll;

	if (window.innerHeight && window.scrollMaxY) {
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}

	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}

	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else {
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}

	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight)
	return arrayPageSize;
}

function overlay()
{
	clearErrorMessage();

	var pageSize = getPageSize();
	var pageSizeHeight = pageSize[1]-80;

	divTD = document.getElementById("div_td");
	divTable = document.getElementById("div_table");
	divElement = document.getElementById("overlay");
	divTable.width = "100%";
	divTD.width = "100%";
	divTD.height = pageSizeHeight +"px";

	divElement.style.width = "100%";
	divElement.style.height= pageSizeHeight +"px";
	divElement.style.visibility="visible";

	promptMessage();
}

function getPagePosition()
{
	var windowTop, windowLeft;
	if (self.innerHeight) {	// all except Explorer
		windowTop = '45%';
		windowLeft = '30%';
		windowLeftPopup = '10%';
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowTop = '43%';
		windowLeft = '30%';
		windowLeftPopup = '10%';
	} else if (document.body) { // other Explorers
		windowTop = '50%';
		windowLeft = '30%';
		windowLeftPopup = '10%';
	}

	arrayPagePosition = new Array(windowTop,windowLeft,windowLeftPopup);
	return arrayPagePosition;
}


function promptMessage()
{
	var pagePosition = getPagePosition();
	var windowTop = pagePosition[0];
	var windowLeft = pagePosition[1];

	lightbox = document.getElementById("overlayBox");
	lightbox.style.top = windowTop;
	lightbox.style.left = windowLeft;
	lightbox.style.visibility="visible";
}

function promptMessagePopUp()
{
	var pagePosition = getPagePosition();
	var windowTop = pagePosition[0];
	var windowLeft = pagePosition[2];

	lightbox = document.getElementById("overlayBox");
	lightbox.style.top = windowTop;
	lightbox.style.left = windowLeft;
	lightbox.style.visibility="visible";
}

function overlayCancel()
{
	overlay();
	bCancel = true; //to bypass struts validation for cancel button
}

function overlayPopUp()
{
	clearErrorMessage();

	var pageSize = getPageSize();
	var pageSizeHeight = pageSize[1]-80;

	divTD = document.getElementById("div_td");
	divTable = document.getElementById("div_table");
	divElement = document.getElementById("overlay");

	divTable.width = "100%";
	divTD.width = "100%";
	divTD.height = pageSizeHeight +"px";

	divElement.style.width = "100%";
	divElement.style.height= pageSizeHeight +"px";
	divElement.style.visibility="visible";

}

function overlayPopUpCancel()
{
	overlayPopUp();
	bCancel = true; //to bypass struts validation for cancel button
}

function hideOverlay()
{
	try
	{
		divElement2 = document.getElementById("overlayBox");
		divElement2.style.visibility="hidden";
		divElement = document.getElementById("overlay");
		divElement.style.visibility="hidden";
	}
	catch (err)
	{
		
	}
}

function clearInputDate()
{
	document.eStandingBean.terminateDay.value = "";
	document.eStandingBean.terminateMonth.value = "";
	document.eStandingBean.terminateYear.value = "";
	document.eStandingBean.terminateDay.disabled = true;
	document.eStandingBean.terminateMonth.disabled = true;
	document.eStandingBean.terminateYear.disabled = true;
	return true;
}

function validateInputDate()
{
	document.eStandingBean.terminateDay.disabled = false;
	document.eStandingBean.terminateMonth.disabled = false;
	document.eStandingBean.terminateYear.disabled = false;
	return true;
}

/*
-can used on condition
 i.for parent window  only use for onclick event , user trigger event,not used for page onload event,
 ii.for pop up window , can be used anyway
*/
function reset_session_timer() {
	var date = new Date();
	var lastEvent = date.getTime();
	if(document.getElementById('lastEvent')!=null)
	{
		document.getElementById('lastEvent').value=lastEvent;
		//alert("1. reset session at :"+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds());
	}

	if (window.opener && !window.opener.closed)
		if(window.opener.document.getElementById('lastEvent')!=null)
		{
			window.opener.document.getElementById('lastEvent').value=lastEvent;
			//alert("2. reset session at :"+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds());
		}
}


