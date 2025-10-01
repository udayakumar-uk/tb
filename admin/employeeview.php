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
		alert("Enter Name");
		document.form1.name.focus();
		return false;
	}
	
	if(document.form1.details.value=="")
	{
		alert("Enter Details");
		document.form1.details.focus();
		return false;
	}
	
	if(document.form1.username.value=="")
	{
		alert("Enter UserName");
		document.form1.username.focus();
		return false;
	}
	
	if(document.form1.password.value=="")
	{
		alert("Enter Password");
		document.form1.password.focus();
		return false;
	}
	
	else
	{
		var checkboxes = document.getElementsByName('check_list[]');
		var vals = "";
		 for (var i=0, n=checkboxes.length;i<n;i++)
		 {
			  if (checkboxes[i].checked) 
			  {
				vals=1;
			  }
		}
		if(vals=='')
		{
			alert("Provide permissions");
			return false;
		}
		return true;
	}
}

function modify_user(id)
{
	if(confirm("Are you sure to modify this user information?"))
	{
		window.location="employeeview.php?id="+id;
		return false;
	}
	else
	return false;
}
function delete_user(id)
{
	if(confirm("Are you sure to delete this user information?"))
	{
		window.location="employeeview.php?did="+id;
		return false;
	}
	else
	return false;
}
</script>
<body>
<?php
if(isset($_POST['Submit']) && $_POST['Submit']!="")
{
	$sel="";
	$solt="";
	for($j=0;$j<count($_POST['check_box']);$j++)
	{
		if($solt=="")
		$solt=$_POST['check_box'][$j];
		else
		$solt=$solt.','.$_POST['check_box'][$j];
	}
	for($i=0;$i<count($_POST['check_list']);$i++)//syntax is foreach($array as $value)
	{
		if($sel=="")
		$sel=$_POST['check_list'][$i];
		else
		$sel=$sel.','.$_POST['check_list'][$i];
	}
	
	if(isset($_POST['status']) && $_POST['status']!='')
	$status=1;
	else
	$status=0;
	
	if($_POST['userid']!='')
	$qr=" and id<>".$_POST['userid'];

	$select=executework("select * from tob_employeeview where username='".$_POST['username']."'".$qr);
	$cnt=@mysqli_num_rows($select);
	if($cnt>0)
	{
		redirect("employeeview.php?exst=1");
	}
	else
	{
		if($_POST['userid']!='')
		{
			$upd=executework("update tob_employeeview set name='".$_POST['name']."',details='".$_POST['details']."',username='".$_POST['username']."',password='".$_POST['password']."',state='".$solt."',disable='".$status."',permissions='".$sel."' where id='".$_POST['userid']."'");
			//echo "update tob_employeeview set name='".$_POST['name']."',details='".$_POST['details']."',username='".$_POST['username']."',password='".$_POST['password']."',state='".$solt."',disable='".$status."',permissions='".$sel."' where id='".$_POST['userid']."'";
			redirect("employeeview.php?succ=2");
		}
		else
		{
			$ins=executework("insert into tob_employeeview values('','".$_POST['name']."','".$_POST['details']."','".$_POST['username']."','".$_POST['password']."','".$solt."','".$status."','".$sel."','','','')");
			redirect("employeeview.php?succ=1");
		}
	}
}
$st='';
if(isset($_GET['id']) && $_GET['id']!='')
{
	$selm=executework("select * from tob_employeeview where id='".$_GET['id']."'");
	$cntm=@mysqli_num_rows($selm);
	if($cntm==0)
	redirect("employeeview.php?invalid=1");
	$rowm=@mysqli_fetch_array($selm);
	$perm=explode(',',$rowm['permissions']);
	$arr=explode(',',$rowm['state']);
	if($rowm['disable']==1)
	$st="checked='checked'";
	else
	$st='';
}

