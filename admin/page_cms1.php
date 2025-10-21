<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_POST['page_id']))
$page_id=$_POST['page_id'];
else if(!empty($_GET['page_id']))
$page_id=$_GET['page_id'];
else
$page_id='';
//if($page_id=='')
//redirect("adminmain.php");

if(!empty($_SESSION['tobadmin'])){

	if(!empty($_POST['subm'])){
		$selmax=executework("select max(id) from tob_cms");
		$rowm=@mysqli_fetch_array($selmax);
		if($rowm[0]!="")
		$max=$rowm[0]+1;
		else
		$max=1;
		
		$selpag=executework("select * from tob_pages where id='".$page_id."'");
		//$rowp=@mysqli_fetch_array($selpage);
		//$selpag=executework("select id from tob_page where title='".$_POST['title']."' and page='".$_POST['page']."'");
		$cntp=@mysqli_num_rows($selpag);
		
		if($cntp>0){
		$rowp=@mysqli_fetch_array($selpag);
		$selplx=executework("select tob_cms.* from tob_cms,tob_pages where tob_pages.id= tob_cms.pageid and tob_pages.id='".$page_id."'");
		//$cntn=@mysqli_num_rows($selcn);
			//$selplx=executework("select * from tob_cms where id=".$rowp['id']);
			$cntx=@mysqli_num_rows($selplx);
			if($cntx>0)
			{
				$rowx=@mysqli_fetch_array($selplx);
				$upcms=executework("update tob_cms set content='".addslashes($_POST['content'])."', hcontent='".addslashes($_POST['hcontent'])."' where id=".$rowx['id']);
				
			}
			else
			{
				$intcms=executework("insert into tob_cms values(".$max.",".$page_id.",'".$_POST['content']."', '".$_POST['hcontent']."',1)");
			}
			redirect("page_cms1.php?page_id=".$page_id);
		}
	}
?>



<?php

	function datepattrn($a){
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
	function datepattrn1($a){
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

	function numround($st,$n){
		if($st!=""){
			$n1=pow(10 ,$n);
			$num=round($st*$n1)/($n1);
		}
		return $num;
	}
$selpage=executework("select * from tob_pages where id='".$page_id."'");
$rowp=@mysqli_fetch_array($selpage);
$selcn=executework("select * from tob_cms,tob_pages where tob_pages.id= tob_cms.pageid and tob_pages.id='".$page_id."'");
$cntn=@mysqli_num_rows($selcn);
if($cntn>0){
	$rowcn=@mysqli_fetch_array($selcn);
	$content=$rowcn['content'];
	$hcontent=$rowcn['hcontent'];
}
else{
	$content='';
	$hcontent='';
}

$get=executework("select * from tob_pages where id='".$rowp['menu_id']."'");
$row00=@mysqli_fetch_array($get);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>CMS | Tobacco Board</title>
</head>


<body>
	
<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>

	<main id="adminMain" class="container-fluid">

		<div class="row">
			<h2 class="admin-title col-auto"><?php echo $row00['page']; ?> / <?php echo $rowp['page']; ?> </h2>

			<div class="col">
				<?php if(!empty($exst) && $exst==1){ ?>
					<div class="alert alert-danger d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">warning</span>
						<span>Given Platform Already Exists</span>
					</div>
				<?php } else if((!empty($_GET['succ']) && $_GET['succ']==1) || (!empty($_GET['succ']) && $_GET['succ']==2) || (!empty($_GET['succ']) && $_GET['succ']==3) || (!empty($_GET['succ']) && $_GET['succ']==4)){ ?>
					<div class="alert alert-success d-flex align-items-center py-1 px-2 m-0 ms-auto" role="alert">
						<span class="flex-shrink-0 me-2 material-symbols-rounded">check_circle</span>
						<?php if(!empty($_GET['succ']) && $_GET['succ']==1){ ?>
							<span> New Platform Added Successfully</span>
						<?php } else if(!empty($_GET['succ']) && $_GET['succ']==2){ ?>
							<span> Platform Modified Successfully </span>
						<?php } else if(!empty($_GET['succ']) && $_GET['succ']==3){ ?>
							<span>Selected Export Details Modified Successfully</span>
						<?php } else if(!empty($_GET['succ']) && $_GET['succ']==4){ ?>
							<span>Selected Export Details Deleted Successfully</span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>


	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validate();">

	<?php if(!empty($page_id)){	?>

		
		<div class="form-group">
			<label for="content" class="form-label">Page Content</label>
			<textarea name="content" cols="40" rows="5" class="form-control" placeholder="Leave a content" id="content"><?php echo $content; ?></textarea>
		</div>
		
		<div class="form-group">
			<label for="hcontent" class="form-label">Hindi Page Content</label>
			<textarea name="hcontent" cols="40" rows="5" class="form-control" placeholder="Leave a hcontent" id="hcontent"><?php echo $hcontent; ?></textarea>
		</div>

		<div class="submit-button text-end">
			<input name="subm" type="hidden" id="subm" />
			<input name="page_id" type="hidden" id="page_id" value="<?php echo $page_id; ?>" />
			<input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
    	</div>
 	<?php } ?>
	
</form>


</main>

</section>


<?php include_once("footer.php");?>

<?php include_once("tinymce.php");?>


<!-- <script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		selector: 'textarea', 
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
</script> -->


<script>
	function chk(){
		document.form1.submit();
	}

	function validate(){
		var cont=document.form1.content.value;
		document.form1.subm.value=1;
		return true;
	}
</script>



<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>