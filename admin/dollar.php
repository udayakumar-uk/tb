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
<title>Dollar Value | Welcome To TOBBACO BOARD Admin</title>
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
    if(document.form1.dollar.value=="")
	{
		alert("Enter Dollar Value")
		document.form1.dollar.focus();
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

	if(!empty($_POST['subm']))
	{
		//$tinsert=executework("insert into tob_dollar (dollar,created_by,created_on,status) values('".$_POST['dollar']."','". $_SESSION['tobadmin'] ."','". date('Y-m-d H:i:s') ."','1')");
		$upd=executework("update tob_dollar set dollar='".$_POST['dollar']."', modified_by='". $_SESSION['tobadmin']."', modified_on='".date('Y-m-d H:i:s')."' where id=1");
		redirect("dollar.php?succ=1");
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">
<?php
	$tselect=executework("select * from tob_dollar where id=1");
	$tcnt=@mysqli_num_rows($tselect);
	
		$trow=@mysqli_fetch_array($tselect);
?>
  <table width="90%" border="0" align="center">
    <tr>
      <td width="25%">&nbsp;</td>
      <td width="9%">&nbsp;</td>
      <td width="66%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1">Dollar Value</span> </td>
    </tr>
    
	<?php
		if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Dollar Value Modified Successfully</span> </td>
    </tr>
	<?php
		}
	?>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Dollar Value in Rs.</td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <input name="dollar" type="text" id="dollar" size="40" value="<?php echo $trow['dollar']?>" />
      </label></td>
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
  </table>
  <?php
  	
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
