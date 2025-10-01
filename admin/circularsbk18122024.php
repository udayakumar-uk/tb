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
<title>Post Circulars | Welcome To TOBBACO BOARD Admin</title>
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
   
    if(document.form1.htitle.value=="")
	{
		alert("Circular Title In Hindi Should Not Be Empty")
		document.form1.htitle.focus();
		return false;
	}
    if(document.form1.title.value=="")
	{
		alert("Circular Title Should Not Be Empty")
		document.form1.title.focus();
		return false;
	}
    else if(document.form1.description.value=="")
	{
		alert("Description Should Not Be Empty")
		document.form1.description.focus();
		return false;
	}
    else if(document.form1.hdescription.value=="")
	{
		alert("Description In Hindi Should Not Be Empty")
		document.form1.hdescription.focus();
		return false;
	}
	else if(document.form1.tfile.value=="" && document.form1.ttype.value=="")
	{
		alert("Browse Circular File");
		document.form1.tfile.focus();
		return false;
	}
	else if(ext1!='jpg' && ext1!='jpeg' && ext1!='png' && ext1!='gif' && ext1!='txt' && ext1!='pdf' && ext1!='doc' && ext1!='docx' && document.form1.ttype.value=="" && document.form1.tfile.value!="")
	{
		alert("Only file types of txt,pdf,doc,docx,jpg,jpeg,gif are allowed for Circular Files");
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
	if(confirm("Are You sure to Delete Selected Circular Details Completely"))
	{
		location.href="circulars.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1)
{
	if(confirm("Are You sure to Move Archive Selected Circular Details"))
	{
		location.href="circulars.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1)
{
	if(confirm("Are You sure to Modify Selected Circular Details"))
	{
		location.href="circulars.php?id="+st+"&edit="+st1;
	}
}
function back1()
{
	location.href="circulars.php";
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
			$select=executework("select * from tob_circulars where id=".$id);
			$drow=@mysqli_fetch_array($select);
			$dir = "../tbdata/circularfiles/";
			$filename = $drow['tfile'];
			unlink ($dir.$filename);
			$tupdate=executework("delete from tob_circulars where id=".$id);	
			redirect("circulars.php?succ=4");
		}
		else if($_GET['edit']=="archive")
		{
			$tupdate=executework("update tob_circulars set archive=1 where id=".$id);	
			redirect("circulars.php?succ=2");
		}
		else
		{
			if(!empty($_POST['subm']))
			{
				$pimage="tfile";
				$target_pathn = "../tbdata/circularfiles/";
				$f1="";
				$f2="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn ."cir".$id.basename( $_FILES[$pimage]['name']); 
					$f1="cir".$id.basename( $_FILES[$pimage]['name']); 
				
					if(file_exists($f1))
					unlink($f1);
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
					$f2=",tfile='$f1' ";
				}
					$tinsert=executework("update tob_circulars set stype='".$_POST['stype']."',title='". $_POST['title'] ."',htitle='". $_POST['htitle'] ."',description='". $_POST['description'] ."',hdescription='". $_POST['hdescription'] ."'$f2 where id=".$id);
					redirect("circulars.php?succ=3");
			}
		}
	}
	else if(!empty($_POST['subm']))
	{
		$date=date("Y-m-d",time()+19800);
		$tselect=executework("select * from tob_circulars where title='". $_POST['title']."'");
		$tcnt=@mysqli_num_rows($tselect);
		if($tcnt>0)
		{
			redirect("circulars.php?exist=1");
		}
		else
		{
			$intmax=executework("SELECT max(id) from tob_circulars");
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
				$target_pathn = "../tbdata/circularfiles/";
				$f1="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn ."cir".$maxid.basename( $_FILES[$pimage]['name']); 
					$f1="cir".$maxid.basename( $_FILES[$pimage]['name']); 
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
				}
			//$tinsert=executework("insert into tob_circulars values($maxid,'$date','". $_POST['title'] ."','". $_POST['htitle'] ."','". $_POST['description'] ."','". $_POST['hdescription'] ."','$f1',0)");
			$tinsert=executework("insert into tob_circulars (ndate,stype,title,htitle,description,hdescription,tfile,archive) values('$date','".$_POST['stype']."','". $_POST['title'] ."','". $_POST['htitle'] ."','". $_POST['description'] ."','". $_POST['hdescription'] ."','$f1',0)");
			redirect("circulars.php?succ=1");
		}
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
<?php
	$tselect=executework("select * from tob_circulars where id=".$id);
	$tcnt=@mysqli_num_rows($tselect);
	if((empty($_GET['edit']) && empty($id)) || (!empty($_GET['edit']) && $tcnt>0))
	{
		$trow=@mysqli_fetch_array($tselect);
?>
  <table width="90%" border="0" align="center">
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="9%">&nbsp;</td>
      <td width="66%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Post Circulars </span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['exist']) && $_GET['exist']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given  Circular Details Alredy Exist </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">New Circular  Posted Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Circular Successfully Move To Archives</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==3)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Circular Details Modify Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==4)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Circular Details Deleted Successfully</span> </td>
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
      <td height="30" style="padding-left:35px;"><span class="style4">Circular Type </span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <select name="stype" id="stype">
          <option value="">Select </option>
          <option value="Grower Community">Grower Community</option>
          <option value="Trader Community">Trader Community</option>
          <option value="Official">Official</option>
        </select>
        <?php
					if(!empty($trow['stype']))
					$stype=$trow['stype'];
					else if(!empty($_POST['stype']))
					$stype=$_POST['stype'];
					else
					$stype='';

					if($stype!="")
					{
					?>
        <script type="text/javascript">
					 var stype='<?php echo $stype ?>';
					 var j;
					for(j=1;j<=document.form1.stype.options.length;j++)
					{
						if(document.form1.stype.options[j].value==stype)
						{
							document.form1.stype.options[j].selected=true;
						}
					}
					</script>
        <?php
					}
				  ?>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Title</td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input name="title" type="text" id="title" size="40" value="<?php echo $trow['title']?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Title (Hindi) </td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input name="htitle" type="text" id="htitle" size="40" value="<?php echo $trow['htitle']?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Description of Circular </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
      <textarea name="description" cols="40" rows="5" id="description"><?php echo $trow['description']?></textarea>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Description of Circular (Hindi) </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <textarea name="hdescription" cols="40" rows="5" id="hdescription"><?php echo $trow['hdescription']?></textarea>
      </label></td>
    </tr>

    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Upload  File </td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30" class="style8">
	  	<?php if(!empty($trow['tfile'])){?><a href="../tbdata/circularfiles/<?php echo $trow['tfile']?>" target="_blank">View File</a><br />
	  	<?php }?>
      <input name="tfile" type="file" id="tfile" />      </td>
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
	  <input name="ttype" type="hidden" id="ttype" value="<?php if(!empty($_GET['edit'])) echo $_GET['edit']; ?>" /></td>
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
		$select=executework("select * from tob_circulars order by id desc");
		$count=@mysqli_num_rows($select);
      ?>
                    <table width="80%" align="center" cellpadding="0" cellspacing="4">
                      <tr>
                        <td colspan="4"><div align="center" class="style53"><font color="#0000FF" size="3" face="Arial, Helvetica, sans-serif"><strong><font color="#0000BF">Total Circulars - <?php echo $count ?></font></strong></font> </div></td>
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

	$select1= executework("select * from tob_circulars order by id desc LIMIT $pagenow1, $max_recs_per_page");
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
                                <a href="circulars.php?page_index=<?php echo "$im" ?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                      <td width="30" height="30" bgcolor="#FFFFFF"><div align="center"><span class="style8">SL No </span></div></td>
                      <td width="149" bgcolor="#FFFFFF"><div align="center" class="style8">Circular Type </div></td>
                      <td width="66" bgcolor="#FFFFFF"><div align="center" class="style8">Date</div></td>
                      <td width="149" bgcolor="#FFFFFF"><div align="center" class="style8">Circular Title </div></td>
                      <td width="331" bgcolor="#FFFFFF"><div align="center" class="style8">Tender Descripotion</div></td>
                      <td width="61" bgcolor="#FFFFFF"><div align="center" class="style8">Status</div></td>
                      <td width="145" bgcolor="#FFFFFF"><div align="center" class="style8">Actions</div></td>
                      </tr>
                    <?php
			$i=$pagenow1+1;
			while($row=@mysqli_fetch_array($select1))
			{
				if(!empty($row['tfile']))
				$link="../tbdata/circularfiles/".$row['tfile'];
				else
				$link="#";
		?>
                    <tr>
                      <td height="30" bgcolor="#FFFFFF" class="style17"><div align="center"><?php echo $i; ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="justify"><a href="<?php echo $link;?>" target="<?php if($link!="#"){?>_blank<?php }?>" class="b"><?php echo $row['stype']?></a></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="center"><?php echo datepattrn($row['ndate']); ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="justify"><a href="<?php echo $link;?>" target="<?php if($link!="#"){?>_blank<?php }?>" class="b"><?php echo $row['title']?></a></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="justify"><?php echo $row['description']?></div></td>
                      <td bgcolor="#FFFFFF" class="style8" style="padding-left:15px;"><?php if($row['archive']==0) echo "Active"; else echo "Archive";?></td>
                      <td bgcolor="#FFFFFF"><div align="center" class="style8"><?php if($row['archive']==0){?><a href="javascript:modf('<?php echo $row['id'] ?>','edit')" class="b">Modify</a>&nbsp; | &nbsp;<a href="javascript:del('<?php echo $row['id'] ?>','archive')" class="b">Archives</a>&nbsp; | &nbsp;<?php }?><a href="javascript:delet('<?php echo $row['id'] ?>','delet')" class="b">Delete</a> </div></td>
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
                      <input name="button" type="button"  class="fbutton" onclick="location.href='circulars.php?page_index=<?php echo "$pre" ?>'" value="Previous" />
                    &nbsp;
                    <?php
		}
		if($page_index < $pages)
   		{
   			$next=$page_index+1;			
			?>
                    <input name="button" type="button"  class="fbutton" onclick="location.href='circulars.php?page_index=<?php echo "$next" ?>'" value="  Next  " />
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
