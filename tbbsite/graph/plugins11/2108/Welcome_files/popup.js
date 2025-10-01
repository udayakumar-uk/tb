function addLoadEvent(func) {
	var oldonload = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = func;
	} else {
		window.onload = function() {
			oldonload();
			func();
		}
	}
}

/* popUp =  <a ... onclick="popUp(this.href,'fixed',580,370);return false;" rel="external"> */

addLoadEvent(externalLinks);

function externalLinks() {
 if (!document.getElementsByTagName) return;
 var anchors = document.getElementsByTagName("a");
 for (var i=0; i<anchors.length; i++) {
   var anchor = anchors[i];
   if (anchor.getAttribute("href") &&
       anchor.getAttribute("rel") == "external")
     anchor.target = "_blank";
 }
}


function popUp(strURL,strType,strHeight,strWidth) {
var strOptions="";
if (strType=="console") strOptions="status,scrollbars,resizable,height="+strHeight+",width="+strWidth;
if (strType=="fixed") strOptions="status,scrollbars,height="+strHeight+",width="+strWidth;
if (strType=="elastic") strOptions="toolbar,menubar,scrollbars,resizable,location,height="+strHeight+",width="+strWidth;
window.open(strURL, 'newWin', strOptions);
}
