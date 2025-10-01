<?php
ob_start();
session_start();
include('include/includei.php');
include('header.php');
if(!empty($_SESSION['tobadmin']))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board,Guntur</title>
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #FF0000}
.style3 {
	color: #000000;
	font-weight: bold;
}
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
    <script class="include" type="text/javascript"    src="../graph/jquery.min.js"></script>
<script>
/*function disprow()
{
	var checkboxes = document.getElementsByName('check_list[]');
	var vals = "";
	 for (var i=0, n=checkboxes.length;i<n;i++)
	 {
		  if (checkboxes[i].checked) 
		  {
			if(vals=="")
			vals = checkboxes[i].value;
			else	
			vals +=","+checkboxes[i].value;
		  }
	}
	vals=vals.trim();
	var subarr=vals.split(",");
	var main_array=['CA','CMA','CS','Others'];
	var diff_array=arr_diff(main_array,subarr);
	
	for(var k=0;k<subarr.length;k++)
	{	
		if(subarr[k]!="")
		{
		document.getElementById(subarr[k]).style.display="";
		}		
	}	
	for(var k=0;k<diff_array.length;k++)
	{	
		document.getElementById(diff_array[k]).style.display="none";		
	}
	
}
*/</script>
<script>
function validation()
{
	if(document.form1.name.value=="")
	{
		alert("Enter Name of the Training Programme");
		document.form1.name.focus();
		return false;
	}
	
	if(document.form1.tno.value=="")
	{
		alert("Enter No of Trainings");
		document.form1.tno.focus();
		return false;
	}
	
	if(document.form1.schedule.value=="")
	{
		alert("Enter Schedule of Training");
		document.form1.schedule.focus();
		return false;
	}
	
	if(document.form1.mnth.value=="")
	{
		alert("Select Schedule Month");
		document.form1.mnth.focus();
		return false;
	}
	
	if(document.form1.yr.value=="")
	{
		alert("Select Schedule Year");
		document.form1.yr.focus();
		return false;
	}
	
	return true;
}

function modify_user(id)
{
	if(confirm("Are you sure to modify this information?"))
	{
		window.location="trainings.php?id="+id;
		return false;
	}
	else
	return false;
}
function delete_user(id)
{
	if(confirm("Are you sure to delete this user information?"))
	{
		window.location="trainings.php?did="+id;
		return false;
	}
	else
	return false;
}
</script>
<body>
<?php
if(!empty($_POST['name']))
{

	if(!empty($_GET['id']))
	$qr=" and id<>".$_GET['id'];
	else
	$qr='';
	
	print_r($_POST);
	$select=executework("select * from tob_training where name='". urlencode($_POST['name'])."'".$qr);
	$cnt=@mysqli_num_rows($select);
	if($cnt>0)
	{
		redirect("trainings.php?exst=1");
	}
	else
	{
		if(!empty($_GET['id']))
		{
			$upd=executework("update tob_training set name='".urlencode($_POST['name'])."',tno='".$_POST['tno']."',schedule='".urlencode($_POST['schedule'])."',mnth='".$_POST['mnth']."',yr='".$_POST['yr']."' where id='".$_GET['id']."'");
			redirect("trainings.php?succ=2");
		}
		else
		{
			
			$ins=executework("insert into tob_training (name,tno,schedule,mnth,yr,status) values('".urlencode($_POST['name'])."','".$_POST['tno']."','".urlencode($_POST['schedule'])."','".$_POST['mnth']."','".$_POST['yr']."',1)");
			redirect("trainings.php?succ=1");
		}
		
	}
}
$st='';
if(isset($_GET['id']) && $_GET['id']!='')
{
	$selm=executework("select * from tob_training where id='".$_GET['id']."'");
	$cntm=@mysqli_num_rows($selm);
	if($cntm==0)
	redirect("trainings.php?invalid=1");
	$rowm=@mysqli_fetch_array($selm);
	$perm=explode(',',$rowm['permissions']);
	$arr=explode(',',$rowm['state']);
	if($rowm['disable']==1)
	$st="checked='checked'";
	else
	$st='';
	
}
if(!empty($rowm['yr']))
	$yr=$rowm['yr'];
else
	$yr=date('Y');

if(!empty($rowm['mnth']))
	$mn=$rowm['mnth'];
else
	$mn=date('n');

if(isset($_GET['did']) && $_GET['did']!='')
{
	$seld=executework("select * from tob_training where id='".$_GET['did']."'");
	$cntd=@mysqli_num_rows($seld);
	if($cntd==0)
	redirect("trainings.php?invalid=1");
	else
	{
		$del=executework("delete from tob_training where id='".$_GET['did']."'");
		redirect("trainings.php?del=1");
	}
}

