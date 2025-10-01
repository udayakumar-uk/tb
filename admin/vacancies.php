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
<title>Post Vacancies | Welcome To TOBBACO BOARD Admin</title>
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
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
//		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'},
			{title : 'New Style', inline : 'span', classes : 'style4'}
		],

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
	var tfile=document.form1.tfile.value;
	var tflen=tfile.length;
	var dpos=tfile.indexOf(".");
	var ext=tfile.substr(dpos+1,tflen);
	var ext1=ext.toLowerCase();
/*	if(document.form1.tenderno.value=="")
	{
		alert("Tender Notice No Should Not Be Empty");
		document.form1.tenderno.focus();
		return false;
	}
*/
	if(document.form1.description.value=="")
	{
		alert("Description of Tender Should Not Be Empty")
		document.form1.description.focus();
		return false;
	}
	else if(document.form1.hdescription.value=="")
	{
		alert("Hindi Description of Tender Should Not Be Empty")
		document.form1.hdescription.focus();
		return false;
	}
/*	else if(document.form1.tfile.value=="" && document.form1.ttype.value=="")
	{
		alert("Browse Tender File");
		document.form1.tfile.focus();
		return false;
	}
*/	else if(ext1!="" && ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png' && ext1!='txt' && ext1!='pdf' && ext1!='doc' && ext1!='docx' && document.form1.ttype.value=="")
	{
		alert("Only file types of txt,pdf,doc,docx,jpg,jpeg,gif,png are allowed for Tender Files");
		document.form1.tfile.value="";
		document.form1.tfile.focus();
		return false;
	}	
/*	else if(document.form1.tstatus.value=="")
	{
		alert("Status Should Not Be Empty");
		document.form1.tstatus.focus();
		return false		
	}
*/	else
	{
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1)
{
	if(confirm("Are You sure to Delete Selected Details Completely"))
	{
		location.href="vacancies.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1)
{
	if(confirm("Are You sure to Move Archive Selected Details"))
	{
		location.href="vacancies.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1)
{
	if(confirm("Are You sure to Modify Selected Details"))
	{
		location.href="vacancies.php?id="+st+"&edit="+st1;
	}
}
function back1()
{
	location.href="vacancies.php";
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
		if($_GET['edit']=="delet")
		{
			$select=executework("select * from tob_vacancies where id=".$id);
			$drow=@mysqli_fetch_array($select);
			$dir = "../tbdata/vacanciesfiles/";
			$filename = $drow['tfile'];
			unlink ($dir.$filename);
			$tupdate=executework("delete from tob_vacancies where id=".$id);	
			redirect("vacancies.php?succ=4");
		}
		else if($_GET['edit']=="archive")
		{
			$tupdate=executework("update tob_vacancies set archive=1 where id=".$id);	
			redirect("vacancies.php?succ=2");
		}
		else
		{
			if(!empty($_POST['subm']))
			{
				$pimage="tfile";
				$target_pathn = "../tbdata/vacanciesfiles/";
				$f1="";
				$f2="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
				
					if(file_exists($f1))
					unlink($f1);
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
					$f2=",tfile='$f1' ";
				}
					if($_POST['tendr']=="")
					{
					$a=0;
					}
					else
					{
					$a=1;
					}
					$tinsert=executework("update tob_vacancies set tenderno='". $_POST['tenderno'] ."',description='". $_POST['description'] ."',hdescription='". $_POST['hdescription'] ."',tstatus='". $_POST['tstatus'] ."',home='".$a."'$f2 where id=".$id);
					redirect("vacancies.php?succ=3");
			}
		}
	}
	else if(!empty($_POST['subm']))
	{
		$date=date("Y-m-d",time()+19800);
		$tselect=executework("select * from tob_vacancies where description='". $_POST['description']."'");
		$tcnt=@mysqli_num_rows($tselect);
		if($tcnt>0)
		{
			redirect("vacancies.php?exist=1");
		}
		else
		{
			$intmax=executework("SELECT max(id) from tob_vacancies");
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
				$target_pathn = "../tbdata/vacanciesfiles/";
				$f1="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
				}
					if($_POST['tendr']=="")
					{
					$a=0;
					}
					else
					{
					$a=1;
					}
			$tinsert=executework("insert into tob_vacancies values($maxid,'$date','". $_POST['tenderno'] ."','". $_POST['description'] ."','". $_POST['hdescription'] ."','$f1','". $_POST['tstatus'] ."',0,'".$a."')");
			redirect("vacancies.php?succ=1");
		}
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
<?php
	$tselect=executework("select * from tob_vacancies where id='".$id."'");
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
      <td colspan="3"><span class="style1">Post Vacancies </span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['exist']) && $_GET['exist']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given Vacancies Details Alredy Exist </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">New Vacancies Posted Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Vacancies Details Successfully Move To Archives</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==3)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Vacancies Details Modify Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==4)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Vacancies Details Deleted Successfully</span> </td>
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
      <td height="30" style="padding-left:35px;"><span class="style4"> Notice No </span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input name="tenderno" type="text" id="tenderno" size="53" value="<?php echo $trow['tenderno']?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Description  </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
      <textarea name="description" cols="40" rows="5" id="description"><?php echo $trow['description']?></textarea>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Hindi Description </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <textarea name="hdescription" cols="40" rows="5" id="hdescription"><?php echo $trow['hdescription']?></textarea>
      </label></td>
    </tr>

    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Upload  File </td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30" class="style8">
	  	<?php if(!empty($trow['tfile'])){?><a href="../tbdata/vacanciesfiles/<?php echo $trow['tfile']?>" target="_blank">View File</a><br /><?php }?>
        <input name="tfile" type="file" id="tfile" />      </td>
    </tr>
    <tr>
      <td height="30" class="style4" style="padding-left:35px;"> Status</td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><input name="tstatus" type="text" id="tstatus" size="53" value="<?php echo $trow['tstatus']?>" /></td>
    </tr>
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">Show In Home Page </td>
      <td height="30"><div align="center">:</div></td>
      <td height="30"><input name="tendr" type="checkbox" id="tendr" value="1" <?php echo $home ?>/></td>
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
	  <input name="ttype" type="hidden" id="ttype" value="<?php if(!empty($_GET['edit'])) echo $_GET['edit']?>" /></td>
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
		$select=executework("select * from tob_vacancies order by id desc");
		$count=@mysqli_num_rows($select);
      ?>
                    <table width="100%" align="center" cellpadding="0" cellspacing="4">
                      <tr>
                        <td colspan="4"><div align="center" class="style53"><font color="#0000FF" size="3" face="Arial, Helvetica, sans-serif"><strong><font color="#0000BF">Total Vacancies - <?php echo $count ?></font></strong></font> </div></td>
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

	$select1= executework("select * from tob_vacancies order by id desc LIMIT $pagenow1, $max_recs_per_page");
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
                                <a href="vacancies.php?page_index=<?php echo "$im" ?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                      <td width="34" height="30" bgcolor="#FFFFFF"><div align="center"><span class="style8">SL No </span></div></td>
                      <td width="99" bgcolor="#FFFFFF"><div align="center"><span class="style8">Date </span></div></td>
                      <td width="280" bgcolor="#FFFFFF"><div align="center" class="style8"> Descripotion</div></td>
                      <td width="280" bgcolor="#FFFFFF"><div align="center" class="style8"> Hindi Descripotion</div></td>
                      <td width="158" bgcolor="#FFFFFF"><div align="center"><span class="style8"> Notice No </span></div></td>
                      <td width="102" bgcolor="#FFFFFF"><div align="center"><span class="style8">Vacancie Status </span></div></td>
                      <td width="81" bgcolor="#FFFFFF"><div align="center" class="style8">Status</div></td>
                      <td width="166" bgcolor="#FFFFFF"><div align="center" class="style8">Actions</div></td>
                      </tr>
                    <?php
			$i=$pagenow1+1;
			while($row=@mysqli_fetch_array($select1))
			{
				if(!empty($row['tfile']))
				$link="../tbdata/vacanciesfiles/".$row['tfile'];
				else
				$link="#";
		?>
                    <tr>
                      <td height="30" bgcolor="#FFFFFF" class="style17"><div align="center"><?php echo $i; ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" ><div align="center"><?php echo datepattrn($row['tdate']);?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="justify"><?php echo $row['description']?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="justify"><?php echo $row['hdescription']?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><a href="<?php echo $link;?>" target="<?php if($link!="#"){?>_blank<?php }?>" class="b"><?php echo $row['tenderno']?></a></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><?php echo $row['tstatus']?></td>
                      <td bgcolor="#FFFFFF" class="style8" style="padding-left:15px;"><?php if($row['archive']==0) echo "Active"; else echo "Archive";?></td>
                      <td bgcolor="#FFFFFF"><div align="center" class="style8"><?php if($row['archive']==0){?><a href="javascript:modf('<?php echo $row['id'] ?>','edit')" class="b">Modify</a>&nbsp; | <a href="javascript:del('<?php echo $row['id'] ?>','archive')" class="b">Archives</a>&nbsp; | &nbsp;<?php }?><a href="javascript:delet('<?php echo $row['id'] ?>','delet')" class="b">Delete</a> </div></td>
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
                      <input name="button" type="button"  class="fbutton" onclick="location.href='vacancies.php?page_index=<?php echo "$pre" ?>'" value="Previous" />
                    &nbsp;
                    <?php
		}
		if($page_index < $pages)
   		{
   			$next=$page_index+1;			
			?>
                    <input name="button" type="button"  class="fbutton" onclick="location.href='vacancies.php?page_index=<?php echo "$next" ?>'" value="  Next  " />
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