<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
	if(!empty($_FILES['fil']['name']))
	{
	$sel=executework("select max(id) from tob_upload");
	$fe=mysqli_fetch_array($sel);
	if($fe[0]!="")
	{
	$maxid=$fe[0]+1;
	}
	else
	{
	$maxid=1;
	}

$target_path="pdf/";
//$target_path1="/../pdf/";
$nam=basename($_FILES['fil']['name']);
$len=strlen($nam);
	$pos=strpos($nam,'.');
	$ext=substr($nam,$pos,$len);
	$img=$nam;
//	$iamg='fil'.$img;
	$target_path=$target_path.$img;
//	$target_path1=$target_path1.$iamg;
//echo "fil=".$target_path;
if(file_exists($target_path))
{
unlink($target_path);
}
//if(file_exists($target_path1))
//{
//unlink($target_path1);
//}
move_uploaded_file($_FILES['fil']['tmp_name'],$target_path);
//move_uploaded_file($_FILES['fil']['tmp_name'],$target_path1);

$ins=executework("insert into tob_upload values('".$maxid."','".$iamg."',1)");
		$se=1;
		redirect("upload.php?sec=".$se);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php include_once('header.php');
?>
<table width="94%" cellspacing="0" cellpadding="0">
  <tr>
    <td height="130"><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table width="100%" cellspacing="0" cellpadding="0">
        <?php
		if(!empty($_GET['sec']) && $_GET['sec']==1)
		{
		?>
		<tr>
          <td height="41" colspan="3"><div align="center" class="style1">File Successfully Uploaded </div></td>
          </tr>
		  <?php
		  }
		  ?>
          <tr>
            <td height="37">&nbsp;</td>
            <td>&nbsp;</td>
            <td>Path: admin/pdf </td>
          </tr>
           <tr>
          <td width="43%" height="37"><div align="right">Select Path</div></td>
          <td width="3%"><div align="center">:</div></td>
          <td width="54%"><select name="path" id="path">
          				<option value="../tbdata/newsfiles/">newsfiles</option>
                        <option value="../tbdata/latest/">latest</option>
                        <option value="../tbdata/newsfiles/">newsfiles</option>
                        <option value="../tbdata/newsfiles/">newsfiles</option>
                        <option value="../tbdata/newsfiles/">newsfiles</option>
                        <option value="../tbdata/newsfiles/">newsfiles</option>
                        <option value="../tbdata/newsfiles/">newsfiles</option>
                        <option value="../tbdata/newsfiles/">newsfiles</option>
          
          </select></td>
        </tr>
          <tr>
          <td width="43%" height="37"><div align="right">Upload File </div></td>
          <td width="3%"><div align="center">:</div></td>
          <td width="54%"><input name="fil" type="file" id="fil" /></td>
        </tr>
        <tr>
          <td height="46">&nbsp;</td>
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" value="Submit" /></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
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