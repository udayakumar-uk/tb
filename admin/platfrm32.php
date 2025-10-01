<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
include_once("header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Platforms</title>
<style type="text/css">
<!--
.style17 {font-family: Arial, Helvetica, sans-serif;font-size: 12px; }
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
.style20 {color: #0000FF}

-->
</style>
</head>
<script>
function mod_master(st)
{
	if(confirm("Are You Sure To Modify"))
	{
		location.href="platfrm32.php?mid="+st;

	}
	else
	return false;
}

function del_master(st4)
{
	if(confirm("Are You Sure To Delete"))
	{
		location.href="platfrm32.php?did="+st4;
	}
	else
	return false;
}

function validate()
{
	if(document.form1.state.value=="")
	{
		alert("select State");
		document.form1.state.focus();
		return false;
	}
	if(document.form1.district.value=="")
	{
		alert("Enter District");
		document.form1.district.focus();
		return false;
	}
	if(document.form1.platform_name.value=="")
	{
		alert("Enter Platform Name");
		document.form1.platform_name.focus();
		return false;
	}
	if(document.form1.seq.value=="")
	{
		alert("Enter Seq No");
		document.form1.seq.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<body>
<form id="form1" name="form1" method="post" action="platfrm32.php" onsubmit="return validate();">
<?php
if(isset($_POST['Submit']) && $_POST['Submit']!="")
{	
	if(isset($_POST['mid']) && $_POST['mid']!="")
	{
	$up=executeupdate("update tob_platfrm set dist='".$_POST['district']."',platform='".$_POST['platform_name']."',apfno='".$_POST['apf']."',isactive='".$_POST['check']."' where id='".$_POST['mid']."'");
	redirect("platfrm32.php?succ=2");
	}
	else
	{
	$ins=executeupdate("insert into tob_platfrm values('','','".$_POST['state']."','".$_POST['district']."','','".$_POST['platform_name']."','".$_POST['apf']."','','".$_POST['check']."')");
	redirect("platfrm32.php?succ=1");
	}
}	
?>
  <table width="100%" height="262" border="0" cellpadding="0" cellspacing="0">
  <?php
  	if(isset($_GET['mid']) && $_GET['mid']!="")
	{
	  $seloy=executework("select * from tob_platfrm where id='".$_GET['mid']."'");
	  //echo "select * from tob_platforms where id='".$_GET['mid']."'";
	  $rowy=@mysqli_fetch_array($seloy);
  	}
	if(isset($_GET['succ']) && $_GET['succ']==2)
	{
  ?>
    <tr>
      <td colspan="3" class="style20"><div align="center"><span class="style6">Given Platform Modified Successfully </span></div></td>
    </tr>
	<?php
	}
	if(isset($_GET['succ']) && $_GET['succ']==3)
	{
	?>
    <tr>
      <td colspan="3" class="style20"><div align="center"><span class="style6">Given Platform Deleted Successfully </span></div></td>
    </tr>
	<?php
	}
	if(isset($_GET['succ']) && $_GET['succ']==1)
	{
	?>
    <tr>
      <td colspan="3" class="style20"><div align="center" class="style6">Given Platform Added Successfully </div></td>
    </tr>
	  <?php
	  }
	  $sel=executework("select * from tob_location where tfield='State'");
	  ?>
    <tr>
      <td width="39%" class="style8"><div align="right">State</div></td>
      <td width="5%" class="style8"><div align="center">:</div></td>
      <td width="56%"><label>
        <select name="state" id="state" onchange="form1.submit();">
		<option value="">Select</option>
		<?php
		while($row=@mysqli_fetch_array($sel))
		{
		?>
		<option value="<?=$row['name'];?>"><?=$row['name'];?></option>
		<?php
		}
		?>
        </select>
                   <?php
					if($_POST['state']!="")
					$state=$_POST['state'];
					else if($row['name']!="")
					$state=$row['name'];
					else 
					$state=$rowy['state'];
					if($state!="")
					{
					?>
      <script type="text/javascript">
					 var ctp='<?php echo $state ?>';
					 var m;
					for(m=0;m<document.form1.state.options.length;m++)
					{
						if(document.form1.state.options[m].value==ctp)
						{
							document.form1.state.options[m].selected=true;
						}
					}
					</script>
                  <?php
					}
				  ?>
<!--				  <script>document.form1.submit();</script>
-->      </label></td>
    </tr>
	<?php
	if(isset($_POST['state']) && $_POST['state']!="")
	{
	  $seluy=executework("select * from tob_location where name='".$_POST['state']."'");
	  $rowuy=@mysqli_fetch_array($seluy);
	  $st=executework("select * from tob_location where precatid='".$rowuy['id']."'");
	 // echo "select * from tob_location where precatid='".$_POST['state']."'";
	  //$rowuy=@mysqli_fetch_array($seluy);
	  
	?>
    <tr>
      <td class="style8"><div align="right">District</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <select name="district" id="district">
		<option value="">Select</option>
		<?php
		while($rowuyv=@mysqli_fetch_array($st))
		{
		?>
		<option value="<?php echo $rowuyv['name'] ?>"><?php echo $rowuyv['name'] ?></option>
		<?php
		}
		?>
        </select>
		
                   <?php
					if($_POST['district']!="")
					$dist=$_POST['district'];
					else 
					$dist=$rowyv['dist'];
					if($dist!="")
					{
					?>
      <script type="text/javascript">
					 var cttp='<?php echo $dist ?>';
					 var m;
					for(m=0;m<document.form1.district.options.length;m++)
					{
						if(document.form1.district.options[m].value==cttp)
						{
							document.form1.district.options[m].selected=true;
						}
					}
					</script>
                  <?php
					}
				  ?>
      </label></td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td class="style8"><div align="right">Platform Name </div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="platform_name" type="text" id="platform_name" value="<?=$rowy['platform']?>" />
      </label></td>
    </tr>
    <tr>
      <td class="style8"><div align="right">APF No.</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="apf" type="text" id="apf" value="<?=$rowy['apfno']?>" />
      </label></td>
    </tr>
	<?php
	  	if(!empty($rowy['isactive']))
	  	$chked='checked="checked"';		
	  	else
	 	$chked='';
	?>	
    <tr>
      <td class="style8"><div align="right">Disable</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="check" type="checkbox" id="check" value="1"<?=$chked;?> />
      </label></td>
    </tr>
    <tr>
      <td colspan="2"><div align="right"></div></td>
      <td><label>
        <input type="submit" name="Submit" value="Submit" />
        <input type="reset" name="Submit2" value="Reset" />
        <input name="mid" type="hidden" id="mid" value="<?=$_GET['mid'];?>" />
      </label></td>
    </tr>
  </table>
    
  <?php
  if(isset($_GET['did']) && $_GET['did']!="")
  {
  	$dlt=executeupdate("delete from tob_platfrm where id='".$_GET['did']."'");
	redirect("platfrm32.php?succ=3");
  }
  $selecth=executework("select * from tob_platfrm");
  $cnth=@mysqli_num_rows($selecth);
  if($cnth > 0)
  { 
  ?>
  <table width="100%" border="1" cellspacing="1" cellpadding="1">
    <tr class="style17">
      <td width="5%"><strong>S.No</strong></td>
      <td width="13%"><strong>State</strong></td>
      <td width="10%"><strong>District</strong></td>
      <td width="18%"><strong>Platform Name </strong></td>
      <td width="10%"><strong>APF No </strong></td>
      <td width="10%"><strong>Status</strong></td>
      <td width="12%">&nbsp;</td>
      <td width="10%">&nbsp;</td>
    </tr>
	<?php
	$i=1;
	while($rowth=@mysqli_fetch_array($selecth))
	{
		if($rowth['isactive']==1)
		$stat='Disabled';
		else
		$stat='Active';
	//$sgh=executework("select * from tob_location  where id='".$rowth['state']."'");
	//$rowgh=@mysqli_fetch_array($sgh);
	
	//$stghty=executework("select * from tob_location  where id='".$rowth['district']."'");
	//$roth=@mysqli_fetch_array($stghty);
	?>
    <tr class="style17">
      <td><?=$i;?></td>
      <td><?php echo $rowth['state'] ?></td>
      <td><?php echo $rowth['dist'] ?></td>
      <td><?php echo $rowth['platform'] ?></td>
      <td><?php echo $rowth['apfno'] ?></td>
      <td><?php echo $stat; ?></td>
      <td><label>
        <input type="submit" name="Submit3" value="Modify" onclick="mod_master('<?php echo $rowth['id'] ?>')"/>
      </label></td>
      <td><label>
        <input type="submit" name="Submit4" value="Delete" onclick="del_master('<?php echo $rowth['id'] ?>')" />
      </label></td>
    </tr>
	<?php
	$i++;
	}
	?>
  </table>
  <?php
  }
  ?>
  <p>&nbsp;</p>
</form>
</body>
</html>
