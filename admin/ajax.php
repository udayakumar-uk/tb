<?php
ob_start();
session_start();
header('Content-type: text/html; charset=utf-8');
include_once("include/includei.php");

$resp="msg=1";

// existance of email
if($_GET['st']!='')
{
	$selemail=executework("select * from tob_images where id='".($_GET['st1'])."'");
	
	echo "cnt=".$cnts=@mysqli_num_rows($selemail);
	if($cnts>0)
	{
		$upd=executework("update tob_images set cover='".($_GET['st'])."' where id=".($_GET['st1']));
		$resp=$resp."~img=1";
	}
	else
	$resp=$resp."~img=0";
}
if(!empty($_GET['st1']) && empty($_GET['st']))
{
	$selempid=executework("select Employee_number from master_employee where Employee_number='".($_GET['empid'])."'");
	$cnt=@mysqli_num_rows($selempid);
	if($cnt >0)
	$resp='Employee Id Already Exist.';
	else
	$resp=1;	
}
echo $resp;
?>