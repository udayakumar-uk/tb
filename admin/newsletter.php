<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if($_SESSION['tobadmin']!="")
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Upload New Letter |Welcome To TOBBACO BOARD Admin</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style5 {color: #FF0000}
-->
</style>
</head>
<script type="text/javascript">
var xmlhttp,usd,tmp,flav,qty,str

function showHint(st)
{
	str=document.getElementById(st).value;
if (str.length==0)
  {
  document.getElementById(usd).innerHTML="";
  return;
  }
xmlhttp=GetXmlHttpObject();
if (xmlhttp==null)
  {
  alert ("Your browser does not support XMLHTTP!");
  return;
  }
var url="sub.php?tit="+str;
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
	var value=xmlhttp.responseText;
	if(value=='')
	{
	}
	else
	{
		if(value>0)
		{
			alert(" Given Album Title Alredy Exist Select Title");	
			document.getElementById("pncat").value=" ";
			document.getElementById("pcat").focus();			
		}
		else 
		{
			document.getElementById("title").value=str;
		}
	}
  }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

function check(form1)
{
	if(document.form1.pcat.value=="" && document.form1.pncat.value=="")
	{
		alert(" New Album title Should Not Be Empty");
		document.form1.pncat.focus();
		return false;
	}
	else if(document.form1.pcat.value!="" && document.form1.pncat.value!="")
	{
		alert(" De-Select Album Title");
		document.form1.pcat.focus();
		return false;
	}
	else if(document.form1.pimage1.value=="")
	{
		alert("Browse Atleast One Image");
		document.form1.pimage1.focus();
		return false;		
	}
	else
	{
		var chk=0;
		var k=document.form1.k.value;
		for(i=1;i<k;i++)
		{
			var pimage="pimage"+i;
			var sta="sta"+i;
			var pi=document.getElementById(pimage).value;
			var plen=pi.length;
			var ppos=pi.indexOf(".");
			var ext=pi.substr(ppos+1,plen);
			var ext1=ext.toLowerCase();
			if(document.form1.type.value=='new')
			{
				for(j=0;j<document.form1.sta.length;j++)
				{
					if(document.form1.sta[j].checked)
					chk=document.form1.sta[j].value;
				}
			}
			st3="pimage"+chk;
			if(document.getElementById(pimage).value!="")
			{
				if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif')
				{
					alert("Only file types of jpg,jpeg,gif are allowed for Image");
					document.getElementById(pimage).value="";
					document.getElementById(pimage).focus();
					return false;
				}
/*				else if(chk==0 && document.form1.type.value=='new' && document.form1.title.value!="")
				{
					alert(" Select Album Cover Image ");
					return false;
				}
*/				else if(chk!="" && document.getElementById(st3).value=="" && document.form1.type.value=='new')
				{
					alert("Browse  Image");	
					document.getElementById(st3).focus();
					return false;
				}
			}
		}
		document.form1.pi_subm.value=1;
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
if(!empty($_POST[pi_subm]))
{
	$cnt1=$_POST[k];
	
	$size="";
	for($j=1;$j<=$cnt1;$j++)
	{
		$pimage1="pimage".$j; 
		if($size=="")
		$size=$_FILES[$pimage1]['size'];
		else 
		$size=$size+$_FILES[$pimage1]['size'];
	}
	if($size<=3300000)
	{
		for($i=1;$i<=$cnt1;$i++)
		{
			$date=date("Y-m-d");
			$pimage="pimage".$i; 
			$sta="sta".$i;
			
			if(!empty($_POST[pcat]))
			$titles=$_POST[pcat];
			else
			$titles=$_POST[pncat];
	
				$target_pathn = "newsletter/oimages/";
				$f1="";
		
					$intmax=executework("SELECT max(id) from tob_nletter");
					$cnt=@mysqli_num_rows($intmax);
					$row=@mysqli_fetch_array($intmax);
					if($row[0]!="")
					{
						$maxid=$row[0]+1;
					}
					else
					{
						$maxid=1;
					}
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .$maxid.basename( $_FILES[$pimage]['name']); 
					$f1=$maxid.basename( $_FILES[$pimage]['name']); 
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
				$add="newsletter/oimages/$f1";
				$tsrc="newsletter/thimages/$f1";
		
						$width="";
						$height="";
						$thumb_height = 120;
						
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
				$pselect=executework("select * from tob_nletter where title='". $titles ."' and pimage='$f1'");
				$pcount=@mysqli_num_rows($pselect);
				if($pcount>0)
				{
					$exist=1;
				}
				else
				{
					if($i==$_POST[sta] && !empty($_POST[sta]))
					$sta=1;
					else if($i==1 && empty($_POST[sta]) && empty($_POST[pcat]))
					$sta=1;
					else
					$sta=0;
	
					if(!empty($f1))
					{
						$psel=executeupdate("insert into tob_nletter values($maxid,'". $titles ."','$f1','$sta','$date')");
						$succ=1;
					}
				}
		}
			if(!empty($succ))
			redirect("newsletter.php?succ=1");
			else if(!empty($exist))
			redirect("newsletter.php?exist=1");
	}
	else
	{
		$exist=3;
	}
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
  <table width="90%" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Upload News Letter </span> </td>
    </tr>
	<?php
		if(!empty($_GET[succ]))
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:120px;">
	  	<div align="left" class="style4 style5">New News Letter Created Successfully</div>
	  </td>
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
      <td colspan="3"><table width="90%" border="0" align="center">
        <tr>
          <td width="15%"><span class="style4">News Letter  Title </span></td>
          <td width="10%"><div align="center"><strong>:</strong></div></td>
          <td width="75%">
		  <?php
		  	$catselect=executework("select distinct title from tob_nletter order by title");
			$ccnt=@mysqli_num_rows($catselect);
		  ?>
            <select name="pcat" id="pcat" onchange="return chng();" style="width:250px;">
				<option value="">Select News Letter Title</option>
				<?php
					if($ccnt>0)
					{
						while($crow=@mysqli_fetch_array($catselect))
						{
				?>	
					<option value="<?php echo $crow[title]?>"><?php echo $crow[title]?></option>
				<?php
						}
					}
				?>
            </select>
			<?php
			if($_POST[pcat]!="")
			{
			?>
				  <script type="text/javascript">
			 var pcats='<?php echo $_POST[pcat] ?>';
			 var j;
			for(j=1;j<=document.form1.pcat.options.length;j++)
			{
				if(document.form1.pcat.options[j].value==pcats)
				{
					document.form1.pcat.options[j].selected=true;
				}
			}
			</script>
		  <?php
			}
		  ?>          </td>
        </tr>
        <tr>
          <td><span class="style4">New  Title </span></td>
          <td><div align="center"><strong>:</strong></div></td>
          <td><label>
            <input name="pncat" type="text" id="pncat" size="40" onchange="showHint('pncat')" />
          </label></td>
        </tr>
		<?php
			for($i=1;$i<=10;$i++)
			{
		?>
        <tr>
          <td><span class="style4">Image <?php echo $i;?></span></td>
          <td><div align="center"><strong>:</strong></div></td>
          <td>
            <input name="pimage<?php echo $i;?>" type="file" id="pimage<?php echo $i;?>" />
			<?php
				if(empty($_POST[pcat]))
				{
			?>
        	   <input name="sta" type="radio" value="<?php echo $i;?>" />
				<span class="style4">New Letter  Main Image </span> 
			<?php
				}
			?>          </td>
        </tr>
		<?php
			}
			if(!empty($_POST[pcat]))
			$value="";
			else
			$value="new";
		?>
        <tr>
          <td class="style4">Upload PDF </td>
          <td class="style4"><div align="center">:</div></td>
          <td><label>
            <input name="pdf" type="file" id="pdf" />
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="40"><label></label></td>
          <td>
            <input type="submit" name="Submit" value="Submit" />
         
            <input name="k" type="hidden" id="k" value="<?php echo $i;?>" />
            <input name="pi_subm" type="hidden" id="pi_subm" />
            <input name="type" type="hidden" id="type" value="<?php echo $value;?>" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
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
