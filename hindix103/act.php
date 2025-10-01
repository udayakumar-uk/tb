<?php
//ob_start();
//session_start();
//header("Cache-control: private"); 
include_once("include/includei.php");

$selcont=executework("select * from tob_cms where pageid=2");
$rowc=@mysqli_fetch_array($selcont);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board, Guntur</title>

<script type="text/JavaScript">
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
    <td colspan="3" valign="top"><div id="head"><?php include_once("header.php")
  ?></div></td>
  </tr>
  <tr>
  	<?php
		if(empty($_GET['prin']))
		{
	?>
    <td width="227" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
  <?php
  	}
  ?>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td height="25" bgcolor="#F7F7F7"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div class="breadcrumb flat"> <a href="#" class="active">&#2361;&#2379;&#2350;</a> <a href="#">&#2361;&#2350;&#2366;&#2352;&#2375; &#2348;&#2366;&#2352;&#2375; &#2350;&#2375;&#2306;</a> <a href="#">&#2348;&#2379;&#2352;&#2381;&#2337; &#2309;&#2343;&#2367;&#2344;&#2367;&#2351;&#2350;</a> </div>
                <script src="js/crumb.js" type="text/javascript" type="text/javascript">
                </script>
            </td>
          </tr>
        </table></td>
        <td width="10%" bgcolor="#F7F7F7"><?php
		   		if(empty($_GET['prin']))
				{
		   ?>
          <a href="#" onclick="MM_openBrWindow('act.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('act.php?prin=y','','width=800,height=600')">&#2331;&#2366;&#2346;</a>
          <?php
		   		}
		   ?></td>
      </tr>
    </table>
      <br />
      <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent"><?php echo $rowc['hcontent'] ?>              
            <div align="center"></div>
          </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
    </table></td>
  </tr>
  <?php
  	if(empty($_GET['prin']))
	{
  ?>
  <tr>
  
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="47%">&nbsp;</td>
        <td width="33%"><div align="right"><a href="http://get.adobe.com/reader/" target="_blank"><img src="tob_imgs1/get_adobe_reader.png" width="158" height="39" border="0" /></a></div></td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="829" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="263" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <?php
  	}
  ?>
  <tr>
    <td colspan="3" valign="top"><div id="footer"><?php include_once("footer.php")
  ?></div></td>
  </tr>
</table>
</body>
</html>

                            
                            