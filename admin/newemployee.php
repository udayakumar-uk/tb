<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
include_once("phpfunctions.php");
if(isset($_SESSION["tobadmin"]))
{

if(!empty($_POST['eid']))
$eid=$_POST['eid'];
else if(!empty($_GET['eid']))
$eid=$_GET['eid'];
else
$eid='';
$select=executework("select * from master_employee where Employee_number='".$eid."'");
$cnt=@mysqli_num_rows($select);
$row=@mysqli_fetch_array($select);

if(!empty($_POST['sd']))
{
	$del=executework("delete from service_details where id=".$_POST['sd']);
	redirect("newemployee.php?eid=".$_POST['eid']."&dsuc=1");
}	
if(!empty($_POST['pd']))
{
	$del=executework("delete from promotion_det where id=".$_POST['pd']);
	redirect("newemployee.php?eid=".$_POST['eid']."&dpsuc=1");
}	
if(!empty($_POST['vd']))
{
	$del=executework("delete from disciplinary_det where id=".$_POST['vd']);
	redirect("newemployee.php?eid=".$_POST['eid']."&dvsuc=1");
}	
if(!empty($_POST['ld']))
{
	$del=executework("delete from tob_aaleaves where id=".$_POST['ld']);
	redirect("newemployee.php?eid=".$_POST['eid']."&dlsuc=1");
}	
/*if($_FILES['image']['name']!="")
{
	$sel=executework("select * from master_employee where Employee_number='".$eid."'");
	$count=@mysqli_num_rows($sel);
	if($count>0)
	{
		$row=@mysqli_fetch_array($sel);
		$target_pathn = "employeeimage/";
		$f=basename($_FILES['image']['name']);
		$len=strlen($f);
		$pos=strpos($f,'.');
		$ext=substr($f,$pos,$len);
		$f1=$row['Employee_number'].$ext;
		$file="employeeimage/".$f1;
		if(file_exists($file))
		{
			unlink("employeeimage/".$f1);
		}
		$tmpn=$_FILES['image']['tmp_name'];
		$target_pathsmn = $target_pathn .$f1; 
		move_uploaded_file($tmpn, $target_pathsmn);
		$update=executework("update master_employee set image='".$f1."' where Employee_number='".$row['Employee_number']."'");
		redirect("newemployee.php?eid=".$row['Employee_number']);
	}
	else
	{
		redirect("employeedata.php?valid=0");
	}
}*/

if(!empty($_POST['subm']))
{
	//print_r($_POST);
	$master_id=010;
	//$ins=executework("insert into master_employee values(".$master_id.",'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','')");
//	echo "insert into master_employee (Employee_number) values('".$master_id."')";
	$ins=executework("insert into master_employee (Employee_number) values('".$master_id."')");
	
		$target_pathn = "employeeimage/";
		$f=basename($_FILES['image']['name']);
		$len=strlen($f);
		$pos=strpos($f,'.');
		$ext=substr($f,$pos,$len);
		$f1=$_POST['empid'].$ext;
		$file="employeeimage/".$f1;
		if(file_exists($file))
		{
			unlink("employeeimage/".$f1);
		}
		$tmpn=$_FILES['image']['tmp_name'];
		$target_pathsmn = $target_pathn .$f1; 
		move_uploaded_file($tmpn, $target_pathsmn);
	
	    //echo "update master_employee set Employee_number='".$_POST['empid']."',Name='".$_POST['Name']."',Designation='".$_POST['Designation']."',E_CLASSIFICATION='".$_POST['E_CLASSIFICATION']."',place_working='".$_POST['place_working']."',E_NATIVE='".$_POST['E_NATIVE']."',E_SECTION='".$_POST['E_SECTION']."',E_ADDRESS='".$_POST['E_ADDRESS']."',Working_from='".date('Y-m-d',strtotime($_POST['Working_from']))."',E_Phone1='".$_POST['E_Phone1']."',E_Phone2='".$_POST['E_Phone2']."',E_Pay_Band='".$_POST['E_Pay_Band']."',E_QUA='".$_POST['E_QUA']."',E_Grade_Pay='".$_POST['E_Grade_Pay']."',E_TECHNON_TECH='".$_POST['E_TECH']."',E_DOB='".datepattrn1($_POST['E_DOB'])."',E_CATEGORY='".$_POST['E_CATEGORY']."',E_DOJ='".datepattrn1($_POST['E_DOJ'])."',E_whetherDRPR='".$_POST['drpr']."',E_JOINED_AS='".$_POST['E_JOINED_AS']."',E_RegularTempAdhoc='".$_POST['E_Regular']."',E_DOR='".datepattrn1($_POST['E_DOR'])."',E_Handicapped='".$_POST['E_Handicapped']."',image='".$f1."',emp_status='In-Service' where  Employee_number='".$master_id."'";
	$upd=executework("update master_employee set Employee_number='".$_POST['empid']."',Name='".$_POST['Name']."',Designation='".$_POST['Designation']."',E_CLASSIFICATION='".$_POST['E_CLASSIFICATION']."',place_working='".$_POST['place_working']."',E_NATIVE='".$_POST['E_NATIVE']."',E_SECTION='".$_POST['E_SECTION']."',E_ADDRESS='".$_POST['E_ADDRESS']."',Working_from='".date('Y-m-d',strtotime($_POST['Working_from']))."',E_Phone1='".$_POST['E_Phone1']."',E_Phone2='".$_POST['E_Phone2']."',E_Pay_Band='".$_POST['E_Pay_Band']."',E_QUA='".$_POST['E_QUA']."',E_Grade_Pay='".$_POST['E_Grade_Pay']."',E_TECHNON_TECH='".$_POST['E_TECH']."',E_DOB='".date('Y-m-d',strtotime($_POST['E_DOB']))."',E_CATEGORY='".$_POST['E_CATEGORY']."',E_DOJ='".date('Y-m-d',strtotime($_POST['E_DOJ']))."',E_whetherDRPR='".$_POST['drpr']."',E_JOINED_AS='".$_POST['E_JOINED_AS']."',E_RegularTempAdhoc='".$_POST['E_Regular']."',E_DOR='".date('Y-m-d',strtotime($_POST['E_DOR']))."',E_Handicapped='".$_POST['E_Handicapped']."',image='".$f1."',emp_status='In-Service' where  Employee_number='".$master_id."'");
	
	$maxid=max_id("service_details","id");
	$maxid1=max_id("promotion_det","id");
	$maxid2=max_id("disciplinary_det","id");
	$maxid3=max_id("tob_aaleaves","id");
	$eid=$_POST['empid'];
	for($i=1;$i<=$_POST['sn'];$i++)
	{
		//echo "ss=".$_POST['sid'.$i];
		if($_POST['sid'.$i]!="")
		{
			$upd=executework("update service_details set E_PLACE='".$_POST['E_PLACE'.$i]."',E_PF='".$_POST['E_PF'.$i]."',E_CADRE='".$_POST['E_CADRE'.$i]."',E_FROM='".date('Y-m-d',strtotime($_POST['E_FROM'.$i]))."',E_TO='".date('Y-m-d',strtotime($_POST['E_TO'.$i]))."' where id=".$_POST['sid'.$i]);
		}
		else
		{
			if($_POST['E_CADRE'.$i]!="")
			{
				$int=executework("insert into service_details values('".$eid."','".$_POST['E_PLACE'.$i]."','".$_POST['E_PF'.$i]."','".$_POST['E_CADRE'.$i]."','".date('Y-m-d',strtotime($_POST['E_FROM'.$i]))."','".date('Y-m-d',strtotime($_POST['E_TO'.$i]))."','0','0','',".$maxid.")");
				$maxid++;
			}
		}
	}
	$arr=array();
	$qr="";
	for($i=1;$i<=$_POST['pn'];$i++)
	{
		if($_POST['pid'.$i]!="")
		{
			$upd=executework("update promotion_det set E_DES='".$_POST['E_DES'.$i]."',E_DOP_DT='".date('Y-m-d',strtotime($_POST['E_DOP_DT'.$i]))."',ptype='".$_POST['ptype'.$i]."',orderno='".$_POST['order'.$i]."' where id=".$_POST['pid'.$i]);
			echo "update promotion_det set E_DES='".$_POST['E_DES'.$i]."',E_DOP_DT='".date('Y-m-d',strtotime($_POST['E_DOP_DT'.$i]))."',ptype='".$_POST['ptype'.$i]."',orderno='".$_POST['order'.$i]."' where id=".$_POST['pid'.$i];
		}
		else
		{
			if($_POST['E_DES'.$i]!="")
			{
			    echo "insert into promotion_det values('".$maxid1."','".$eid."','".$_POST['E_DES'.$i]."','".date('Y-m-d',strtotime($_POST['E_DOP_DT'.$i]))."','".$_POST['ptype'.$i]."','".$_POST['order'.$i]."')";
				$int=executework("insert into promotion_det values('".$maxid1."','".$eid."','".$_POST['E_DES'.$i]."','".date('Y-m-d',strtotime($_POST['E_DOP_DT'.$i]))."','".$_POST['ptype'.$i]."','".$_POST['order'.$i]."')");
				$maxid1++;
			}
		}
	}
	for($i=1;$i<=$_POST['vn'];$i++)
	{
		
		
		if($_POST['vid'.$i]!="")
		{
			$upd=executework("update disciplinary_det set refno='".$_POST['refno'.$i]."',det='".$_POST['det'.$i]."',status='".$_POST['status'.$i]."' where id=".$_POST['vid'.$i]);
		}
		else
		{
			if($_POST['refno'.$i]!="")
			{
				$int=executework("insert into disciplinary_det values('".$maxid2."','".$eid."','".$_POST['refno'.$i]."','".$_POST['det'.$i]."','".$_POST['status'.$i]."')");
				$maxid2++;
			}
		}
	}
	for($i=1;$i<=$_POST['ln'];$i++)
	{
		if($_POST['eob'.$i]=="")
		$_POST['eob'.$i]=0;
		if($_POST['eaccured'.$i]=="")
		$_POST['eaccured'.$i]=0;
		if($_POST['eused'.$i]=="")
		$_POST['eused'.$i]=0;

		if($_POST['hob'.$i]=="")
		$_POST['hob'.$i]=0;
		if($_POST['haccured'.$i]=="")
		$_POST['haccured'.$i]=0;
		if($_POST['hused'.$i]=="")
		$_POST['hused'.$i]=0;
		
		$etot=0;
		$ebal=0;
		$etot=$_POST['eob'.$i]+$_POST['eaccured'.$i];
		$ebal=$etot-$_POST['eused'.$i];

		$htot=0;
		$hbal=0;
		$htot=$_POST['hob'.$i]+$_POST['haccured'.$i];
		$hbal=$htot-$_POST['hused'.$i];

		if($_POST['lid'.$i]!="")
		{

				$upd=executework("update tob_aaleaves set edate='".date('Y-m-d',strtotime($_POST['edate'.$i]))."',eob='".$_POST['eob'.$i]."',eaccured='".$_POST['eaccured'.$i]."',etotal=".$etot.",eused=".$_POST['eused'.$i].",ebal=".$ebal.",hob='".$_POST['hob'.$i]."',haccured='".$_POST['haccured'.$i]."',htotal=".$htot.",hused=".$_POST['hused'.$i].",hbal=".$hbal." where id=".$_POST['lid'.$i]);

//			$sel=executework("select * from tob_aaleaves where empno='".$eid."' and edate='".datepattrn1($_POST['edate'.$i])."'");
//			$cnt=@mysqli_num_rows($sel);
//			if($cnt>0)
//			{
////				$upd=executework("update tob_aaleaves set refno='".$_POST['refno'.$i]."',det='".$_POST['det'.$i]."',status='".$_POST['status'.$i]."' where id=".$_POST['vid'.$i]);
//			}
//			else
//			{
//				$int=executework("insert into tob_aaleaves values('".$maxid3."','".$eid."','".datepattrn1($_POST['edate'.$i])."','".$_POST['eob'.$i]."','".$_POST['eaccured'.$i]."',".$etot.",".$_POST['eused'.$i].",".$ebal.",'".$_POST['hob'.$i]."','".$_POST['haccured'.$i]."',".$htot.",".$_POST['hused'.$i].",".$hbal.")");
//				$maxid3++;
//			}
		}
		else
		{
			if($_POST['edate'.$i]!="")
			{
				$int=executework("insert into tob_aaleaves values('".$maxid3."','".$eid."','".date('Y-m-d',strtotime($_POST['edate'.$i]))."','".$_POST['eob'.$i]."','".$_POST['eaccured'.$i]."',".$etot.",".$_POST['eused'.$i].",".$ebal.",'".$_POST['hob'.$i]."','".$_POST['haccured'.$i]."',".$htot.",".$_POST['hused'.$i].",".$hbal.")");
				$maxid3++;
			}
		}
	}
	redirect("newemployee.php?esucc=1");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Employee Data | Welcome To TOBBACO BOARD Admin</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style8a {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }

a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	color: #000000;
	text-decoration: none;
}
a.b:hover {
	color: #990000;
	text-decoration: none;
}
a.b:active {
	color: #990000;
	text-decoration: none;
}

-->
</style>
<script src="jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validate_image()
{
	if(document.form1.image.value=="")
	{
		alert("Browse Image");
		document.form1.image.focus();
		return false;
	}
	else
	{
		var pimage="image";
		var pi=document.getElementById(pimage).value;
		var plen=pi.length;
		var ppos=pi.indexOf(".");
		var ext=pi.substr(ppos+1,plen);
		var ext1=ext.toLowerCase();
		if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png')
		{
			alert("Only file types of jpg,jpeg,gif,png are allowed for Image");
			document.getElementById(pimage).value="";
			document.getElementById(pimage).focus();
			return false;
		}
		else
		{
			document.getElementById("form1").submit();
			return true;
		}
	}
}

function validate_employee()
{
	if(confirm("Are you sure to update this employee data?"))
	{
		var empid=document.form1.empid.value;
		if(empid.trim()=='')
		{
			alert("Enter Empployee Number");
			document.form1.empid.focus();
			return false;
		}
		if(document.form1.image.value!="")
		{
					var pimage="image";
			var pi=document.getElementById(pimage).value;
			var plen=pi.length;
			var ppos=pi.indexOf(".");
			var ext=pi.substr(ppos+1,plen);
			var ext1=ext.toLowerCase();
			if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png')
			{
				alert("Only file types of jpg,jpeg,gif,png are allowed for Image");
				document.getElementById(pimage).value="";
				document.getElementById(pimage).focus();
				return false;
			}
		}
		document.form1.subm.value=1;
		document.form1.submit();
		return true;
	}
	else
	return false;
}


function back_list(st,st1)
{
	location.href="employeedata.php?catg="+st+"&group_by="+st1;
}

function sel_combo(st,adv)
{
	var fld=document.getElementById(st);
	//alert(adv);
	for(k=0;k<fld.options.length;k++)
	{
		//alert(fld.options[k].value.toLowerCase()+"--"+adv.toLowerCase());
		if(fld.options[k].value.toLowerCase()==adv.toLowerCase())
		{
			fld.options[k].selected=true;
		}

	}
}

function add_ser()
{
	if(confirm("Are you sure to add service details?"))
	{
		var n=document.form1.sn.value;
		var sn=document.form1.nserv.value;
		var tot=parseInt(n)+parseInt(sn);
		document.form1.sn.value=tot;
		document.form1.submit();
	}
	else
	return false;
}
function rem()
{
	var n=document.form1.sn.value;
	var tot=parseInt(n)-1;
	document.form1.sn.value=tot;
	document.form1.submit();
}
function add_prom()
{
	if(confirm("Are you sure to add promotion details?"))
	{
		var n=document.form1.pn.value;
		var sn=document.form1.mprom.value;
		var tot=parseInt(n)+parseInt(sn);
		document.form1.pn.value=tot;
		document.form1.submit();
	}
	else
	return false;
}
function remv()
{
	var n=document.form1.pn.value;
	var tot=parseInt(n)-1;
	document.form1.pn.value=tot;
	document.form1.submit();
}
function delt(st)
{
	if(confirm("Are you sure to delete this record?"))
	{
		document.form1.sd.value=st;
		document.form1.submit();
	}
	else
	return false;
}
function deltv(st)
{
	if(confirm("Are you sure to delete this record?"))
	{
		document.form1.pd.value=st;
		document.form1.submit();
	}
	else
	return false;
}
function add_vig()
{
	if(confirm("Are you sure to add vigilance details?"))
	{
		var n=document.form1.vn.value;
		var sn=document.form1.vig.value;
		var tot=parseInt(n)+parseInt(sn);
		document.form1.vn.value=tot;
		document.form1.submit();
	}
	else
	return false;
}
function remvv()
{
	var n=document.form1.vn.value;
	var tot=parseInt(n)-1;
	document.form1.vn.value=tot;
	document.form1.submit();
}
function deltvv(st)
{
	if(confirm("Are you sure to delete this record?"))
	{
		document.form1.vd.value=st;
		document.form1.submit();
	}
	else
	return false;
}

function add_leaves()
{
	if(confirm("Are you sure to add leave details?"))
	{
		var n=document.form1.ln.value;
		var sn=document.form1.lev.value;
		var tot=parseInt(n)+parseInt(sn);
		document.form1.ln.value=tot;
		document.form1.submit();
	}
	else
	return false;
}
function remvl()
{
	var n=document.form1.ln.value;
	var tot=parseInt(n)-1;
	document.form1.ln.value=tot;
	document.form1.submit();
}
function deltvl(st)
{
	if(confirm("Are you sure to delete this record?"))
	{
		document.form1.ld.value=st;
		document.form1.submit();
	}
	else
	return false;
}

function cal_leavtot(st,n)
{
	if(st=='e')
	{
		var ob=document.getElementById("eob"+n).value;
		var acc=document.getElementById("eaccured"+n).value;
		var usd=document.getElementById("eused"+n).value;
		if(isNaN(ob)==true)
		{
			alert("Enter valid opening balalnce");
			document.getElementById("eob"+n).value="";
			document.getElementById("eob"+n).focus;
			return false;
		}
		if(isNaN(acc)==true)
		{
			alert("Enter valid accured leaves");
			document.getElementById("eaccured"+n).value="";
			document.getElementById("eaccured"+n).focus;
			return false;
		}
		if(isNaN(usd)==true)
		{
			alert("Enter valid used leaves");
			document.getElementById("eused"+n).value="";
			document.getElementById("eused"+n).focus;
			return false;
		}
	}
	if(st=='h')
	{
		var ob=document.getElementById("hob"+n).value;
		var acc=document.getElementById("haccured"+n).value;
		var usd=document.getElementById("hused"+n).value;
		if(isNaN(ob)==true)
		{
			alert("Enter valid opening balalnce");
			document.getElementById("hob"+n).value="";
			document.getElementById("hob"+n).focus;
			return false;
		}
		if(isNaN(acc)==true)
		{
			alert("Enter valid accured leaves");
			document.getElementById("haccured"+n).value="";
			document.getElementById("haccured"+n).focus;
			return false;
		}
		if(isNaN(usd)==true)
		{
			alert("Enter valid used leaves");
			document.getElementById("hused"+n).value="";
			document.getElementById("hused"+n).focus;
			return false;
		}
	}

	if(ob=="")
	ob=0;
	if(acc=="")
	acc=0;
	if(usd=="")
	usd=0;
	
	var tot=0;
	var bal=0;

	var tot=parseInt(ob)+parseInt(acc);
	var bal=parseInt(tot)-parseInt(usd);
	if(st=='e')
	{
		document.getElementById("etot"+n).value=tot;
		document.getElementById("ebal"+n).value=bal;
	}
	if(st=='h')
	{
		document.getElementById("htot"+n).value=tot;
		document.getElementById("hbal"+n).value=bal;
	}
}

function checkempid()
{
	var empid=document.getElementById('empid').value;	
	 var xmlhttp;    
	  if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
		 xmlhttp=new XMLHttpRequest();
	  }
	  else
	  {// code for IE6, IE5
		 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function()
	  {
		 if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var res=xmlhttp.responseText;
			//alert(res);
			if(res!=1)
			{
				alert(res);
				//document.form1.empid.value="";
				document.form1.empid.focus();
			}	
								
		}
	  }
	xmlhttp.open("GET","ajax.php?st1=empid&&empid="+empid,true);
	//alert("admin/php/ajax.php?st=agentaprove&&id="+st);
	xmlhttp.send();
	
}
</script>
<style type="text/css">
<!--
.style9 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #0000FF;
}
.style10 {color: #FF0000}
-->
</style>
</head>
<body>
<?php

function dateobj_bet_dates($date2,$date1)
{
	$dt2=date('Y-m-d H:i:s',strtotime($date1));
	$dt1=date('Y-m-d H:i:s',strtotime($date2));
	$y1=date('Y',strtotime($date1));
	$y2=date('Y',strtotime($date2));
	$m1=date('m',strtotime($date1));
	$m2=date('m',strtotime($date2));
	$d1=date('d',strtotime($date1));
	$d2=date('d',strtotime($date2));
	$h1=date('H',strtotime($date1));
	$h2=date('H',strtotime($date2));
	$i1=date('i',strtotime($date1));
	$i2=date('i',strtotime($date2));
	$s1=date('s',strtotime($date1));
	$s2=date('s',strtotime($date2));
	
	$days=date('t',strtotime($date1));
	//echo "dd=".$days;
	
	if($s2>$s1)
	{
		$s1=$s1+60;
		$i1=$i1-1;
	}
	$s=$s1-$s2;
	if($i2>$i1)
	{
		$i1=$i1+60;
		$h1=$h1-1;
	}
	$i=$i1-$i2;
	if($h2>$h1)
	{
		$h1=$h1+24;
		$d1=$d1-1;
	}
	$h=$h1-$h2;
	if($d2>$d1)
	{
		$d1=$d1+$days;
		$m1=$m1-1;
	}
	$d=$d1-$d2;
	if($m2>$m1)
	{
		$m1=$m1+12;
		$y1=$y1-1;
	}
	$m=$m1-$m2;
		$y=$y1-$y2;
		
	if($y2>$y1)
	{
		return "invalid";
	}
	else
	{
		$arr=array($y,$m,$d,$h,$i,$s);
		return $arr;
	}
}


	
	
//	if($row['E_whether DR/PR']!="")
//	{
//		if($row['E_whether DR/PR']=='PR')
//		$row['E_whether DR/PR']='Promotion';
//		else
//		$row['E_whether DR/PR']='Direct Recruitment';
//	}
//	if($row['E_Regular/Temp/Adhoc']!="")
//	{
//		if($row['E_Regular/Temp/Adhoc']=='R')
//		$row['E_Regular/Temp/Adhoc']='Regular';
//		else if($row['E_Regular/Temp/Adhoc']=='T')
//		$row['E_Regular/Temp/Adhoc']='Temporary';
//	}
//	if($row['E_TECH/NON TECH']!="")
//	{
//		if($row['E_TECH/NON TECH']=='T')
//		$row['E_TECH/NON TECH']='Technical';
//		else if($row['E_TECH/NON TECH']=='NT')
//		$row['E_TECH/NON TECH']='Non-Technical';
//	}

$select=executework("select * from master_employee where Employee_number='".$eid."'");
$cnt=@mysqli_num_rows($select);
$row=@mysqli_fetch_array($select);

	if($row['image']!="")
	$img="employeeimage/".$row['image'];
	else
	$img="noimage.png";
//$seldesg=executework("select * from master_designations order by E_DESI");
$seldesg=executework("select * from tob_designation order by designation");
$cntd=@mysqli_num_rows($seldesg);
$desg=array();
$i=0;
while($rowd=@mysqli_fetch_array($seldesg))
{
	$desg[$i]['id']=$rowd['id'];
	$desg[$i]['desg']=$rowd['designation'];
	$i++;
}	

$selloc=executework("select * from tob_platfrm order by platform");
$cntl=@mysqli_num_rows($selloc);
$loc=array();
$i=0;
while($rowl=@mysqli_fetch_array($selloc))
{
	$loc[$i]['id']=$rowl['id'];
	$loc[$i]['loc']=$rowl['platform'];
	
	//$loc[$i]=$rowl['platform'];
	$i++;
}	

$selqua=executework("select * from master_qualifications order by E_QUA");
$cntq=@mysqli_num_rows($selqua);
$qual=array();
$i=0;
while($rowq=@mysqli_fetch_array($selqua))
{
	$qual[$i]=$rowq['E_QUA'];
	$i++;
}	

$selcat=executework("select * from master_category order by E_CATEGORY");
$cntc=@mysqli_num_rows($selcat);
$catg=array();
$i=0;
while($rowc=@mysqli_fetch_array($selcat))
{
	$catg[$i]=$rowc['E_CATEGORY'];
	$i++;
}

if(!empty($_POST['Name']))
{
	$empid=$_POST['empid'];$name=$_POST['Name'];$designation=$_POST['Designation'];$e_classification=$_POST['E_CLASSIFICATION'];$place_working=$_POST['place_working'];$e_native=$_POST['E_NATIVE'];$e_section=$_POST['E_SECTION'];$e_address=$_POST['E_ADDRESS'];$working_from=$_POST['Working_from'];$e_phone1=$_POST['E_Phone1'];$e_phone2=$_POST['E_Phone2'];$e_pay_band=$_POST['E_Pay_Band'];$e_qua=$_POST['E_QUA'];$e_grade_pay=$_POST['E_Grade_Pay'];$e_tech=$_POST['E_TECH'];$e_dob=$_POST['E_DOB'];$e_category=$_POST['E_CATEGORY'];$e_doj=$_POST['E_DOJ'];$drpr=$_POST['drpr'];$e_joined_as=$_POST['E_JOINED_AS'];$e_regular=$_POST['E_Regular'];$e_dor=$_POST['E_DOR'];$e_handicapped=$_POST['E_Handicapped'];
}
else
{
	$empid=$row['Employee_number'];$name=$row['Name'];$designation=$row['Designation'];$e_classification=$row['E_CLASSIFICATION'];$place_working=$row['place_working'];$e_native=$row['E_NATIVE'];$e_section=$row['E_SECTION'];$e_address=$row['E_ADDRESS'];$working_from=datepattrn($row['Working_from']);$e_phone1=$row['E_Phone1'];$e_phone2=$row['E_Phone2'];$e_pay_band=$row['E_Pay_Band'];$e_qua=$row['E_QUA'];$e_grade_pay=$row['E_Grade_Pay'];$e_tech=$row['E_TECHNON_TECH'];$e_dob=datepattrn($row['E_DOB']);$e_category=$row['E_CATEGORY'];$e_doj=$row['E_DOJ'];$drpr=$row['E_whetherDRPR'];$e_joined_as=$row['E_JOINED_AS'];$e_regular=$row['E_RegularTempAdhoc'];$e_dor=$row['E_DOR'];$e_handicapped=$row['E_Handicapped'];
}
?>
<?php include_once("header.php"); ?>
<?php
if(!in_array('ADD',$detai))
{
	redirect("employeedata.php");
}
?>
<a name="top" id="top"></a>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
    <?php
	if(!empty($_GET['esucc']) && $_GET['esucc']==1)
	{
	?>
      <tr>
        <td width="90%" height="25" bgcolor="#F7F7F7"><div align="center" class="style10">New Employee Created SuccessFully</div></td>
        </tr>
   <?php
   }
   ?> 
    </table>
      <br />
      <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <div>
                      <div>
                        <table width="98%" border="0">
	  					<tr>
						 <td><strong><?php if(!empty($stp)) echo $stp ?></strong></td>
						</tr>
                          <tr>
                            <td height="90" colspan="3"><div align="center">
<form action="newemployee.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >
                    <br />

                    <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
                      <tr>
                        <td colspan="3" bgcolor="#FFFFFF" class="style1">General Profile</td>
                      </tr>
                      <tr>
                        <td colspan="3" bordercolor="#000000" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                          <tr bgcolor="#F5F5F5">
                            <td bgcolor="#F5F5F5" class="style8a">Employee Number</td>
                            <td width="34%" bgcolor="#F5F5F5" class="style8"><label>
                              <input name="empid" type="text" id="empid" value="<?php echo $empid; ?>" onchange="checkempid();"/>
                            </label></td>
                            <td width="26%" rowspan="5"><div align="center"><img src="<?php echo $img ?>" height="150"/></div></td>
                          </tr>
                          
                          <tr bgcolor="#DDDDDD">
                            <td width="40%" bgcolor="#DDDDDD" class="style8a">Name</td>
                            <td bgcolor="#DDDDDD" class="style8"><label>
                              <input name="Name" type="text" id="Name" value="<?php echo $name; ?>" />
                              </label></td>
                            </tr>
                          <tr bgcolor="#F5F5F5">
                            <td class="style8a">Designation</td>
                            <td class="style8"><label>
                              <select name="Designation" id="Designation">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($desg);$i++)
								{
								?>
                                <option value="<?php echo $desg[$i]['id'] ?>"><?php echo $desg[$i]['desg'] ?></option>
                                <?php
								}
								?>
                              </select>
                              <script>sel_combo("Designation",'<?php echo $designation; ?>');</script>
                              </label></td>
                            </tr>
                          <tr bgcolor="#DDDDDD">
                            <td class="style8a">Group</td>
                            <td class="style8"><label>
                              <input name="E_CLASSIFICATION" type="text" id="E_CLASSIFICATION" value="<?php echo $e_classification; ?>" />
                              </label></td>
                            </tr>
                          <tr bgcolor="#F5F5F5">
                            <td colspan="2" rowspan="4" class="style8a"></td>
                            </tr>
                          <tr bgcolor="#DDDDDD">
                            <td bgcolor="#F5F5F5" class="style8">Chnage Image</td>
                          </tr>
                          <tr bgcolor="#DDDDDD">
                            <td bgcolor="#F5F5F5" class="style8"><div align="center">
                                <label>
                                <input type="file" name="image" id="image" />
                                </label>
                            </div></td>
                          </tr>
                          <tr bgcolor="#DDDDDD">
                            <td bgcolor="#F5F5F5" class="style8"><div align="center">
                                <label>
                              <!--  <input type="button" name="imgsubm" id="imgsubm" value="Submit" onclick="return validate_image();" />-->
                                </label>
                            </div></td>
                          </tr>
                        </table></td>
                        </tr>
                      <tr>
                        <td width="40%" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                        <td width="30%" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                        <td width="30%" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                          <tr bgcolor="#F5F5F5">
                            <td bgcolor="#F5F5F5" class="style8a">Present Place Of Working</td>
                            <td width="29%" bgcolor="#F5F5F5" class="style8"><label>
                              <select name="place_working" id="place_working">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($loc);$i++)
								{
								?>
                                <option value="<?php echo $loc[$i]['id'] ?>"><?php echo $loc[$i]['loc'] ?></option>
                                <?php
								}
								?>
                                                            </select>
                              <script>sel_combo("place_working",'<?php echo $place_working; ?>');</script>
                              </label></td>
                            
                            <td width="23%" bgcolor="#F5F5F5" class="style8a">Native Place</td>
                            <td width="26%" bgcolor="#F5F5F5" class="style8"><label>
                              <input name="E_NATIVE" type="text" id="E_NATIVE" value="<?php echo $e_native; ?>" />
                              </label></td>
                          </tr>
                          <tr bgcolor="#DDDDDD">
                            <td width="22%" bgcolor="#DDDDDD" class="style8a">Section</td>
                            <td bgcolor="#DDDDDD" class="style8"><label>
                              <input name="E_SECTION" type="text" id="E_SECTION" value="<?php echo $e_section; ?>" />
                              </label></td>
                            <td bgcolor="#DDDDDD" class="style8a">Present Residing Address</td>
                            <td bgcolor="#DDDDDD" class="style8"><label>
                              <textarea name="E_ADDRESS" id="E_ADDRESS"><?php echo $e_address; ?></textarea>
                              </label></td>
                          </tr>
                          <tr bgcolor="#F5F5F5">
                            <td class="style8a">Date Of Working In This Place</td>
                            <td class="style8"><label>
                              <input name="Working_from" type="date" id="Working_from" value="<?php echo $working_from; ?>" />
                              </label></td>
                              <?php
							  	$dates1="Working_from";
							  ?>
                            <td class="style8a">Phone Nos.</td>
                            <td class="style8"><label>
                              <input name="E_Phone1" type="text" id="E_Phone1" value="<?php echo $e_phone1; ?>" size="10" />
