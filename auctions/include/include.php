<?php
function csrf_token_check()
{
	
	try
	{
		// Run CSRF check, on POST data, in exception mode, for 10 minutes, in one-time mode.
		NoCSRF::check( 'csrf_token', $_POST, true, 60*10, false );
		// form parsing, DB inserts, etc.
		// ...
		$result = 'Done';
		
	}
	catch ( Exception $e )
	{
		// CSRF attack detected
		$result = $e->getMessage() . ' Action ignored.';
	}
	return $result;
}
function executework1($srt)
{
	/*$db = mysql_connect("localhost", "root", "");
	mysql_select_db("tobaccob_tobacc0",$db);
	return mysql_query($srt,$db);*/
	
	$db = mysqli_connect("localhost","tobacco","#hTki690","tobacco") or die(mysqli_error);
	//print_r(mysqli_query($db,$srt));
	return mysqli_query($db,$srt);
}
function executework($srt)
{
	$db = mysql_connect("localhost", "tobacco", "#hTki690");
	mysql_select_db("tobacco",$db);
	return mysql_query($srt,$db);
}
function executeupdate($srt)
{
	$db = mysql_connect("localhost", "tobacco", "#hTki690");
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
function echo_str($str)
{
	print(htmlentities($str,  ENT_QUOTES,  "utf-8"));
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
$sel=executework("select * from employee_admin");
?>
