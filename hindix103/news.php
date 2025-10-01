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
<title>News &amp; Events | Tobacco Board, Guntur</title>

<style type="text/css">
<!--
.style32 {	font-size: 16px;
	color: #CC0000;
	font-weight: bold;
}
.style34 {font-size: 16px}
-->
</style>
<script type="text/JavaScript">
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
    <td colspan="3" valign="top"><div id="head"><?php include_once("header.php")
  ?></div></td>
  </tr>
  <?php
  	if(empty($_GET['prin']))
	{
  ?>
  <tr>
    <td width="225" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php")
  ?>	</td>
   <?php
   	}
   ?> 
	<td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
      
        <td height="25" bgcolor="#F7F7F7">&nbsp;&nbsp; 
        <div class="breadcrumb flat">        
        <a href="index.php">Home</a>
          <?php if(empty($_GET['ar'])) {?>
                    <a href="#"> News &amp; Events</a>
          <?php }else {?>
&raquo; <a href="news.php">News &amp; Events</a> <a href="#">Archives</a></div>
<?php }?></div></td>
        <td width="10%" bgcolor="#F7F7F7"><?php
		   		if(empty($_GET['prin']))
				{
		   ?>
          <a href="#" onclick="MM_openBrWindow('news.php?ar=<?php echo $_GET['ar']?>&amp;prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('news.php?ar=<?php echo $_GET['ar']?>&amp;prin=y','','width=800,height=600')">Print</a>
          <?php
		   		}
		   ?></td>
      </tr>
    </table>
      <br />
      <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="justify"><div class="rightcorner1">
          <div class="innercontent">
		   <div id="innermenu" class="innermenbox" style="display:none"> </div>
           <div class="rightcorner1">
              <div class="innercontent">
                <div>
                  <div>
                    <div>
                      <div>
					    <table width="100%" border="0">
                          <?php
		$max_recs_per_page=30;
		if(!empty($_GET['ar']) && $_GET['ar']==1)
		$archive="where archive=1";
		else
		$archive="where archive=0";
		
		$select=executework("select * from tob_news $archive order by id desc");
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

	$select1= executework("select * from tob_news $archive order by id desc LIMIT $pagenow1, $max_recs_per_page");
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
                                          <a href="news.php?page_index=<?php echo "$im" ?>&amp;ar=<?php echo $_GET[ar]?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                            <td><table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
                                <tr>
                                  <td align="justify" style="padding:15px;"><ul>
                                      <?php
		  	while($rows=@mysqli_fetch_array($select1))
			{
				if($rows['tfile']!="" && $rows['tfile']!="#")
				$link="../tbdata/newsfiles/".$rows['tfile'];
				else
				$link="#";
				$fcheck=explode(".",$rows['tfile']);
				if(!empty($rows['tfile']))
				{
		  ?>
                <li style="padding-bottom:10px; padding-right:10px;"><a href="<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><?php echo $rows['hdescription']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" /><?php }?></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif" border="0" />											
						</a><br />
                </li>
              <?php
			  	}
				else
				{
					echo '<li style="padding-bottom:10px; padding-right:10px;">'.$rows['hdescription'].'</li>';
				}	
			}
			?></ul></td>
                                </tr>
                            </table></td>
                          </tr>
                          <?php
		}
		else
		{
	?>
                          <tr>
                            <td height="90" colspan="3"><div align="center">
                                <p>&nbsp;</p>
                              <p>Required Information Not Available</p>
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
  <?php
  	if(empty($_GET['prin']))
	{
  ?>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr>
        <td width="39%">&nbsp;Page Updated on : <?php if(!empty($row['ndate'])){?><span class="update"><?php echo datepattrn($row['ndate'])?></span><?php }?></td>
        <td width="41%">
			<div align="center">
			  <?php
				if(!empty($_GET['ar']) && $_GET['ar']==1)			
				{
			?>
			  <a href="news.php" class="a">&laquo; Back To News &amp; Evetns </a>
			  <?php
				}
				else
				{
			?>
			  <a href="news.php?ar=1" class="a">&raquo; Archives</a>
			  <?php	
				}
			?>
	          </div></td>
        <td width="20%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="730" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="364" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
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
