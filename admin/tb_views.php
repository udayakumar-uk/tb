<?php
ob_start();
session_start();
header("Cache-control: private"); 
include_once("include/includei.php");
if(!empty($_SESSION['tobadmin'])) {
?>

<?php
	function datepattrn($a) {
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
	function datepattrn1($a) {
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
?>



<!DOCTYPE html>
<html lang="en">
<head>
  	<?php include_once("head.php")?>
	<title>Statistics | Tobacco Board</title>
</head>
<body>

<section id="adminLayout">

	<?php include "header.php" ?>

	<?php include "sidebar.php"; ?>
	
	<main id="adminMain" class="container-fluid">

	<h2 class="admin-title">Views on TB Bill -2022 </h2>

	<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check(this);">

	  <?php
		$max_recs_per_page=30;
		$select=executework("select * from tb_views order by id");
		$count=@mysqli_num_rows($select);
      ?>

		<div class="d-flex align-items-center justify-content-between my-3">
			<h4 class="sub-title no-dash mb-0">Total - <?php echo $count ?></h4>

			<?php
			if ($count > 0) {
				if (empty($_GET['page_index'])) {
					$page_index=1;
				}	
				else {
					$page_index=$_GET['page_index'];
				}
				$total_recs = $count;
				$pages = $count / $max_recs_per_page; 
				if ($pages < 1) { 
					$pages = 1; 
				}
				if ($pages / (int) $pages <> 1) { 
					$pages = (int) $pages + 1; 
				} 
				else { 
					$pages = $pages; 
				}
				$page12=(int) $page_index;
				
				$pagenow1 = ($max_recs_per_page*($page12-1)); 

				$select1= executework("select * from tb_views order by id LIMIT $pagenow1, $max_recs_per_page");
				// $count1 = @mysqli_num_rows($sql1);
				
				if($pages > 1){ ?>
				<ul class="pagination">
				<?php for($im=1;$im<=$pages;$im++) {
					if($page12 != $im){ ?>
						<li class="page-item"><a class="page-link hlink1" href="statistics.php?page_index=<?php echo "$im" ?>"><?php echo "$im" ?></a></li>
					<?php } else{ ?>
						<li class="page-item active" aria-current="page"> <span class="page-link"><?php echo "$im" ?></span> </li>
					<?php } } ?>
				</ul>
				<?php } ?>
			</div>

	
		<div class="table-responsive">
			<table class="table table-bordered ">
				<thead class="text-center">
					<tr>
						<th>SL No </th>
						<th>Date </th>
						<th>Name</th>
						<th>Designation </th>
						<th>Contact No</th>
						<th>Email Id </th>
						<th>Place</th>
						<th>Views</th>
					</tr>
				</thead>
				<tbody>
	
                    <?php
					$i=$pagenow1+1;
					while($row=@mysqli_fetch_array($select1)) { ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo date('d-m-Y',strtotime($row['vdate'])); ?></td>
						<td><?php echo stripslashes($row['name']) ?></td>
						<td><?php echo stripslashes($row['designation']) ?></td>
						<td><?php echo stripslashes($row['mobile'])?></td>
						<td><?php echo stripslashes($row['email']) ?></td>
						<td><?php echo stripslashes($row['place']) ?></td>
						<td><?php echo stripslashes($row['views']) ?></td>
					</tr>
				<?php $i++; } } ?>
				</tbody>
			</table>
		</div>

		<?php if ($pages > 1) { ?>
			<div class="text-end">
				<?php if($page_index != 1){
					$pre=$page_index-1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='tb_views.php?page_index=<?php echo $pre ?>'" />Previous</button>
				<?php
				}
				if($page_index < $pages) {
				$next=$page_index+1; ?>
					<button name="button" type="button" class="btn btn-sm btn-primary fbutton" onclick="location.href='tb_views.php?page_index=<?php echo $next ?>'" />Next  </button>
				<?php } ?>
			</div>
        <?php } ?>

			
	</div>
</div>


</main>


</section>

<?php include_once("footer.php");?>





<!-- <script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
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
</script> -->


<script type="text/javascript">
function check(form1) {
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
	if(document.form1.tenderno.value=="") {
		alert("Tender Notice No Should Not Be Empty");
		document.form1.tenderno.focus();
		return false;
	}
	else if(document.form1.description.value=="") {
		alert("Description of Tender Should Not Be Empty")
		document.form1.description.focus();
		return false;
	}
	else if(document.form1.hdescription.value=="") {
		alert("Description of Tender In Hindi Should Not Be Empty")
		document.form1.hdescription.focus();
		return false;
	}
	else if(document.form1.mfile.value=="" && document.form1.ttype.value=="") {
		alert("Browse Tender File");
		document.form1.mfile.focus();
		return false;
	}
	else if(ext1!='jpg' && ext1!='jpeg' && ext1!='gif' && ext1!='png' && ext1!='txt' && ext1!='pdf' && ext1!='doc' && ext1!='docx' && ext1!='rar' && ext1!='zip' && document.form1.ttype.value=="") {
		alert("Only file types of txt,pdf,doc,docx,jpg,jpeg,png,gif,rar,zip are allowed for Tender Files");
		document.form1.tfile.value="";
		document.form1.tfile.focus();
		return false;
	}	
	else if(document.form1.tstatus.value=="") {
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
function delet(st,st1) {
	if(confirm("Are You sure to Delete Selected Tender Details Completely")) {
		location.href="tenders.php?id="+st+"&edit="+st1;
	}
}

function del(st,st1) {
	if(confirm("Are You sure to Move Archive Selected Tender Details")) {
		location.href="tenders.php?id="+st+"&edit="+st1;
	}
}
function modf(st,st1) {
	if(confirm("Are You sure to Modify Selected Tender Details")) {
		location.href="tenders.php?id="+st+"&edit="+st1;
	}
}
function back1() {
	location.href="tb_views.php";
}
</script>


<?php } else { ?>
	<script language="javascript">parent.location.href="index.php";</script>
<?php } ?>


</body>
</html>
