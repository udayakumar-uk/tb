<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{

	$states=array('Andhra Pradesh','Karnataka');
	if(!empty($_POST['subm']))
	{
		$selid=executework("select * from tob_auctsetting");
		$cnt=@mysqli_num_rows($selid);
		$row=@mysqli_fetch_array($selid);
		
print_r($_POST);
		
		for($i=0;$i<count($states);$i++)
		{
			$selv=executework("select * from tob_auctsetting where state='".$states[$i]."'");
			$cntv=@mysqli_num_rows($selv);
			if($cntv>0)
			{
				$upd=executework("update tob_auctsetting set year='".$_POST['year'.$i]."',sdate='".date('Y-m-d',strtotime(str_replace('/','-',$_POST['sdate'.$i])))."',days='".$_POST['days'.$i]."',qty='".$_POST['qty'.$i]."', avg='".$_POST['avg'.$i]."', modified_by='".$_SESSION['tobadmin']."', modified_on='".date('Y-m-d H:i:s')."' where state='".$states[$i]."'");
			}
			else
			{
				$int=executework("insert into tob_auctsetting (state,year,sdate,days,qty,avg,created_by,created_on,status) values('".$states[$i]."','".$_POST['year'.$i]."', '".date('Y-m-d',strtotime(str_replace('/','-',$_POST['sdate'.$i])))."','".$_POST['days'.$i]."','".$_POST['qty'.$i]."','".$_POST['avg'.$i]."','".$_SESSION['tobadmin']."','".date('Y-m-d H:i:s')."','1')");
			}
		}
		redirect("auction_gsettings.php?succ=1");
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
	document.form1.subm.value=1;
	return true;
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
<td width="973"><span class="style1">Auction Data</span> </td>
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
    <tr>
      <td width="798">&nbsp;</td>
    </tr>
    <?php
	for($i=0;$i<count($states);$i++)
	{
		$sels=executework("select * from tob_auctsetting where state='".$states[$i]."'"); 
		$row=@mysqli_fetch_array($sels);

		if(!empty($row['year']))
		$year=$row['year'];
		else if(!empty($_POST['year'.$i]))
		$year=$_POST['year'.$i];
		else
		$year=date('Y');
		
		if(!empty($row['sdate']))
		$sdate=date('d/m/Y',strtotime($row['sdate']));
		else if(!empty($_POST['sdate'.$i]))
		$sdate=$_POST['sdate'.$i];
		else
		$sdate=date('d/m/Y');

	?>
    <tr>
      <td><div align="center">
        <table width="90%" border="1" cellpadding="6" cellspacing="0">
          <tr>
            <td colspan="5"><div align="center"><strong><?php echo $states[$i]; ?></strong></div>              <div align="center"></div>              <div align="center"></div></td>
            </tr>
          
          <tr>
            <td><div align="center"><strong>Year</strong></div></td>
            <td><div align="center"><strong>Date</strong></div></td>
            <td><div align="center"><strong>Days</strong></div></td>
            <td><div align="center"><strong>Qty<br />
              (M.Kgs)</strong></div></td>
            <td><div align="center"><strong>Avg Price</strong></div></td>
            </tr>
          <tr>
            <td><div align="center">
              <label>
              <select name="year<?php echo $i; ?>" id="year<?php echo $i; ?>">
                <option value="">Select</option>
                <?php
				for($y=date('Y');$y>=2000;$y--)
				{
				?>
                <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                <?php
				}
				?>
              </select>
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="sdate<?php echo $i; ?>" type="text" id="sdate<?php echo $i; ?>" value="<?php if(!empty($row['sdate'])) echo $row['sdate']; ?>" size="10" />
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="days<?php echo $i; ?>" type="text" id="days<?php echo $i; ?>" value="<?php if(!empty($row['days'])) echo $row['days']; ?>" size="10" />
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="qty<?php echo $i; ?>" type="text" id="qty<?php echo $i; ?>" value="<?php if(!empty($row['qty'])) echo $row['qty']; ?>" size="10" />
              </label>
            </div></td>
            <td><div align="center">
              <label>
              <input name="avg<?php echo $i; ?>" type="text" id="avg<?php echo $i; ?>" value="<?php if(!empty($row['avg'])) echo $row['avg']; ?>" size="10" />
              </label>
            </div></td>
            </tr>
        </table>
      </div></td>
    </tr>
    <script>
	$('#year<?php echo $i; ?>').val('<?php echo $year; ?>');
	$('#sdate<?php echo $i; ?>').val('<?php echo $sdate; ?>');
jQuery('#sdate<?php echo $i; ?>').datepicker();
jQuery('#sdate<?php echo $i; ?>').readOnly=true;
	</script>
    <?php
	}
	?>
    
    <tr>
      <td><div align="center">
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
</script>