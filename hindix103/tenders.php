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
<title>Tenders | Tobacco Board, Guntur</title>

<style type="text/css">
<!--
.style30 {color: #990000}
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
function show_pop(dname,id)
{
	if(dname!="" && dname!='#')
	{
		window.open(dname,"DisplayWindow","resizable=no,titlebar=no,toolbar=no,scrollbars=yes,directories=no,menubar=no,width=600,height=900,left=300,top=25");
	}
}
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
    <td colspan="3" valign="top"><div id="head"><?php include_once("header.php");?></div></td>
  </tr>
  <tr>
  	<?php
		if(empty($_GET['prin']))
		{
	?>
    <td width="225" rowspan="2" valign="top" bgcolor="#ededed" >
	<?php include_once("leftmenu.php") ?>	</td>
  <?php
  	}
  ?>
    <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabbor">
      <tr>
        <td width="90%" height="25" bgcolor="#F7F7F7"><div class="breadcrumb flat"> <a href="index.php">Home</a>
          <?php if(empty($_GET['ar'])) { ?>
          <a href="#">Tenders</a>
          <?php } else { ?>
 <a href="tenders.php">Tenders</a> <a href="#">Archives</a>
<?php } ?></div></td>
        <td width="10%" bgcolor="#F7F7F7"><?php
		   		if(empty($_GET['prin']))
				{
		   ?>
          <a href="#" onclick="MM_openBrWindow('tenders.php?ar=<?php echo $_GET['ar'] ?>&prin=y','','width=800,height=600')"><img src="tob2_imgs/printButton.gif" border="0" /></a> <a href="#" onclick="MM_openBrWindow('tenders.php?ar=<?php echo $_GET['ar'] ?>&prin=y','','width=800,height=600')">Print</a>
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
			<div id="innermenu" class="innermenbox" style="display:none;">
			</div>
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
		
		$select=executework("select * from tob_tender $archive order by id desc");
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

	$select1= executework("select * from tob_tender $archive order by id desc LIMIT $pagenow1, $max_recs_per_page");
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
                                          <a href="tenders.php?page_index=<?php echo "$im" ?>&amp;ar=<?php echo $_GET['ar']?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                            <td><table width="95%" border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#EDEDED">
                                <tr bgcolor="#EEDF73">
                                  <td width="23%" height="30" bgcolor="#EDEDED"><div align="left"><strong>Tender Notice No </strong></div></td>
                                  <td width="33%" bgcolor="#EDEDED"><div align="left"><strong>Description of Tender </strong></div></td>
                                  <td width="20%" bgcolor="#EDEDED"><div align="left"><strong>Status</strong></div></td>
                                  <!--<td width="24%"><div align="left"><strong>Awarded To </strong></div></td>-->
                                </tr>
                          <tr>
                            <td colspan="4" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <?php
		  	$i=1;$b=1;
		  	while($rows=@mysqli_fetch_array($select1))
			{
				if($rows['mfile']!="")
				{
					$link1="../tbdata/tenderfiles/".$rows['mfile'];
					$link="reg.php?pg=".$rows['mfile']."&id=".$rows['id'];
				}
				else
				$link="#";
				
				$fcheck=explode(".",$rows['mfile']);

				if($i%2)
				$bgcolor="#FFFFFF";
				else
				$bgcolor="#F4F4F4";
				if ($rows['id']!=256 || ($rows['id']==256 && date('d-m-Y')!='09-05-2018'))
				{
		  ?>
				<tr valign="top">
				  <td width="23%" height="25" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;"><?php echo $rows['tenderno'] ?></td>
				  <td width="33%" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;">
				    <div align="left">
					<?php
				   if($rows['isactive']=='0')
					 {
				  	if(!empty($rows['mfile']))
					{
				  ?>				    
				      <a href="#" onclick="show_pop('<?php echo $link ?>')"><?php echo $rows['hdescription']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />				        </a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $link?>" target="<?php if($link!="#"){?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif" border="0" />											
				          </a>
				    <?php
					}
				   	}
					else
					{
						echo $rows['hdescription'];
					}
					}
					else
					{
				   ?>		
				       <?php
					
				  	if(!empty($rows['mfile']))
					{
				  ?>				    
				      <?php echo $rows['hdescription']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
				      <?php }?>
				      &nbsp;&nbsp;&nbsp;<img src="tob2_imgs/newindow_icon.gif" border="0" />											
				      
				    <?php
				   	}
					else
					{
						echo $rows['hdescription'];
					}
					}
				   ?>
				   
				   
				   
				   	
				      </div></td>
				  <td width="20%" align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;"><?php echo $rows['tstatus']?></td>
				  <!--<td width="24%" align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;"><?php echo $rows['award']?></td>-->
				</tr>
                <?php
				}
				?>
				<tr valign="top">
				  <td height="25" align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;">&nbsp;</td>
				   <td align="left" bgcolor="<?php echo $bgcolor?>" style="padding-right:15px;">
				  <?php
				if($rows['tfile']!="")
				{
					$link1="tbdata/tenderfiles/".$rows['tfile'];
					$link="reg.php?pg=".$rows['tfile']."&id=".$rows['id'];
				}
				else
				$link="#";
				
				$fcheck=explode(".",$rows['tfile']);

				if($i%2)
				$bgcolor="#FFFFFF";
				else
				$bgcolor="#F4F4F4";

				  if($rows['isactive']=='0')
				  {
				  if(isset($rows['tfile']) && $rows['tfile']!="")
				  {
				  ?>
				  <p><a href="#" onclick="show_pop('<?php echo $link ?>')"><?php echo $rows['subtitle1']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />				        </a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $link ?>" target="<?php if($link!="#"){ ?>_blank<?php } ?>"><img src="tob2_imgs/newindow_icon.gif" border="0" />											
				  </a></p>
				  
				  	<?php
					}
				   	}
					else
					{
						echo $rows['subtitle1'];
					}
					}
					else
					{
				   ?>		
				   <?php
				  	if(!empty($rows['tfile']))
					{
				   ?>				    
				      <?php echo $rows['subtitle1']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
				      <?php }?>
				      &nbsp;&nbsp;&nbsp;<img src="tob2_imgs/newindow_icon.gif" border="0" />											
				      
				    <?php
				   	}
					else
					{
						echo $rows['subtitle1'];
					}
					}
				    ?>


				<?php
				if($rows['sfile']!="")
				{
					$link2="tbdata/tenderfiles/".$rows['sfile'];
					$links="reg.php?pg=".$rows['sfile']."&id=".$rows['id'];
				}
				else
				$links="#";
				
				$fcheck=explode(".",$rows['tfile']);

				if($i%2)
				$bgcolor="#FFFFFF";
				else
				$bgcolor="#F4F4F4";

				  if($rows['isactive']=='0')
				  {
				  if(isset($rows['sfile']) && $rows['sfile']!="")
				  {
				  ?>
				  <p><a href="#" onclick="show_pop('<?php echo $links ?>')"><?php echo $rows['subtitle2']; if($fcheck[1]=='pdf'){ ?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />				        </a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $links ?>" target="<?php if($links!="#"){ ?>_blank<?php }?>"><img src="tob2_imgs/newindow_icon.gif" border="0" />											
				  </a></p>
				  
				  	<?php
					}
				   	}
					else
					{
						echo $rows['subtitle2'];
					}
					}
					else
					{
				   ?>		
				   <?php
				  	if(!empty($rows['sfile']))
					{
				   ?>				    
				      <?php echo $rows['subtitle2']; if($fcheck[1]=='pdf'){?>&nbsp;<img src="tob2_imgs/pdf_icon.gif" width="12" height="15" border="0" />
				      <?php }?>
				      &nbsp;&nbsp;&nbsp;<img src="tob2_imgs/newindow_icon.gif" border="0" />											
				      
				    <?php
				   	}
					else
					{
						echo $rows['subtitle2'];
					}
					}
				    ?>


				  
				  <td align="left" bgcolor="<?php echo $bgcolor ?>" style="padding-right:15px;">&nbsp;</td>
				  </tr>
            <?php	
				$i++;
			}

			?>
								</table></td>
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
                                <p class="style32">&nbsp;</p>
                              <p>Required Information Not Available</p>
                              <p class="style32">&nbsp;</p>
                            </div></td>
                          </tr>
     <?php
		}
	?>
                          <tr>
                            <td style="padding-left:15px;">&nbsp;</td>
                          </tr>
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
   
    <td colspan="2" valign="top"><table width="100%" border="0">
      <tr valign="middle">
        <td width="23%">&nbsp;Page Updated on : <?php if(!empty($row['tdate'])){?><span class="update"><?php echo datepattrn($row['tdate'])?></span><?php }?></td>
        <td width="68%"><div align="left"><span style="padding-left:15px;">
          <?php
				if(!empty($_GET['ar']) && $_GET['ar']==1)			
				{
			?>
          <a href="tenders.php" class="style30">&laquo; Back To Tenders</a>
          <?php
				}
				else
				{
			?>
          <a href="tenders.php?ar=1" class="style30">&raquo; Archives</a>
          <?php	
				}
			?>
        </span></div></td>
        <td width="9%"><div align="right"><a href="#top" ><img src="tob2_imgs/bact2top.jpg" width="94" height="27" border="0" title="Back to top" alt="Back to Top" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="tob2_imgs/spacer.png" width="220" height="1" /></td>
    <td width="831" valign="top"><img src="tob2_imgs/spacer.png" width="535" height="1" /></td>
    <td width="263" valign="top"><img src="tob2_imgs/spacer.png" width="225" height="1" /></td>
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
