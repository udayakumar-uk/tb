<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
	$variety=array('FCV','Non FCV', 'Refuse Tobacco', 'Tobacco Products', 'Un Manufactured Tobacco');
	$sel=executework("select * from tob_homexport");
	$data=array();
	while($row=@mysqli_fetch_array($sel))
	{
		$vart=$row['variety'];
		$data[$vart]=$row;
	}

	if(!empty($_POST['subm']))
	{
		$selid=executework("select * from tob_gsettings where graph='Action Graph'");
		$cnt=@mysqli_num_rows($selid);
		$row=@mysqli_fetch_array($selid);
		
		$upd=executework("update tob_gsettings set export_fmonth='". make_safe($_POST['fmonth'])."',export_fyear='". make_safe($_POST['fyear'])."',export_tmonth='". make_safe($_POST['tmonth'])."',export_tyear='". make_safe($_POST['tyear'])."' where id=".$row['id']);

		for($i=0;$i<count($variety);$i++)
		{
			$vart=$variety[$i];
			$selv=executework("select * from tob_homexport where variety='".$variety[$i]."'");
			$cntv=@mysqli_num_rows($selv);
			if($cntv>0)
			{
				$upd=executework("update tob_homexport set cqty='".$_POST['cqty'.$i]."',cvalr='".$_POST['cvalr'.$i]."',cvald='".$_POST['cvald'.$i]."',mqty='".$_POST['mqty'.$i]."', mvalr='".$_POST['mvalr'.$i]."', mvald='".$_POST['mvald'.$i]."' where variety='".$variety[$i]."'");
			}
			else
			{
				$int=executework("insert into tob_homexport (variety,cqty,cvalr,cvald,mqty,mvalr,mvald) values('".$variety[$i]."', '".$_POST['cqty'.$i]."','".$_POST['cvalr'.$i]."','".$_POST['cvald'.$i]."','".$_POST['mqty'.$i]."','".$_POST['mvalr'.$i]."','".$_POST['mvald'.$i]."')");
			}
		}
		redirect("export_gsettings.php?succ=1");
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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
.style10 {font-size: 14px; color: #0000FF; }
-->
</style>
</head>
<script src="genfunctions.js" type="text/javascript"></script>
<script src="../jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
<script>
function validate_settings()
{
	var fmonth=$('#fmonth').val();
	var tmonth=$('#tmonth').val();
	var fyear=$('#fyear').val();
	var tyear=$('#tyear').val();
	
	var difference=((parseInt(tyear)-parseInt(fyear))*12)+(parseInt(tmonth)-parseInt(fmonth));
	//alert(difference);
	/*var fdat=document.form1.fdate.value;
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
	else*/
	var valid="";
	/*if(document.form1.tg.value=="")
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
	}*/
	/*if(document.form1.gstates.value=="")
	{
		alert("Select Default State For Graph Page");
		document.form1.gstates.focus();
		return false;
	}*/
	/*if(document.form1.hxmin.value=="")
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
	}*/
	if(document.form1.fmonth.value=="")
	{
		alert("Select from month");
		document.form1.fmonth.focus();
		return false;
	}
	else if(document.form1.fyear.value=="")
	{
		alert("Select from year");
		document.form1.fyear.focus();
		return false;
	}
	else if(document.form1.tmonth.value=="")
	{
		alert("Select to month");
		document.form1.tmonth.focus();
		return false;
	}
	else if(document.form1.tyear.value=="")
	{
		alert("Select to year");
		document.form1.tyear.focus();
		return false;
	}
	/*else if(parseInt(difference)>5 || parseInt(difference)<=0)
	{
		alert("difference between months should be <=5 and >0");
		document.form1.tyear.focus();
		return false;
	}
	else if(document.form1.export_type.checked.length==0)
	{
		alert("Select Type");
		document.form1.export_type.focus();
		return false;
	}*/
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
//if(!empty($_POST['subm']))
//{
//	/*echo "hiii";
//	exit();*/
//	$selmax=executework("select max(id) from tob_gsettings");
//	$rowm=@mysqli_fetch_array($selmax);
//	if($rowm[0]!="")
//	$max=$rowm[0]+1;
//	else
//	$max=1;
//	
//	$selid=executework("select * from tob_gsettings where graph='Action Graph'");
//	//echo ("select * from tob_gsettings where graph='Action Graph'");
//	//echo "select * from tob_gsettings where graph='Action Graph'";
//	$cnt=@mysqli_num_rows($selid);
//	echo "count=".$cnt;
//	if($cnt>0)
//	{
//		//echo "hiiiii count value=".$cnt;
//		$row=@mysqli_fetch_array($selid);
//		$upd=executework("update tob_gsettings set export_fmonth='". make_safe($_POST['fmonth'])."',export_fyear='". make_safe($_POST['fyear'])."',export_tmonth='". make_safe($_POST['tmonth'])."',export_tyear='". make_safe($_POST['tyear'])."',export_category='". make_safe($_POST['category'])."',export_type='".make_safe($_POST['export_type'])."' where id=".$row['id']);
//		echo ("update tob_gsettings set export_fmonth='". make_safe($_POST['fmonth'])."',export_fyear='". make_safe($_POST['fyear'])."',export_tmonth='". make_safe($_POST['tmonth'])."',export_tyear='". make_safe($_POST['tyear'])."',export_category='". make_safe($_POST['category'])."',export_type='".make_safe($_POST['export_type'])."' where id=".$row['id']);
//		//echo ("update tob_gsettings set export_fmonth='". make_safe($_POST['fmonth'])."',export_fyear='". make_safe($_POST['fyear'])."',export_tmonth='". make_safe($_POST['tmonth'])."',export_tyear='". make_safe($_POST['tyear'])."',export_category='". make_safe($_POST['category'])."' where id=".$row['id']);
//		//echo "update tob_gsettings set tg='".$_POST['tg']."',dstate_home='".$_POST['hstates']."',dstate_graph='".$_POST['gstates']."',min1='".$_POST['hxmin']."',max1='".$_POST['hxmax']."',min2='".$_POST['gxmin']."',max2='".$_POST['gxmax']."',min3='".$_POST['cxmin']."',max3='".$_POST['cxmax']."',fdate='".datepattrn1($_POST['fdate'])."',tdate='".datepattrn1($_POST['tdate'])."' where id=".$row['id'];
//	}
//	else
//	{
////		$int=executework("insert into values(".$max.",'Action Graph'
//	}
//	$succ="success1";
//	redirect("export_gsettings.php?succ=".$succ);
//}
?>
<body>
<?php include_once("header.php");?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validate_settings();">
<table width="975" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
<td width="973"><span class="style1">Export Performance</span> </td>
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
if(!empty($_GET['succ']))
{
?>
<tr>
  <td height="30" class="style2"><div align="center"><span class="style10">Given Details Updated Success fully </span></div></td>
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
      <td width="239" height="30" class="style12"><div align="left" class="style8">Months Range</div></td>
      <td width="56" class="style12">&nbsp;</td>
      <td width="503" class="style12a">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" class="style12a"><div align="right" class="style4">
          <div align="left">Home Page</div>
      </div></td>
      <td class="style12"><div align="center"><strong>:</strong></div></td>
      <td class="style12a">From :
        <label>
        <?php
			$months = array (
  array("January",1),
  array("Febrauary",2),
  array("March",3),
  array("April",4),
  array("May",5),
  array("June",6),
  array("July",7),
  array("August",8),
  array("September",9),
  array("October",10),
  array("November",11),
  array("December",12)
);

		
		//	$months=array("January"=>"1","Febrauary"=>"2","March"=>"3","April"=>"4","May"=>"5","June"=>"6","July"=>"7","August"=>"8","September"=>"9","October"=>"10","November"=>"11","December"=>"12");
			//print_r($months);
		?>
        <select name="fmonth" id="fmonth">
        	<option value="">Select Month</option>
            <?php
				for($m=0;$m<count($months);$m++)
				{
			?>
            <option value="<?php echo $months[$m][1]; ?>"><?php echo $months[$m][0]; ?></option>
            <?php
				}
			?>
        </select>
        <?php
			if(!empty($row['export_fmonth']))
			{
		?>
        <script type="text/javascript">
			$('#fmonth').val('<?php echo $row['export_fmonth']; ?>');
		</script>
        <?php
			}
		?>
        <select name="fyear" id="fyear">
        	<option value="">Select Year</option>
            <?php
				for($y="2020";$y<=date('Y');$y++)
				{
			?>
            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
            <?php
				}
			?>
        </select>
        <?php
			if(!empty($row['export_fyear']))
			{
		?>
        <script type="text/javascript">
			$('#fyear').val('<?php echo $row['export_fyear']; ?>');
		</script>
        <?php
			}
		?>
          </label>
        &nbsp; To :
        <label>
        <select name="tmonth" id="tmonth">
        	<option value="">Select Month</option>
            <?php
				for($m=0;$m<count($months);$m++)
				{
			?>
            <option value="<?php echo $months[$m][1]; ?>"><?php echo $months[$m][0]; ?></option>
            <?php
				}
			?>
        </select>
         <?php
			if(!empty($row['export_tmonth']))
			{
		?>
        <script type="text/javascript">
			$('#tmonth').val('<?php echo $row['export_tmonth']; ?>');
		</script>
        <?php
			}
		?>
        <select name="tyear" id="tyear">
        	<option value="">Select Year</option>
            <?php
				for($y="2020";$y<=date('Y');$y++)
				{
			?>
            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
            <?php
				}
			?>
        </select>
         <?php
			if(!empty($row['export_tyear']))
			{
		?>
        <script type="text/javascript">
			$('#tyear').val('<?php echo $row['export_tyear']; ?>');
		</script>
        <?php
			}
		?>
      </label></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><div align="center">
        <table width="90%" border="1" cellpadding="6" cellspacing="0">
          <tr>
            <td rowspan="2"><div align="center"><strong>Variety</strong></div></td>
            <td colspan="3"><div align="center"><strong>Current Month</strong></div>              <div align="center"></div>              <div align="center"></div></td>
            <td colspan="3"><div align="center"><strong>Cummilative</strong></div>              <div align="center"></div>              <div align="center"></div></td>
            </tr>
          <tr>
            <td><div align="center"><strong>Qty<br />
            (M.Tons)</strong></div></td>
            <td><div align="center"><strong>Value<br />
            (Rs. Cr.)</strong></div></td>
            <td><div align="center"><strong>Value<br />
            (M.USD)</strong></div></td>
            <td><div align="center"><strong>Qty<br />
              (M.Tons)</strong></div></td>
            <td><div align="center"><strong>Value<br />
              (Rs. Cr.)</strong></div></td>
            <td><div align="center"><strong>Value<br />
              (M.USD)</strong></div></td>
          </tr>
          <?php
		  for($i=0;$i<count($variety);$i++)
		  {
		  	$vart=$variety[$i];
		  ?>
          <tr>
            <td><div align="center"><strong><?php echo $variety[$i]; ?></strong></div></td>
            <td><div align="center">
              <label>
              <input name="cqty<?php echo $i; ?>" type="text" id="cqty<?php echo $i; ?>" value="<?php if(!empty($data[$vart]['cqty'])) echo (float)$data[$vart]['cqty']; ?>" size="10" />
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="cvalr<?php echo $i; ?>" type="text" id="cvalr<?php echo $i; ?>" value="<?php if(!empty($data[$vart]['cvalr'])) echo (float)$data[$vart]['cvalr']; ?>" size="10" />
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="cvald<?php echo $i; ?>" type="text" id="cvald<?php echo $i; ?>" value=" <?php if(!empty($data[$vart]['cvald'])) echo (float)$data[$vart]['cvald']; ?>" size="10" />
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="mqty<?php echo $i; ?>" type="text" id="mqty<?php echo $i; ?>" value=" <?php if(!empty($data[$vart]['mqty'])) echo (float)$data[$vart]['mqty']; ?>" size="10" />
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="mvalr<?php echo $i; ?>" type="text" id="mvalr<?php echo $i; ?>" value=" <?php if(!empty($data[$vart]['mvalr'])) echo (float)$data[$vart]['mvalr']; ?>" size="10" />
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="mvald<?php echo $i; ?>" type="text" id="mvald<?php echo $i; ?>" value=" <?php if(!empty($data[$vart]['mvald'])) echo (float)$data[$vart]['mvald']; ?>" size="10" />
              </label>
            </div></td>
          </tr>
          <?php
		  }
		  ?>
        </table>
      </div></td>
    </tr>
    <tr>
      <td colspan="3"><div align="center">
        <input name="subm" type="hidden" id="subm" />
        <input type="submit" name="Submit" value="Submit" />
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