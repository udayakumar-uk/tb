<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Photogallery | Tobacco Board, Guntur</title>
<!--<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
--><link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<style type="text/css">
<!--
.style34 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
</head>
<script language="javascript">
function show_image(img)
{
//admin/photogallery/oimages/<?php echo $row['image']?>
		var dname="coach_arivalequip.php?coach=<?php echo $_GET['cn'] ?>&eq=<?php echo $_GET['eq'] ?>&caid=<?php echo $_GET['aid'] ?>";
		window.open(dname,"DisplayWindow","resizable=no,titlebar=no,toolbar=no,scrollbars=yes,directories=no,menubar=no,width=1000,height=900,left=100,top=25");
		
}
</script>
<body>
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
		$d= substr($a,0, 2);// day
		$e = substr($a,5, 1);// '-'
 		$f = substr($a,6, 4);// year
		$c="-";
		$e="-";
		$g=$f."/".$b."/".$d;
		return $g;
	}
?>
<a name="top" id="top"></a>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="tob2_imgs/spacer.png" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("headerp.php")
  ?></td>
 <script>
jQuery.noConflict();

 </script>
  </tr>
  <tr>
    <td width="225" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php");
	$seltit=executework("select * from tob_album_title where id='".$_GET['tit']."'");
		$cntt=@mysqli_num_rows($seltit);
	$rowt=@mysqli_fetch_array($seltit);
  ?>	</td>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="92%" height="25" bgcolor="#e7e6e6"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><div class="breadcrumb flat"> <a href="#" class="active">Home</a> <a href="#">Photo gallery</a> <a href="#">View Photo</a> </div>
                  <script src="js/crumb.js" type="text/javascript"> </script>
              </td>
            </tr>
        </table></td>
        </tr>
    </table>
      <br />
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
            <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <div>
                      <div><?php include('thumbs.php')?></div>
                    </div>
                    </div>
                </div>
              </div>
              </div>
              </div>
          <a href="javascript:window.print()" target="_blank"></a> </div></td>
      </tr>
      <tr>
    <td valign="top" bgcolor="#FFFFFF"><div align="center"><span class="style34">&nbsp;</span></div></td>
    </tr>
       <tr>
    <td valign="top" bgcolor="#FFFFFF"><div align="center"><span class="style34"><a href="photogallery.php">Back To Gallery</a></span></div></td>
    </tr>
    </table></td>
  </tr>
  <tr>
   
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="59%">&nbsp;Page Updated on : <?php if(!empty($rowt['updated_on'])){?><span class="update"><?php echo datepattrn($rowt['updated_on'])?></span><?php }?></td>
        <td width="16%">&nbsp;</td>
        <td width="25%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="696" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="398" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("footer.php")
  ?></td>
  </tr>
</table>
</body>
</html>
