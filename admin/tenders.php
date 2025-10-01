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
	var mfile=document.form1.mfile.value;
	var mflen=mfile.length;
	var dpos=mfile.indexOf(".");
	var ext=mfile.substr(dpos+1,mflen);
	var ext1=ext.toLowerCase();

	var tfile=document.form1.tfile.value;
	var tflen=tfile.length;
	var tpos=tfile.indexOf(".");
	var text=tfile.substr(tpos+1,tflen);
	var text1=text.toLowerCase();

	var sfile=document.form1.sfile.value;
	var sflen=sfile.length;
	var spos=sfile.indexOf(".");
	var sext=sfile.substr(spos+1,sflen);
	var sext1=sext.toLowerCase();
	if(document.form1.tenderno.value=="")
	{
		alert("Tender Notice No Should Not Be Empty");
		document.form1.tenderno.focus();
		return false;
	}
	else if(document.form1.description.value=="")
	{
		alert("Description of Tender Should Not Be Empty")
		document.form1.description.focus();
		return false;
	}
	else if(document.form1.hdescription.value=="")
	{
		alert("Description of Tender In Hindi Should Not Be Empty")
		document.form1.hdescription.focus();
		return false;
	}
	else if(document.form1.mfile.value=="" && document.form1.ttype.value=="")
	{
		alert("Browse Tender File");
		document.form1.mfile.focus();
		return false;
	}
	else if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png' && ext1!='txt' && ext1!='pdf' && ext1!='doc' && ext1!='docx' && ext1!='rar' && ext1!='zip' && document.form1.ttype.value=="")
	{
		alert("Only file types of txt,pdf,doc,docx,jpg,jpeg,png,gif,rar,zip are allowed for Tender Files");
		document.form1.tfile.value="";
		document.form1.tfile.focus();
		return false;
	}	
	else if(document.form1.tstatus.value=="")
	{
		alert("Status Should Not Be Empty");
		document.form1.tstatus.focus();
		return false		
	}
	else
	{
		document.form1.subm.value=1;
		return true
	}
}
function delet(st,st1)
{
	if(confirm("Are You sure to Delete Selected Tender Details Completely"))
	{
		location.href="tenders.php?id="+st+"&edit="+st1;
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
	if(confirm("Are You sure to Modify Selected Tender Details"))
	{
		location.href="tenders.php?id="+st+"&edit="+st1;
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
		$select=executework("select * from tob_tender where id='".$id."'");
		$drow=@mysqli_fetch_array($select);
		if($_GET['edit']=="delet")
		{
			$dir = "../tbdata/tenderfiles/";
			$filename = $drow['tfile'];
			unlink ($dir.$filename);
			$filen = $drow['mfile'];
			unlink ($dir.$filen);
			$files = $drow['sfile'];
			unlink ($dir.$files);
			
			$tupdate=executework("delete from tob_tender where id='".$id."'");	
			redirect("tenders.php?succ=4");
		}
		else if($_GET['edit']=="archive")
		{
			$tupdate=executework("update tob_tender set archive=1 where id='".$id."'");	
			redirect("tenders.php?succ=2");
		}
		else
		{
			if(!empty($_POST['subm']))
			{
				$pimage="tfile";
				$target_pathn = "../tbdata/tenderfiles/";
				$f1="";
				$f2="";
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$ef=$target_pathn .$drow['tfile'];
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
				
					if(file_exists($f1))
					unlink($f1);
					if(file_exists($ef))
					unlink($ef);
					
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
					$f2=",tfile='$f1' ";
				}
				
				$simage="sfile";
				$target_path= "../tbdata/tenderfiles/";
				$f3="";
				$f4="";
				if (!empty($_FILES[$simage]['name']))
				{
					$f3= basename($_FILES[$simage]['name']); 
					$ef1=$target_path.$drow['sfile'];
					$target_pathsm = $target_pathn .basename( $_FILES[$simage]['name']); 
					$f1=basename( $_FILES[$simage]['name']); 
				
					if(file_exists($f3))
					unlink($f3);
					if(file_exists($ef1))
					unlink($ef1);
					
					move_uploaded_file($_FILES[$simage]['tmp_name'], $target_pathsm);
					$f4=",sfile='$f3' ";
				}
				
				$mimage="mfile";
				$target_pathi= "../tbdata/tenderfiles/";
				$f5="";
				$f6="";
				if (!empty($_FILES[$mimage]['name']))
				{
					$f5= basename($_FILES[$mimage]['name']); 
					$ef2=$target_pathi.$drow['mfile'];
					$target_pathsmy = $target_pathn .basename( $_FILES[$mimage]['name']); 
					$f5=basename( $_FILES[$mimage]['name']); 
				
					if(file_exists($f5))
					unlink($f5);
					if(file_exists($ef2))
					unlink($ef2);
					
					move_uploaded_file($_FILES[$mimage]['tmp_name'], $target_pathsmy);
					$f6=",mfile='".$f5."' ";
				}
					if($_POST['tendr']=="")
					{
					$a=0;
					}
					else
					{
					$a=1;
					}
	$tinsert=executework("update tob_tender set tenderno='". $_POST['tenderno'] ."',description='".$_POST['description']."', hdescription='".$_POST['hdescription']."', subtitle1='".$_POST['subt1']."', subtitle2='".$_POST['subt2']."', tstatus='".$_POST['tstatus']."', award='".$_POST['award']."', home='". $_POST['home'] ."', isactive='".$a."'".$f2.$f4.$f6." where id='".$id."'");
					
					redirect("tenders.php?succ=3");
			}
		}
	}
	else if(!empty($_POST['subm']))
	{
		$date=date("Y-m-d",time()+19800);
		$tselect=executework("select * from tob_tender where tenderno='". $_POST['tenderno']."'");
		$tcnt=@mysqli_num_rows($tselect);
		if($tcnt>0)
		{
			redirect("tenders.php?exist=1");
		}
		else
		{
			$intmax=executework("SELECT max(id) from tob_tender");
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
			
				$mimage="mfile";
				$target_pathny = "../tbdata/tenderfiles/";
				$f10="";
				
				if (!empty($_FILES[$mimage]['name']))
				{
					$f10= basename($_FILES[$mimage]['name']); 
					$target_pathsy = $target_pathny .basename( $_FILES[$mimage]['name']); 
					$f10=basename( $_FILES[$mimage]['name']); 
					move_uploaded_file($_FILES[$mimage]['tmp_name'], $target_pathsy);
				}
				echo $f10;
			
				$pimage="tfile";
				$target_pathn = "../tbdata/tenderfiles/";
				$f1="";
				
				if (!empty($_FILES[$pimage]['name']))
				{
					$f1= basename($_FILES[$pimage]['name']); 
					$target_pathsmn = $target_pathn .basename( $_FILES[$pimage]['name']); 
					$f1=basename( $_FILES[$pimage]['name']); 
					move_uploaded_file($_FILES[$pimage]['tmp_name'], $target_pathsmn);
				}
				echo $f1;
				
				$simage="sfile";
				$target_path= "../tbdata/tenderfiles/";
				$f3="";
				
				if (!empty($_FILES[$simage]['name']))
				{
					$f3= basename($_FILES[$simage]['name']); 
					$target_pathsm = $target_path .basename( $_FILES[$simage]['name']); 
					$f3=basename( $_FILES[$simage]['name']); 
					move_uploaded_file($_FILES[$simage]['tmp_name'], $target_pathsm);
				}
				echo $f3;
				
				if(empty($_POST['tendr']))
				{
				$a=0;
				}
				else
				{
				$a=1;
				}
				if(!empty($_POST['home']))
				$home=1;
				else
				$home='';
			$tinsert=executework("insert into tob_tender values(".$maxid.",'".$date."','". $_POST['tenderno'] ."','". $_POST['description'] ."','". $_POST['hdescription'] ."','".$f10."','".$_POST['subt1']."','".$f1."','".$_POST['subt2']."','".$f3."','". $_POST['tstatus'] ."','".$_POST['award']."',0,'". $home ."','".$a."')");
			
			echo "insert into tob_tender values(".$maxid.",'".$date."','". $_POST['tenderno'] ."','". $_POST['description'] ."','". $_POST['hdescription'] ."','$f10','".$_POST['subt1']."','$f1','".$_POST['subt2']."','$f3','". $_POST['tstatus'] ."','".$_POST['award']."',0,'". $_POST['home'] ."','".$a."')";
			//echo "insert into tob_tender values($maxid,'$date','". $_POST[tenderno] ."','". $_POST[description] ."','". $_POST[hdescription] ."','".$_POST['title']."','".$_POST['subt1']."','$f1','".$_POST['subt2']."','$f2','". $_POST[tstatus] ."','".$_POST['award']."',0,'". $_POST[home] ."','".$a."')";
			redirect("tenders.php?succ=1");
		}
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
<?php
	$tselect=executework("select * from tob_tender where id='".$id."'");
	$tcnt=@mysqli_num_rows($tselect);
	if((empty($_GET['edit']) && empty($id)) || (!empty($_GET['edit']) && $tcnt>0))
	{
		$trow=@mysqli_fetch_array($tselect);
		if($trow['home']!="")
		$home="checked='checked'";
		else
		$home="";
		if($trow['isactive']!=0)
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
      <td colspan="3"><span class="style1">Post Tenders</span> </td>
    </tr>
    
	<?php
		if(isset($_GET['exist']) && $_GET['exist']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given Tender Details Alredy Exist </td>
    </tr>
	<?php
		}
		else if(isset($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">New Tender Posted Successfully</span> </td>
    </tr>
	<?php
		}
		else if(isset($_GET['succ']) && $_GET['succ']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Tender Successfully Move To Archives</span> </td>
    </tr>
	<?php
		}
		else if(isset($_GET['succ']) && $_GET['succ']==3)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Tender Details Modify Successfully</span> </td>
    </tr>
	<?php
		}
		else if(isset($_GET['succ']) && $_GET['succ']==4)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Tender Details Deleted Successfully</span> </td>
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
      <td height="30" style="padding-left:35px;"><span class="style4">Tender Notice No </span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input name="tenderno" type="text" id="tenderno" size="53" value="<?php if(!empty($trow['tenderno'])) echo $trow['tenderno'] ?>" />
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Description of Tender </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <textarea name="description" cols="40" rows="5" id="description"><?php if(!empty($trow['description'])) echo $trow['description'] ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Description of Tender (Hindi) </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <textarea name="hdescription" cols="40" rows="5" id="hdescription"><?php if(!empty($trow['hdescription'])) echo $trow['hdescription'] ?></textarea>
      </label></td>
    </tr>

    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Upload Tender File </td>
      <th height="30" valign="top"><div align="center">:</div></th>
      <td height="30" class="style8"><label>
	  	<?php if(!empty($trow['mfile'])){?><a href="../tbdata/tenderfiles/<?php echo $trow['mfile'] ?>" target="_blank">View File</a><br /><?php }?>
      <input name="mfile" type="file" id="mfile" />
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">&nbsp;</td>
      <th height="30" valign="top">&nbsp;</th>
      <td height="30" class="style8">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Subtitle1</td>
      <th height="30" valign="top"><div align="center">:</div></th>
      <td height="30" class="style8"><input name="subt1" type="text" id="subt1" size="53" value="<?php if(!empty($trow['subtitle1'])) echo $trow['subtitle1']?>" /></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Upload Tender File1 </td>
      <th height="30" valign="top"><div align="center"><strong>:</strong></div></th>
      <td height="30" class="style8">
	  	<?php if(!empty($trow['tfile'])){?><a href="../tbdata/tenderfiles/<?php echo $trow['tfile'] ?>" target="_blank">View File</a><br /><?php }?>
        <input name="tfile" type="file" id="tfile" />      </td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">&nbsp;</td>
      <th height="30" valign="top">&nbsp;</th>
      <td height="30" class="style8">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Subtitle2</td>
      <th height="30" valign="top"><div align="center">:</div></th>
      <td height="30" class="style8"><input name="subt2" type="text" id="subt2" size="53" value="<?php echo $trow['subtitle2'] ?>" /></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Upload Tender File2 </td>
      <th height="30" valign="top"><div align="center">:</div></th>
      <td height="30" class="style8">
<?php if(!empty($trow['sfile'])){?><a href="../tbdata/tenderfiles/<?php echo $trow['sfile']?>" target="_blank">View File</a><br /><?php }?>
	  <input name="sfile" type="file" id="sfile" /></td>
    </tr>
    <tr>
      <td height="30" class="style4" style="padding-left:35px;">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" class="style4" style="padding-left:35px;">Tender Status</td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><input name="tstatus" type="text" id="tstatus" size="53" value="<?php echo $trow['tstatus']?>" />
	  <input name="home" type="checkbox" id="home" value="1" <?php echo $home; ?>/>
        <span class="style8">Home</span></td>
    </tr>
    <tr>
      <td class="style4" style="padding-left:35px;">Awarded</td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <textarea name="award" cols="40" id="award"><?php echo $trow['award'] ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td height="50" class="style4" style="padding-left:35px;">Tender Closed</td>
      <td height="30"><div align="center">:</div></td>
      <td height="30"><input name="tendr" type="checkbox" id="tendr" value="1" <?php echo $actv;?>/></td>
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
		$max_recs_per_page=30;
		$select=executework("select * from tob_tender order by id desc");
		$count=@mysqli_num_rows($select);
      ?>
                    <table width="100%" align="center" cellpadding="0" cellspacing="4">
                      <tr>
                        <td colspan="4"><div align="center" class="style53"><font color="#0000FF" size="3" face="Arial, Helvetica, sans-serif"><strong><font color="#0000BF">Total Tenders - <?php echo $count ?></font></strong></font> </div></td>
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

	$select1= executework("select * from tob_tender order by id desc LIMIT $pagenow1, $max_recs_per_page");
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
                                <a href="tenders.php?page_index=<?php echo "$im" ?>" class="hlink1"><?php echo "$im" ?></a>&nbsp;
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
                      <td width="158" bgcolor="#FFFFFF"><div align="center"><span class="style8">Tender Notice No </span></div></td>
                      <td width="280" bgcolor="#FFFFFF"><div align="center" class="style8">Tender Descripotion</div></td>
                      <td width="102" bgcolor="#FFFFFF"><div align="center"><span class="style8">Tender Status </span></div></td>
                      <td width="81" bgcolor="#FFFFFF"><div align="center" class="style8">Awarded To </div></td>
                      <td width="81" bgcolor="#FFFFFF"><div align="center" class="style8">Status</div></td>
                      <td width="166" bgcolor="#FFFFFF"><div align="center" class="style8">Actions</div></td>
                      </tr>
                    <?php
			$i=$pagenow1+1;
			while($row=@mysqli_fetch_array($select1))
			{
				if(!empty($row['tfile']))
				$link="../tbdata/tenderfiles/".$row['mfile'];
				else
				$link="#";
		?>
                    <tr>
                      <td height="30" bgcolor="#FFFFFF" class="style17"><div align="center"><?php echo $i; ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" ><div align="center"><?php echo datepattrn($row['tdate']); ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><a href="<?php echo $link; ?>" target="<?php if($link!="#"){?>_blank<?php } ?>" class="b"><?php echo $row['tenderno'] ?></a></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px; padding-right:15px;"><div align="justify"><?php echo $row['description'] ?></div></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><?php echo $row['tstatus']?></td>
                      <td bgcolor="#FFFFFF" class="style17" style="padding-left:15px;"><?php echo $row['award']?></td>
                      <td bgcolor="#FFFFFF" class="style8" style="padding-left:15px;"><?php if($row['archive']==0) echo "Active"; else echo "Archive";?></td>
                      <td bgcolor="#FFFFFF"><div align="center" class="style8"><?php if($row['archive']==0){?><a href="javascript:modf('<?php echo $row['id'] ?>','edit')" class="b">Modify</a>&nbsp; | <a href="javascript:del('<?php echo $row['id'] ?>','archive')" class="b">Archives</a>&nbsp; | &nbsp;<?php } ?><a href="javascript:delet('<?php echo $row['id'] ?>','delet')" class="b">Delete</a> </div></td>
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
                      <input name="button" type="button"  class="fbutton" onclick="location.href='tenders.php?page_index=<? echo "$pre" ?>'" value="Previous" />
                    &nbsp;
                    <?php
		}
		if($page_index < $pages)
   		{
   			$next=$page_index+1;			
			?>
                    <input name="button" type="button"  class="fbutton" onclick="location.href='tenders.php?page_index=<? echo "$next" ?>'" value="  Next  " />
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