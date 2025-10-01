<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");

$selcont=executework("select * from tob_cms where pageid=7");
$rowc=@mysqli_fetch_array($selcont);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tobacco Board, Guntur</title>

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
    <td width="264" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td height="25" bgcolor="#F7F7F7">&nbsp;&nbsp;&nbsp; <a href="default.php">Home</a>&nbsp; &raquo;&nbsp; FCV Growers &nbsp; &raquo;&nbsp; Fixing Crop Size </td>
      </tr>
    </table>
      <br />
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="innermenbox"></div>
            <?php echo $rowc['content'] ?>
            <p class="update">&nbsp;</p>
              </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="47%">&nbsp;</td>
        <td width="33%">&nbsp;</td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="442" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="20%" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("footer.php")
  ?></td>
  </tr>
</table>
</body>
</html>