,
<input name="E_Phone2" type="text" id="E_Phone2" value="<?php echo $e_phone2; ?>" size="10" />
</label></td>
                          </tr>

                        </table></td>
                        </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                        <td bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                        <td bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                            <tr bgcolor="#F5F5F5">
                              <td bgcolor="#F5F5F5" class="style8a">Pay Band</td>
                              <td width="29%" bgcolor="#F5F5F5" class="style8"><label>
                                <input name="E_Pay_Band" type="text" id="E_Pay_Band" value="<?php echo $e_pay_band; ?>" />
                                </label></td>
                              <td width="23%" bgcolor="#F5F5F5" class="style8a">Educational Qualifications</td>
                              <td width="26%" bgcolor="#F5F5F5" class="style8"><label>
                                <select name="E_QUA" id="E_QUA">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($qual);$i++)
								{
								?>
                                <option value="<?php echo $qual[$i] ?>"><?php echo $qual[$i] ?></option>
                                <?php
								}
								?>
                                                                </select>
                              <script>sel_combo("E_QUA",'<?php echo $e_qua; ?>');</script>
                                </label></td>
                            </tr>
                            <tr bgcolor="#DDDDDD">
                              <td width="22%" bgcolor="#DDDDDD" class="style8a">Grade Pay</td>
                              <td bgcolor="#DDDDDD" class="style8"><label>
                                <input name="E_Grade_Pay" type="text" id="E_Grade_Pay" value="<?php echo $e_grade_pay; ?>" />
                                </label></td>
                              <td bgcolor="#DDDDDD" class="style8a">Technical/Non-Technical</td>
                              <td bgcolor="#DDDDDD" class="style8"><label>
                                <select name="E_TECH" id="E_TECH">
                                  <option value="">Select</option>
                                  <option value="T">Technical</option>
                                  <option value="NT">Non-Technical</option>
                                                                                                </select>
                              <script>sel_combo("E_TECH",'<?php echo $e_tech; ?>');</script>
                                </label></td>
                            </tr>

                        </table></td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                        <td bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                        <td bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                            <tr bgcolor="#F5F5F5">
                              <td bgcolor="#F5F5F5" class="style8a">Date Of Birth</td>
                              <td width="29%" bgcolor="#F5F5F5" class="style8"><label>
                                <input name="E_DOB" type="date" id="E_DOB" value="<?php echo $e_dob; ?>" />
                                </label></td>
                                <?php
								$dates1.=",E_DOB";
								?>
                              <td width="23%" bgcolor="#F5F5F5" class="style8a">Category</td>
                              <td width="26%" bgcolor="#F5F5F5" class="style8"><label>
                                <select name="E_CATEGORY" id="E_CATEGORY">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($catg);$i++)
								{
								?>
                                <option value="<?php echo $catg[$i] ?>"><?php echo $catg[$i] ?></option>
                                <?php
								}
								?>
                                                                </select>
                              <script>sel_combo("E_CATEGORY",'<?php echo $e_category; ?>');</script>
                                </label></td>
                            </tr>
                            <tr bgcolor="#DDDDDD">
                              <td width="22%" bgcolor="#DDDDDD" class="style8a">Date Of Entry Into Service</td>
                              <td bgcolor="#DDDDDD" class="style8"><label>
                                <input name="E_DOJ" type="date" id="E_DOJ" value="<?php echo $e_doj; ?>" />
                                <?php
								$dates1.=",E_DOJ";
								?>
                                </label></td>
                              <td bgcolor="#DDDDDD" class="style8a">DR/PR</td>
                              <td bgcolor="#DDDDDD" class="style8"><label>
                                <select name="drpr" id="drpr">
                                  <option value="">Select</option>
                                  <option value="DR">Direct Recruitment</option>
                                  <option value="PR">Promotion</option>
                                                                                                </select>
                              <script>sel_combo("drpr",'<?php echo $drpr; ?>');</script>
                                </label></td>
                            </tr>
                            <tr bgcolor="#F5F5F5">
                              <td class="style8a">Designation At Joining Service</td>
                              <td class="style8"><label>
                                <select name="E_JOINED_AS" id="E_JOINED_AS">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($desg);$i++)
								{
								?>
                                <option value="<?php echo $desg[$i]['id'] ?>"><?php echo $desg[$i]['desg'] ?></option>
                                <?php
								}
								?>
                                </select>
                              <script>sel_combo("E_JOINED_AS",'<?php echo $e_joined_as; ?>');</script>
