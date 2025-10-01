<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
	$yr=date('Y');
	if(!empty($_POST['year']))
	$yrs=$_POST['year'];
	else
	$yrs=$yr;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Auction Details | Welcome To TOBBACO BOARD Admin</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.style7 {font-size: 14px; color: #FF0000; font-family: Arial, Helvetica, sans-serif;}
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }

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
</head>
<script src="genfunctions.js" type="text/javascript"></script>
<script src="../jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function chng()
{
	if(document.form1.state.value!='Karnataka')
	{
		document.getElementById("ct").style.visibility='visible';
		document.getElementById("ct").style.position='relative';
	}
	else
	{
		document.getElementById("ct").style.visibility='hidden';
		document.getElementById("ct").style.position='absolute';
	}
}

function chk()
{
	document.form1.submit();
}

function check(form1)
{
	if(document.form1.state.value=="")
	{
		alert("State Should Not Be Empty");
		document.form1.state.focus();
		return false;
	}
	else if(document.form1.plats.value=="")
	{
		alert("Platform Name Should Not Be Empty");
		document.form1.plats.focus();
		return false;
	}
	else if(isNaN(document.form1.qauth.value)==true)
	{
		alert("Enter Valid Quantity Autherised");
		document.form1.qauth.value="";
		document.form1.qauth.focus();
		return false;
	}
	else if(isNaN(document.form1.qest.value)==true)
	{
		alert("Enter Valid Quantity Estimated");
		document.form1.qest.value="";
		document.form1.qest.focus();
		return false;
	}
	else if(document.form1.cdate.value=="")
	{
		alert("Date Of Commence Should Not Be Empty");
		document.form1.cdate.focus();
		return false;
	}
	else
	{
		document.form1.subm.value=1;
		return true
	}
}
</script>
<body>
<?php include_once("header.php");?>
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

	function numround($st,$n)
	{
		if($st!="")
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}

	if(!empty($_POST['subm']))
	{
		$selmax=executework("select max(id) from tob_auct");
		$rowm=@mysqli_fetch_array($selmax);
		if($rowm[0]!="")
		$max=$rowm[0]+1;
		else
		$max=1;

		$selplat=executework("select * from tob_platform where platform='".$_POST['plats']."'");
		$rowp=@mysqli_fetch_array($selplat);
		
		$seldat=executework("select * from tob_auct where platf=".$_POST['plats']." and year=".$_POST['year']);
		$cnt=@mysqli_num_rows($seldat);
		if($cnt>0)
		{
			$row=@mysqli_fetch_array($seldat);
			$upqry=executework("update tob_auct set qauth=".$_POST['qauth'].",qest=".$_POST['qest'].",cdate='".datepattrn1($_POST['cdate'])."',edate='".date('Y-m-d',strtotime($_POST['edate']))."' where id=".$row['id']);
		}
		else
		{
			$intqry=executework("insert into tob_auct values(".$max.",".$_POST['plats'].",".$_POST['year'].",".$_POST['qauth'].",".$_POST['qest'].",'".date('Y-m-d',strtotime($_POST['cdate']))."','".date('Y-m-d',strtotime($_POST['edate']))."')");
		}
		redirect("platform1.php?succ=1");
	}

?>
<form action="platform1.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
  <table width="90%" border="0" align="center">
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="9%">&nbsp;</td>
      <td width="66%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Add Auction Details </span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Data Updated Successfully</span> </td>
    </tr>
	<?php
		}
		else
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7"></span> </td>
    </tr>
	<?php
		}
		
/*		if(isset($_SESSION['tobadmin']) && $_SESSION['tobadmin']=='admin')
		{
			$detai=array('Andra Pradesh','Karnataka');
		}
		else if(isset($_SESSION['tobadmin']))
		{
			$sel=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
			$row=@mysqli_fetch_array($sel);
			$details=array($row['permissions']);
			foreach($details as $detail)
			$detai=explode(',',$detail);
		}
		else
		$detai=array();
		print_r($detai);
*/	?>

<?php
	    $sel=executework("select * from tob_employeeview where username='".$_SESSION['tobadmin']."'");
		//echo "select * from tob_employeeview where username='".$_SESSION['tobadmin']."'";
		$row=@mysqli_fetch_array($sel);
			$details=array($row['permissions']);
			if($_SESSION['tob']=='admin')
			$detai=array('Andhra Pradesh','Karnataka');
			foreach($details as $detail)
			{
			    if($detail!='')
			    $detai=explode(',',$detail);
			    else
			    $detai=array();
			}
			 //$int=in_array('Andhra Pradesh',$detai);
			//print_r($int);
