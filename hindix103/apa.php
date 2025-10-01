<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");

$selcont=executework("select * from tob_cms where pageid=46");
$rowc=@mysqli_fetch_array($selcont);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board, Guntur</title>

<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body>
<a name="top" id="top"></a>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("header.php")
  ?></td>
  </tr>
  <tr>
    <td width="226" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php 
	include_once("leftmenu.php")
  ?>	</td>
    <td colspan="2" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td height="25" bgcolor="#e7e6e6"><div class="breadcrumb flat"> <a href="#" class="active">Home</a> <a href="#">Field Offices</a> <a href="#">Auction Platforms In AP</a> </div>
            <script src="js/crumb.js" type="text/javascript">
            </script>
        </td>
        <td width="8%" bgcolor="#e7e6e6"><?php
		   		if(empty($_GET['prin']))
				{
		   ?>
            <a href="#" onclick="MM_openBrWindow('apa.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('apa.php?prin=y','','width=800,height=600')">Print</a>
            <?php
		   		}
		   ?></td>
      </tr>
    </table>
      <br />
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="innermenbox"></div>
        <?php echo $rowc['hcontent'] ?></td>
        </tr>
      </table>
     </td>
  </tr>
  <tr>
   
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="47%">&nbsp; </td>
        <td width="33%">&nbsp;</td>
        
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="830" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="263" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">
	<?php 
	include_once("footer.php")
  ?>
  </td>
  </tr>
</table>
</body>
</html>

                            
                            