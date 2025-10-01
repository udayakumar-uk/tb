<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if($_SESSION['tobadmin']!="")
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 17px;
	font-weight: bold;
}
.style2 {font-size: 15px}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
-->
</style>
</head>
<script type="text/javascript">
function psback(st1)
{	
	document.form1.action="imagelist.php?page_index="+st1;
	document.form1.submit();
	return false;
}
/*function rmv(st1,st2,st3)
{	
	document.form1.action="pimagemod.php?page_index="+st1+"&title="+st2+"&delid="+st3;
	document.form1.submit();
	return false;
}
*/
function rmv(st)
{	
	document.getElementById("pimage"+st).value="";
	return;
}
function chkbox(st)
{
	var n=document.form1.k.value;
	if(document.getElementById("sta"+st).checked==true)
	{
		for(i=1;i<=n;i++)
		{
			if(st!=i)
			{
				document.getElementById("sta"+i).checked=false;
			}
		}
	}
}
</script>
<body>
<?php
	if($_GET['delid']!='')
	{
	
		$sea=executework("select * from tob_images where id='". $_GET['delid'] ."'");
		$cnta=@mysqli_num_rows($sea);
		echo "cnt=".$cnta;
		if($cnta>0)
		{
			$rowa=@mysqli_fetch_array($sea);
			$selp=executeupdate("delete from tob_images where id='". $_GET['delid'] ."'");
			$omg="photogallery/oimages/".$rowa['image'];
			$tmg="photogallery/thimages/".$rowa['image'];
			echo "omm=".$omg."--".$tmg;
			if(file_exists($omg))
			unlink($omg);
			if(file_exists($tmg))
			unlink($tmg);
			$selimg=executework("select * from tob_images where title='".$_GET['title']."'");
			$cntm=@mysqli_num_rows($selimg);
			if($cntm>0)
			redirect("pimagemod.php?page_index=".$_GET['page_index']."&title=".$_GET['title']);
			else
			redirect("imagelist.php?succ=5");
		}
	}
if(!empty($_GET[pedit]))
{
	if($_GET[pedit]=='editimage')
	{
		$cnt1=$_POST[k];
		for($i=1;$i<=$cnt1;$i++)
		{
			$pimage="pimage".$i; 
			$id="ids".$i;
			$target_pathn ="photogallery/oimages/";
			$f1="";
			$f2="";
			if (!empty($_FILES[$pimage]['name']))
			{
					$f=basename($_FILES[$pimage]['name']);
					$len=strlen($f);
					$pos=strpos($f,'.');
					$ext=substr($f,$pos,$len);
					echo "et=".$ext."--".$pos;
					$target_pathsmn = $target_pathn .$_POST[$id].$ext; 
					$f1=$_POST[$id].$ext; 
				
				if(file_exists($f1))
				unlink($f1);
				move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
				$f2=" image='$f1',";
				
			$add="photogallery/oimages/$f1";
			$tsrc="photogallery/thimages/$f1";
	
					$width="";
					$height="";
					$thumb_height = 600;
					
					// Content type
					header('(anti-spam-(anti-spam-content-type:)) image/jpeg');
					
					// Get new sizes
					list($width, $height) = getimagesize($add);
					$ratio = ($height/$width);
					$newwidth = ($thumb_height/$ratio);
					$newheight = $thumb_height;

			$n_width=$newwidth; // Fix the width of the thumb nail images
			$n_height=$newheight; // Fix the height of the thumb nail imaage
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
			if($_FILES[$pimage][type]=="image/jpeg"){
			$im=ImageCreateFromJPEG($add);
			$width=ImageSx($im); // Original picture width is stored
			$height=ImageSy($im); // Original picture height is stored
			$newimage=imagecreatetruecolor($n_width,$n_height);
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			ImageJpeg($newimage,$tsrc);
			chmod("$tsrc",0777);
			}
				
			}	
/*			if($i==$_POST[sta])
			$sta=1;
			else
			$sta=0;
*/			
				if($_POST['sta'.$i]==1)
				$sta=1;
				else
				$sta=0;
				$selp=executeupdate("update tob_images set $f2 status='$sta' where id=".$_POST[$id]);
			$succ=$i;
		}
		if(!empty($succ))
		redirect("imagelist.php?succ=4");
	}
}
?>
<?php
	if(!empty($_GET[title]))
	{
		$sel=executework("select * from tob_images where title='". $_GET[title] ."' order by status desc");
		$count=@mysqli_num_rows($sel);
		if($count>0)
		{
?>
<?php include_once("header.php");?>
<table width="95%" border="0" align="center">
  <tr>
    <td colspan="3"><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return pi_check(this);">
      <table width="95%" border="0" align="center">
        <tr>
          <td width="26%">&nbsp;</td>
          <td width="66%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><span class="style1">Album Images For <?php echo $_GET[title];?></span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
		<?php
			$i=1;
			while($row1=@mysqli_fetch_array($sel))
			{
				$chec="";
				
				//echo "cc=".$row1[status];
				if($row1[status]==1)
				$chec="checked=checked";
				else
				$chec="";
		?>
        <tr>
          <td><div align="center" class="style3">Album Image <?php echo $i?></div></td>
          <td>
			<img src="photogallery/thimages/<?php echo $row1[image] ?>" width="75" height="50" /><br />
            <input name="pimage<?php echo $i?>" type="file" id="pimage<?php echo $i?>" value="<?php echo $row1[pimage]?>" />
			<a class="style6" style="cursor:pointer" onclick="rmv('<?php echo $i ?>');">Remove</a> <input type="hidden" name="ids<?php echo $i?>" value="<?php echo $row1[id]?>" />
            &nbsp;&nbsp; 
            <input name="sta<?php echo $i;  ?>" type="checkbox" id="sta<?php echo $i;  ?>" onchange="chkbox('<?php echo $i ?>');" value="1" <?php echo $chec ?> >
			
            <span class="style3">Main Product Image</span> </td>
        </tr>
		<?php
			 $i++;
			}
		?>
        <tr id="ad" style="visibility:hidden; position:absolute;">
          <td>&nbsp;</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" name="Submit2" value=" Add More " onclick="add_chng3();" />          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input type="submit" name="Submit" value=" Modify " />
            <input name="k" type="hidden" id="k" value="<?php echo $count?>" />
            <input name="pi_subm" type="hidden" id="pi_subm" />
            <input name="mid" type="hidden" id="mid" value="<?php echo $_GET[mid]?>" />
            <input name="type" type="hidden" id="type" value="edit" />
            <input type="button" name="Button" value="  Back  " onclick="psback('<?php echo $_GET[page_index]?>');" /></td>
        </tr>
      </table>
        </form>
    </td>
    </tr>
</table>
<?php include_once("footer.php");?>
<?php
	}
}
?>
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