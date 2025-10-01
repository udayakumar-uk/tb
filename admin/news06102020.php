<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");	
include("check_user.php");
include('nocsrf.php');
if(!empty($_SESSION['tobadmin']))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Post News &amp; Events | Welcome To TOBBACO BOARD Admin</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.style7 {font-size: 14px; color: #FF0000; font-family: Arial, Helvetica, sans-serif;}
.style17 {font-family: Arial, Helvetica, sans-serif;font-size: 12px; }
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }

a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	color: #000000;
	text-decoration: none;
}
a.b:hover {
	color: #990000;
	text-decoration: none;
}
a.b:active {
	color: #990000;
	text-decoration: none;
}

-->
</style>
</head>
<script type="text/javascript">
function check(form1)
{
	var tfile=document.form1.tfile.value;
	var tflen=tfile.length;
	var dpos=tfile.indexOf(".");
	var ext=tfile.substr(dpos+1,tflen);
	var ext1=ext.toLowerCase();
    if(document.form1.description.value=="")
	{
		alert("Description Should Not Be Empty")
		document.form1.description.focus();
		return false;
	}
    if(document.form1.hdescription.value=="")
	{
		alert("Description In Hindi Should Not Be Empty")
		document.form1.hdescription.focus();
		return false;
	}
	
	else if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='txt' && ext1!='pdf' && ext1!='doc' && ext1!='docx' && document.form1.ttype.value=="" && document.form1.tfile.value!="")
	{
		alert("Only file types of txt,pdf,doc,docx,jpg,jpeg,gif are allowed for News Files");
		document.form1.tfile.value="";
		document.form1.tfile.focus();
		return false;
	}	
	else
	{
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1)
{
	if(confirm("Are You sure to Delete News & Events Details Completely"))
	{
		document.form1.action="news.php?id="+st+"&edit="+st1;
		document.form1.submit();
		//location.href="news.php?id="+st+"&edit="+st1;
	}
}
function del(st,st1)
{
	if(confirm("Are You sure to Move Archive Selected News & Events Details"))
	{
		document.form1.action="news.php?id="+st+"&edit="+st1;
		document.form1.submit();
		//location.href="news.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1)
{
	if(confirm("Are You sure to Modify Selected News & Events Details"))
	{
		document.form1.action="news.php?id="+st+"&edit="+st1;
		document.form1.submit();
		//location.href="news.php?id="+st+"&edit="+st1;
	}
}
function back1()
{
	location.href="news.php";
}
</script>
<body>
<?php include_once("header.php");?>
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

if(!empty($_GET['id']))
$id=$_GET['id'];
else if(!empty($_POST['id']))
$id=$_POST['id'];
else
$id='';

	if(!empty($_GET['edit']))
	{ 
		$result=csrf_token_check();
		if($result=='Done')
		{
			$select=executework1("select * from tob_news where id=".$id);
			$drow=@mysqli_fetch_array($select);
			if($_GET['edit']=="delet")
			{
				$dir = "../tbdata/newsfiles/";
				$filename = $drow['tfile'];
				unlink ($dir.$filename);
				$tupdate=executework1("delete from tob_news where id=".$id);	
				redirect("news.php?succ=4");
			}
			else if($_GET['edit']=="archive")
			{
				$tupdate=executework1("update tob_news set archive=1 where id=".$id);	
				redirect("news.php?succ=2");
			}
			else
			{
				if(!empty($_POST['subm']))
				{
					$pimage="tfile";
					$target_pathn = "../tbdata/newsfiles/";
					$f1="";
					$f2="";
					if (!empty($_FILES[$pimage]['name']))
					{
						$f1= basename($_FILES[$pimage]['name']); 
						$ef=$target_pathn .$drow['tfile'];
						if(file_exists($ef))
						unlink($ef);
						$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
						$f1=basename( $_FILES[$pimage]['name']); 
					
						if(file_exists($f1))
						unlink($f1);
						move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
						$f2=",tfile='$f1' ";
					}
						$tinsert=executework1("update tob_news set description='". $_POST['description'] ."',hdescription='". $_POST['hdescription'] ."',home='". $_POST['home'] ."'$f2 where id=".$id);
						redirect("news.php?succ=3");
				}
			}
		}
	}
	else if(!empty($_POST['subm']))
	{
		$result=csrf_token_check();
		if($result=='Done')
		{
			$date=date("Y-m-d",time()+19800);
			$tselect=executework1("select * from tob_news where title='". $_POST['description']."'");
			$tcnt=@mysqli_num_rows($tselect);
			if($tcnt>0)
			{
				redirect("news.php?exist=1");
			}
			else
			{
				$intmax=executework1("SELECT max(id) from tob_news");
				$cnt=@mysqli_num_rows($intmax);
				$row=@mysqli_fetch_array($intmax);
				if($row[0]!="")
				{
					$maxid=$row[0]+1;
				}
				else
				{
					$maxid=1;
				}
					$pimage="tfile";
					$target_pathn = "../tbdata/newsfiles/";
					$f1="";
					if (!empty($_FILES[$pimage]['name']))
					{
						$f1= basename($_FILES[$pimage]['name']); 
						$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
						$f1=basename( $_FILES[$pimage]['name']); 
						move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
					}
				$tinsert=executework1("insert into tob_news values($maxid,'$date','". $_POST['description'] ."','". $_POST['hdescription'] ."','$f1',0,'". $_POST['home'] ."')");
				$ins_id=@mysqli_insert_id();
				//if(!empty($ins_id))
				//{
					redirect("news.php?succ=1");
				//}
				//else 
				//{
				//	redirect("news.php?err=1");
				//}
			}
		}
	}
	$token = NoCSRF::generate( 'csrf_token' );
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
<?php
	$tselect=executework1("select * from tob_news where id=".$id);
	$tcnt=@mysqli_num_rows($tselect);
	if((empty($_GET['edit']) && empty($id)) || (!empty($_GET['edit']) && $tcnt>0))
	{
		$trow=@mysqli_fetch_array($tselect);
		if($trow['home']!="")
		$home="checked='checked'";
		else
		$home="";
?>
  <table width="90%" border="0" align="center">
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="9%">&nbsp;</td>
      <td width="66%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Post News And Events </span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['exist']) && $_GET['exist']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given  Details Alredy Exist </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">New &amp; Events Posted Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['err']) && $_GET['err']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Data Doesn't inserted.., Check User Privileges </span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected News &amp; Events Successfully Move To Archives</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==3)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected News &amp; Events Details Modify Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==4)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected News &amp; Events Details Deleted Successfully</span> </td>
    </tr>
	<?php
		}
		else
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7"></span> </td>
    </tr>
	<?php
		}
	?>
    
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Description of News &amp; Events </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
      <textarea name="description" cols="40" rows="5" id="description"><?php echo $trow['description']?></textarea>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Description of News &amp; Events (hindi) </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <textarea name="hdescription" cols="40" rows="5" id="hdescription"><?php echo $trow['hdescription']?></textarea>
      </label></td>
    </tr>

    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Upload  File </td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30" class="style8">
	  	<?php if(!empty($trow['tfile'])){?><a href="newsfiles/<?php echo $trow['tfile']?>" target="_blank">View File</a><br /><?php }?>
        <input name="tfile" type="file" id="tfile" />
        <input name="home" type="checkbox" id="home" value="1" <?php echo $home;?>/>
        Home</td>
    </tr>
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">
	  	<?php
			if(empty($_GET['edit']))
			{
		?>
        <input type="submit" name="Submit" value="Submit" />
        <input type="reset" name="Submit2" value="Reset" />
		<?php
			}
			else
			{
		?>
        <input type="submit" name="Submit" value="Modify" />
        <input type="reset" name="Submit2" value="Cancel" onclick="back1();" />
		<?php
			}
		?>
      <input name="subm" type="hidden" id="subm" />	 
	  <input name="ttype" type="hidden" id="ttype" value="<?php echo $_GET['edit']?>" /></td>
    </tr>
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
    <tr>
      <td height="50" colspan="3" class="style4"><table width="100%" border="0" align="center">
        <tr>
          <td><table width="100%" border="0">
              <tr>
                <td>
	  <?php
		$max_recs_per_page=50;
		$select=executework1("select * from tob_news order by id desc");
		$count=@mysqli_num_rows($select);
      ?>
                    <table width="80%" align="center" cellpadding="0" cellspacing="4">
                      <tr>
                        <td colspan="4"><div align="center" class="style53"><font color="#0000FF" size="3" face="Arial, Helvetica, sans-serif"><strong><font color="#0000BF">Total News &amp; Events - <?php echo $count ?></font></strong></font> </div></td>
                      </tr>
                      <?php
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

	$select1= executework1("select * from tob_news order by id desc LIMIT $pagenow1, $max_recs_per_page");
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
                                <a href="news.php?page_index=<?php echo "$im" ?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                <td><table width="85%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                      <td width="37" height="30" bgcolor="#FFFFFF"><div align="center"><span class="style8">SL No </span></div></td>
                      <td width="77" bgcolor="#FFFFFF"><div align="center" class="style8">Date</div></td>
                      <td width="261" bgcolor="#FFFFFF"><div align="center" class="style8">Tender Descripotion</div></td>
                      <td width="85" bgcolor="#FFFFFF"><div align="center" class="style8">Status</div></td>
                      <td width="253" bgcolor="#FFFFFF"><div align="center" class="style8">Actions</div></td>
                      </tr>
                    <?php
			$i=$pagenow1+1;
			while($row=@mysqli_fetch_array($select1))
			{
				if(!empty($row['tfile']))
				$link="../tbdata/newsfiles/".$row['tfile'];
				else
				$link="";
		?>
                    <tr>
                      <td height="30" bgcolor="#FFFFFF" class="style17"><div align="center"><?php echo $i; ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="center"><?php echo datepattrn($row['ndate']); ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="justify"><a href="<?php echo $link;?>" target="<?php if($link!="#"){?>_blank<?php }?>" class="b"><?php echo $row['description']?></a></div></td>
                      <td bgcolor="#FFFFFF" class="style8" style="padding-left:15px;"><?php if($row['archive']==0) echo "Active"; else echo "Archive";?></td>
                      <td bgcolor="#FFFFFF"><div align="center" class="style8"><?php if($row['archive']==0){?><a href="javascript:modf('<?php echo $row['id'] ?>','edit')" class="b">Modify</a>&nbsp; | &nbsp;<a href="javascript:del('<?php echo $row['id'] ?>','archive')" class="b">Archives</a>&nbsp; | &nbsp;<?php }?><a href="javascript:delet('<?php echo $row['id'] ?>','delet')" class="b">Delete</a></div></td>
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
                      <input name="button" type="button"  class="fbutton" onclick="location.href='news.php?page_index=<?php echo "$pre" ?>'" value="Previous" />
                    &nbsp;
                    <?php
		}
		if($page_index < $pages)
   		{
   			$next=$page_index+1;			
			?>
                    <input name="button" type="button"  class="fbutton" onclick="location.href='news.php?page_index=<?php echo "$next" ?>'" value="  Next  " />
                    <?php
			
		}
		?>                  </td>
                </tr>
              </table>
            <?php
		}
	?>          </td>
        </tr>
      </table></td>
    </tr>
  </table>
  <?php
  	}
	else
	{
		redirect("invalidaccess.php");
	}
  ?>
  <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
</form>
<?php include_once("footer.php");?>
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
