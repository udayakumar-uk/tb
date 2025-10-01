var url = window.location.pathname;
var pageId = url.substring(url.lastIndexOf('/')+1,url.lastIndexOf("."));
var dom_data_collection = new DomDataCollection();
dom_data_collection.config.functionsToExclude = ['myFunction1','myFunction2'];
dom_data_collection.initFunctionsToExclude();
dom_data_collection.startInspection();
var dp = encode_deviceprint();
var jsEventsString = UIEventCollector.serialize();
var Encoded = dp;
var Decoded = decodeURIComponent(dp);
var domElementsString = dom_data_collection.domDataAsJSON();
		
var theFormNameOuter = document.getElementsByTagName("form")[0];
var theFormNameInner = document.getElementsByTagName("form")[1];
var theFormName = theFormNameOuter;
var theFormAction = "No";
var theFormActionValOuter = theFormNameOuter.attributes["action"].value;
var theIndex3 = theFormActionValOuter.indexOf("Login"); 

if (theIndex3 != -1)
{
	theFormAction = "Yes";
	post_deviceprint();
}	

if(typeof theFormNameInner != "undefined")
{
	theFormName = theFormNameInner;
	var theFormActionValInner = theFormNameInner.attributes["action"].value;
	var theIndex1 = theFormActionValInner.indexOf("Confirm"); 
	var theIndex2 = theFormActionValInner.indexOf("Verify"); 

	if (theIndex1 != -1 && theIndex2 == -1)
	{
		theFormAction = "Yes";
	}	
}

if (theFormAction == "Yes")
{
	var element = document.createElement("input");       
	element.setAttribute("type", "hidden");     
	element.setAttribute("value", domElementsString);     
	element.setAttribute("name", "domElementsString");         
	theFormName.appendChild(element);   
	
	var element1 = document.createElement("input");       
	element1.setAttribute("type", "hidden");     
	element1.setAttribute("value", jsEventsString);     
	element1.setAttribute("name", "jsEventsString");         
	theFormName.appendChild(element1);   
	
	var element2 = document.createElement("input");       
	element2.setAttribute("type", "hidden");     
	element2.setAttribute("value", pageId);     
	element2.setAttribute("name", "pageId");         
	theFormName.appendChild(element2);   
	
	var element3 = document.createElement("input");       
	element3.setAttribute("type", "hidden");     
	element3.setAttribute("value", theFormAction);     
	element3.setAttribute("name", "theFormAction");         
	theFormName.appendChild(element3);   
}