</label></td>
                              <td class="style8a">Regular/Temporary/Adhoc</td>
                              <td class="style8"><label>
                                <select name="E_Regular" id="E_Regular">
                                  <option value="">Select</option>
                                  <option value="R">Regular</option>
                                  <option value="T">Temporary</option>
                                  <option value="A">Adhoc</option>
                                                                                                </select>
                              <script>sel_combo("E_Regular",'<?php echo $e_regular; ?>');</script>
                                </label></td>
                            </tr>
                            <tr bgcolor="#DDDDDD">
                              <td bgcolor="#DDDDDD" class="style8a">Date Of Retirement</td>
                              <td bgcolor="#DDDDDD" class="style8"><label>
                                <input name="E_DOR" type="date" id="E_DOR" value="<?php echo $e_dor; ?>" />
                                <?php
								$dates1.=",E_DOR";
								?>
                                </label></td>
                              <td bgcolor="#DDDDDD" class="style8a">Physical Handicapped</td>
                              <td bgcolor="#DDDDDD" class="style8"><input name="E_Handicapped" type="text" id="E_Handicapped" value="<?php echo $e_handicapped; ?>" /></td>
                            </tr>
                            <?php
							$tarr=array();
							$dreg=$e_dor;
							$dtday=date('Y-m-d');
							$treg=strtotime($dreg);
							$ttday=strtotime($dtday);
							if($ttday>$treg)
							$serd=$dreg;
							else
							$serd=$dtday;
							$tarr=dateobj_bet_dates($e_doj,$serd);
							?>
                            <tr bgcolor="#F5F5F5">
                              <td class="style8a">Total Service Completed</td>
                              <td class="style8"><?php echo $tarr[0]. " Years ".$tarr[1]." Months ".$tarr[2]." Days"; ?><label>
                              <input type="hidden" name="tot_service" id="tot_service" />
                              </label></td>
                              <td class="style8a">&nbsp;</td>
                              <td class="style8">&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                      
                      
                      <tr>
                        <td bgcolor="#FFFFFF" class="style1">&nbsp;</td>
                        <td colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style1">Service Details</td>
                        <td colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="3" bgcolor="#FFFFFF" class="style8"><table width="100%" border="1" align="center" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                          <tr>
                            <td width="9%" rowspan="2" bgcolor="#F5F5F5"><div align="center">S.No</div></td>
                            <td width="19%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Designation</div></td>
                            <td width="26%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Place Of Working</div></td>
                            <td width="18%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Place Code</div></td>
                            <td colspan="2" bgcolor="#F5F5F5"><div align="center">Duration</div></td>
                            <td width="12%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Period Completed<br />
                              (Y-M-D)</div></td>
                            <td width="12%" rowspan="2" bgcolor="#F5F5F5">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="8%" bgcolor="#F5F5F5"><div align="center">From</div></td>
                            <td width="8%" bgcolor="#F5F5F5"><div align="center">To</div></td>
                          </tr>
                    <?php
				   $selser=executework("select * from service_details where E_NO='".$eid."' order by E_FROM");
				   $cnts=@mysqli_num_rows($selser);
					if(!empty($_POST['sn']))
					$sn=$_POST['sn'];
					else if($cnts>0)
					$sn=$cnts;
					else
					$sn=1;
					$s=1;
					$b=1;
				   if($cnts>0)
				   {
							while($rows=@mysqli_fetch_array($selser))
							{
								print_r($rows);
								if($b==1)
								$bg="#F5F5F5";
								else
								$bg="#DDDDDD";

								if($_POST['E_CADRE'.$s]!="")
								$e_cadre=$_POST['E_CADRE'.$s];
								else if($rows['E_CADRE']!="")
								$e_cadre=$rows['E_CADRE'];
								else
								$e_cadre="";
								
								if($_POST['E_PLACE'.$s]!="")
								$e_place=$_POST['E_PLACE'.$s];
								else if($rows['E_PLACE']!="")
								$e_place=$rows['E_PLACE'];
								else
								$e_place="";
								
								if($_POST['E_PF'.$s]!="")
								$e_pf=$_POST['E_PF'.$s];
								else if($rows['E_PF']!="")
								$e_pf=$rows['E_PF'];
								else
								$e_pf="";
								
								if($_POST['E_FROM'.$s]!="")
								$e_from=$_POST['E_FROM'.$s];
								else if($rows['E_FROM']!="" && $rows['E_FROM']!="0000-00-00")
								$e_from=datepattrn($rows['E_FROM']);
								else
								$e_from="";
								
								if($_POST['E_TO'.$s]!="")
								$e_to=$_POST['E_TO'.$s];
								else if($rows['E_TO']!="" && $rows['E_TO']!="0000-00-00")
								$e_to=datepattrn($rows['E_TO']);
								else
								$e_to="";

								$fd=date('Y-m-d',strtotime($e_from));
								if($e_to!="" && $e_to!='0000-00-00')
								$td=date('Y-m-d',strtotime($e_to));
								else
								$td=date('Y-m-d H:i:s');
//								$fd=gmdate('Y-m-d H:i:s',mktime(date("H")-1, date("i")-1, date("s")-1, date("m")-1, date("d")-1, date("Y")-1));
								$fdt=strtotime($fd);
								$tdt=strtotime($td);
								
								$diff=$tdt-$fdt;
								
//								echo "<br>dd=".$fd."--".$td."--".$fdt."--".$tdt."       ".$diff;
								$yr=$diff%(60*60*24);
								$diff=$diff-$sc;
								$m=$diff%(60*60);
								//echo "<br> sec=".$sc."  min=".$m;
								$days=NULL;
								$days=dateobj_bet_dates($fd,$td);
								
						?>
                          <tr bgcolor="<?php echo $bg ?>">
                            <td><?php echo $s; ?>
                              <input type="hidden" name="sid<?php echo $s ?>" id="sid<?php echo $s ?>" value="<?php echo $rows['id'] ?>" /></td>
                            <td><?php //echo $rows['E_CADRE']; ?>
                              <label>
                              <select name="E_CADRE<?php echo $s ?>" id="E_CADRE<?php echo $s ?>">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($desg);$i++)
								{
								?>
                                <option value="<?php echo $desg[$i]['id'] ?>"><?php echo $desg[$i]['desg'] ?></option>
                                <?php
								}
								?>
                              </select>
                              <script>sel_combo('<?php echo "E_CADRE".$s; ?>','<?php echo $e_cadre; ?>');</script>
                              </label></td>
                            <td><?php //echo $rows['E_PLACE']; ?>
                              <label>
                              <select name="E_PLACE<?php echo $s ?>" id="E_PLACE<?php echo $s ?>">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($loc);$i++)
								{
								?>
                                <option value="<?php echo $loc[$i]['id'] ?>"><?php echo $loc[$i]['loc'] ?></option>
                                <?php
								}
								?>
                                                            </select>
                              <script>sel_combo('<?php echo "E_PLACE".$s; ?>','<?php echo $e_place; ?>');</script>
                              </label></td>
                            <td><?php //echo $rows['E_PF']; ?>
                              <label>
                              <input name="E_PF<?php echo $s ?>" type="text" id="E_PF<?php echo $s ?>" value="<?php echo $e_pf; ?>" />
                              </label></td>
                            <td><div align="center"><?php //echo datepattrn($rows['E_FROM']); ?>
                              <label>
                              <input name="E_FROM<?php echo $s ?>" type="date" id="E_FROM<?php echo $s ?>" value="<?php echo $e_from; ?>" />
                              </label>
                            </div></td>
                            <td><div align="center"><?php //echo datepattrn( substr($td,0,10)); ?>
                              <label>
                              <input name="E_TO<?php echo $s ?>" type="date" id="E_TO<?php echo $s ?>" value="<?php echo $e_to; ?>" />
                              </label>
                                <?php
								$dates1.=",E_FROM".$s.",E_TO".$s;
								?>
                            </div></td>
                            <td><div align="center"><?php echo $days[0]."-".$days[1]."-".$days[2]; ?></div></td>
                            <td><div align="center"><a style="cursor:pointer" onclick="delt('<?php echo $rows['id'] ?>')">&nbsp;Delete&nbsp;</a></div></td>
                          </tr>
                        <?php
								$s++;
								$b++;
								if($b>2)
								$b=1;
							}
				  	}
							while($s<=$sn)
							{
									if($b==1)
									$bg="#F5F5F5";
									else
									$bg="#DDDDDD";
						?>
                        <tr bgcolor="<?php echo $bg ?>">
                            <td><?php echo $s; ?>
                              <input type="hidden" name="sid<?php echo $s ?>" id="sid<?php echo $s ?>" value="" /></td>
                            <td><?php //echo $rows['E_CADRE']; ?>
                              <label>
                              <select name="E_CADRE<?php echo $s ?>" id="E_CADRE<?php echo $s ?>">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($desg);$i++)
								{
								?>
                                <option value="<?php echo $desg[$i]['id'] ?>"><?php echo $desg[$i]['desg'] ?></option>
                                <?php
								}
								?>
                              </select>
                              <script>sel_combo('<?php echo "E_CADRE".$s; ?>','<?php if(!empty($_POST['E_CADRE'.$s])) echo $_POST['E_CADRE'.$s]; ?>');</script>
                              </label></td>
                            <td><?php //echo $rows['E_PLACE']; ?>
                              <label>
                              <select name="E_PLACE<?php echo $s ?>" id="E_PLACE<?php echo $s ?>">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($loc);$i++)
								{
								?>
                                <option value="<?php echo $loc[$i]['id'] ?>"><?php echo $loc[$i]['loc'] ?></option>
                                <?php
								}
								?>
                                                            </select>
                              <script>sel_combo('<?php echo "E_PLACE".$s; ?>','<?php if(!empty($_POST['E_PLACE'.$s])) echo $_POST['E_PLACE'.$s]; ?>');</script>
                              </label></td>
                            <td><?php //echo $rows['E_PF']; ?>
                              <label>
                              <input name="E_PF<?php echo $s ?>" type="text" id="E_PF<?php echo $s ?>" value="<?php if(!empty($_POST['E_PF'.$s])) echo $_POST['E_PF'.$s]; ?>" />
                              </label></td>
                            <td><div align="center"><?php //echo datepattrn($rows['E_FROM']); ?>
                              <label>
                              <input name="E_FROM<?php echo $s ?>" type="date" id="E_FROM<?php echo $s ?>" value="<?php if(!empty($_POST['E_FROM'.$s])) echo $_POST['E_FROM'.$s]; ?>" />
                              </label>
                            </div></td>
                            <td><div align="center"><?php //echo datepattrn( substr($td,0,10)); ?>
                              <label>
                              <input name="E_TO<?php echo $s ?>" type="date" id="E_TO<?php echo $s ?>" value="<?php if(!empty($_POST['E_TO'.$s])) echo $_POST['E_TO'.$s]; ?>" />
                              </label>
                                <?php
								$dates1.=",E_FROM".$s.",E_TO".$s;
								?>
                            </div></td>
                            <td><div align="center"></div></td>
                            <td><div align="center"><a style="cursor:pointer" onclick="rem()">&nbsp;Remove&nbsp;</a></div></td>
                        </tr>
                        	<?php
								$s++;
								$b++;
								if($b>2)
								$b=1;
							}
							?>
                        </table></td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td class="style8">&nbsp;</td>
                        <td colspan="2" class="style8"><div align="right">Add&nbsp; 
                          <label>
                          <select name="nserv" id="nserv">
                            <option value="1" selected="selected">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                          </label>
                        &nbsp; Record&nbsp;
                        <label>
                        <input type="button" name="button3" id="button3" value="  GO  " onclick="add_ser();" />
                        </label>
                        &nbsp;&nbsp; </div></td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td class="style8"><input name="sn" type="hidden" id="sn" value="<?php echo $sn ?>" />
                          <input type="hidden" name="sd" id="sd" /></td>
                        <td colspan="2" class="style8">&nbsp;</td>
                      </tr>
                  <?php
				   $selpr=executework("select * from promotion_det where E_NO='".$eid."' order by E_DOP_DT");
				   $cntp=@mysqli_num_rows($selpr);
				   if(!empty($_POST['pn']))
				   $pn=$_POST['pn'];
				   else if($cntp>0)
				   $pn=$cntp;
				   else
				   $pn=3;
				   		//$rowp=@mysqli_fetch_array($selpr);
				   ?>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                        <td colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style8">Promotion Details</td>
                        <td colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="3" class="style8"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
					<?php