//echo ($_POST['state']==in_array('Andhra Pradesh',$detai))
?>
    <tr>
      <td height="30" style="padding-left:35px;"><div align="center"><span class="style4">State</span></div></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td><label>
        <select name="state" id="state" onchange="chk();" >
          <option value="" selected="selected">Select</option>
         <option value="Andhra Pradesh" >Andhra Pradesh</option>
          <option value="Karnataka" >Karnataka</option>
        </select>
      </label>
	  				<?php
					if(!empty($_POST['state']))
					$ct=$_POST['state'];
					else
					$ct=$detai;
					
					if($ct!="")
					{
					?>
                <script type="text/javascript">
					 var ct='<?php echo $ct ?>';
					 var j;
					for(j=1;j<=document.form1.state.options.length;j++)
					{
						if(document.form1.state.options[j].value==ct)
						{
							document.form1.state.options[j].selected=true;
						}
					}
					</script>
                <?php
					}
				?>  
				<script>
				//chk();
				</script>   
				
				  </td>
    </tr>
	<?php
	$qry='';
	if(!empty($_POST['state']))
	{
		if($_POST['state']=='Andhra Pradesh' && !empty($_POST['catg']))
		$qry=" and catg='".$_POST['catg']."'";
		$selplat=executework("select * from tob_platform where state='".$_POST['state']."'".$qry." and isactive=1 order by catg,sno,apfno");
		
		if(!empty($_POST['plats']))
		{
			$selpl=executework("select * from tob_platform where id=".$_POST['plats']);
			$rown=@mysqli_fetch_array($selpl);
			if($rown['isactive']==0)
			$chkd="checked='checked'";
			else
			$chkd="";
			if($rown['home']==1)
			$chkd1="checked='checked'";
			else
			$chkd1="";
		}
	}
	?>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;"><div align="center">Platform Name </div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><label>
        <select name="plats" id="plats" onchange="chk();">
          <option value="">Select</option>
		 <?php
		 while($rowp=@mysqli_fetch_array($selplat))
		 {
		 ?>
          <option value="<?php echo $rowp['id'] ?>"><?php echo $rowp['platform']."(".$rowp['apfno'].")"; ?></option>
		 <?php
		 }
		 ?>
        </select>
        <?php
					if(!empty($_POST['plats']))
					{
					?>
      <script type="text/javascript">
					 var ctp='<?php echo $_POST['plats'] ?>';
					 var j;
					for(j=0;j<document.form1.plats.options.length;j++)
					{
						if(document.form1.plats.options[j].value==ctp)
						{
							document.form1.plats.options[j].selected=true;
						}
					}
					</script>
      <?php
					}
				  ?>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;"><div align="center">Auction Year</div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><label>
        <select name="year" id="year" onchange="chk();">
          <?php
		 for($i=2009;$i<=$yr;$i++)
		 {
		 ?>
          <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php
		 }
		 ?>
        </select>
        <?php
					if($yrs!="")
					{
					?>
        <script type="text/javascript">
					 var ctp='<?php echo $yrs ?>';
					 var j;
					for(j=0;j<document.form1.year.options.length;j++)
					{
						if(document.form1.year.options[j].value==ctp)
						{
							document.form1.year.options[j].selected=true;
						}
					}
					</script>
        <?php
					}
			
	if(!empty($_POST['plats']) && !empty($_POST['year']))
	{		
		$selauct=executework("select * from tob_auct where platf=".$_POST['plats']." and year=".$_POST['year']);
		$cnta=@mysqli_num_rows($selauct);
		$rowa=@mysqli_fetch_array($selauct);
	}
				  ?>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">&nbsp;&nbsp;
          <div align="center">Quantity Autherised </div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><input name="qauth" type="text" id="qauth" value="<?php if(!empty($rowa['qauth'])) echo $rowa['qauth']?>" /></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">&nbsp;&nbsp;
          <div align="center">Quantity Estimated </div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><input name="qest" type="text" id="qest" value="<?php if(!empty($rowa['qest'])) echo $rowa['qest']?>" /></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">&nbsp;&nbsp;
          <div align="center">Date Of Commence </div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><input name="cdate" type="text" id="cdate" value="<?php if(!empty($rowa['cdate']) && $rowa['cdate']!='0000-00-00') { echo datepattrn($rowa['cdate']); }?>" /></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">&nbsp;&nbsp;
          <div align="center">Date Of Closure </div></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td class="style8"><input name="edate" type="text" id="edate" value="<?php if(!empty($rowa['edate']) && $rowa['edate']!='0000-00-00') { echo datepattrn($rowa['edate']); }?>" /></td>
    </tr>
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td>
	  	<?php
			if(empty($_GET['edit']))
			{
		?>
        <input type="submit" name="Submit" value="Submit" />
        <input type="reset" name="Submit2" value="Reset" />
		<?php
			}
			else
			{
		?>
        <input type="submit" name="Submit" value="Modify" />
        <input type="reset" name="Submit2" value="Cancel" onclick="back1();" />
		<?php
			}
		?>
      <input name="subm" type="hidden" id="subm" />	 
	  <input name="ttype" type="hidden" id="ttype" value="<?php echo $_GET['edit']?>" /></td>
    </tr>
    <tr>
      <td height="50" colspan="3" class="style4">&nbsp;</td>
    </tr>
  </table>
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
jQuery('#cdate').datepicker();
jQuery('#cdate').readOnly=true;
jQuery('#edate').datepicker();
jQuery('#edate').readOnly=true;
chng();
</script>