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
<title>Change Password | Welcome toTOBBACCO BOARD... Admin</title>
<style type="text/css">
<!--
.style51 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;}
.style27 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #FF0000; }
.style88 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
</head>
<script type="text/javascript">
function valid(form1)
{
	 if(trimString(document.form1.oldpass.value)=="")
	{
		alert("Enter Old Password");
		document.form1.oldpass.value="";
		document.form1.oldpass.focus();
		return false;
	}
	else if(trimString(document.form1.newpass.value)=="")
	{
		alert("Enter New Password");
		document.form1.newpass.value="";
		document.form1.newpass.focus();
		return false;
	}
	else if(trimString(document.form1.conpass.value)=="")
	{
		alert("Enter Confirm Password");
		document.form1.conpass.value="";
		document.form1.conpass.focus();
		return false;
	}
	else if((trimString(document.form1.newpass.value))!=(trimString(document.form1.conpass.value)))
	{
		alert("New Password and confirm Password Not Match");
		document.form1.conpass.value="";
		document.form1.conpass.focus();
		return false;
	}
	else 
	return true;
}	

	function trimString(str)
	{
		while (str.charAt(0) ==' ')
		str = str.substring(1);
		while (str.charAt(str.length - 1) == ' ')
		str = str.substring(0, str.length - 1);
		return str;
	}

</script>
<body>
<?php
	if (!empty($_POST['oldpass']))
	{
		$sql=executework("select password from tob_admin where admin='".$_SESSION['tobadmin']."' and password='" .$_POST['oldpass'] . "'");
		$count=@mysqli_num_rows($sql);
		if($count > 0)
		{
			$sq11=executework("update tob_admin set password='".$_POST['newpass'] ."' where admin='".$_SESSION['tobadmin']."'");
			$succ=1;
		}
		else
		{
			$exist=1;
		}
	}	

?>
<?php include_once("header.php");?>
<form id="form1" name="form1" method="post" action="" onsubmit="return valid(this);">
  <table width="80%" border="0" align="center">
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style88">Change Password</span> </td>
    </tr>
    
    
	<?php
		if(!empty($succ))
		{
	?>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><div align="center" class="style27">The Password Changed Successfully&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
    </tr>
    <?php
		}
		else if(!empty($exist))
		{
	?>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><div align="center" class="style27">The Old Password is Wrong&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
    </tr>
	<?php
		}
	?>
    <tr>
      <td width="287">&nbsp;</td>
      <td width="60">&nbsp;</td>
      <td width="419">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right" class="style51">Old Password </div></td>
      <td><div align="center"><strong>:</strong></div></td>
      <td><label>
        <input name="oldpass" type="password" id="oldpass" />
      </label></td>
    </tr>
    <tr>
      <td><div align="right" class="style51">New Password </div></td>
      <td><div align="center"><strong>:</strong></div></td>
      <td><label>
        <input name="newpass" type="password" id="newpass" />
      </label></td>
    </tr>
    <tr>
      <td><div align="right" class="style51">Confirm Password </div></td>
      <td><div align="center"><strong>:</strong></div></td>
      <td><label>
        <input name="conpass" type="password" id="conpass" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><label>
      <input type="submit" name="Submit" value="Submit" />
      </label></td>
    </tr>
    <tr>
      <td height="50">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
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
