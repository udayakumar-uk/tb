<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(isset($_SESSION["tobadmin"]) && $_SESSION['tobadmin']=='admin')
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<script>
	function validate() {
		if(document.form1.designation.value=="") {
			alert("Enter Designation");
			document.form1.designation.focus();
			return false;
		}
		else {
			return true;
		}
	}
</script>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style7 {font-size: 14px; color: #FF0000; font-family: Arial, Helvetica, sans-serif;}
.stylem {font-size: 14px; color:#0000FF; font-family: Arial, Helvetica, sans-serif;}
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
<body>
<?php
include_once("header.php");
if(isset($_POST['Submit']) && $_POST['Submit']!="")
{
	if($_POST['tid']!="")
	{
	executework("update tob_designation set designation='".mysqli_real_escape_string($_POST['designation'])."' where id='".mysqli_real_escape_string($_POST['tid'])."'");
		redirect("designation.php?succ=2");
	}
	else
	{
	executework("insert into tob_designation value('','".mysqli_real_escape_string($_POST['designation'])."')");
		redirect("designation.php?succ=1");
	}	
}
if(isset($_GET['did']) && $_GET['did']!="")
{
	executework("delete from tob_designation where id='".mysqli_real_escape_string($_GET['did'])."'");
	redirect("designation.php?del=1");
}
if(isset($_GET['succ']) && $_GET['succ']==1)
$message="Designation added successfully";
else if(isset($_GET['succ']) && $_GET['succ']==2)
$message="Designation updated successfully";
else if(isset($_GET['del']) && $_GET['del']==1)
$message="Designation deleted successfully";
else
$message='';
?>
<form id="form1" name="form1" method="post" action="">
  <table width="98%" height="65" border="0" cellpadding="2" cellspacing="0">
  <?php
	if(isset($_GET['mid']) && $_GET['mid']!='')
	{
		$selty=executework("select * from tob_designation where id='".mysqli_real_escape_string($_GET['mid'])."'");
		$rowty=@mysqli_fetch_array( $selty);
	}
	if($message!='')
	{
  ?>
    <tr>
      <td colspan="3"><div align="center" class="stylem"><?php echo $message; ?></div></td>
    </tr>
    <?php
	}
	?>
    <tr>
      <td width="37%" class="style4"><div align="right">Add Designation </div></td>
      <th width="6%" class="style4"><div align="center">:</div></th>
      <td width="57%"><label>
        <input name="designation" type="text" id="designation" size="30" value="<?php if(isset($rowty)) echo $rowty['designation'] ?>" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="Submit" />
        <input name="tid" type="hidden" id="tid" value="<?php if(isset($_GET['mid'])) echo $_GET['mid'] ?>" />
      </label></td>
    </tr>
  </table>
�  
<table width="71%" border="1" align="center" cellpadding="2" cellspacing="0">
    <tr class="style8">
      <td><div align="center">S.No</div></td>
      <td><div align="center">Designation </div></td>
      <td><div align="center"></div></td>
      <td><div align="center"></div></td>
    </tr>
	<?php
	$sel=executework("select * from tob_designation");
	$i=1;
	while($row=@mysqli_fetch_array($sel))
	{
	?>
    <tr class="style4">
      <td><div align="center"><?php echo $i; ?></div></td>
      <td><div align="left"><?php echo $row['designation'] ?></div></td>
      <td><div align="center"><a href="designation.php?mid=<?php echo $row['id'] ?>"><input type="button" name="button" id="button" value="Modify" />
      </a></div></td>
      <td><div align="center"><a href="designation.php?did=<?php echo $row['id'] ?>"><input type="button" name="button" id="button" value="Delete" /></a></div></td>
    </tr>
	<?php
	$i++;
	}
	?>
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