//						if($rowp["E_DES_1"]!=NULL)
//						{
					?>
                          <tr>
                            <td width="6%" bgcolor="#F5F5F5"><div align="center">S.No</div></td>
                            <td width="21%" bgcolor="#F5F5F5"><div align="center">Designation After Promotion</div></td>
                            <td width="18%" bgcolor="#F5F5F5"><div align="center">Date Of Promotion</div></td>
                            <td width="19%" bgcolor="#F5F5F5"><div align="center">Type Of Promotion<br />
                              (Regular/ACP/MACP)</div></td>
                            <td width="19%" bgcolor="#F5F5F5"><div align="center">Order No.</div></td>
                            <td width="19%" bgcolor="#F5F5F5">&nbsp;</td>
                          </tr>
                        <?php
							$p=1;
							$b=1;
							//for($p=1;$p<=5;$p++)
				   if($cntp>0)
				   {
							while($rowp=@mysqli_fetch_array($selpr))
							{
								$des="E_DES";
								$dat="E_DOP_DT";
//								if($rowp[$des]!=NULL)
//								{
									if($b==1)
									$bg="#F5F5F5";
									else
									$bg="#DDDDDD";
									
									if($_POST['E_DES'.$p]!="")
									$e_des=$_POST['E_DES'.$p];
									else if($rowp[$des]!="")
									$e_des=$rowp[$des];
									else
									$e_des="";
									
									if($_POST['E_DOP_DT'.$p]!="")
									$edt=$_POST['E_DOP_DT'.$p];
									else if($rowp[$dat]!="")
									$edt=datepattrn($rowp[$dat]);
									else
									$edt="";
									
									if($_POST['ptype'.$p]!="")
									$ptype=$_POST['ptype'.$p];
									else if($rowp['ptype']!="")
									$ptype=$rowp['ptype'];
									else
									$ptype="";
									
									if($_POST['order'.$p]!="")
									$orderno=$_POST['order'.$p];
									else if($rowp['orderno']!="")
									$orderno=$rowp['orderno'];
									else
									$orderno="";
									
									
						?>
                          <tr bgcolor="<?php echo $bg ?>">
                            <td><?php echo $p ?>
                              <input type="hidden" name="pid<?php echo $p ?>" id="pid<?php echo $p ?>" value="<?php echo $rowp['id'] ?>" /></td>
                            <td><label>
                              <select name="E_DES<?php echo $p ?>" id="E_DES<?php echo $p ?>">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($desg);$i++)
								{
								?>
                                <option value="<?php echo $desg[$i]['id'] ?>"><?php echo $desg[$i]['desg'] ?></option>
                                <?php
								}
								?>
                                                  </select>
                              <script>sel_combo("E_DES<?php echo $p ?>",'<?php echo $e_des; ?>');</script>
                              </label></td>
                            <td><div align="center">
                              <label>
                              <input type="date" name="E_DOP_DT<?php echo $p ?>2" id="E_DOP_DT<?php echo $p ?>2" value="<?php echo $edt; ?>" />
                              </label>
                            </div></td>
							   <?php
								$dates1.=",E_DOP_DT".$p;
								?>
 <td><label>
                              <select name="ptype<?php echo $p ?>" id="ptype<?php echo $p ?>">
                                <option value="">Select</option>
                                <option value="Regular">Regular</option>
                                <option value="ACP">ACP</option>
                                <option value="MACP">MACP</option>
                                                  </select>
                              <script>sel_combo("ptype<?php echo $p ?>",'<?php echo $ptype; ?>');</script>
                            </label></td>
                            <td><label>
                            <input name="order<?php echo $p ?>" type="text" id="order<?php echo $p ?>" value="<?php echo $orderno; ?>" />
                            </label></td>
                            <td><div align="center"><a style="cursor:pointer" onclick="deltv('<?php echo $rowp['id'] ?>')">&nbsp;Delete&nbsp;</a></div></td>
                          </tr>
							 <?php
							 		$p++;
									$b++;
									if($b>2)
									$b=1;
//							 	}
							}
