<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");

$seldat=executework("select updated_on from tob_album_title order by updated_on desc limit 1");
$rowd=@mysqli_fetch_array($seldat);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Photogallery | Tobacco Board, Guntur</title>
<style type="text/css">
<!--
.style32 {	font-size: 16px;
	color: #CC0000;
	font-weight: bold;
}
.style34 {font-size: 16px}
-->
</style>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
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
    <td colspan="3" valign="top"><?php include_once("header.php")
  ?></td>
  </tr>
  <tr>
    <td width="225" rowspan="2" valign="top" bgcolor="#ededed" >
      <?php include_once("leftmenu.php")
  ?>    </td>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="92%" height="25" bgcolor="#e7e6e6"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><div class="breadcrumb flat"> <a href="#" class="active">&#2361;&#2379;&#2350;</a> <a href="#">&#2347;&#2379;&#2335;&#2379; &#2327;&#2376;&#2354;&#2352;&#2368;</a></div>
                  <!--<script src="js/crumb.js" type="text/javascript" type="text/javascript">
                  </script>
              --></td>
            </tr>
        </table></td>
        <td width="8%" bgcolor="#e7e6e6"><?php
		   		if(empty($_GET['prin']))
				{
		   ?>
            <a href="#" onclick="MM_openBrWindow('photogallery.php?prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('photogallery.php?prin=y','','width=800,height=600')">Print</a>
            <?php
		   		}
		   ?>
        </td>
      </tr>
    </table>
      <br />
      <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" align="justify"><div class="rightcorner1">
              <div class="innercontent">
                <div class="rightcorner1">
                  <div class="innercontent">
                    <div>
                      <div>
                        <div>
                          <div>
                            <table width="100%" border="0">
                              <?php
		$max_recs_per_page=50;
		$select=executework("select * from tob_album_title order by id desc");
		$count=@mysqli_num_rows($select);
		$row=@mysqli_fetch_array($select);
if ($count > 0)
{
      ?>
                              <tr>
                                <td><table width="95%" border="0" align="center">
                                    <?php
	if (empty($_GET['page_index']))
	{
		$page_index=1;
	}	
	else
	{
		$page_index=$_GET['page_index'];
	}
	$total_recs = $count;
	$pages = $count / $max_recs_per_page; 
	if ($pages < 1)
	{ 
		$pages = 1; 
	}
	if ($pages / (int) $pages <> 1)
	{ 
		$pages = (int) $pages + 1; 
	} 
	else
	{ 
		$pages = $pages; 
	}
	$page12=(int) $page_index;
	
	$pagenow1 = ($max_recs_per_page*($page12-1)); 

	$select1= executework("select * from tob_album_title order by position desc LIMIT $pagenow1, $max_recs_per_page");
	$count1 = @mysqli_num_rows($sql1);
	
	if($pages > 1)
	{
	?>
                                    <tr>
                                      <td colspan="2" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Page&nbsp;
                                        <?php
	  for($im=1;$im<=$pages;$im++)
	  {
	  		if($page12 != $im)
			{
				?>
                                        <a href="photogallery.php?page_index=<?php echo "$im" ?>&amp;ar=<?php echo $_GET[ar]?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
                                        <?php
			}
			else
			{
					?>
                                        <font color="red"><?php echo "$im" ?></font>&nbsp;
                                        <?php
			}
		}
	?>
                                        </strong></font></td>
                                    </tr>
                                    <?php
	}
	?>
                                  </table></td>
                              </tr>
                              <tr>
                                <td align="justify" style="padding:15px;"><ul style="list-style-type:square; color:#990000;">
                                    <?php
				while($rows=@mysqli_fetch_array($select1))
				{
			  ?>
                                    <li><a href="viewphoto.php?tit=<?php echo $rows['id'] ?>"><?php echo $rows['htitle'] ?></a></li>
                 <?php	
				}
			  ?></ul></td></tr>
           <?php
		}
		else
		{
	?><tr> <td height="90" colspan="3"><div align="center">
                                    <p >&nbsp;</p>
                                    <p >Coming Soon </p>
                                    <p>&nbsp;</p>
                                  </div></td>
                              </tr>
                              <?php
		}
	?>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <a href="javascript:window.print()" target="_blank"></a> </div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" valign="top"><table width="100%" border="0">
        <tr>
          <td width="39%">&nbsp;Page Updated on :
            <?php if(!empty($rowd['updated_on'])){?>
            <span class="update"><?php echo datepattrn($rowd['updated_on'])?></span>
            <?php }?></td>
          <td width="41%">&nbsp;</td>
          <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="766" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="328" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><?php include_once("footer.php")
  ?></td>
  </tr>
</table>
</body>
</html>
