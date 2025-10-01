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
<title>Upload Slide | Welcome toTOBBACCO BOARD... Admin</title>
<style type="text/css">
<!--
.style51 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;}
.style88 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
.style89 {color: #FF0000}
-->
</style>
</head>
<script type="text/javascript">
function valid(form1)
{
	if(document.form1.stype.value=="")
	{
		alert("Slide No Should Not Be Empty");
		document.form1.stype.focus();
		return false;
	}
	else if((document.form1.stype.value=='slide4' || document.form1.stype.value=='slide5' || document.form1.stype.value=='slide6') && document.getElementById("image1").value=="")
	{
		alert("Browse Slide Image");
		document.getElementById("image1").focus();
		return false;
	}
	else if((document.form1.stype.value=='slide1' || document.form1.stype.value=='slide2' || document.form1.stype.value=='slide3') && document.getElementById("image1").value=="" && document.getElementById("image2").value=="")
	{
		alert("Browse Slide Image");
		return false;
	}
/*	else if(document.getElementById("image1").value=="")
	{
		alert("Browse Slide Image1");
		document.getElementById("image1").focus();
		return false;
	}
*/	else
	{
		if(document.form1.stype.value=='slide1' || document.form1.stype.value=='slide2' || document.form1.stype.value=='slide3')
		var k=2;
		else
		var k=1;
		for(i=1;i<=k;i++)
		{
			var pimage="image"+i;
			var pi=document.getElementById(pimage).value;
			var plen=pi.length;
			var ppos=pi.indexOf(".");
			var ext=pi.substr(ppos+1,plen);
			var ext1=ext.toLowerCase();		

				if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && document.getElementById(pimage).value!="")
				{
					alert("Only file types of jpg,jpeg,gif are allowed for Slide Image");
					document.getElementById(pimage).value="";
					document.getElementById(pimage).focus();
					return false;
				}
		}
		document.form1.subm_slide.value=1;
		return true;	
	}
}
function chng()
{
	document.form1.submit();
}
</script>
<body>
<?php include_once("header.php");?>
<?php
	if(!empty($_POST['subm_slide']))
	{
		$sel=executework("select * from tob_imageslide where slideno='".$_POST['stype']."'");
		$rsel=@mysqli_fetch_array($sel);
		
		$cnt1=2;
		for($i=1;$i<=$cnt1;$i++)
		{
			$pimage="image".$i; 
				$id="ids".$i;
				$target_pathn ="slide_images/";
				$dimage="slide_images/".$rsel[$pimage];
				$f1="";
				$f2="";
				if (!empty($_FILES[$pimage]['name']))
				{
					if(!empty($rsel[$pimage]))
					unlink($dimage);

					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .$rsel[id]."_".$i.basename( $_FILES[$pimage]['name']); 
					$f1=$rsel[id]."_".$i.basename( $_FILES[$pimage]['name']); 
					if(file_exists($f1))
					unlink($f1);
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
					$f2=" $pimage='$f1'";
					
				$add="slide_images/$f1";
				$tsrc="slide_images/$f1";
		
				$n_width=163; // Fix the width of the thumb nail images
				$n_height=129; // Fix the height of the thumb nail imaage
				if ($_FILES[$pimage][type]=="image/gif")
				{
				$im=ImageCreateFromGIF($add);
				$width=ImageSx($im); // Original picture width is stored
				$height=ImageSy($im); // Original picture height is stored
				$newimage=imagecreatetruecolor($n_width,$n_height);
				imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
				if (function_exists("imagegif")) 
				Header("Content-type: image/gif");
				ImageGIF($newimage,$tsrc);
				chmod("$tsrc",0777);
				}////////// end of gif file thumb nail creation//////////
				
				////////////// starting of JPG thumb nail creation//////////
				if($_FILES[$pimage]['type']=="image/jpeg"){
				$im=ImageCreateFromJPEG($add);
				$width=ImageSx($im); // Original picture width is stored
				$height=ImageSy($im); // Original picture height is stored
				$newimage=imagecreatetruecolor($n_width,$n_height);
				imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
				ImageJpeg($newimage,$tsrc);
				chmod("$tsrc",0777);
				}
					
				}	
					$selp=executework("update tob_imageslide set $f2 where slideno='".$_POST['stype']."'");
				$succ=$i;
			}
			if(!empty($succ))
			redirect("upload_slides.php?succ=1");
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return valid(this);">
  <table width="80%" border="0" align="center">
    <tr>
      <td width="127">&nbsp;</td>
      <td width="73">&nbsp;</td>
      <td width="578">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="40" colspan="3"><span class="style88">Update Slide Images </span></td>
    </tr>
	<?php
		if(!empty($_GET['succ']))
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:120px;">
	  	<div align="left" class="style51 style89">Slide Images Updated Successfully </div>	  </td>
    </tr>
	<?php	
		}
		else
		{
	?>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	<?php
		}
	?>
    <tr>
      <td height="30"><div align="right" class="style51"> Slide No </div></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <select name="stype" id="stype" onchange="chng();">
          <option value="">Select Slide</option>
          <option value="slide1">Slide 1</option>
          <option value="slide2">Slide 2</option>
          <option value="slide3">Slide 3</option>
          <option value="slide4">Slide 4</option>
          <option value="slide5">Slide 5</option>
          <option value="slide6">Slide 6</option>
        </select>
        <strong>
        <?php
			if(!empty($_REQUEST['stype']))
			{
			?>
        <script language="JavaScript" type="text/javascript">
			 var stype='<?php echo $_REQUEST['stype'] ?>';
			 var i;
			for(i=0;i<document.form1.stype.options.length;i++)
			{
				if(document.form1.stype.options[i].value==stype)
				{
					document.form1.stype.options[i].selected=true;
				}
			}
			  </script>
        <?php
			}
			?>
        </strong>      </label></td>
    </tr>
	<?php
	if(!empty($_POST['stype']))
	{
		$select=executework("select * from tob_imageslide where slideno='". $_POST['stype'] ."'");
		$srow=@mysqli_fetch_array($select);
	}
	?>
    <tr>
      <td height="30"><div align="right" class="style51">Image 1  </div></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30">
	  	<?php if(!empty($srow['image1'])) {?><img src="slide_images/<?php echo $srow['image1'];?>" width="70" height="70" /><br /><?php }?>
        <input name="image1" type="file" id="image1" />
      </td>
    </tr>
	<?php
	if(!empty($_POST['stype']) && ($_POST['stype']=='slide1' || $_POST['stype']=='slide2' || $_POST['stype']=='slide3'))
	{
	?>
    <tr>
      <td height="30"><div align="right" class="style51">Image 2  </div></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30">
	  	<?php if(!empty($srow['image2'])) {?><img src="slide_images/<?php echo $srow['image2'];?>" width="70" height="70" /><br /><?php }?>
        <input name="image2" type="file" id="image2" />
      </td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30"><label>
        <input type="submit" name="Submit" value="  Update  " />
        <input name="subm_slide" type="hidden" id="subm_slide" />
        <input name="type" type="hidden" id="type" value="new" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
