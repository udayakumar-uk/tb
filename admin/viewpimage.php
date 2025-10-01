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
<title>Untitled Document</title>
<style type="text/css">
<!--
.style7 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.style10 {
	font-weight: bold;
}
-->
</style>
</head>
<script type="text/javascript">
function modfy3(st,st1,st2,st3)
{
	if(confirm("Are You Sure To Delete This Image Completely"))
	{
		location.href="viewpimage.php?iedit="+st+"&title="+st1+"&page_index="+st2+"&tit="+st3;

	}
}
function psback(st1)
{	
	document.form1.action="albumdelete.php?page_index="+st1;
	document.form1.submit();
	return false;
}
</script>
<body>
<?php
	if(!empty($_GET['iedit']) && $_GET['iedit']=='delet')
	{
		$selche=executework("select * from tob_images where id=".($_GET['title']));
		$rche=@mysqli_fetch_array($selche);
		if($rche['cover']==1)
		{
			$sel12=executework("select min(id) as id from tob_images where titleid='".($rche['titleid'])."'");
			$row12=@mysqli_fetch_array($sel12);
			$ids=$row12['id'];
			$selp=executework("delete from tob_images where id=".($_GET['title'])."");
			$selu=executework("update tob_images set cover=1 where id=".($ids));
			redirect("viewpimage.php?title=".$_GET['tit']."");
		}
		else
		{
			$dir = "../tbdata/photogallery/oimages/";
			$dir1 = "../tbdata/photogallery/thimages/";
			$filename = $rche[image];
			unlink ($dir.$filename);
			unlink ($dir1.$filename);
			$selp=executework("delete from tob_images where id=". ($_GET['title']) ."");
			redirect("viewpimage.php?title=".$_GET['tit']."");
		}
	}
	if(!empty($_GET['title']))
	{
?>
<?php include_once("header.php");?>
<form id="form1" name="form1" method="post" action="">
  <table width="90%" border="0" align="center">
  <?php
  $selt=executework("select * from  tob_album_title where id='".($_GET['title'])."'");
  $rowt=@mysqli_fetch_array($selt);
  ?>
    <tr>
      <td height="40" colspan="3" class="style7"><strong>Album Images For <?php echo $rowt['title'] ?></strong></td>
    </tr>    
    <tr>
      <td colspan="3"><table width="50%" border="0" align="left" cellpadding="2" cellspacing="2" style=" margin-left:30px;">
	      <tr>
		  <?php
			$pim=executework("select * from tob_images where titleid='".$_GET['title'] ."' order by id");
			$pcount=@mysqli_num_rows($pim);
				$i=1;
				$j=1;
			   while($prow=@mysqli_fetch_array($pim))
			   {
		  ?>
          <td class="style7 style10"><img src="../tbdata/photogallery/thimages/<?php echo $prow['image'] ?>" height="150" width="150" /><br /><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" name="Submit3" value="Delete" onclick="modfy3('delet','<?php echo $prow['id'];?>','<?php echo $_GET['page_index'] ?>','<?php echo $_GET['title']?>')"/></td><td>&nbsp;</td>
	      
		  <?php
		  		$i++;$j++;
				if($i>5)
				{
			  ?>
        </tr>
        <tr>
          <?php
				$i=1;
			}
				
		  	   }
		  ?>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td width="28%">&nbsp;</td>
      <td width="37%">&nbsp;</td>
      <td width="35%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center">
        <label>
        <input type="button" name="Button" value="  Back  " onclick="psback('<?php if(!empty($_GET['page_index'])) echo $_GET['page_index']?>');" />
        </label>
      </div></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php include_once("footer.php");?>
<?php
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