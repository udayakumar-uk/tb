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
    <td colspan="3" valign="top"><div id="head"><?php include_once("header.php");?></div></td>
  </tr>
  <tr>
    <?php
		if(empty($_GET[prin]))
		{
	?>
    <td width="225" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
    <?php
		}
	?>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="92%" height="25" bgcolor="#e7e6e6"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><div class="breadcrumb flat"> <a href="#" class="active">Home</a> <a href="#">Terms &amp; Conditions </a> </div>
                  <script src="js/crumb.js" type="text/javascript" type="text/javascript">
                  </script>
              </td>
            </tr>
        </table></td>
        <td width="8%" bgcolor="#e7e6e6"><?php
		   		if(empty($_GET[prin]))
				{
		   ?>
            <a href="#" onclick="MM_openBrWindow('hyper.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('fcvt.php?prin=y','','width=800,height=600')">Print</a>
            <?php
		   		}
		   ?>
        </td>
      </tr>
    </table>
      <br />
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div id="innermenu" class="innermenbox"></div>
            <div class="innercontent">
              <div class="innermenbox1">
              <a href="tfcv.php" title=""></a>
              <p>This website is  designed, developed and maintained by Tobacco Board, Government of  India. </p>
              <p>Though all efforts have  been made to ensure the accuracy and currency of the content on this website,  the same should not be construed as a statement of law or used for any legal  purposes. Incase of any ambiguity or doubts, users are advised to verify/check  with the Department(s) and/or other source(s), and to obtain appropriate  professional advice. </p>
              <p>Under no circumstances will this Department be  liable for any expense, loss or damage including, without limitation, indirect  or consequential loss or damage, or any expense, loss or damage whatsoever  arising from use, or loss of use, of data, arising out of or in connection with  the use of this website. </p>
              <p>These terms and  conditions shall be governed by and construed in accordance with the Indian  Laws. Any dispute arising under these terms and conditions shall be subject to  the jurisdiction of the courts of India. </p>
              <p>The information posted  on this website could include hypertext links or pointers to information  created and maintained by non-Government/private organisations. Tobacco Board is providing these links and pointers solely for your  information and convenience. When you select a link to an outside website, you  are leaving the Tobacco Board website and are subject to the  privacy and security policies of the owners/sponsors of the outside website. </p>
              <p>Tobacco Board,  does not guarantee the availability of such linked pages at all times. </p>
              <p>&nbsp;</p>
              </div>
              </div>
            <p>&nbsp;</p>
            <p class="update">&nbsp;</p>
              </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
    </table></td>
  </tr>
     <?php
  	if(empty($_GET[prin]))
	{
  ?>
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
    <td width="817" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="260" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
   <?php
  	}
  ?>
  <tr>
    <td colspan="3" valign="top"><div id="footer"><?php include_once("footer.php");?></div></td>
  </tr>
  
</table>
</body>
</html>