//						}
				  }
				  while($p<=$pn)
				  {
									if($b==1)
									$bg="#F5F5F5";
									else
									$bg="#DDDDDD";
				 ?>
                        <tr bgcolor="<?php echo $bg ?>">
                            <td><?php echo $p ?></td>
                            <td><label>
                              <select name="E_DES<?php echo $p ?>" id="E_DES<?php echo $p ?>">
                                <option value="">Select</option>
                                <?php
								for($i=0;$i<count($desg);$i++)
								{
								?>
                                <option value="<?php echo $desg[$i]['id'] ?>"><?php echo $desg[$i]['desg'] ?></option>
                                <?php
								}
								?>
                                                  </select>
                              <script>sel_combo("E_DES<?php echo $p ?>",'<?php if(!empty($_POST['E_DES'.$p])) echo $_POST['E_DES'.$p]; ?>');</script>
                              </label></td>
                            <td><div align="center">
                              <label>
                              <input type="date" name="E_DOP_DT<?php echo $p ?>" id="E_DOP_DT<?php echo $p ?>" value="<?php if(!empty($_POST['E_DOP_DT'.$p])) echo $_POST['E_DOP_DT'.$p]; ?>" />
                              </label>
                            </div></td>
							   <?php
								$dates1.=",E_DOP_DT".$p;
								?>
 <td><label>
                              <select name="ptype<?php echo $p ?>" id="ptype<?php echo $p ?>">
                                <option value="">Select</option>
                                <option value="Regular">Regular</option>
                                <option value="ACP">ACP</option>
                                <option value="MACP">MACP</option>
                                                  </select>
                              <script>sel_combo("ptype<?php echo $p ?>",'<?php if(!empty($_POST['ptype'.$p])) echo $_POST['ptype'.$p]; ?>');</script>
                            </label></td>
                            <td><label>
                            <input name="order<?php echo $p ?>" type="text" id="order<?php echo $p ?>" value="<?php if(!empty($_POST['order'.$p])) echo $_POST['order'.$p]; ?>" />
                            </label></td>
                            <td><div align="center"><a style="cursor:pointer" onclick="remv()">&nbsp;Remove&nbsp;</a></div></td>
                        </tr>
					<?php
						$p++;
									$b++;
									if($b>2)
									$b=1;
					}
					?>
                        </table></td>
                      </tr>
                      <tr>
                        <td class="style8">&nbsp;</td>
                        <td colspan="2" class="style8"><div align="right">Add&nbsp;
                                <label>
                                <select name="mprom" id="mprom">
                                  <option value="1" selected="selected">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>
                                </label>
                          &nbsp; Record&nbsp;
                          <label>
                            <input type="button" name="button4" id="button4" value="  GO  " onclick="add_prom();" />
                            </label>
                          &nbsp;&nbsp; </div></td>
                      </tr>
                      <tr>
                        <td class="style8"><input name="pn" type="hidden" id="pn" value="<?php echo $pn ?>" />
                            <input type="hidden" name="pd" id="pd" /></td>
                        <td colspan="2" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style8">Vigilance / Disciplinary Details</td>
                        <td colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="style8"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                            <?php
							$refno='';
				   $selds=executework("select * from disciplinary_det where E_NO='".$eid."' order by id");
				   $cntd=@mysqli_num_rows($selds);
				   if(!empty($_POST['vn']))
				   $vn=$_POST['vn'];
				   else if($cntd>0)
				   $vn=$cntd;
				   else
				   $vn=1;
					?>
                            <tr>
                              <td width="6%" bgcolor="#F5F5F5"><div align="center">S.No</div></td>
                              <td width="21%" bgcolor="#F5F5F5"><div align="center">Case Ref. No.</div></td>
                              <td width="18%" bgcolor="#F5F5F5"><div align="center">Details Of The Case</div></td>
                              <td width="19%" bgcolor="#F5F5F5"><div align="center">Status Of The Case</div></td>
                              <td width="19%" bgcolor="#F5F5F5">&nbsp;</td>
                            </tr>
                            <?php
							$v=1;
							$b=1;
							//for($p=1;$p<=5;$p++)
				   if($cntd>0)
				   {
							while($rowd=@mysqli_fetch_array($selds))
							{
								$des="E_DES";
								$dat="E_DOP_DT";
//								if($rowp[$des]!=NULL)
//								{
									if($b==1)
									$bg="#F5F5F5";
									else
									$bg="#DDDDDD";
									
									if($_POST['refno'.$v]!="")
									$refno=$_POST['refno'.$v];
									else if($rowd['refno']!="")
									$refno=$rowd['refno'];
									else $refno="";

									if($_POST['det'.$v]!="")
									$det=$_POST['det'.$v];
									else if($rowd['det']!="")
									$det=$rowd['det'];
									else $det="";

									if($_POST['status'.$v]!="")
									$status=$_POST['status'.$v];
									else if($rowd['status']!="")
									$status=$rowd['status'];
									else $status="";
						?>
                            <tr bgcolor="<?php echo $bg ?>">
                              <td><?php echo $v ?>
                                  <input type="hidden" name="vid<?php echo $v ?>" id="vid<?php echo $v ?>" value="<?php echo $rowd['id'] ?>" /></td>
                              <td><input name="refno<?php echo $v ?>" type="text" id="refno<?php echo $v ?>" size="40" value="<?php echo $refno; ?>" /></td>
                              <td><div align="center">
                                  <label>
                                  <textarea name="det<?php echo $v ?>" cols="30" id="det<?php echo $v ?>"><?php echo $det; ?></textarea>
                                  </label>
                              </div></td>
                              <td><label>
                                <div align="center">
                                  <input type="text" name="status<?php echo $v ?>" id="status<?php echo $v ?>" value="<?php echo $status; ?>" />
                                </div>
                                </label></td>
                              <td><div align="center"><a style="cursor:pointer" onclick="deltvv('<?php echo $rowd['id'] ?>')">&nbsp;Delete&nbsp;</a></div></td>
                            </tr>
                            <?php
							 		$v++;
									$b++;
									if($b>2)
									$b=1;
//							 	}
							}
//						}
				  }
				  while($v<=$vn)
				  {
				 ?>
                            <tr bgcolor="<?php echo $bg ?>">
                              <td><?php echo $v ?></td>
                              <td><input name="refno<?php echo $v ?>" type="text" id="refno<?php echo $v ?>" value="<?php if(!empty($_POST['refno'.$v])) echo $_POST['refno'.$v] ?>" size="40" /></td>
                              <td><div align="center">
                                  <label>
                                  <textarea name="det<?php echo $v ?>" cols="30" id="det<?php echo $v ?>"><?php if(!empty($_POST['det'.$v])) echo $_POST['det'.$v]; ?></textarea>
                                  </label>
                              </div></td>
                              <td><label>
                                <div align="center">
                                  <input type="text" name="status<?php echo $v ?>" id="status<?php echo $v ?>" value="<?php if(!empty($_POST['status'.$v])) echo $_POST['status'.$v] ?>" />
                                </div>
                                </label></td>
                              <td><div align="center"><a style="cursor:pointer" onclick="remvv()">&nbsp;Remove&nbsp;</a></div></td>
                            </tr>
                            <?php
						$v++;
					}
					?>
                        </table></td>
                      </tr>
                      <tr>
                        <td class="style8">&nbsp;</td>
                        <td colspan="2" class="style8"><div align="right">Add&nbsp;
                                <label>
                                <select name="vig" id="vig">
                                  <option value="1" selected="selected">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>
                                </label>
                          &nbsp; Record&nbsp;
                          <label>
                            <input type="button" name="button5" id="button5" value="  GO  " onclick="add_vig();" />
                            </label>
                          &nbsp;&nbsp; </div></td>
                      </tr>
                      <tr>
                        <td class="style8"><input name="vn" type="hidden" id="vn" value="<?php echo $vn ?>" />
                            <input type="hidden" name="vd" id="vd" /></td>
                        <td colspan="2" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" class="style8">Leave Details</td>
                        <td colspan="2" bgcolor="#FFFFFF" class="style8">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="style8"><table width="100%" border="1" cellpadding="4" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#000000">
                            <?php
				   $seldl=executework("select * from tob_aaleaves where empno='".$eid."' order by edate");
				   $cntl=@mysqli_num_rows($seldl);
				   if(!empty($_POST['ln']))
				   $ln=$_POST['ln'];
				   else if($cntl>0)
				   $ln=$cntl;
				   else
				   $ln=1;
					?>
                            <tr>
                              <td width="6%" rowspan="2" bgcolor="#F5F5F5"><div align="center">S.No</div></td>
                              <td width="18%" rowspan="2" bgcolor="#F5F5F5"><div align="center">Date</div></td>
                              <td colspan="5" bgcolor="#F5F5F5"><div align="center">Earned</div></td>
                              <td colspan="5" bgcolor="#F5F5F5"><div align="center">HPL</div></td>
                              <td width="19%" rowspan="2" bgcolor="#F5F5F5">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="6%" bgcolor="#F5F5F5">Opening Balance</td>
                              <td width="7%" bgcolor="#F5F5F5">Accured</td>
                              <td width="6%" bgcolor="#F5F5F5">Total</td>
                              <td width="6%" bgcolor="#F5F5F5">Used</td>
                              <td width="6%" bgcolor="#F5F5F5">Balance</td>
                              <td width="6%" bgcolor="#F5F5F5">Opening Balance</td>
                              <td width="6%" bgcolor="#F5F5F5">Accured</td>
                              <td width="4%" bgcolor="#F5F5F5">Total</td>
                              <td width="4%" bgcolor="#F5F5F5">Used</td>
                              <td width="6%" bgcolor="#F5F5F5">Balance</td>
                            </tr>
                            <?php
							$l=1;
							$m=1;
							//for($p=1;$p<=5;$p++)
				   if($cntl>0)
				   {
							while($rowl=@mysqli_fetch_array($seldl))
							{
									if($m==1)
									$bg="#F5F5F5";
									else
									$bg="#DDDDDD";
									
									if($_POST['edate'.$l]!="")
									$edate=$_POST['edate'.$l];
									else if($rowl['edate']!="")
									//$edate=datepattrn($rowl['edate']);
									$edate=$rowl['edate'];
									else 
									$edate="";
									
									if($_POST['eob'.$l]!="")
									$eob=$_POST['eob'.$l];
									else if($rowl['eob']!="")
									$eob=$rowl['eob'];
									else 
									$eob="";
									
									if($_POST['eaccured'.$l]!="")
									$eaccured=$_POST['eaccured'.$l];
									else if($rowl['eaccured']!="")
									$eaccured=$rowl['eaccured'];
									else 
									$eaccured="";
									
									if($_POST['eused'.$l]!="")
									$eused=$_POST['eused'.$l];
									else if($rowl['eused']!="")
									$eused=$rowl['eused'];
									else 
									$eused="";
									
									if($_POST['hob'.$l]!="")
									$hob=$_POST['hob'.$l];
									else if($rowl['hob']!="")
									$hob=$rowl['hob'];
									else 
									$hob="";
									
									if($_POST['haccured'.$l]!="")
									$haccured=$_POST['haccured'.$l];
									else if($rowl['haccured']!="")
									$haccured=$rowl['haccured'];
									else 
									$haccured="";
									
									if($_POST['hused'.$l]!="")
									$hused=$_POST['hused'.$l];
									else if($rowl['hused']!="")
									$hused=$rowl['hused'];
									else 
									$hused="";
									
						?>
                            <tr bgcolor="<?php echo $bg ?>">
                              <td><?php echo $l ?>
                                  <input type="hidden" name="lid<?php echo $l ?>" id="lid<?php echo $l ?>" value="<?php echo $rowl['id'] ?>" /></td>
                              <td><input name="edate<?php echo $l ?>" type="date" id="edate<?php echo $l ?>" value="<?php echo $edate; ?>" /></td>
                              <td><input name="eob<?php echo $l ?>" type="text" id="eob<?php echo $l ?>" size="5" value="<?php echo $eob; ?>" onchange="cal_leavtot('e','<?php echo $l ?>');" /></td>
                              <td><input name="eaccured<?php echo $l ?>" type="text" id="eaccured<?php echo $l ?>" size="5" value="<?php echo $eaccured; ?>" onchange="cal_leavtot('e','<?php echo $l ?>');" /></td>
                              <td><input name="etot<?php echo $l ?>" type="text" id="etot<?php echo $l ?>" size="10" value="<?php echo $refno; ?>" readonly="readonly" /></td>
                              <td><input name="eused<?php echo $l ?>" type="text" id="eused<?php echo $l ?>" size="5" value="<?php echo $eused; ?>" onchange="cal_leavtot('e','<?php echo $l ?>');" /></td>
                              <td><input name="ebal<?php echo $l ?>" type="text" id="ebal<?php echo $l ?>" size="5" value="<?php echo $refno; ?>" readonly="readonly" /></td>
                              <td><input name="hob<?php echo $l ?>" type="text" id="hob<?php echo $l ?>" size="5" value="<?php echo $hob; ?>" onchange="cal_leavtot('h','<?php echo $l ?>');" /></td>
                              <td><input name="haccured<?php echo $l ?>" type="text" id="haccured<?php echo $l ?>" size="5" value="<?php echo $haccured; ?>" onchange="cal_leavtot('h','<?php echo $l ?>');" /></td>
                              <td><input name="htot<?php echo $l ?>" type="text" id="htot<?php echo $l ?>" size="10" value="<?php echo $refno; ?>" readonly="readonly" /></td>
                              <td><input name="hused<?php echo $l ?>" type="text" id="hused<?php echo $l ?>" size="5" value="<?php echo $hused; ?>" onchange="cal_leavtot('h','<?php echo $l ?>');" /></td>
                              <td><input name="hbal<?php echo $l ?>" type="text" id="hbal<?php echo $l ?>" size="5" value="<?php echo $refno; ?>" readonly="readonly" /></td>
                              <td><div align="center"><a style="cursor:pointer" onclick="deltvl('<?php echo $rowl['id'] ?>')">&nbsp;Delete&nbsp;</a></div></td>
                            </tr>
                            <script>
                            cal_leavtot('e','<?php echo $l ?>');
                            cal_leavtot('h','<?php echo $l ?>');
                            </script>
							   <?php
								$dates1.=",edate".$l;
							 		$l++;
									$m++;
									if($m>2)
									$m=1;
//							 	}
							}
//						}
				  }
				  while($l<=$ln)
				  {
				 ?>
                            <tr bgcolor="<?php echo $bg ?>">
                              <td><?php echo $l ?></td>
                              <td><input name="edate<?php echo $l ?>" type="date" id="edate<?php echo $l ?>" value="<?php if(!empty($_POST['edate'.$l])) echo $_POST['edate'.$l] ?>" /></td>
                              <td><input name="eob<?php echo $l ?>" type="text" id="eob<?php echo $l ?>" value="<?php if(!empty($_POST['eob'.$l])) echo $_POST['eob'.$l] ?>" size="5" onchange="cal_leavtot('e','<?php echo $l ?>');" /></td>
                              <td><input name="eaccured<?php echo $l ?>" type="text" id="eaccured<?php echo $l ?>" size="5" value="<?php if(!empty($_POST['eaccured'.$l])) echo $_POST['eaccured'.$l]; ?>" onchange="cal_leavtot('e','<?php echo $l ?>');" /></td>
                              <td><input name="etot<?php echo $l ?>" type="text" id="etot<?php echo $l ?>" size="10" value="<?php echo $refno; ?>" readonly="readonly" /></td>
                              <td><input name="eused<?php echo $l ?>" type="text" id="eused<?php echo $l ?>" size="5" value="<?php if(!empty($_POST['eused'.$l])) echo $_POST['eused'.$l]; ?>" onchange="cal_leavtot('e','<?php echo $l ?>');" /></td>
                              <td><input name="ebal<?php echo $l ?>" type="text" id="ebal<?php echo $l ?>" size="5" value="<?php echo $refno; ?>" readonly="readonly" /></td>
                              <td><input name="hob<?php echo $l ?>" type="text" id="hob<?php echo $l ?>" size="5" value="<?php if(!empty($_POST['hob'.$l])) echo $_POST['hob'.$l]; ?>" onchange="cal_leavtot('h','<?php echo $l ?>');" /></td>
                              <td><input name="haccured<?php echo $l ?>" type="text" id="haccured<?php echo $l ?>" size="5" value="<?php if(!empty($_POST['haccured'.$l])) echo $_POST['haccured'.$l]; ?>" onchange="cal_leavtot('h','<?php echo $l ?>');" /></td>
                              <td><input name="htot<?php echo $l ?>" type="text" id="htot<?php echo $l ?>" size="10" value="<?php echo $refno; ?>" readonly="readonly" /></td>
                              <td><input name="hused<?php echo $l ?>" type="text" id="hused<?php echo $l ?>" size="5" value="<?php if(!empty($_POST['hused'.$l])) echo $_POST['hused'.$l]; ?>" onchange="cal_leavtot('h','<?php echo $l ?>');" /></td>
                              <td><input name="hbal<?php echo $l ?>" type="text" id="hbal<?php echo $l ?>" size="5" value="<?php echo $refno; ?>" readonly="readonly" /></td>
                              <td><div align="center"><a style="cursor:pointer" onclick="remvl()">&nbsp;Remove&nbsp;</a></div></td>
                            </tr>
                            <script>
                            cal_leavtot('e','<?php echo $l ?>');
                            cal_leavtot('h','<?php echo $l ?>');
                            </script>
                            <?php
								$dates1.=",edate".$l;
						$l++;
					}
					?>
                        </table></td>
                      </tr>
                      <tr>
                        <td class="style8">&nbsp;</td>
                        <td colspan="2" class="style8"><div align="right">Add&nbsp;
                                <label>
                                <select name="lev" id="lev">
                                  <option value="1" selected="selected">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>
                                </label>
                          &nbsp; Record&nbsp;
                          <label>
                            <input type="button" name="button5" id="button5" value="  GO  " onclick="add_leaves();" />
                            </label>
                          &nbsp;&nbsp; </div></td>
                      </tr>
                      <tr>
                        <td class="style8"><input name="ln" type="hidden" id="ln" value="<?php echo $ln ?>" />
                            <input type="hidden" name="ld" id="ld" /></td>
                        <td colspan="2" class="style8">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="3" class="style8">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="3" class="style8">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="3" class="style8"><div align="center">
                          <label>
                          <input type="submit" name="button2" id="button2" value="Submit" onclick="return validate_employee();" />
                          </label>
