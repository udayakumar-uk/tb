<?php
function executework($srt)
{
	$db = mysql_connect("localhost", "tobacco", "#hTki690");
	mysql_select_db("tobacco",$db);
	return mysql_query($srt,$db);
}
function executeupdate($srt)
{
	$db = mysql_connect("localhost:3306", "tobacco", "#hTki690");
	mysql_select_db("tobacco",$db);
	mysql_query($srt,$db);
	return mysql_affected_rows();
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