if(isset($_GET['did']) && $_GET['did']!='')
{
	$seld=executework("select * from tob_employeeview where id='".$_GET['did']."'");
	$cntd=@mysqli_num_rows($seld);
	if($cntd==0)
	redirect("employeeview.php?invalid=1");
	else
	{
		$del=executework("delete from tob_employeeview where id='".$_GET['did']."'");
		redirect("employeeview.php?del=1");
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
      <td colspan="3" class="style1"><div align="center" class="style9 style1">User created successfully.</div></td>
    </tr>
    <?php } ?>
    <?php if(isset($_GET['succ']) && $_GET['succ']==2) { ?>
    <tr>
      <td colspan="3" class="style1"><div align="center" class="style9 style1">User updated successfully.</div></td>
    </tr>
    <?php } ?>
    <?php if(isset($_GET['del']) && $_GET['del']==1) { ?>
    <tr>
      <td colspan="3"class="style1"><div align="center" class="style9 style1">User deleted successfully.</div></td>
    </tr>
    <?php } ?>
    <?php if(isset($_GET['exst']) && $_GET['exst']==1) { ?>
    <tr>
      <td colspan="3" class="style2"><div align="center" class="style7 style2">User already exists with same username.</div></td>
    </tr>
    <?php } ?>
    <?php if(isset($_GET['invalid']) && $_GET['invalid']==1) { ?>
    <tr>
      <td colspan="3" class="style2"><div align="center" class="style7 style2">Invalid Access</div></td>
    </tr>
    <?php } ?>    <tr>
      <td width="41%" class="style8"><div align="right">Name</div></td>
      <td width="5%" class="style8"><div align="center">:</div></td>
      <td width="54%"><label>
        <input name="name" type="text" id="name" size="30" value="<?php if(isset($rowm)){ echo $rowm['name']; } ?>"/>
      </label></td>
    </tr>
    <tr>
      <td class="style8"><div align="right">Details</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <textarea name="details" cols="30" rows="3" id="details"><?php if(isset($rowm)){ echo $rowm['details']; } ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td class="style8"><div align="right">UserName</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="username" type="text" id="username" size="30" value="<?php if(isset($rowm)){ echo $rowm['username']; } ?>" />
      </label></td>
    </tr>
    <tr>
      <td class="style8"><div align="right">Password</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="password" type="text" id="password" size="30" value="<?php if(isset($rowm)){ echo $rowm['password']; } ?>" />
      </label></td>
    </tr>
	<?php
	$sroty1=executework("select * from tob_location where tfield='State' and precatid=0");
	$cnt1=@mysqli_num_rows($sroty1);
	//echo "select name from tob_location where tfield='State' precatid=0";
	//echo $cnbt=@mysqli_num_rows($sroty1);
	//print_r($sts);
	//$sts=array('Andhra Pradesh', 'Karnataka');
	?>
    
    <tr>
      <td class="style8"><div align="right">States</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td class="style8">
	<?php
	if($cnt1 >0)
	{
	$j=1;
	?>
	  <table width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
         
	<?php
	  while($stsdf=@mysqli_fetch_array($sroty1))
	  {
	  	//$arr=array();
		if(isset($rowm) && in_array($stsdf['id'],$arr))
	  	$chk1='checked="checked"';		
	  	else
	 	$chk1='';
		//echo $chk1;
		
		//print_r($chk1);
	  ?>
	  <td><input name="check_box[]" type="checkbox" id="check_box[]" value="<?php echo $stsdf['id']; ?>"<?php echo $chk1;?>    />
		<?php echo $stsdf['name']; ?>
        </td>
	     <?php
		// echo $j;
		 $j++;
		  if($j>=5)
		  {
		  	$j=1;
		  ?>
        </tr>
			<tr>
  <?php
		   }
	   }
   }
		if($j<=4)
		{
			for($k=$j;$k<=4;$k++)
			{
				echo "<td>&nbsp;</td>";
			}
		}
   //}
  ?>
  	</tr>
 </table>

	  
	  </td>
    </tr>
    
	<?php
	$details=array('ADD','VIEW','MODIFY','DELETE','PRINT');
	?>
    <tr>
      <td height="33" class="style8"><div align="right">Permissions(can select multiples) </div></td>
      <td class="style8"><div align="center">:</div></td>
      <td class="style8">
	  <?php
	  for($i=0;$i<count($details);$i++)	
	  {
	  	if(isset($rowm) && in_array($details[$i],$perm))
	  	$chk='checked="checked"';		
	  	else
	 	$chk='';
	  	/*if(in_array($_POST['chick_list[]'],$subjec[$i]))
	  	$chk='checked="checked"';		
	  	else
	 	 $chk='';*/
	 	 ?>	 
   	    <input name="check_list[]" type="checkbox" id="check_list[]" value="<?php echo $details[$i] ?>" <?php echo $chk; ?>  />
		<?php echo  $details[$i]; ?>
    <?php
		} 
		/*foreach($_POST['check_list[]'] as $selected)
		echo "$selected";*/
		?>    </tr>
		<?php
	  	if(!empty($rowm['disable']))
	  	$chked='checked="checked"';		
	  	else
	 	$chked='';
		?>
    <tr>
      <td class="style8"><div align="right">disable</div></td>
      <td class="style8"><div align="center">:</div></td>
      <td><label>
        <input name="status" type="checkbox" id="status" value="1" <?php echo $chked; ?>  />
      </label></td>
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
   $selecty=executework("select * from tob_employeeview");
   $cnt=@mysqli_num_rows($selecty);
   if($cnt >0)
   {
  ?>
  &nbsp;
  <table width="100%" height="61" border="1" cellpadding="1" cellspacing="1">
    <tr class="style8">
      <td width="8%"><div align="center"><strong>S.No</strong></div></td>
      <td width="22%"><div align="center"><strong>Name</strong></div></td>
      <td width="21%"><div align="center"><strong>Details</strong></div></td>
      <td width="23%"><div align="center"><strong>UserName</strong></div></td>
      <td width="23%"><div align="center"><strong>State</strong></div></td>
      <td width="26%"><div align="center"><strong>Permissions</strong></div></td>
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
		
		$stry=$row['state'];
		//$cm=str_split($row['state'],$stry);
		//print_r($cm);
	$slet=executework("select group_concat(name) as strat from tob_location where id in(".$row['state'].")");
	//echo "select group_concat(name) as strat from tob_location where id in(".$row['state'].")";
	$rowtt=@mysqli_fetch_array($slet);
	//$slet=executework("select * group_concat('".$row['state']."') as strat from tob_location");
		
	
	//$sperm=explode(',',$rowtt['name']);
	//print_r($sperm);
	?>
    <tr class="style17">
      <td><div align="center"><?php echo $i ?></div></td>
      <td><div align="center"><?php echo $row['name'] ?></div></td>
      <td><div align="center"><?php echo $row['details'] ?></div></td>
      <td><div align="center"><?php echo $row['username'] ?></div></td>
      <td><div align="center"><?php echo $rowtt['strat'] ?></div></td>
      <td><div align="center"><?php echo $row['permissions'] ?></div></td>
      <td class="style4"><div align="center"><?php echo $stat ?></div></td>
      <td class="style4"><div align="center">
          <input type="button" name="button<?=$row['id']; ?>" id="button<?=$row['id']; ?>" value="Modify" onclick="modify_user('<?=$row['id']; ?>');" />
      </div></td>
      <td class="style4"><div align="center">
          <label>
          <input type="button" name="button" id="button" value="Delete" onclick="delete_user('<?=$row['id']; ?>');" />
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
