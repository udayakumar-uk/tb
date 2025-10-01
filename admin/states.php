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
<title>Add States | Welcome To TOBBACO BOARD Admin</title>
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
.style8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style12 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
</head>
<script>
function validate_sates()
{
	if(document.form1.state.value=="")
	{
		alert("State Should Not Be Empty");
		document.form1.state.focus();
		return false;
	}
	if(document.form1.dist.value=="")
	{
		alert("District Should Not Be Empty");
		document.form1.dist.focus();
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
if(!empty($_POST['subm']))
{
$selmax=executework("select max(id) from tob_states");
			$rowm=@mysqli_fetch_array($selmax);
			if($rowm[0]!="")
			$max=$rowm[0]+1;
			else
			$max=1;
			if(empty($_POST['states']) && empty($_POST['dists']))
			{
				$sst=executework("select state from tob_states where state='".$_POST['state']."'");
				$cntst=mysqli_num_rows($sst);
				
				$sdt=executework("select dist from tob_states where dist='".$_POST['dist']."'");
				$cntdt=mysqli_num_rows($sdt);
				
				if($cntst==0 && $cntdt==0)
				{			
				$instdt=executework("insert into tob_states values(".$max.",'".$_POST['state']."','".$_POST['dist']."')"); 
				$succ="success";
				}
					if($cntst > 0)
					{
					$succ="stateexists";
					}
					if($cntdt > 0)
					{
					$succ="distexists";
					}
				
			}
					if(!empty($_POST['states']) && empty($_POST['dists']))
					{			
						$dist=executework("select * from tob_states where dist='".$_POST['dist']."'");
						$cntdt=mysqli_num_rows($dist);
						if($cntdt >0)
						{
						$succ="distexists";
						}
						else
						{
							$insdt=executework("insert into tob_states values(".$max.",'".$_POST['state']."','".$_POST['dist']."')");
							$succ="success";
						}
					}
						if(!empty($_POST['states']) && !empty($_POST['dists']))
						{
							$updstate=executework("update tob_states set state='".$_POST['state']."',dist='".$_POST['dist']."' where state='".$_POST['states']."' and dist='".$_POST['dists']."'");
							
									
							$succ="success1";
							
						}
					redirect("states.php?succ=".$succ);
}
?>
<body>
<?php include_once("header.php");?>
<form id="form1" name="form1" method="post" action="states.php" onsubmit="return validate_sates();">
<table width="975" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
<td width="973"><span class="style1">States Entry</span> </td>
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
  <table width="634" align="center" cellpadding="0" cellspacing="0">
    <tr>
	<?php
	$sels=executework("select DISTINCT state from tob_states"); 
	?>
      <td width="125" height="30"><div align="right" class="style4">
        <div align="center">States</div>
      </div></td>
      <td width="54"><div align="center"><strong>:</strong></div></td>
      <td width="453"><select name="states" id="states" onchange="form1.submit();">
        <option value="">Select</option>
		 <?php
		while($fes=@mysqli_fetch_array($sels))
		{
		?>
                <option value="<?php echo $fes['state'] ?>"><?php echo $fes['state'] ?></option>
                <?php
		}
		?>
      </select>
	   <?php
					if(!empty($_POST['states']))
					{
					?>
                <script type="text/javascript">
					 var ct1='<?php echo $_POST['states'] ?>';
					 
					for(j=0;j<document.form1.states.options.length;j++)
					{
						if(document.form1.states.options[j].value==ct1)
						{
						document.form1.states.options[j].selected=true;
						}
					}
					</script>
                <?php
					}
				?> 
      </td>
    </tr>
	
    <tr>
      <td height="31"><div align="right" class="style8">
        <div align="center">State</div>
      </div></td>
      <td><div align="center"><strong>:</strong></div></td>
      <td><input name="state" type="text" id="state" value="<?php if(!empty($_POST['states'])) echo $_POST['states'] ?>"/></td>
    </tr>
	<?php
	if(!empty($_POST['states']))
	$seld=executework("select * from  tob_states where state='".$_POST['states']."'"); 
	?>
    <tr>
      <td height="31"><div align="center"><span class="style8">District</span>s</div></td>
      <td><div align="center"><strong>:</strong></div></td>
      <td><select name="dists" id="dists" onchange="form1.submit();">
        <option value="">Select</option>
		<?php
		while($fed=@mysqli_fetch_array($seld))
		{
		 ?>
                <option value="<?php echo $fed['dist'] ?>"><?php echo $fed['dist'] ?></option>
                <?php
		}
		?>
      </select>
	  <?php
					if(!empty($_POST['dists']))
					{
					?>
                <script type="text/javascript">
					 var ct1='<?php echo $_POST['dists'] ?>';
					 
					for(k=0;k<document.form1.dists.options.length;k++)
					{
						if(document.form1.dists.options[k].value==ct1)
						{
						document.form1.dists.options[k].selected=true;
						}
					}
					</script>
                <?php
					}
				?> 
	  </td>
    </tr>
	 <tr>
      <td height="34"><div align="center"><span class="style8">District</span></div></td>
      <td><div align="center"><strong>:</strong></div></td>
      <td><input name="dist" type="text" id="dist" value="<?php if(!empty($_POST['dists'])) echo $_POST['dists'] ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit" />
      <input name="subm" type="hidden" id="subm" /></td>
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
//chng();
</script>
