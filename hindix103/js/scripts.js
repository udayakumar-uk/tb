


function toggleMe(a){

var e=document.getElementById(a);

if(!e)return true;

if(e.style.display=="none"){

e.style.display="block"

} else {

e.style.display="none"

}

return false;

}

function toggleMe1(a,b,c,d,f){

var e=document.getElementById(a);

if(!e)return true;

if(e.style.display=="none"){

e.style.display="block"

document.getElementById(a).style.backgroundColor="#F5F5F5";

document.getElementById(b).innerHTML='Hide&nbsp;<img src="pw_imgs/hide.png" border="0" />';

document.getElementById(c).style.backgroundColor="#F5F5F5";

document.getElementById(d).innerHTML='<img src="pw_imgs/arrowblue1.png" width="14" height="17" border="0" />';

check(a,f);

} else {

e.style.display="none",

document.getElementById(a).style.backgroundColor="";

document.getElementById(b).innerHTML='Show&nbsp;<img src="pw_imgs/show.png" border="0" />';

document.getElementById(c).style.backgroundColor="";

document.getElementById(d).innerHTML='<img src="pw_imgs/arrowblue.png" width="14" height="17" border="0" />';

}

return false;

}



function toggleMe2(a,b,c,d,f){

var e=document.getElementById(a);

if(!e)return true;

if(e.style.display=="none"){

e.style.display="block"

document.getElementById(a).style.backgroundColor="#F5F5F5";

document.getElementById(b).innerHTML='Hide&nbsp;<img src="pw_imgs/hide.png" border="0" />';

document.getElementById(c).style.backgroundColor="#F5F5F5";

document.getElementById(d).innerHTML='<img src="pw_imgs/arrowblue1.png" width="14" height="17" border="0" />';

check(a,f);

} else {

e.style.display="none",

document.getElementById(a).style.backgroundColor="";

document.getElementById(b).innerHTML='Show&nbsp;<img src="pw_imgs/show.png" border="0" />';

document.getElementById(c).style.backgroundColor="";

document.getElementById(d).innerHTML='<img src="pw_imgs/arrowblue.png" width="14" height="17" border="0" />';

}

return false;

}







function col(st)

{

document.getElementById(st).style.backgroundColor="#F5F5F5";

}

function col1(st)

{

document.getElementById(st).style.backgroundColor="";

}





function load_pg(pg,div)

{

	$("#"+div).load(pg);

}

function eall(st)

{

   	var cnt=st;

		document.getElementById('showall').innerHTML='<a href="#" onclick="hall('+st+');">Hide All</a>';

	for(i=1;i<=cnt;i++)

	{

		var par="par"+i;

		var mopar="mopar"+i;

		var para="para"+i;

		var chng="chng"+i;

		var pimg="pimg"+i;

		document.getElementById(para).style.display="block";

		document.getElementById(par).style.backgroundColor="#FFFFFF";

		document.getElementById(chng).innerHTML='Hide&nbsp;<img src="pw_imgs/hide.png" border="0" />';

		document.getElementById(par).style.backgroundColor="#FFFFFF";

		document.getElementById(pimg).innerHTML='<img src="pw_imgs/arrowblue1.png" width="14" height="17" border="0" />';

	}

}

function hall(st)

{

   	var cnt=st;

	document.getElementById('showall').innerHTML='<a href="#" onclick="eall('+st+');">Show All</a>';

	for(i=1;i<=cnt;i++)

	{

		var par="par"+i;

		var mopar="mopar"+i;

		var para="para"+i;

		var chng="chng"+i;

		var pimg="pimg"+i;

		document.getElementById(para).style.display='none';

		document.getElementById(par).style.backgroundColor="";

		document.getElementById(chng).innerHTML='Show&nbsp;<img src="pw_imgs/show.png" border="0"/>';

		document.getElementById(par).style.backgroundColor="";

		document.getElementById(pimg).innerHTML='<img src="pw_imgs/arrowblue.png" width="14" height="17" border="0" />';

	}

}



function check(st,st1)

{

	var cnt=st1;

	for(i=1;i<=cnt;i++)

	{

		var par="par"+i;

		var mopar="mopar"+i;

		var para="para"+i;

		var chng="chng"+i;

		var pimg="pimg"+i;

		if(st!=para)

		{

			document.getElementById(para).style.display='none';

			document.getElementById(par).style.backgroundColor="";

			document.getElementById(chng).innerHTML='Show&nbsp;<img src="pw_imgs/show.png" border="0" />';

			document.getElementById(par).style.backgroundColor="";

			document.getElementById(pimg).innerHTML='<img src="pw_imgs/arrowblue.png" width="14" height="17" border="0" />';

		}

	}

}




function show_pane(pane)

{

	document.getElementById(pane).style.visibility='visible';

}

function show_pane1(pane)

{

	document.getElementById(pane).style.visibility='hidden';

}

// social icon funtion

/*function chng(st,st1,st2)

{

	if(st2=='in')	

	{

		document.getElementById(st1).innerHTML='<img src="'+st+'"/>';

	}

	else

	{

		document.getElementById(st1).innerHTML='<img src="'+st+'"/>';

	}

}*/











