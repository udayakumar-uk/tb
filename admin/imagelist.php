<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if($_SESSION['tobadmin']!="")
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
-->
</style>
</head>
<script type="text/javascript">
function modfy2(st,st1,st2)
{
	if(confirm("Are You Sure To Delete This Album Detailes Completely"))
	{
		location.href="pimagemod.php?pedit="+st+"&title="+st1+"&page_index="+st2;

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
                        <td><?php
		$max_recs_per_page=30;
		$select=executework("select distinct title from tob_images order by title");
		$count=@mysqli_num_rows($select);
      ?>
                            <table width="90%" align="center" cellpadding="0" cellspacing="4">
							<tr>
								<td>
								<div align="center" class="style21">Total Albums - <?php echo $count; ?>								    </div></td>
							</tr>
	<?php
		if($_GET[succ]==1)
		{
	?>
                              <tr>
                                <td colspan="3" class="style15">&nbsp;</td>
                              <tr>
                                <td colspan="3" class="style15"><div align="center" class="style20"><strong>New Album Added Successfully </strong></div></td>
                              <?php 
		}
		else if($_GET[exist]==1)
		{
	?>
                              <tr>
                                <td colspan="3" class="style15"><div align="center"><span class="style20"><strong>Given Album Title Alredy Exist </strong></span></div></td>
                              </tr>
	<?php
		}
		else if($_GET[succ]==5)
		{
     ?>                         <tr>
                                <td colspan="3" class="style15"><div align="center" class="style20"><strong>Selected Album Details Delete Successfully </strong>
                                  </div>
                                </div></td>
                              </tr>
                              <?php
		}
		else if($_GET[succ]==4)
		{
?>		
                              <tr>
                                <td colspan="3" class="style15"><div align="center" class="style20"><strong>Selected Album Details Modify Successfully </strong>
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

	$select1= executework("select distinct(title) from tob_images order by id LIMIT $pagenow1, $max_recs_per_page");
	$count1 = @mysqli_num_rows($sql1);
	
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
                                        <a href="imagelist.php?page_index=<?php echo "$im" ?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                        <td><table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
                            <tr>
                              <td width="38" bgcolor="#FFFFFF">
                                  <div align="center"><span class="style14">SL No </span></div>                              </td>
                              <td width="107" bgcolor="#FFFFFF"><div align="center"><span class="style14">Album Title</span></div></td>
                              <td bgcolor="#FFFFFF"><div align="center"><span class="style4">Album Cover Image </span></div></td>
                              <td bgcolor="#FFFFFF"><div align="center"><span class="style14">View Album </span></div></td>
                              <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                            <?php
			$i=1;
			while($row=@mysqli_fetch_array($select1))
			{
				$selimg=executework("select * from tob_images where title='".$row['title']."' and status=1");
				$cntt=@mysqli_num_rows($selimg);
				$rowt=@mysqli_fetch_array($selimg);
				if($cntt>0)
				$immg="<img src='photogallery/thimages/". $rowt[image]."' height=80 width=100 />";
				else
				$immg="";
		?>
                            <tr>
                              <td bgcolor="#FFFFFF"><div align="center"><span class="style15" ><?php echo $i; ?></span></div></td>
                              <td bgcolor="#FFFFFF"><span class="style15" > &nbsp; <?php echo $row[title];?></span></td>
                              <td width="110" bgcolor="#FFFFFF" class="style15"><div align="center"><span class="style7 style10"><?php echo $immg ?></span></div></td>
                              <td width="110" bgcolor="#FFFFFF" class="style15"><div align="center"> <a href="viewpimage.php?page_index=<?php echo $page_index?>&title=<?php echo $row[title]?>"> Album Images</a> </div></td>
                              <td width="106" bgcolor="#FFFFFF">
                                <input type="button" name="Button" value=" Modify Images" onclick="modfy1('editimage','<?php echo $row[title];?>','<?php echo $page_index ?>')" />                              </td>
                              <td width="76" bgcolor="#FFFFFF"><div align="center">
                                  <input type="button" name="Submit3" value="  Delete  " onclick="modfy2('delet','<?php echo $row[title];?>','<?php echo $page_index ?>')"/>
                              </div></td>
                            </tr>
                            <?php
				$i++;
			}
		}
		?>
                        </table></td>
                      </tr>
                    </table>
                      <?php
    if ($pages > 1)
  	{
  		?>
                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
                        <tr>
                          <td align="center" valign="top"><?php
   
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
		?>                          </td>
                        </tr>
                      </table>
                    <?php
		}
	?>                  </td>
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