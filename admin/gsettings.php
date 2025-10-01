<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Graph Settings | Welcome To TOBBACO BOARD Admin</title>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FF0000;
}
.style4 {font-size: 14px}
.style6 {font-family: Arial, Helvetica, sans-serif; color: #FF0000; font-size: 14px; }
.style8 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #0000FF;
	font-weight: bold;
}
.style12a {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
</head>
<script src="genfunctions.js" type="text/javascript"></script>
<script src="jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
<script>
function validate_settings()
{
	var fdat=document.form1.fdate.value;
	var tdat=document.form1.tdate.value;
	if(fdat!="" && tdat!="")
	{
		var dd=fdat.substring(0,2);
		var mm=fdat.substring(3,5);
		var yy=fdat.substring(6,10);
		fdat=yy+"-"+mm+"-"+dd;
		fdatt=new Date(fdat).getTime();
		
		var dd=tdat.substring(0,2);
		var mm=tdat.substring(3,5);
		var yy=tdat.substring(6,10);
		tdat=yy+"-"+mm+"-"+dd;
		tdatt=new Date(tdat).getTime();
		if(fdatt>tdatt)
		var valid='n';
		else
		var valid='y';
	}
	else
	var valid="";
		if(document.form1.tg.value=="")
	{
		alert("Select Table / Graph")
		document.form1.tg.focus();
		return false;
	}

	if(document.form1.hstates.value=="")
	{
		alert("Select Default State For Home Page");
		document.form1.hstates.focus();
		return false;
	}
	if(document.form1.gstates.value=="")
	{
		alert("Select Default State For Graph Page");
		document.form1.gstates.focus();
		return false;
	}
	if(document.form1.hxmin.value=="")
	{
		alert("Enter Average Price Range For Home Page");
		document.form1.hxmin.focus();
		return false;
	}
	if(isNaN(document.form1.hxmin.value)==true)
	{
		alert("Enter Valid Average Price Range For Home Page");
		document.form1.hxmin.value="";
		document.form1.hxmin.focus();
		return false;
	}
	if(document.form1.hxmax.value=="")
	{
		alert("Enter Average Price Range For Home Page");
		document.form1.hxmax.focus();
		return false;
	}
	if(isNaN(document.form1.hxmax.value)==true)
	{
		alert("Enter Valid Average Price Range For Home Page");
		document.form1.hxmax.value="";
		document.form1.hxmax.focus();
		return false;
	}
	if(parseInt(document.form1.hxmax.value)<parseInt(document.form1.hxmin.value))
	{
		alert("Enter Valid Average Price Range For Home Page");
		document.form1.hxmax.value="";
		document.form1.hxmax.focus();
		return false;
	}
	
	if(document.form1.gxmin.value=="")
	{
		alert("Enter Average Price Range For Day Inforation");
		document.form1.gxmin.focus();
		return false;
	}
	if(isNaN(document.form1.gxmin.value)==true)
	{
		alert("Enter Valid Average Price Range For Day Inforation");
		document.form1.gxmin.value="";
		document.form1.gxmin.focus();
		return false;
	}
	if(document.form1.gxmax.value=="")
	{
		alert("Enter Average Price Range For Day Inforation");
		document.form1.gxmax.focus();
		return false;
	}
	if(isNaN(document.form1.gxmax.value)==true)
	{
		alert("Enter Valid Average Price Range For Day Inforation");
		document.form1.gxmax.value="";
		document.form1.gxmax.focus();
		return false;
	}
	if(parseInt(document.form1.gxmax.value)<parseInt(document.form1.gxmin.value))
	{
		alert("Enter Valid Average Price Range For Day Inforation");
		document.form1.gxmax.value="";
		document.form1.gxmax.focus();
		return false;
	}

	if(document.form1.cxmin.value=="")
	{
		alert("Enter Average Price Range For Cumulative");
		document.form1.cxmin.focus();
		return false;
	}
	if(isNaN(document.form1.cxmin.value)==true)
	{
		alert("Enter Valid Average Price Range For Cumulative");
		document.form1.cxmin.value="";
		document.form1.cxmin.focus();
		return false;
	}
	if(document.form1.cxmax.value=="")
	{
		alert("Enter Average Price Range For Cumulative");
		document.form1.cxmax.focus();
		return false;
	}
	if(isNaN(document.form1.cxmax.value)==true)
	{
		alert("Enter Valid Average Price Range For Cumulative");
		document.form1.cxmax.value="";
		document.form1.cxmax.focus();
		return false;
	}
	if(parseInt(document.form1.cxmax.value)<parseInt(document.form1.cxmin.value))
	{
		alert("Enter Valid Average Price Range For Cumulative");
		document.form1.cxmax.value="";
		document.form1.cxmax.focus();
		return false;
	}
	if(document.form1.fdate.value=="")
	{
		alert("Enter Date Range");
		document.form1.fdate.focus();
		return false;
	}
	if(document.form1.tdate.value=="")
	{
		alert("Enter Date Range");
		document.form1.tdate.focus();
		return false;
	}
	else if(valid!="" && valid=='n')
	{
		alert("Invalid Date Range");
		document.form1.tdate.focus();
		return false;
	}
	else
	{
		document.form1.subm.value=1;
		return true;
	}
}
</script>
<?php
	function datepattrn($a)
	{
 		$b = substr($a,5, 2);// month
 		$c = substr($a,7, 1);// '-'
		$d= substr($a,8, 2);// day
		$e = substr($a,4, 1);// '-'
 		$f = substr($a,0, 4);// year
		$c="-";
		$e="-";
		$g=$d."/".$b."/".$f;
		return $g;
	}
	function datepattrn1($a)
	{
 		$b = substr($a,3, 2);// month
 		$c = substr($a,2, 1);// '-'
		$d= substr($a,0, 2);// day
		$e = substr($a,5, 1);// '-'
 		$f = substr($a,6, 4);// year
		$c="-";
		$e="-";
		$g=$f."/".$b."/".$d;
		return $g;
	}
if(!empty($_POST['subm']))
{
	$selmax=executework("select max(id) from tob_gsettings");
	$rowm=@mysqli_fetch_array($selmax);
	if($rowm[0]!="")
	$max=$rowm[0]+1;
	else
	$max=1;
	
	$selid=executework("select * from tob_gsettings where graph='Action Graph'");
	//echo "select * from tob_gsettings where graph='Action Graph'";
	$cnt=@mysqli_num_rows($selid);
	if($cnt>0)
	{
		$row=@mysqli_fetch_array($selid);
		$upd=executework("update tob_gsettings set tg='".$_POST['tg']."',dstate_home='".$_POST['hstates']."',dstate_graph='".$_POST['gstates']."',min1='".$_POST['hxmin']."',max1='".$_POST['hxmax']."',min2='".$_POST['gxmin']."',max2='".$_POST['gxmax']."',min3='".$_POST['cxmin']."',max3='".$_POST['cxmax']."',fdate='".datepattrn1($_POST['fdate'])."',tdate='".datepattrn1($_POST['tdate'])."' where id=".$row['id']);
		//echo "update tob_gsettings set tg='".$_POST['tg']."',dstate_home='".$_POST['hstates']."',dstate_graph='".$_POST['gstates']."',min1='".$_POST['hxmin']."',max1='".$_POST['hxmax']."',min2='".$_POST['gxmin']."',max2='".$_POST['gxmax']."',min3='".$_POST['cxmin']."',max3='".$_POST['cxmax']."',fdate='".datepattrn1($_POST['fdate'])."',tdate='".datepattrn1($_POST['tdate'])."' where id=".$row['id'];
	}
	else
	{
//		$int=executework("insert into values(".$max.",'Action Graph'
	}
	$succ="success1";
	redirect("gsettings.php?succ=".$succ);
}
?>
<body>
<?php include_once("header.php");?>
<form id="form1" name="form1" method="post" action="gsettings.php" onsubmit="return validate_settings();">
<table width="975" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
<td width="973"><span class="style1">Graph Settings</span> </td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<?php
if(!empty($_GET['succ']) && $_GET['succ']=="stateexists")
{
?>
<tr>
  <td><div align="left"><span class="style6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; State Already Exists </span></div></td>
</tr>
<?php
}
if(!empty($_GET['succ']) && $_GET['succ']=="success")
{
?>
<tr>
  <td><span class="style2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style4"> Given Details Inserted Success fully </span></span></td>
</tr>
<?php
}
if(!empty($_GET['succ']) && $_GET['succ']=="distexists")
{
?>
<tr>
  <td><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style6"> District Already Exists </span></div></td>
</tr>
<?php
}
if(!empty($_GET['succ']) && $_GET['succ']=="success1")
{
?>
<tr>
  <td class="style2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="style4">Given Details Updated Success fully </span></td>
</tr>
<?php
}

?>
</table>
  <table width="800" align="center" cellpadding="0" cellspacing="0">
	<?php
	$sels=executework("select * from tob_gsettings where graph='Action Graph'"); 
	$row=@mysqli_fetch_array($sels);
	?>
    <tr>
      <td width="239" height="30" class="style1">Auction Graph</td>
      <td width="56">&nbsp;</td>
      <td width="503">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" class="style12"><span class="style8">Default in Home Page </span></td>
      <td class="style12">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30" class="style12"><div align="left">Home Page </div></td>
      <th class="style12"><div align="center" class="style12a"><strong>:</strong></div></th>
      <td><label>
        <select name="tg" id="tg">
		<option value="">Select</option>
		<option value="Table">Table</option>
		<option value="Graph">Graph</option>
        </select>
      </label></td>
      <?php
	  if(!empty($row['tg']))
	  {
	  ?>
      <script>sel_combo('tg','<?php echo $row['tg'] ?>');</script>
      <?php
	  }
	  ?>
    </tr>
    <tr>
      <td height="30" class="style12"><div align="right" class="style4">
          <div align="left" class="style8">Default State</div>
      </div></td>
      <td class="style12">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
<?php
	    $selht=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
		$rowty=@mysqli_fetch_array($selht);
			$details=array($rowty['permissions']);
			foreach($details as $detail)
			$detai=explode(',',$detail);
?>
    <tr>
      <td height="30" class="style12a"><div align="right" class="style4">
          <div align="left">Home Page</div>
      </div></td>
      <td class="style12a"><div align="center"><strong>:</strong></div></td>
      <td><select name="hstates" id="hstates">
		<?php
		if($_SESSION['tobadmin']=='admin' || in_array('Andhra Pradesh',$detai) || in_array('Karnataka',$detai))
		{
		?>
        <option value="">Select</option>
		<?php
		}
		if((isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin') || in_array('Andhra Pradesh',$detai))
		{
		?>
        <option value="Andhra Pradesh">Andhra Pradesh</option>
		<?php
		}
		 if((isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin') || in_array('Karnataka',$detai))
		 {
		?>
        <option value="Karnataka">Karnataka</option>
		<?php
		}
		?>
      </select></td>
      <script>sel_combo('hstates','<?php echo $row['dstate_home'] ?>');</script>
    </tr>
    <tr>
      <td height="30" class="style12a"><div align="right" class="style4">
          <div align="left">Graph Page</div>
      </div></td>
      <td class="style12a"><div align="center"><strong>:</strong></div></td>
      <td><select name="gstates" id="gstates">
		<?php
		if($_SESSION['tobadmin']=='admin' || in_array('Andhra Pradesh',$detai) || in_array('Karnataka',$detai))
		{
		?>
        <option value="">Select</option>
		<?php
		}
		if((isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin') || in_array('Andhra Pradesh',$detai))
		{
		?>
        <option value="Andhra Pradesh">Andhra Pradesh</option>
		<?php
		}
		 if((isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin') || in_array('Karnataka',$detai))
		 {
		?>
        <option value="Karnataka">Karnataka</option>
		<?php
		}
		?>
      </select></td>
      <script>sel_combo('gstates','<?php echo $row['dstate_graph'] ?>');</script>
    </tr>
    <tr>
      <td height="30" class="style12a"><div align="left" class="style8">Average Price Range</div></td>
      <td class="style12a">&nbsp;</td>
      <td class="style12a">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" class="style12a"><div align="right" class="style4">
          <div align="left">Home Page</div>
      </div></td>
      <td class="style12a"><div align="center"><strong>:</strong></div></td>
      <td class="style12a">Min : 
        <label>
        <input name="hxmin" type="text" id="hxmin" value="<?php echo $row['min1'] ?>" size="10" />
      </label>
        &nbsp; Max : 
        <label>
        <input name="hxmax" type="text" id="hxmax" size="10" value="<?php echo $row['max1'] ?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" class="style12a"><div align="right" class="style4">
          <div align="left">Graph Page Day</div>
      </div></td>
      <td class="style12a"><div align="center"><strong>:</strong></div></td>
      <td class="style12a">Min :
      <label>
          <input name="gxmin" type="text" id="gxmin" size="10" value="<?php echo $row['min2'] ?>" />
        </label>
        &nbsp; Max :
        <label>
          <input name="gxmax" type="text" id="gxmax" size="10" value="<?php echo $row['max2'] ?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" class="style12a"><div align="right" class="style4">
          <div align="left">Graph Page Cumulative</div>
      </div></td>
      <td class="style12"><div align="center"><strong>:</strong></div></td>
      <td class="style12a">Min :
        <label>
          <input name="cxmin" type="text" id="cxmin" size="10" value="<?php echo $row['min3'] ?>" />
          </label>
        &nbsp; Max :
        <label>
          <input name="cxmax" type="text" id="cxmax" size="10" value="<?php echo $row['max3'] ?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" class="style12"><div align="left" class="style8">Dates Range</div></td>
      <td class="style12">&nbsp;</td>
      <td class="style12a">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" class="style12a"><div align="right" class="style4">
          <div align="left">Home Page</div>
      </div></td>
      <td class="style12"><div align="center"><strong>:</strong></div></td>
      <td class="style12a">From :
        <label>
        <input name="fdate" type="text" id="fdate" size="20" value="<?php echo datepattrn($row['fdate']) ?>" />
          </label>
        &nbsp; To :
        <label>
        <input name="tdate" type="text" id="tdate" size="20" value="<?php echo datepattrn($row['tdate']) ?>" />
      </label></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><div align="center">
        <input type="submit" name="Submit" value="Submit" />
        <input name="subm" type="hidden" id="subm" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<?php include_once("footer.php");?>
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
<script>
jQuery('#fdate').datepicker();
jQuery('#fdate').readOnly=true;
jQuery('#tdate').datepicker();
jQuery('#tdate').readOnly=true;
</script>