?>
<form id="form1" name="form1" method="post" action="" onsubmit="return validation();">

  <table width="100%" height="347" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" class="style4">&nbsp;</td>
    </tr>
    <?php if(isset($_GET['succ']) && $_GET['succ']==1) { ?>
    <tr>
      <td colspan="3" class="style1"><div align="center" class="style9 style1">Training programme created successfully.</div></td>
    </tr>
    <?php } ?>
    <?php if(isset($_GET['succ']) && $_GET['succ']==2) { ?>
    <tr>
      <td colspan="3" class="style1"><div align="center" class="style9 style1">Training Programme updated successfully.</div></td>
    </tr>
    <?php } ?>
    <?php if(isset($_GET['del']) && $_GET['del']==1) { ?>
    <tr>
      <td colspan="3"class="style1"><div align="center" class="style9 style1">Training Programme deleted successfully.</div></td>
    </tr>
    <?php } ?>
    <?php if(isset($_GET['exst']) && $_GET['exst']==1) { ?>
    <tr>
      <td colspan="3" class="style2"><div align="center" class="style7 style2">Training Programme exists with same name.</div></td>
    </tr>
    <?php } ?>
    <?php if(isset($_GET['invalid']) && $_GET['invalid']==1) { ?>
    <tr>
      <td colspan="3" class="style2"><div align="center" class="style7 style2">Invalid Access</div></td>
    </tr>
    <?php } ?>    <tr>
      <td width="41%" class="style8"><div align="right">Name of Training Programme</div></td>
      <td width="5%" class="style8"><div align="center">:</div></td>
      <td width="54%"><label>
        <textarea name="name" cols="30" rows="3" id="name"><?php if(isset($rowm)){ echo urldecode($rowm['name']); } ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td class="style8"><div align="right">No. of Trainings</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="tno" type="text" id="tno" size="30" value="<?php if(isset($rowm)){ echo $rowm['tno']; } ?>"/>
      </label></td>
    </tr>
    <tr>
      <td class="style8"><div align="right">Schedule of Training</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <textarea name="schedule" cols="30" rows="3" id="schedule"><?php if(isset($rowm)){ echo urldecode($rowm['schedule']); } ?></textarea>
      </label></td>
    </tr>
	
    <tr>
      <td class="style8"><div align="right">Schedule Month &amp; Year</div></td>
      <td><div align="center">:</div></td>
      <td><select name="mnth" id="mnth">
        <option value="">Month</option>
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select> 
           &amp; 
           <select name="yr" id="yr">
             <option value="">Year</option>
             <?php
			for($i=2015;$i<=(date('Y')+10); $i++)
			{
			?>
             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
			}
				?>
        </select></td>
      <script language="javascript">
			$('#mnth').val('<?php echo $mn; ?>'); $('#yr').val('<?php echo $yr; ?>');</script>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="Submit" />
	<input type="hidden" name="userid" id="userid" value="<?php if(isset($_GET['id'])){  echo $_GET['id']; } ?>" />
      </label></td>
    </tr>
  </table>
  <?php
   $selecty=executework("select * from tob_training");
   $cnt=@mysqli_num_rows($selecty);
   if($cnt >0)
   {
  ?>
  &nbsp;
  <table width="100%" height="61" border="1" cellpadding="1" cellspacing="1">
    <tr class="style8">
      <td width="8%"><div align="center"><strong>S.No</strong></div></td>
      <td width="22%"><div align="center"><strong>Training Programme Name</strong></div></td>
      <td width="21%"><div align="center"><strong>No Of Trainings</strong></div></td>
      <td width="23%"><div align="center"><strong>Schedule</strong></div></td>
      <td width="23%"><div align="center"><strong>Schedule <br />
        Month &amp; Year</strong></div></td>
      <td width="26%" class="style1"><div align="center" class="style3">Status</div></td>
      <td width="26%" class="style1"><div align="center"></div></td>
      <td width="26%" class="style1"><div align="center"></div></td>
    </tr>
	<?php
	$i=1;
	while($row=@mysqli_fetch_array($selecty))
	{
		if($row['disable']==1)
		$stat='Disabled';
		else
		$stat='Active';
		
	?>
    <tr class="style17">
      <td><div align="center"><?php echo $i ?></div></td>
      <td><div align="center"><?php echo urldecode($row['name']); ?></div></td>
      <td><div align="center"><?php echo $row['tno'] ?></div></td>
      <td><div align="center"><?php echo urldecode($row['schedule']) ?></div></td>
      <td><div align="center"><?php echo date('M', mktime(0, 0, 0, $row['mnth'], 10))." - ".$row['yr']; ?></div></td>
      <td class="style4"><div align="center"><?php echo $stat ?></div></td>
      <td class="style4"><div align="center">
          <input type="button" name="button<?php echo $row['id']; ?>" id="button<?php echo $row['id']; ?>" value="Modify" onclick="modify_user('<?php echo $row['id']; ?>');" />
      </div></td>
      <td class="style4"><div align="center">
          <label>
          <input type="button" name="button" id="button" value="Delete" onclick="delete_user('<?php echo $row['id']; ?>');" />
          </label>
      </div></td>
    </tr>
	<?php
	$i++;
	}
	?>
  </table>
  <?php
  }
  }
  ?>
</form>
</body>
</html>
