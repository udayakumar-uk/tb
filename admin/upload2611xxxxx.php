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

	if(!empty($_POST['eng_path']))
	$target_path=$_POST['eng_path'];
	if(!empty($_POST['hindi_path']))
	$target_path=$_POST['hindi_path'];
$nam=basename($_FILES['fil']['name']);
$len=strlen($nam);
	$pos=strpos($nam,'.');
	$ext=substr($nam,$pos,$len);
	$img=$nam;
//	$iamg='fil'.$img;
	$target_path=$target_path.$img;
//	$target_path1=$target_path1.$iamg;
exit();

if(file_exists($target_path))
{
unlink($target_path);
}
//if(file_exists($target_path1))
//{
//unlink($target_path1);
//}
echo move_uploaded_file($_FILES['fil']['tmp_name'],$target_path);

//move_uploaded_file($_FILES['fil']['tmp_name'],$target_path1);

$ins=executework("insert into tob_upload values('".$maxid."','".$iamg."',1)");
		$se=1;
		//redirect("upload.php?sec=".$se);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board,Guntur</title>
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
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


<script src="../js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function get_lang(lang)
{
	
	if(lang=='english')
	{
		
		$("#hindi_path").hide();
		$("#eng_path").show();
	}
	else if(lang=='hindi')
	{
		$("#eng_path").hide();
		$("#hindi_path").show();
	}
	
}
function check_file()
{
	
	if($('select#eng_path option:selected').val()!='')
	var path=$('select#eng_path option:selected').val();
	if($('select#hindi_path option:selected').val()!='')
	var path=$('select#hindi_path option:selected').val();
	
	var filess= $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
	var url=path+filess;
	
	$.ajax(url, { method: 'GET' }) .done(function(response) { 
	
	if(confirm("A file with given name already exits. Do you want to overwrite existing file with this?"))
	{
	 $("#form1").submit(); 
	} 
	else
	{ 
	  $("#form1")[0].reset();
	 // return false;
	} 
	}).fail(function(response) 
	{ 
		$("#form1").submit();  
	})
		return false;
}
</script>
<table width="94%" cellspacing="0" cellpadding="0">
  <tr>
    <td height="130"><form  method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return false;">
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
         <!-- <tr>
            <td height="37">&nbsp;</td>
            <td>&nbsp;</td>
            <td>Path: admin/pdf </td>
          </tr>-->
          
            <tr>
          <td width="43%" height="37"><div align="right">Select Language</div></td>
          <td width="3%"><div align="center">:</div></td>
          <td width="54%"><select name="lang" id="lang" onchange="get_lang(this.value);">
           <option value="">Select Language</option>
                        <option value="english">English</option>
                        <option value="hindi">Hindi</option>
          </select></td>
        </tr>
           <tr style="display:none" id="eng_path">
          <td width="43%" height="37"><div align="right">Select Path</div></td>
          <td width="3%"><div align="center">:</div></td>
          <td width="54%"><select name="eng_path" id="eng_path">
          				<option value="">Select Path</option>
                        <option value="https://tobaccoboard.com/tbdata/pdf/">pdf</option>
                        <option value="https://tobaccoboard.com/tbdata/images/">Images</option>
          </select></td>
        </tr>
        <tr style="display:none" id="hindi_path">
          <td width="43%" height="37"><div align="right">Select Path</div></td>
          <td width="3%"><div align="center">:</div></td>
          <td width="54%"><select name="hindi_path" id="hindi_path">
          				<option value="">Select Path</option>
                        <option value="https://tobaccoboard.com/tbdata/hindi/pdf">pdf</option>
                        <option value="https://tobaccoboard.com/tbdata/hindi/images/">Images</option>
                        <option value="https://tobaccoboard.com/tbdata/hindi/members/">Members</option>
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
          <td><input type="submit" name="Submit" value="Submit" onclick="check_file();" /></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
<div class="container">
<div class="row">
<div class="col-md-12">
</div>
</div>
</div>
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