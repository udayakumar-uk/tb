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
function executework($srt)
{
	$db = mysqli_connect("localhost", "root", "", "tobaccoboard");
	//mysql_select_db("tobaccob_tobacc0",$db);
	return mysqli_query($db,$srt);
}
function executework1($srt)
{
	$db = mysqli_connect("localhost", "root", "", "tobaccoboard");
	//mysql_select_db("tobaccob_tobacc0",$db);
	return mysqli_query($db,$srt);
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