&nbsp;&nbsp;&nbsp;
<label>
<input type="button" name="button" id="button" value=" Cancel  " onclick="javascript:location.href='employeedata.php'" />
</label>
<input name="eid" type="hidden" id="eid" value="<?php echo $eid ?>" />
<input type="hidden" name="subm" id="subm" />
                        </div></td>
                      </tr>
                    </table>
  <p>&nbsp;</p>
</form>
                              </div></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    </div>
                </div>
              </div>
              </div>
              </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
    </table></td>
  </tr>
  <?php
  	if(empty($_GET['prin']))
	{
  ?>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top"><table width="100%" border="0">
      <tr>
        <td width="39%">&nbsp;</td>
        <td width="41%"><div align="center"></div></td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="442" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
  </tr>
  <?php
  	}
  ?>
</table>
<script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar1
pdate='<?php echo $dates1 ?>';
if(pdate!="")
{
	var pdates=new Array();
	pdates=pdate.split(',');
	for(k=0;k<pdates.length;k++)
	{
		jQuery('#'+pdates[k]).datepicker();
		jQuery('#'+pdates[k]).readOnly=true;
	}
}
jQuery('#indate').datepicker();
jQuery('#indate').readOnly=true;

var dsuc='<?php if(!empty($_GET['dsuc'])) echo $_GET['dsuc'] ?>';
var dpsuc='<?php if(!empty($_GET['dpsuc'])) echo $_GET['dpsuc'] ?>';
var dvsuc='<?php if(!empty($_GET['dvsuc'])) echo $_GET['dvsuc'] ?>';
var dlsuc='<?php if(!empty($_GET['dlsuc'])) echo $_GET['dlsuc'] ?>';
if(dsuc!="")
alert("Service details record deleted successfully");
if(dlsuc!="")
alert("Leave details record deleted successfully");
if(dpsuc!="")
alert("Promotion details record deleted successfully");
if(dvsuc!="")
alert("Disciplinary details record deleted successfully");
</script>
<?php include_once("footer.php"); ?>
</body>
</html>
<?php 
}
else
{
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php 
}	
?>