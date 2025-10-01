<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin']))
{

	if(!empty($_POST['subm']))
	{
		$selmax=executework("select max(id) from tob_cms");
		$rowm=@mysqli_fetch_array($selmax);
		if($rowm[0]!="")
		$max=$rowm[0]+1;
		else
		$max=1;
		
		$selpag=executework("select id from tob_page where title='".$_POST['title']."' and page='".$_POST['page']."'");
		$cntp=@mysqli_num_rows($selpag);
		if($cntp>0)
		{
			$rowp=@mysqli_fetch_array($selpag);
			$selplx=executework("select * from tob_cms where id=".$rowp['id']);
			$cntx=@mysqli_num_rows($selplx);
			if($cntx>0)
			{
				$rowx=@mysqli_fetch_array($selplx);
				$upcms=executework("update tob_cms set content='".addslashes($_POST['content'])."', hcontent='".addslashes($_POST['hcontent'])."' where id=".$rowx['id']);
				
			}
			else
			{
				$intcms=executework("insert into tob_cms values(".$max.",".$rowp['id'].",'".$_POST['content']."', '".$_POST['hcontent']."',1)");
			}
		}
		else
		{
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CMS | Welcome To TOBBACO BOARD Admin</title>
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
<link rel="stylesheet" type="text/css" href="../Scripts/home.css" />
<link rel="stylesheet" type="text/css" href="../Scripts/doctextsizer.css" />
</head>
<!-- TinyMCE -->
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
<!-- /TinyMCE -->
<script language="javascript">
function chk()
{
	document.form1.submit();
}

function validate()
{
	var cont=document.form1.content.value;
	if(document.form1.title.value=="")
	{
		alert("Please Select Menu Title");
		document.form1.title.focus();
		return false;
	}
	else if(document.form1.page.value=="")
	{
		alert("Please Select Page Name");
		document.form1.page.focus();
		return false;
	}
	else if(cont.length<=0)
	{
		alert("Please Enter Page Content");
		document.form1.content.focus();
		return false;
	}
	else
	{
		document.form1.subm.value=1;
		return true;
	}
}
</script>
<body>
<?php include_once("header12102019.php");?>
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

	function numround($st,$n)
	{
		if($st!="")
		{
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}

?>
<form action="page_cms.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validate();">
  <table width="90%" border="0" align="center">
    <tr>
      <td width="28%">&nbsp;</td>
      <td width="5%">&nbsp;</td>
      <td width="67%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><span class="style1"> CMS </span> </td>
    </tr>
    
	<?php
		if(!empty($exst) && $exst==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" class="style7" style="padding-left:150px;">Given Platform Alredy Exist </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==1)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">New Platform Added Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==2)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Platform Modified  Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==3)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Export Details Modified Successfully</span> </td>
    </tr>
	<?php
		}
		else if(!empty($_GET['succ']) && $_GET['succ']==4)
		{
	?>
    <tr>
      <td height="40" colspan="3" style="padding-left:150px;"><span class="style7">Selected Export Details Deleted Successfully</span> </td>
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
		$seltit=executework("select distinct title from tob_page where isactive=1");
	?>
    <tr>
      <td height="30" style="padding-left:35px;"><span class="style4">Menu Title </span></td>
      <td height="30"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <select name="title" id="title" onchange="chk();">
          <option value="" selected="selected">Select</option>
		  <?php
		  while($rowt=@mysqli_fetch_array($seltit))
		  {
		  ?>
          <option value="<?php echo $rowt['title'] ?>"><?php echo $rowt['title'] ?></option>
		  <?php
		  }
		  ?>
        </select>
      </label>
	  				<?php
					if(!empty($_POST['title']))
					{
					?>
                <script type="text/javascript">
					 var ct='<?php echo $_POST['title'] ?>';
					 var j;
					for(j=0;j<document.form1.title.options.length;j++)
					{
						if(document.form1.title.options[j].value==ct)
						{
							document.form1.title.options[j].selected=true;
						}
					}
					</script>
                <?php
					}
					if(!empty($_POST['title']))
		$selpag=executework("select distinct page from tob_page where title='".$_POST['title']."' and isactive=1");
				?>        </td>
    </tr>
    <tr id="ct">
      <td height="30" valign="top" style="padding-left:35px;"><span class="style4">Page Name </span></td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30"><label>
        <select name="page" id="page">
          <option value="">Select</option>
		  <?php
		  while($rowp=@mysqli_fetch_array($selpag))
		  {
		  ?>
          <option value="<?php echo $rowp['page'] ?>"><?php echo $rowp['page'] ?></option>
		  <?php
		  }
		  ?>
        </select>
        <?php

					if(!empty($_POST['page']))
					{
					?>
                <script type="text/javascript">
					 var ct='<?php echo $_POST['page'] ?>';
					 var j;
					for(j=0;j<document.form1.page.options.length;j++)
					{
						if(document.form1.page.options[j].value==ct)
						{
							document.form1.page.options[j].selected=true;
						}
					}
					</script>
                <?php
					}
				  ?>
      </label>
        &nbsp;&nbsp;&nbsp; <label>
        <input name="go" type="button" id="go" value="GO!!" onclick="chk();" />
        </label></td>
    </tr>
	<?php
	if(!empty($_POST['title']) && !empty($_POST['page']))
	{
		$selcn=executework("select * from tob_cms where id in(select id from tob_page where title='".$_POST['title']."' and page='".$_POST['page']."')");
		$rowcn=@mysqli_fetch_array($selcn);
	?>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Page Content </td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" colspan="3" valign="top" style="padding-left:35px;"><label>
        <textarea name="content" cols="120" rows="30" id="content"><?php echo $rowcn['content'] ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td height="30" valign="top" class="style4" style="padding-left:35px;">Hindi Page Content </td>
      <td height="30" valign="top"><div align="center"><strong>:</strong></div></td>
      <td height="30">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" colspan="3" valign="top" style="padding-left:35px;"><label>
        <textarea name="hcontent" cols="120" rows="30" id="hcontent"><?php echo $rowcn[3] ?></textarea>
      </label></td>
    </tr>
    
    <tr>
      <td height="50" colspan="3" class="style4" style="padding-left:35px;"><div align="center">
        <label>
        <input type="submit" name="Submit" value="Submit" />
        </label>
        <input name="subm" type="hidden" id="subm" />
      </div></td>
    </tr>
 	<?php
	}
	?>
   <tr>
      <td height="50" colspan="3" class="style4">&nbsp;</td>
    </tr>
  </table>
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
<script>
//chng();
</script>