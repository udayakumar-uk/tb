<?
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/include.php");

$selcont=executework("select * from tob_cms where pageid=28");
$rowc=@mysql_fetch_array($selcont);
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
    <td colspan="3" valign="top"><div id="head"><? include_once("header.php");?></div></td>
  </tr>
  <tr>
     <?
		if(empty($_GET[prin]))
		{
	?>
    <td width="24%" valign="top" bgcolor="#F0E284"><br />
	<? include_once("leftmenu.php")
  ?>	</td>
    <?
		}
	?>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td height="25" bgcolor="#F7F7F7">&nbsp;&nbsp;&nbsp; <a href="default.php">Home</a>&nbsp; &raquo;&nbsp; FCV Tobacco &nbsp; &raquo;&nbsp; Soil Types </td>
		<td width="8%" bgcolor="#F7F7F7">
		   <?
		   		if(empty($_GET[prin]))
				{
		   ?>
		   <a href="#" onclick="MM_openBrWindow('soiltypes.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('soiltypes.php?prin=y','','width=800,height=600')">Print</a>
		   <?
		   		}
		   ?>
		   </td>
      </tr>
    </table>
      <br />
      <table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div id="innermenu" class="innermenbox">
              <table width="100%" border="0" align="center" cellpadding="7" cellspacing="2" bgcolor="#F7F7F7">
                <tr>
                  <td width="93%" height="25" bgcolor="#F0E284"> &nbsp;&nbsp; <img align="absmiddle"  src="tob2_imgs/dtarrow.png" width="10" height="10" />&nbsp; <a href="fcvt.php">FCV (Traditional  ) </a></td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#F0E284">&nbsp;&nbsp; <img align="absmiddle"  src="tob2_imgs/dtarrow.png" width="10" height="10" />&nbsp; <a href="fcvn.php">FCV (NLS)</a></td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#F0E284">&nbsp;&nbsp; <img align="absmiddle"  src="tob2_imgs/dtarrow.png" width="10" height="10" />&nbsp; <a href="fcvs.php">FCV (SLS) </a></td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#F0E284">&nbsp;&nbsp; <img align="absmiddle"  src="tob2_imgs/dtarrow.png" width="10" height="10" />&nbsp; <a href="fcvm.php">FCV (Mysore) </a></td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#F0E284">&nbsp;&nbsp; <img align="absmiddle"  src="tob2_imgs/dtarrow.png" width="10" height="10" />&nbsp; <a href="soiltypes.php">Soil Types </a></td>
                </tr>
               
              </table>
            </div>
            <div class="innercontent">
                <div>
                  <? echo $rowc['content'] ?>
            </div>
          </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#F0E284">&nbsp;</td>
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="47%">&nbsp;Page Updated on : <span class="update">11-01-2012</span> </td>
        <td width="33%">&nbsp;</td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
    <?
  	if(empty($_GET[prin]))
	{
  ?>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="442" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="20%" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
   <?
  	}
  ?>
  <tr>
    <td colspan="3" valign="top"><div id="footer"><? include_once("footer.php");?></div></td>
  </tr>
</table>
</body>
</html>
