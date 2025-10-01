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
<title></title>
<style type="text/css">
<!--
.style14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style15 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px}
input.normal {font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		font-weight: bold;
		color: #000000;}
.style20 {color: #FF0000}
.style21 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #0000FF;
	font-weight: bold;
}
.style4 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style23 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #990000; }
-->
</style>
</head>
<script>
function moveto(st,st1)
{
	document.form1.action="albumdelete.php?movid="+st+"&act="+st1;
	document.form1.submit();
}
</script>
<script type="text/javascript">
function modfy2(st,st1,st2,i)
{
	var val=document.getElementById("hfdel"+i).value;
	if(confirm("Are You Sure To Delete This Album Detailes Completely?Album contains "+val+" Image(s)"))
	{
		location.href="albumdelete.php?pedit="+st+"&title="+st1+"&page_index="+st2;

	}
}
function modfy1(st,st1,st2)
{
	if(confirm("Are You Sure To Modify This Album images"))
	{
		location.href="pimagemod.php?pedit="+st+"&title="+st1+"&page_index="+st2;

	}
}
</script>
<body>
<?php
$dat=date('Y-m-d');
if(!empty($_GET['movid']))
{	
	$selrec1=executework("select * from  tob_album_title where id='".($_GET['movid'])."'");
	$rowrec1=@mysqli_fetch_array($selrec1);
	if($_GET['act']=='up')
	$qry="where position < ".($rowrec1['position'])." order by position desc limit 1";
	if($_GET['act']=='down')
	$qry="where position > ".($rowrec1['position'])." order by position Asc limit 1";
	
	$selqry=executework("select * from tob_album_title ".$qry."");
	$rowqry=@mysqli_fetch_array($selqry);
	
	$temp=$rowqry['position'];
	$upd1=executework("update tob_album_title set position='".($rowrec1['position'])."' where id='".($rowqry['id'])."'");
	$upd2=executework("update tob_album_title set position='".($temp)."' where id='".($rowrec1['id'])."'");
	redirect("albumdelete.php?titid=".$rowrec1['id']."");
}

if(!empty($_GET['pedit']) && $_GET['pedit']=='delet')
{
	$selche=executework("select * from tob_images where titleid=".($_GET['title'])." ");
	while($rche=@mysqli_fetch_array($selche))
	{
		$dir = "../tbdata/photogallery/oimages/";
		$dir1 = "../tbdata/photogallery/thimages/";
		$filename = $rche['image'];
		unlink ($dir.$filename);
		unlink ($dir1.$filename);
	}
	$selp=executework("delete from tob_images where titleid=".($_GET['title'])."");
	$selp1=executework("delete from tob_album_title where id=".($_GET['title'])."");
	redirect("albumdelete.php?succ=success");
}
?>
<?php
	include_once("header.php");
?>
      <form id="form1" name="form1" method="post" action="">
        <table width="80%" border="0" align="center">
		<tr>
		  <td colspan="3">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="3">&nbsp; <span class="style4">Albums List </span></td>
		  </tr>
		
		<tr>
		  <td colspan="3">&nbsp;</td>
		  </tr>
		<tr>
            <td width="100%" colspan="3"><table width="90%" border="0" align="center">
                <tr>
                  <td><table width="100%" border="0">
                      <tr>
                        <td>
	  <?php
		$max_recs_per_page=30;
		$select=executework("select * from  tob_album_title order by position");
		$count=@mysqli_num_rows($select);
      ?>
                            <table width="90%" align="center" cellpadding="0" cellspacing="4">
							<?php
							if($count > 0)
							{
							?>
							<tr>
								<td>
								<div align="center" class="style21"><span class="style23">Total Albums</span> <span class="style23">- <?php echo $count; ?>							    </span></div></td>
							</tr>
							<?php
							}
							?>
	<?php
		if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
                              <tr>
                                <td colspan="3" class="style15">&nbsp;</td>
                              <tr>
                                <td colspan="3" class="style15"><div align="center" class="style20"><strong>New Album Added Successfully </strong></div></td>
                              <?php 
		}
		else if(!empty($_GET['exist']) && $_GET['exist']==1)
		{
	?>
                              <tr>
                                <td colspan="3" class="style15"><div align="center"><span class="style20"><strong>Given Album Title Alredy Exist </strong></span></div></td>
                              </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']=='success')
		{
     ?>                         <tr>
                                <td colspan="3" class="style15"><div align="center" class="style20"><strong>Selected Album  Deleted Successfully </strong>
                                  </div>
                                  </div></td>
                              </tr>
        <?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==4)
		{
        ?>		
                              <tr>
                                <td colspan="3" class="style15"><div align="center" class="style20"><strong>Selected Album Details Modify Successfully </strong>
                                  </div>
                                  </div></td>
                              </tr>
							  <?php
		}
		else if(!empty($_GET['titid']))
		{
        ?>		
                              <tr>
                                <td colspan="3" class="style15"><div align="center" class="style20"><strong>Album Adjusted Success Fully</strong>
                                  </div>
                                  </div></td>
                              </tr>
<?php
		}
if ($count > 0)
{
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

	$select1= executework("select * from  tob_album_title order by position LIMIT $pagenow1, $max_recs_per_page");
	$count1 = @mysqli_num_rows($select1);
	
	if($pages > 1)
	{
	?>
                              <tr>
                                <td colspan="3" align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Page&nbsp;
                                        <?php
	  for($im=1;$im<=$pages;$im++)
	  {
	  		if($page12 != $im)
			{
				?>
                                        <a href="albumdelete.php?page_index=<?php echo "$im" ?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
					  <?php
					  if($count > 0)
					  {
					  ?>
                      <tr>
                        <td><table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
                            <tr>
                              <td width="40" bgcolor="#FFFFFF">
                              <div align="center"><span class="style14">SL No </span></div>                              </td>
                              <td width="118" bgcolor="#FFFFFF"><div align="center"><span class="style14">Album Title</span></div></td>
                              <td bgcolor="#FFFFFF"><div align="center"><span class="style4">Album Cover Image </span></div></td>
                              <td bgcolor="#FFFFFF"><div align="center" class="style14">View Album Images</div></td>
                              <td width="151" bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
            <?php
			$i=1;
			while($row=@mysqli_fetch_array($select1))
			{
				$selimg=executework("select * from tob_images where titleid='".($row['id'])."' and cover=1");
				$cntt=@mysqli_num_rows($selimg);
				$rowt=@mysqli_fetch_array($selimg);
				if($cntt>0)
				$immg="<img src='../tbdata/photogallery/thimages/". $rowt['image']."' height=80 width=100 />";
				else
				$immg="";
				
				$selimg1=executework("select * from tob_images where titleid='".($row['id'])."'");
				$cntt1=@mysqli_num_rows($selimg1);
				$rowt1=@mysqli_fetch_array($selimg1);
		   ?>
                            <tr>
                              <td bgcolor="#FFFFFF"><div align="center"><span class="style15" ><?php echo $i; ?></span></div></td>
                              <td bgcolor="#FFFFFF"><div align="center"><span class="style15" > &nbsp; <?php echo $row['title'];?></span></div></td>
                              <td width="120" bgcolor="#FFFFFF" class="style15"><div align="center"><span class="style7 style10"><?php echo $immg ?></span></div></td>
                              <td width="115" bgcolor="#FFFFFF" class="style15"><div align="center"> <a href="viewpimage.php?page_index=<?php //echo_str($page_index); ?>&title=<?php echo $row['id']?>"> Album Images</a> </div></td>
                              <td bgcolor="#FFFFFF"><div align="center">
                                  <input type="button" name="Submit3" value="  Delete  " onclick="modfy2('delet','<?php echo $row['id']; ?>','<?php //echo_str($page_index); ?>','<?php echo $i ?>')"/>
                                  <input name="hfdel<?php echo $i ?>" type="hidden" id="hfdel<?php echo $i ?>" value="<?php echo $cntt1 ?>"/>
                              </div></td>
                            </tr>
                            
        <?php
				$i++;
			}
		}
		?>
		            </table></td>
                      </tr>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><div align="center" class="style15 style20">No Albums Found</div></td>
					  <?php
					  }
					  ?>
                    </table>
    <?php
    if ($pages > 1)
  	{
  	?>
                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
                        <tr>
                          <td align="center" valign="top">
		<?php   
		if($page_index != 1)
		{
			$pre=$page_index-1;
		?>
                              <input name="button" type="button"  class="fbutton" onclick="location.href='imagelist.php?page_index=<?php echo "$pre" ?>'" value="Previous" />
                            &nbsp;
         <?php
		}
		if($page_index < $pages)
   		{
   			$next=$page_index+1;			
		?>
                            <input name="button" type="button"  class="fbutton" onclick="location.href='imagelist.php?page_index=<?php echo "$next" ?>'" value="  Next  " />
        <?php			
		}
		?>              </td>
                        </tr>
                      </table>
        <?php
		}
	    ?>      
		        </td>
                </tr>
            </table></td>
          </tr>		  
        </table>
      </form>
<?php
	include_once("footer.php");
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