<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{
if(!empty($_POST['pcat']))
$pcat=$_POST['pcat'];
else if(!empty($_GET['titid']))
$pcat=$_GET['titid'];
else
$pcat='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New Album |Welcome To TOBBACO New Album |Welcome To TOBBACO BOARD Admin BOARD Admin</title>
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
<script src="../jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />
</head>
<script>
function moveto(st,st1)
{
	document.form1.action="modphotogallery.php?movid="+st+"&act="+st1;
	document.form1.submit();
}
/// http Object funtion for ajax
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
	var xmlhttp,str1
function homecheck(str,st1)
{
	str1=document.getElementById(str).checked;
	if(str1==true)
	st=1;
	else
	st=0;
	xmlhttp= new XMLHttpRequest();
	if (xmlhttp==null)
	{
		alert ("Your browser does not support XMLHTTP!");
		return false;
	}
	
	var url="ajax.php?st="+st+"&st1="+st1;
	xmlhttp.onreadystatechange=stateChangedu;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
  
}

function stateChangedu()
{
if (xmlhttp.readyState==4)
  {
	var value=xmlhttp.responseText;
	var values=value.split('~');
	var valuen=new Array();
	var value1=new Array();
	if(value=='')
	{
	}
	else
	{
		for(i=0;i<values.length;i++)
		{
			valuen=values[i].split('=');
			var fld=valuen[0];
			value1[fld]=valuen[1];
			if(fld=="img" && value1[fld]==0)
			{
				
				alert("Invalid Image Location");
				return false;			
			}
			
		}
		
	}
  }
}
</script>
<script type="text/javascript">
function check(form1)
{
	if(document.form1.pncat.value=="")
	{
		alert("Please Enter Album English Title");
		document.form1.pncat.focus();
		return false;
	}
	if(document.form1.hpncat.value=="")
	{
		alert("Please Enter Album Hindi Title");
		document.form1.pncat.focus();
		return false;
	}		
	else
	{		
		document.form1.subm.value=1;
		return true;	
	}	
}
</script>
<body>
<?php include_once("header.php");?>
<?php
	function datepattrn($a)
	{
 		$b = substr($a,5, 2);// month
 		$c = substr($a,7, 1);// '-'
		$d= substr($a,8, 2);// day
		$e = substr($a,4, 1);// '-'
 		$f = substr($a,0, 4);// year
		$c="-";
		$e="-";
		$g=$d."/".$b."/".$f;
		return $g;
	}
	function datepattrn1($a)
	{
 		$b = substr($a,3, 2);// month
 		$c = substr($a,2, 1);// '-'
		$d = substr($a,0, 2);// day
		$e = substr($a,5, 1);// '-'
 		$f = substr($a,6, 4);// year
		$c="-";
		$e="-";
		$g=$f."/".$b."/".$d;
		return $g;
	}
	if(!empty($_GET['movid']))
	{	
		$selrec1=executework("select * from  tob_images where id='".$_GET['movid']."'");
		$rowrec1=@mysqli_fetch_array($selrec1);
		if($_GET['act']=='up')
		$qry="where position < ".$rowrec1['position']." and titleid=".$rowrec1['titleid']." order by position desc limit 1";
		if($_GET['act']=='down')
		$qry="where position > ".$rowrec1['position']." and titleid=".$rowrec1['titleid']." order by position Asc limit 1";
		
		$selqry=executework("select * from tob_images ".$qry."");
		echo "select * from tob_images ".$qry."";
		$rowqry=@mysqli_fetch_array($selqry);
		
		$temp=$rowqry['position'];
		echo "idd=".$rowqry['id']."--".$rowrec1['id']."--".$temp;
		$upd1=executework("update tob_images set position='".$rowrec1['position']."' where id='".$rowqry['id']."'");
		$upd2=executework("update tob_images set position='".$temp."' where id='".$rowrec1['id']."'");
		echo "update tob_images set position='".$rowrec1['position']."' where id='".$rowqry['id']."'";
		redirect("modphotogallery.php?titid=".$rowrec1['titleid']."");
	}
	if(!empty($pcat))
	{
		$seltit=executework("select * from tob_album_title where id='".$pcat."'");
		$rowtit=@mysqli_fetch_array($seltit);
		$selimg=executework("select * from tob_images where titleid='".$pcat."' order by position asc");
		$cimg=@mysqli_num_rows($selimg);
	}
	$dat=date('Y-m-d');
	if(!empty($_POST['subm']))
	{
		$upd=executework("update tob_album_title set title='".$_POST['pncat']."',htitle='".$_POST['hpncat']."',updated_on='".$dat."' where id='".$pcat."'");
		redirect("modphotogallery.php?succ=success");
	}
?>
<form action="modphotogallery.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
  <table width="90%" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Modify Albums </span> </td>
    </tr>
	    <tr>
      <td height="40" colspan="3" style="padding-left:120px;">&nbsp;</td>
    </tr>
	<?php			
	if(!empty($_GET['succ']) && $_GET['succ']=='success')
	{
	?>
    <tr>
      <td colspan="3"><div align="center" class="style4 style5"> Album Title Modified Successfully </div></td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td colspan="3"><table width="90%" border="0" align="center">
        <tr>
          <td width="18%"><span class="style4">Albums</span></td>
          <td width="7%"><div align="center"><strong>:</strong></div></td>
          <td width="75%">
		  <?php
		  	$catselect=executework("select * from tob_album_title order by id");
			//$ccnt=@mysqli_num_rows($catselect);
		  ?>
		  <select name="pcat" id="pcat" onchange="form1.submit();" style="width:250px;">
            <option value="">Select Album</option>
           	   <?php					
				while($crow=@mysqli_fetch_array($catselect))
				{
				?>
           			 <option value="<?php echo $crow['id'] ?>"><?php echo $crow['title'] ?></option>
            	<?php
				}				
				?>
          </select>
		    <?php
			if($pcat!="")
			{
			?>
			 <script type="text/javascript">
			 var pcats='<?php echo $pcat ?>';
			 var j;
			for(j=0;j<document.form1.pcat.options.length;j++)
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
          <td><span class="style4">New Album Title </span></td>
          <td><div align="center"><strong>:</strong></div></td>
          <td><label>
            <input name="pncat" type="text" id="pncat" size="40" value="<?php if(!empty($rowtit['title'])) echo $rowtit['title'] ?>"/>
          </label></td>
        </tr>
        <tr>
          <td><span class="style4">New Album Title (Hindi) </span></td>
          <td><div align="center"><strong>:</strong></div></td>
          <td><label>
            <input name="hpncat" type="text" id="hpncat" size="40" value="<?php if(!empty($rowtit['htitle'])) echo $rowtit['htitle'] ?>"/>
          </label></td>
        </tr>		
		<?php
		if($pcat!="")
		{
		?>
        <tr>
          <td>&nbsp;</td>
          <td height="40"><label></label></td>
          <td>
            <input type="submit" name="Submit" value="Submit" />
         
            <input name="k" type="hidden" id="k" value="<?php if(!empty($i)) echo $i;?>" />
            <input name="subm" type="hidden" id="subm" />
            <input name="type" type="hidden" id="type" value="<?php if(!empty($value)) echo $value;?>" /></td>
        </tr>
		<?php
		}
		?>
      </table></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
	<?php
		$i=1;
	if(!empty($cimg) && $cimg >0)
	{
	?>
    <tr>
      <td colspan="3"><table width="686" height="25" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#0066FF">
	  
        <tr>
        
        <?php
		$imgcnt=1;
		$x=1;
		while($rowimg=@mysqli_fetch_array($selimg))
	  	{
			if($rowimg['cover']==1)
			$chkd="checked=true";
			else
			$chkd="";
	   ?>
<td width="200">
<div align="center">

<p>
<img src="../tbdata/photogallery/thimages/<?php echo $rowimg['image'] ?>" height="100" width="100"/><br />
<br />
<span class="style4">
Home :
<label>

<input name="hom<?php echo $x ?>" type="checkbox" id="hom<?php echo $x ?>" value="1" onchange="homecheck(this.id,'<?php echo $rowimg['id'] ?>');" <?php echo $chkd ?> />
                </label>
                <input name="pid<?php echo $x ?>" type="hidden" id="pid<?php echo $x ?>" value="<?php echo $rowimg['id'] ?>" />
</span></p>
            <p><?php
		  if($i!=1)
		  {	
		  ?>
	   <a href="#" onclick="moveto('<?php echo $rowimg['id'] ?>','up');"><img src="tob2_imgs/leftarrow.png" width="40" height="40" /></a>
<?php
		  }
		  if($i!=$cimg)
		  {
		  ?>
<a href="#" onclick="moveto('<?php echo $rowimg['id'] ?>','down');"><img src="tob2_imgs/rightarrow.png" width="40" height="40" /></a>
<?php
		  }
		  ?>
</p>

</div>
</td>

<?php
		  if($imgcnt==4)
		  {
		  	$imgcnt=0;
		  ?>
</tr>

		  <tr>
		   <td>&nbsp;</td>
		   <td>&nbsp;</td>
		    <td>&nbsp;</td>
			 <td>&nbsp;</td>
		  </tr>
			 <tr>		 
		  <?php
		  }
		  $i++;
		  $imgcnt++;
		  $x++;
	  }
		  ?>
        </tr>
		<?php
	}
	else
	{
		if($pcat!="")
		{
	?>
    <tr>
      <td colspan="3"><div align="center" class="style4 style5">No Images Found In This Album</div></td>
    </tr>
	<?php
		}
	}
	?>
      </table></td>
    </tr>
  </table>
</form>
<script>
jQuery('#adate').datepicker();
jQuery('#adate').readOnly=true;
</script>
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
