<?php
ob_start();
session_start();
header("Cache-control: private"); 
include("include/includei.php");
include("check_user.php");
include('nocsrf.php');
if(!empty($_GET['id']))
$id=$_GET['id'];
else if(!empty($_POST['id']))
$id=$_POST['id'];
else
$id='';
if(!empty($_GET['edit']))
$edit=$_GET['edit'];
else if(!empty($_POST['ttype']))
$edit=$_POST['ttype'];
else
$edit='';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!empty($_SESSION['tobadmin']))
{?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Post Tenders | Welcome To TOBBACO BOARD Admin</title>
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
<script type="text/javascript" src="admin/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",

		// Theme options
//		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		<!--content_css : "css/content.css",-->
		// Drop lists for link/image/media/template dialogs
		/*template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",*/

		
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<script type="text/javascript">
function check(form1)
{
	var mfile=document.form1.bimg.value;
	var mflen=mfile.length;
	var dpos=mfile.indexOf(".");
	var ext=mfile.substr(dpos+1,mflen);
	var ext1=ext.toLowerCase();

	if(document.form1.mem_name.value=="")
	{
		alert("Member Name Should Not Be Empty");
		document.form1.mem_name.focus();
		return false;
	}
	else if(document.form1.designation.value=="")
	{
		alert("Designation Should Not Be Empty")
		document.form1.designation.focus();
		return false;
	}
	else if(ext1!='' && ext1!='jpg' && ext1!='jpeg' && ext1!='gif')
	{
		alert("Only file types of jpg,jpeg,gif are allowed for Tender Files");
		document.form1.bimg.value="";
		document.form1.bimg.focus();
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
	if(confirm("Are You sure to Delete Selected Member Details Completely"))
	{
		location.href="board_members.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1)
{
	if(confirm("Are You sure to Move Archive Selected Tender Details"))
	{
		location.href="tenders.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1)
{
	if(confirm("Are You sure to Modify Selected Member"))
	{
		location.href="board_members.php?id="+st+"&edit="+st1;
	}
}
function back1()
{
	location.href="tenders.php";
}
</script>
<body>
<?php include_once("header.php");?>
<?php
	$token = NoCSRF::generate( 'csrf_token' );
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
		$select=executework("select * from tob_brdmember where id=".$id);
		$drow=@mysqli_fetch_array($select);
		if($_GET['edit']=="delet")
		{
			$dir = "../tbdata/members/";
			$filename = $drow['image'];
			unlink ($dir.$filename);
			$tupdate=executework("delete from tob_brdmember where id=".$id);	
			redirect("board_members.php?succ=4");
		}
		else if($_GET['edit']=='edit')
		{ 
		 if(!empty($_POST['Submit']))
		 {
				$mimage="bimg";
				$target_pathi= "../tbdata/members/";
				$f5="";
				$f6="";
				if (!empty($_FILES[$mimage]['name']))
				{
					$f5= basename($_FILES[$mimage]['name']); 
					$ef2=$target_pathi.$drow['bimg'];
					$target_pathsmy = $target_pathi .basename( $_FILES[$mimage]['name']); 
					//$f5=basename( $_FILES[$mimage]['name']); 
					//echo $target_pathsmy;
					move_uploaded_file($_FILES[$mimage]['tmp_name'], $target_pathsmy);
					$f6=",image='$f5' ";
				}
				//echo ("update tob_brdmember set name='". $_POST['mem_name'] ."',designation='".$_POST['designation']."', addr='".$_POST['addr']."' ".$f6." where id=".$id);
				//exit();
	$tinsert=executework("update tob_brdmember set sl_no='".$_POST['sl_no']."',name='".addslashes($_POST['mem_name'])."',designation='".addslashes($_POST['designation'])."', addr='".addslashes($_POST['addr'])."' ".$f6." where id=".$id);
					
					redirect("board_members.php?succ=3");
		}

		}
	}
	else if(!empty($_POST['Submit']))
	{

		$mimage="bimg";
					$target_pathny = "../tbdata/members/";
					$f10="";
					
					if (!empty($_FILES[$mimage]['name']))
					{
						$f10= basename($_FILES[$mimage]['name']); 
						$target_pathsy = $target_pathny .basename( $_FILES[$mimage]['name']); 
						$f10=basename( $_FILES[$mimage]['name']); 
						move_uploaded_file($_FILES[$mimage]['tmp_name'], $target_pathsy);
					}
				$tinsert=executework("insert into tob_brdmember (sl_no,name,designation,image,addr,added_on,status) values('".$_POST['sl_no']."','". addslashes($_POST['mem_name']) ."','". addslashes($_POST['designation']) ."','".$f10."','".addslashes($_POST['addr'])."','".date('Y-m-d H:i:s')."',1)");
				//echo "insert into tob_brdmember (sl_no,name,designation,image,addr,added_on,status) values('".$_POST['sl_no']."','". $_POST['mem_name'] ."','". $_POST['designation'] ."','".$f10."','".addslashes($_POST['addr'])."','".date('Y-m-d H:i:s')."',1)";
				redirect("board_members.php?succ=1");
		
	}
	

?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
<?php
	$tselect=executework("select * from tob_brdmember where id='".$id."'");
	$tcnt=@mysqli_num_rows($tselect);
	
	if((empty($edit) && empty($id)) || (!empty($edit) && $tcnt>0))
	{
		$trow=@mysqli_fetch_array($tselect);
		if(!empty($trow['home']))
		$home="checked='checked'";
		else
		$home="";
		if(!empty($trow['isactive']) && $trow['isactive']!=0)
		$actv="checked='checked'";
		else
		$actv="";
?>
  <table width="90%" border="0" align="center">
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="9%">&nbsp;</td>
      <td width="66%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Board Members</span> </td>
    </tr>
    
	<?php
		if(isset($_GET['exist']) && $_GET['exist']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given Board Member Details Alredy Exist </td>
    </tr>
	<?php
		}
		else if(isset($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">New Board Member Details Posted Successfully</span> </td>
    </tr>
	<?php
		}
		else if(isset($_GET['succ']) && $_GET['succ']==3)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Member Details Modify Successfully</span> </td>
    </tr>
	<?php
		}
		else if(isset($_GET['succ']) && $_GET['succ']==4)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Member Details Deleted Successfully</span> </td>
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
      <td height="30" style="padding-left:35px;"><span class="style4">Sl.No </span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input name="sl_no" type="number" id="sl_no" size="50" value="<?php if(!empty($trow['sl_no'])) echo $trow['sl_no'] ?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" style="padding-left:35px;"><span class="style4">Name </span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input name="mem_name" type="text" id="mem_name" size="50" value="<?php if(!empty($trow['name'])) echo stripslashes($trow['name']) ?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Designation</span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input type="text" name="designation" id="designation" value="<?php if(!empty($trow['designation'])) echo stripslashes($trow['designation']) ?>">
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Image </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input type="file" name="bimg" id="bimg">
      </label></td>
    </tr>
    
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Address</span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <textarea name="addr" cols="40" rows="5" id="addr"><?php if(!empty($trow['addr'])) echo stripslashes($trow['addr']) ?></textarea>
      </label></td>
    </tr>

    <tr>
      <td height="50" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">
	  	<?php
			if(empty($edit))
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
	  <input name="ttype" type="hidden" id="ttype" value="<?php echo $edit; ?>" /></td>
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
		$max_recs_per_page=30;
		$select=executework("select * from tob_brdmember order by id desc");
		$count=@mysqli_num_rows($select);
      ?>
                    <table width="100%" align="center" cellpadding="0" cellspacing="4">
                      <tr>
                        <td colspan="4"><div align="center" class="style53"><font color="#0000FF" size="3" face="Arial, Helvetica, sans-serif"><strong><font color="#0000BF">Total Members - <?php echo $count ?></font></strong></font> </div></td>
                      </tr>
<?php
$pages='';
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

	$select1= executework("select * from tob_brdmember order by sl_no,id  LIMIT $pagenow1, $max_recs_per_page");
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
                                <a href="admin/board_members.php?page_index=<?php echo "$im" ?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                    <td width="34" height="30" bgcolor="#FFFFFF"><div align="center"><span class="style8">#</span></div></td>
                      <td width="34" height="30" bgcolor="#FFFFFF"><div align="center"><span class="style8">SL No </span></div></td>
                       <td width="280" bgcolor="#FFFFFF"><div align="center" class="style8">Image</div></td>
                      <td width="99" bgcolor="#FFFFFF"><div align="center"><span class="style8">Name </span></div></td>
                      <td width="158" bgcolor="#FFFFFF"><div align="center"><span class="style8">Designation </span></div></td>                     
                      <td width="102" bgcolor="#FFFFFF"><div align="center"><span class="style8">Address </span></div></td>
                      </tr>
                    <?php
			$i=$pagenow1+1;
			while($row=@mysqli_fetch_array($select1))
			{
				//print_r($row);
				if(!empty($row['image']))
				$link="../tbdata/members/".$row['image'];
				else
				$link="../tbdata/members/boardmembers_thumb.gif";
		?>
                    <tr>
                      <td height="30" bgcolor="#FFFFFF" class="style17"><div align="center"><?php echo $i; ?></div></td>
                       <td height="30" bgcolor="#FFFFFF" class="style17"><div align="center"><?php echo $row['sl_no']; ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" ><div align="center"><img src="<?php echo $link; ?>" style="height:150px; width:150px"  /></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><?php echo stripslashes($row['name']); ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="justify"><?php echo stripslashes($row['designation']) ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><?php echo stripslashes($row['addr'])?></td>
                      <td bgcolor="#FFFFFF"><div align="center" class="style8">
					 <a href="javascript:modf('<?php echo $row['id'] ?>','edit')" class="b">Modify</a>&nbsp; | &nbsp;<a href="javascript:delet('<?php echo $row['id'] ?>','delet')" class="b">Delete</a> </div></td>
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
                  <td align="center" valign="top">
			<?php
		if($page_index != 1)
		{
			$pre=$page_index-1;
			
			?>
                      <input name="button" type="button"  class="fbutton" onclick="location.href='board_members.php?page_index=<?php echo "$pre" ?>'" value="Previous" />
                    &nbsp;
                    <?php
		}
		if($page_index < $pages)
   		{
   			$next=$page_index+1;			
			?>
                    <input name="button" type="button"  class="fbutton" onclick="location.href='board_members.php?page_index=<?php echo "$next" ?>'" value="  Next  " />
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