<?php
function executework($srt)
{
	$db = mysqli_connect("localhost", "root", "","tobaccoboard");
	return mysqli_query($db,$srt);
}
function executeworkins($srt)
{
	$db = mysqli_connect("localhost", "root", "","tobaccoboard");
	mysql_query($db,$srt);
	return mysqli_insert_id($db);
}
function formattodb($swe)
{
	$day1=substr($swe,0,2);
	$month1=substr($swe,3,2);
	$year1=substr($swe,6,4);
	$newyear=$year1."-".$month1."-".$day1;
	return $newyear;
}
function formatfromdb($swe)
{
	$day1=substr($swe,8,2);
	$month1=substr($swe,5,2);
	$year1=substr($swe,0,4);
	$newyear=$month1."/".$day1."/".$year1;
	return $newyear;
}
function redirect($url) { 

if(headers_sent()) { 

?> 
<html><head> 
<script language="javascript" type="text/javascript"> 
<!-- 
window.parent.document.location='<?php print($url);?>'; 
//--> 
</script> 
</head></html> 
<?php
exit; 

} else { 

header("Location: ".$url); 
exit; 

} 

} 
?>